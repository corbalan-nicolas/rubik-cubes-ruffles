<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

<article class="grid grid-rows-[auto_1fr]">
    <div>
        <x-blogs.cover :blog="$blog" />
    </div>
    <div class="grid grid-rows-[1fr_auto]">
        <div class="bg-neutral-lighter py-2 px-4 min-w-0">
            <h3 class="truncate">{{ $blog->title ?? 'Untitled blog' }}</h3>
            <p class="card__desc">{{ $blog->desc }}</p>
        </div>

        <div class="p-2 bg-neutral-light flex justify-end items-center gap-4">
            <button
                class="btn btn-danger"
                data-open-modal-confirm-delete
                data-blog="{{$blog->title}}"
                data-route="{{route('dashboard.blogs.destroy', ['blog' => $blog->id])}}"
            >Delete</button>
            <a class="btn btn-primary" href="{{ route('dashboard.blogs.edit', ['id' => $blog->id]) }}">Edit</a>
        </div>
    </div>
</article>
