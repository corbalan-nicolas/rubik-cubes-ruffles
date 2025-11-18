<?php
/**
 * This component is meant to be in the same document as the "blog-modal-preview.blade.php"
 * here's the button to open the modal, the modal has the respective JavaScript
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

<article>
    <p>{{ $blog->title }}</p>
    <p>Wrote it by {{ $blog->author->display_name }}</p>

    <button
        data-blog-modal-preview-provider
        data-blog='@json($blog)'
    >Review</button>
</article>
