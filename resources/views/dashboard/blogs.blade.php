<?php
/**
 * TODO view documentation
 * @var \Illuminate\Database\Eloquent\Collection $blogsDraft
 * @var \Illuminate\Database\Eloquent\Collection $blogsValidating
 * @var \Illuminate\Database\Eloquent\Collection $blogsPublished
 * @var boolean $hasBlogs
 */
?>

<x-layouts.dashboard>
    <x-slot:title>My blogs</x-slot:title>

    <h1>My blogs</h1>

    <x-blogs.form-create />

    @if (!$hasBlogs)
        <p>You don't have any blogs yet 🤸‍♂️</p>
    @endif

    @if (count($blogsDraft))
        <section>
            <h2>Drafts</h2>
            @foreach($blogsDraft as $blog)
                <x-blogs.card-draft :blog="$blog" />
            @endforeach
        </section>
    @endif

    @if (count($blogsValidating))
        <section>
            <h2>Awaiting validation</h2>
            @foreach($blogsValidating as $blog)
                <x-blogs.card-validating :blog="$blog" />
            @endforeach
        </section>
    @endif

    @if (count($blogsPublished))
        <section>
            <h2>Published</h2>
            <p>Thank you for being part of this!</p>
            @foreach($blogsPublished as $blog)
                <x-blogs.card-published :blog="$blog" />
            @endforeach
        </section>
    @endif
</x-layouts.dashboard>
