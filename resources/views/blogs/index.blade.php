<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection $blogs
 */
?>

<x-layouts.main>
    <x-slot:title>Nuestros Blogs</x-slot:title>

    <div class="container-sm">
        <h2 class="sr-only">Blogs</h2>

        {{--<h3>Search</h3>
        <form action="{{ route('blogs.index') }}" method="GET">
            @csrf
            <label for="q">Title</label>
            <input type="search" id="q" name="q" placeholder="Search...">
            <button>Search</button>
        </form>--}}

        <section class="pt-4">
            @forelse($blogs as $blog)
                <article class="grid grid-cols-[auto_1fr] mb-4">
                    <div>
                        <x-blogs.cover :blog="$blog" />
                    </div>
                    <div class="bg-neutral-lighter py-2 px-4 min-w-0">
                        <div class="">
                            <h3 class="text-xl">
                                {{ $blog->title ?? 'Untitled blog' }}
                            </h3>
                            <p class="text-sm font-light">Wrote it by {{ $blog->author->display_name }}</p>
                            <p class="card__desc">{{ $blog->desc }}, published on</p>

                            <a
                                href="{{ route('blogs.show', ['id' => $blog->id]) }}"
                                class="border py-2 px-4 inline-block"
                            >See more</a>
                        </div>
                    </div>
                </article>
            @empty
                <p>Whoops! There's not any published blog</p>
            @endforelse
        </section>
    </div>
</x-layouts.main>
