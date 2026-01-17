<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 * @var \Illuminate\Database\Eloquent\Collection $categories
 */

?>

{{--
RTE documentation:
https://quilljs.com/docs/quickstart
--}}

<x-layouts.blog-editor>
    <x-slot:title>{{ $blog->title }}</x-slot:title>

    <header class="flex justify-between items-center py-2 px-4 bg-neutral-lighter border-b-black/10">
        <div class="flex items-center gap-4">
            <a
                href="{{ route('dashboard.blogs') }}"
                title="Go back to dashboard"
                aria-label="Go back to dashboard"
            >
                <img class="h-12" src="{{ url('/images/brand/qubo-isotype-theme-white.svg') }}" alt="Qubo's logo">
            </a>

            <div class="header__title">
                <h1 class="text-lg">Editing Blog</h1>
                <p id="saving-feedback" class="text-sm font-light">Every change will be automatically saved</p>
            </div>
        </div>

        <button
            id="btn-options"
            aria-controls="options"
{{--            title="Show / hide sidebar"--}}
        >
{{--            <x-icons.sidebar-right />--}}
            <span class="sr-onlyy">Show / hide sidebar</span>
        </button>
    </header>

    <main id="main" class="overflow-hidden grid grid-cols-1 grid-rows-1 has-[#options.active]:grid-cols-[7.5fr_2.5fr]">
        <div>
            <div
                id="editor"
                class="h-full blog-body"
            >
                {!! $blog->body ?? '' !!}
            </div>
        </div>

        <div id="options" class="not-[.active]:hidden active bg-neutral-light p-4">
            <div>
                <div class="mb-4">
                    <label for="cover" title="Change blog's cover">
                        <x-blogs.cover class="w-full cursor-pointer hover:brightness-90" :blog="$blog" />
                    </label>
                    <div class="hidden">
                        <input
                            id="cover"
                            type="file"
                            name="cover"
                            data-save-on="change"
                        >
                    </div>
                </div>

                <div class="mb-4">
                    <label for="cover_alt">Cover description</label>
                    <input
                        id="cover_alt"
                        class="input"
                        type="text"
                        name="cover_alt"
                        placeholder="Description provided for blind users"
                        data-save-on="input"
                        value="{{ old('cover_alt', $blog->cover_alt) }}"
                    >
                </div>
            </div>

            <div class="mb-4">
                <label for="title">Title <span>*</span></label>
                <input id="title"
                       class="input"
                       type="text"
                       name="title"
                       data-save-on="input"
                       value="{{old('title', $blog->title)}}"
                >
            </div>

            <div class="mb-4">
                <label for="desc">Description <span>*</span></label>
                <textarea
                    name="desc"
                    class="textarea"
                    id="desc"
                    data-save-on="input"
                >{{old('desc', $blog->desc)}}</textarea>
            </div>

            <div class="mb-4">
                <label for="categories">Categories *</label>
                {{-- https://slimselectjs.com/selects#multiple TODO: Apply customize styling --}}
                <select id="categories" name="categories[]" multiple>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(in_array($category->id, $blog->getCategoryIds()))
                        >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            @if(auth()->user()->role_id < 4)
                <form id="publish-form" action="{{ route('dashboard.blogs.request_publish', ['blog' => $blog->id === 0 ? -666 : $blog->id]) }}" method="post">
                    @csrf

                    @if($errors->any())
                        <div class="bg-red-900/10 p-2 my-4 animate-highlight">
                            <div class="flex gap-2 items-center">
                                <x-icons.danger />
                                <p id="publish-error" class="text-sm">Your blog has some errors</p>
                            </div>
                            <ul class="text-sm ps-4 mt-2 list-disc">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button id="publish-button" class="btn btn-primary btn-full">Request for publish</button>
                </form>
            @else
                <form id="publish-form" action="{{ route('dashboard.blogs.publish', ['blog' => $blog->id === 0 ? -666 : $blog->id]) }}" method="post">
                    @csrf
                    <button id="publish-button" class="btn btn-primary btn-full">Publish</button>
                </form>
            @endif
        </div>
    </main>
</x-layouts.blog-editor>

{{--
    SCRIPT
--}}
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
// VARIABLES
const $formControls = document.querySelectorAll(':is(input, textarea, selector)')
let saveTimeout = null;
let blogId = {{ $blog->id }};
let isDoingTheFirstFetch = undefined

const toolbar = [
    [{'header': ['normal', '1', '2','3','4','5','6']}],
    ['bold', 'italic', 'underline', 'strike', 'link'],
    [{list: 'ordered'}, {list:'bullet'}],
    ['image', 'video']
]
const quill = new Quill('#editor', {
    modules: {
      toolbar
    },
    theme: 'snow',
    placeholder: 'Start writing...'
})

let categories = []
const slimSelect = new SlimSelect({
    select: '#categories',
    events: {
        afterChange: (newValue) => {
            categories = newValue
            handleInput()
        }
    }
})

const $btnOpenAndCloseOptions = document.querySelector('#btn-options')
const $containerOptions = document.querySelector('#options')



// Events
$formControls.forEach($control => $control.addEventListener('input', handleInput))
quill.on('text-change', handleInput)
$btnOpenAndCloseOptions.addEventListener('click', () => $containerOptions.classList.toggle('active'))
window.addEventListener('pagehide', () => {
    if(blogId === 0) return

    console.log('pagehide event')
    const data = getFormData()
    let url = "{{ route('dashboard.blogs.update', ['id' => -666])}}"
    url = url.replace('-666', blogId)

    navigator.sendBeacon(url, data)
})



// Methods
function handleInput() {
    document.querySelector('#saving-feedback').innerText = 'Saving...'
    document.querySelector('#publish-button').disabled = true // This is not perfect, but it works at least for the first time

    if (saveTimeout !== null) {
        clearTimeout(saveTimeout)
    }

    saveTimeout = setTimeout(handleTimeout, 1000)
}

async function handleTimeout() {
    const formData = getFormData()
    await fetchSave(formData)

    saveTimeout = null
    document.querySelector('#saving-feedback').innerText = 'Saved'
}

function getFormData() {
    /* https://muffinman.io/blog/uploading-files-using-fetch-multipart-form-data/
       https://developer.mozilla.org/en-US/docs/Web/API/FormData*/
    // console.log('getFormData()')
    const formData = new FormData()

    formData.append('_token', '{{ @csrf_token() }}');

    formData.append('title', document.querySelector('#title')?.value ?? '')
    formData.append('desc', document.querySelector('#desc')?.value)
    formData.append('body', quill.root.innerHTML)
    categories.forEach(category => {
        formData.append('categories[]', category.value)
    })

    formData.append('cover', document.querySelector('#cover')?.files[0] ?? '{{ $blog->cover }}')
    formData.append('cover_alt', document.querySelector('#cover_alt')?.value)

    return formData
}

async function fetchSave(body) {
    if (blogId === 0 && isDoingTheFirstFetch) {
        return
    }

    if (isDoingTheFirstFetch === undefined) {
        isDoingTheFirstFetch = true
    }

    let url = "{{ route('dashboard.blogs.update', ['id' => -666])}}"
    url = url.replace('-666', blogId)
    const options = {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body,
    }

    const response = await fetch(url, options)
    const { error, data } = await response.json()

    if (error) {
        console.error('[blogs-edit.blade.php fetchSave()] Error during save', error)
        return
    }

    updateUIElements({...data})
}

function updateUIElements({cover = '', cover_alt = '', just_created = false, id = 0}) {
    const baseStoragePath = '{{ str_replace('\\', '/', \Storage::url('/')) }}';
    const $cover = document.querySelector(`#cover-${blogId}`)

    if (cover !== '' && cover !== 'undefined' && cover !== null) {
        $cover.src = baseStoragePath + cover
    }

    if (cover_alt !== '' && cover !== 'undefined' && cover !== null) {
        $cover.alt = cover_alt ?? ''
    }

    if (just_created) {
        console.log('Blog just created...')
        const $publishForm = document.querySelector('#publish-form')
        blogId = id

        $publishForm.action = $publishForm.action.replace('-666', blogId)
        $cover.id = `cover-${blogId}`

        const newUrl = location.pathname + '/' + blogId
        history.replaceState({}, '', newUrl)

        handleInput() // If the user has changed something during the first fetch, I want to save it
    }

    isDoingTheFirstFetch = false
    document.querySelector('#publish-button').disabled = false
}
</script>
