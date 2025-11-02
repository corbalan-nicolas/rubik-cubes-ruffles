<?php
/**
 * TODO: View documentation
 */
?>

<x-layouts.dashboard>
    <x-slot:title>Publish requests</x-slot:title>

    <h1>Publish requests</h1>

    @forelse($requests as $blog)
        @if($loop->first)
            <p>First loop</p>
        @endif

        <article>
            {{ $blog->title }}

            <x-blogs.blog-modal-preview :blog="$blog"></x-blogs.blog-modal-preview>
        </article>
    @empty
        <p>No more publishing requests here! Thank you for your work :)</p>
    @endforelse
</x-layouts.dashboard>
