<?php
/**
 * TODO view documentation
 * @var $blogs
 */
?>

<x-layouts.main>
    <x-slot:title>Nuestros Blogs</x-slot:title>

    <div class="container-sm">
        <h2 class="sr-only">Blogs</h2>

        <h3>Search</h3>
        <form action="{{ route('blogs.index') }}" method="GET">
            @csrf
            <label for="q">Title</label>
            <input type="search" id="q" name="q" placeholder="Search...">
            <button>Search</button>
        </form>

        @forelse($blogs as $blog)
            <article>
                {{--<img src="{{ $blog->cover }}" alt="{{ $blog->cover_alt ?? 'Blog\'s cover' }}">--}}
                <h3>{{ $blog->title }}</h3>
                <small>Author: {{ $blog->author->display_name }}</small>
                <p>{{ $blog->desc }}</p>
                <a href="{{ route('blogs.show', ['id' => $blog->id]) }}">See more</a>
            </article>
        @empty
            <p>Ups! There's not any published blog</p>
        @endforelse
    </div>
</x-layouts.main>
