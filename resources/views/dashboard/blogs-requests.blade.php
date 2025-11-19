<?php
/**
 * TODO: View documentation
 */
?>

<x-layouts.dashboard>
    <x-slot:title>Publish requests</x-slot:title>

    <h2 class="text-6xl mb-4">Publish requests</h2>

    @forelse($requests as $blog)
        <x-blogs.blog-modal-preview-card :blog="$blog" />

        @if($loop->last)
            <x-blogs.blog-modal-preview />
        @endif
    @empty
        <p>No more publishing requests here! Thank you for your work :)</p>
    @endforelse
</x-layouts.dashboard>
