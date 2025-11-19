<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>


<img
    id="cover-{{ $blog->id }}"
    class="{{ $class }}"
    src="{{ $blog->cover ? \Storage::url($blog->cover) : url('/images/no-cover-3-2.webp') }}"
    alt="{{ $blog->cover_alt ?? '' }}"
>
