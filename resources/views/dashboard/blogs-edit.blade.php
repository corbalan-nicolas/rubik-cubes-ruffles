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

    <header>
        <div>
            <a
                href="{{ route('dashboard.blogs') }}"
                title="Go back to dashboard"
                aria-label="Go back to dashboard"
            >
                <img id="go-back" src="{{ url('/images/brand/qubo-isotype-theme-white.svg') }}" alt="Qubo's logo">
            </a>

            <div class="header__title">
                <h1>Edit Blog</h1>
                <p id="saving-feedback">Every change will be automatically saved</p>
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

    <main id="main">
        <div>
            <div id="editor">
                {!! $blog->body ?? '' !!}
            </div>
        </div>

        <div id="options" class="active">
            <div>
                <div>
                    <label for="cover" title="Change blog's cover">
                        <span class="sr-only">Cover (set or change)</span>
                        <x-blogs.cover :blog="$blog" />
                    </label>
                    <input
                        class="sr-only"
                        id="cover"
                        type="file"
                        name="cover"
                        data-save-on="change"
                    >
                </div>

                <div>
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

            <div>
                <label for="title">Title <span>*</span></label>
                <input id="title"
                       class="input"
                       type="text"
                       name="title"
                       data-save-on="input"
                       value="{{old('title', $blog->title)}}"
                >
            </div>

            <div>
                <label for="desc">Description <span>*</span></label>
                <textarea
                    name="desc"
                    class="textarea"
                    id="desc"
                    data-save-on="input"
                >{{old('desc', $blog->desc)}}</textarea>
            </div>

            <div>
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
                <form action="{{ route('dashboard.blogs.request_publish', ['blog' => $blog->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-primary btn-full">Request for publish</button>
                </form>
            @else
                <form action="{{ route('dashboard.blogs.publish', ['blog' => $blog->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-primary btn-full">Publish</button>
                </form>
            @endif
        </div>
    </main>
</x-layouts.blog-editor>

{{--
    SCRIPT
--}}
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script defer>
// VARIABLES
const $formControls = document.querySelectorAll(':is(input, textarea, #editor, selector)')
let saveTimeout = null;

const quill = new Quill('#editor', {
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



$formControls.forEach($control => $control.addEventListener('input', handleInput))
$btnOpenAndCloseOptions.addEventListener('click', () => $containerOptions.classList.toggle('active'))



function handleInput() {
    document.querySelector('#saving-feedback').innerText = 'Saving...'

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
    formData.append('body', quill.getSemanticHTML())
    categories.forEach(category => {
        formData.append('categories[]', category.value)
    })

    formData.append('cover', document.querySelector('#cover')?.files[0] ?? '{{ $blog->cover }}')
    formData.append('cover_alt', document.querySelector('#cover_alt')?.value)

    return formData
}

async function fetchSave(body) {
    // console.log('fetchSave()')
    const url = "{{ route('dashboard.blogs.update', ['id' => $blog->id]) }}"
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

function updateUIElements({cover = '', cover_alt = ''}) {
    const baseStoragePath = '{{ str_replace('\\', '/', \Storage::url('/')) }}';

    if (cover !== '' && cover !== 'undefined' && cover !== null) {
        document.querySelector('#cover-{{$blog->id}}').src = baseStoragePath + cover
    }

    if (cover_alt !== '' && cover !== 'undefined' && cover !== null) {
        document.querySelector('#cover-{{$blog->id}}').alt = cover_alt ?? ''
    }
}
</script>
