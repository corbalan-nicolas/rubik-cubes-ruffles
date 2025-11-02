<?php
/**
 * TODO view documentation
 * @var $blogs
 */
?>

<x-layouts.main>
    <x-slot:title>Nuestros Blogs</x-slot:title>

    <h1>Blogs</h1>

    @forelse($blogs as $blog)
        <article>
            {{--<img src="{{ $blog->cover }}" alt="{{ $blog->cover_alt ?? 'Blog\'s cover' }}">--}}
            <h2>{{ $blog->title }}</h2>
            <small>Author: {{ $blog->author->display_name }}</small>
            <p>{{ $blog->desc }}</p>
            <a href="{{ route('blogs.show', ['id' => $blog->id]) }}">See more</a>
        </article>
    @empty
        <p>Ups! There's not any published blog</p>
    @endforelse
</x-layouts.main>
