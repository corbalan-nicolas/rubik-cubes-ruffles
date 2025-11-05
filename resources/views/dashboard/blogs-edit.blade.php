<?php
/**
 * TODO: View documentation
 * @var $blog
 *
 * All this markdown thing was made following this guide (very useful!): https://javascript.plainenglish.io/how-i-built-a-markdown-editor-in-vanilla-javascript-live-preview-included-350dd8066873
 */
?>

{{--
TODO: Implement RTE (Rich-text-editor)
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
        >Show / hide options</button>
    </header>

    <main id="main">
        <div>
            <div id="editor">
                {!! $blog->body !!}
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
const $formControls = document.querySelectorAll(':is(input, textarea, #editor)')
let saveTimeout = null;

const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Start writing...'
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
