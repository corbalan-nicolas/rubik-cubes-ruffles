<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

<article>
    <h3>{{ $blog->title ?? 'Untitled blog' }}</h3>
    <p>{{ $blog->desc }}</p>
    <button>Unpublish</button>
</article>
