<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

@if ($blog->cover !== null && \Storage::exists($blog->cover))
    <img class="user-cover" src="{{ \Storage::url($blog->cover) }}" alt="{{ $blog->cover_alt }}">
@else
    <img src="{{ url('/images/no-cover-3-2.webp') }}" alt="No cover illustration">
@endif

<style>
    .user-cover {
        /* TODO: Change this line bellow */
        max-width: min(100%, 300px);
    }
</style>
