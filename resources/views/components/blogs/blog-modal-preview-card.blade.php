<?php
/**
 * This component is meant to be in the same document as the "blog-modal-preview.blade.php"
 * here's the button to open the modal, the modal has the respective JavaScript
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

<article class="bg-neutral-light grid grid-cols-[auto_1fr]">
    <x-blogs.cover :blog="$blog" />

    <div class="grid grid-rows-[1fr_auto]">
        <div class="py-2 px-4">
            <p class="text-xl font-h">{{ $blog->title }}</p>
            <p class="text-sm">Wrote it by {{ $blog->author->display_name }}</p>
        </div>

        <div class="flex py-2 px-4 justify-end">
            <button
                class="btn btn-primary"
                data-blog-modal-preview-provider
                data-blog='@json($blog)'
            >Review</button>
        </div>
    </div>
</article>
