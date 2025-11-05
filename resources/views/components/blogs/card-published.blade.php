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
            <p>{{ $blog->desc }}</p>
        </div>
        <div class="card__actions">
            <button
                class="btn"
                data-open-modal-confirm-cancel-validation
                data-blog="{{$blog->title}}"
                data-route="{{route('dashboard.blogs.move_to_draft', ['blog' => $blog->id])}}"
            >Unpublish</button>
            <a class="btn btn-primary" href="{{ route('blogs.show', ['id' => $blog->id]) }}">See more</a>
        </div>
    </div>
</article>
