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
--}}

<x-layouts.blog-edit>
    <x-slot:title>{{ $blog->title }}</x-slot:title>

    <header>
        <a href="{{ route('dashboard.blogs') }}">Go back to dashboard</a>

        <label title="Editor">
            <input type="radio" name="display-controls" value="editor" checked>
            <span class="sr-only">Editor</span>
        </label>
        <label title="Editor and Preview">
            <input type="radio" name="display-controls" value="editor-and-preview">
            <span class="sr-only">Editor and preview</span>
        </label>
        <label title="Preview">
            <input type="radio" name="display-controls" value="preview">
            <span class="sr-only">Preview</span>
        </label>
    </header>

    <h1>Edit Blog</h1>
    <p>Every change will be automatically saved</p>
    <span id="save-state">{{-- Empty / Saving... / Saved --}}</span>

    <main id="main">
        <textarea id="markdown" aria-label="Your blog's body" data-save-on="input" name="body"
        >{{ old('body', $blog->body) }}</textarea>

        <div id="preview"></div>

        <div id="options">
            <div>
                <label for="cover">
                    <span class="sr-only">Cover (set or change)</span>
                    <img src="{{ old('cover', $blog->cover) }}" alt="{{ old('cover_alt', $blog->cover_alt) }}">
                    Cover: {{ $blog->cover }}
                </label>
                <input
                    id="cover"
                    type="file"
                    name="cover"
                    data-save-on="change"
                >

                <label for="cover_alt">Cover description</label>
                <input
                    id="cover_alt"
                    type="text"
                    name="cover_alt"
                    placeholder="Description provided for blind users"
                    data-save-on="input"
                    value="{{ old('cover_alt', $blog->cover_alt) }}"
                >
            </div>

            <div>
                <label for="title">Title <span>*</span></label>
                <input id="title"
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
                    id="desc"
                    data-save-on="input"
                >{{old('desc', $blog->desc)}}</textarea>
            </div>

            @if(auth()->user()->role_id < 4)
                <form action="{{ route('dashboard.blogs.request_publish', ['blog' => $blog->id]) }}" method="post">
                    @csrf
                    <button>Request for publish</button>
                </form>
            @else
                <form action="{{ route('dashboard.blogs.publish', ['blog' => $blog->id]) }}" method="post">
                    @csrf
                    <button>Publish</button>
                </form>
            @endif
        </div>
    </main>
</x-layouts.blog-edit>

{{--
    SCRIPT
--}}
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script defer>
// VARIABLES
const $ = (selector) => document.querySelector(selector)
const $$ = (selector) => document.querySelectorAll(selector)

let saveTimeout = null
let saveState = ''

const $markdown = $('#markdown');
const $preview = $('#preview');
const $displayControllers = $$('[name="display-controls"]')

// Form fields
const $body = $markdown
const $title = $('#title')
const $desc = $('#desc')
const $cover = $('#cover')
const $cover_alt = $('#cover_alt')


// EVENTS
$displayControllers.forEach(elem => elem.addEventListener('change', setDisplayClassNames))
$markdown.addEventListener('input', async () => {
    updatePreview()
})
$$('[data-save-on]').forEach(elem => {
    const event = elem.dataset.saveOn
    elem.addEventListener(event, handleSave)
})



// METHODS
function setDisplayClassNames() {
    const display = $('[name="display-controls"]:checked').value

    $markdown.className = 'hidden'
    $preview.className = 'hidden'

    if (display.includes('editor')) {
        $markdown.className = 'block'
    }

    if (display.includes('preview')) {
        $preview.className = 'block'
    }
}

function updatePreview() {
    const markdown = $markdown.value
    const html = marked.parse(markdown)

    $preview.innerHTML = html
}

/**
 * This function will be called after 1 sec on those HTMLElements that has the attribute <data-save-on="JS_EVENT">
 */
function handleSave(event) {
    if(saveTimeout !== null) {
        clearTimeout(saveTimeout)
    }

    setSaveState('Saving...')
    saveTimeout = setTimeout(async () => {
        // FETCH
        const fetchBody = {
            _token: <?= '"'. csrf_token() .'"' ?>,
            body: $body.value,
            title: $title.value,
            desc: $desc.value,
            cover: $cover.value,
            cover_alt: $cover_alt.value,
        }

        const url = '<?= route('dashboard.blogs.update', ['id' => $blog->id]) ?>';
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(fetchBody)
        }

        const res = await fetch(url, options)

        // console.log(res)
        // console.log(<?='"'. csrf_token() . '"' ?>)
        // console.log(url, options, event.currentTarget, res)
        // TODO: cancel the previous fetch if there's one

        clearTimeout(saveTimeout)
        saveTimeout = null
        setSaveState('Saved')
    }, 1000)
}

function setSaveState(text) {
    saveState = text
    ;$('#save-state').innerText = saveState
}



// INIT
setDisplayClassNames()
updatePreview()
</script>
