<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

<article class="card">
    <div class="card__cover">
        <x-blogs.cover :blog="$blog" />
    </div>
    <div class="card__body">
        <div class="card__info">
            <h3 class="card__title">{{ $blog->title ?? 'Untitled blog' }}</h3>
            <p class="card__desc">{{ $blog->desc }}</p>
        </div>

        <div class="card__actions">
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
