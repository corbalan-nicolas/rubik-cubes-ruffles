<?php
/**
 * TODO: Blade template documentation
 * @var $blog;
 * @var $html_body
 */

/*
In terms of usability, I'm thinking this like those "Twitch's unban requests". Of course it's not going to be as
good as theirs, but I'll try my best :)

Like, for example, when you accept a publishing request, it should automatically go to the next one, and when you
deny a publishing request, you should leave some feedback for the author, etc.
*/
?>

<!-- aria-controls would be appropriate here? -->
<button id="btn-modal-preview-{{ $blog->id }}">Show preview</button>

<dialog id="modal-preview-{{ $blog->id }}">
    <div>
        <header>
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->author->name }}</p>
        </header>
        <main>
            {!! $html_body !!}
        </main>


        <!-- TODO: Let the admin to put some feedback (especially on "deny_publish") -->
        <form action="{{ route('dashboard.blogs.deny_publish', ['blog' => $blog->id]) }}" method="post">
            @csrf
            <button>Deny publish</button>
        </form>

        <!-- Eventually I might want to use this on another page, but for now
         I'll assume that this is going to be used only for publish-requests -->
        <form action="{{ route('dashboard.blogs.allow_publish', ['blog' => $blog->id]) }}" method="post">
            @csrf
            <button>Allow to publish</button>
        </form>
    </div>
</dialog>

<script defer>
    const $btn = document.querySelector('#btn-modal-preview-{{ $blog->id }}')
    const $modal = document.querySelector('#modal-preview-{{ $blog->id }}')

    $btn.addEventListener('click', () => $modal.showModal())
</script>
