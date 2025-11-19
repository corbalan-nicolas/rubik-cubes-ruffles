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

    <section class="bg-neutral-light">
        <div class="container-sm flex justify-start items-end pb-2 pt-60">
            <p class="text-xl">Published by <span class="font-bold">{{ $blog->author->display_name }}</span></p>
        </div>
    </section>

    <div class="container-sm py-2">
        @foreach($blog->categories as $category)
            <span class="text-sm inline-block px-4 bg-white/80 rounded-full">{{$category->name}}</span>
        @endforeach
    </div>

    <section class="container-sm overflow-hidden blog-body">
        {!! $blog->body !!}
    </section>

{{--    <form action="{{ route('blogs.like', ['id' => $blog->id]) }}" method="POST">--}}
{{--        @csrf--}}
{{--        <button>--}}
{{--            Like this blog--}}
{{--        </button>--}}
{{--    </form>--}}

    <a class="fixed bottom-4 right-4 border p-2" href="#">
        <x-icons.up />
        <span class="sr-only">Go up</span>
    </a>
</x-layouts.main>
