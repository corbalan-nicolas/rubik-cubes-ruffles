<?php
/**
 * TODO view documentation
 * @var $blog
 * @var $html_body
 */
?>

<x-layouts.main>
    <x-slot:title>{{ $blog->title }}</x-slot:title>
    <x-slot:desc>{{ $blog->desc }}</x-slot:desc>

    <section class="blog-header">
        <div class="container-sm">
            <p class="author">Published by {{ $blog->author->display_name }}</p>

            @foreach($blog->categories as $category)
                <span class="badge">{{$category->name}}</span>
            @endforeach
        </div>
    </section>

    <section class="container-sm blog-body">
        {!! $blog->body !!}
    </section>

    <form action="{{ route('blogs.like', ['id' => $blog->id]) }}" method="POST">
        @csrf
        <button>
            Like this blog
        </button>
    </form>

    <a id="go-up" class="btn btn-icon" href="#">
        <x-icons.up />
        <span class="sr-only">Go up</span>
    </a>
</x-layouts.main>
