<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

<article>
    <h3>{{ $blog->title ?? 'Untitled blog' }}</h3>
    <p>{{ $blog->desc }}</p>
    <a href="{{ route('dashboard.blogs.edit', ['id' => $blog->id]) }}">Edit</a>
</article>
