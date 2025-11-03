<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $blog
 */
?>

<article>
    <x-blogs.cover :blog="$blog" />
    <h3>{{ $blog->title ?? 'Untitled blog' }}</h3>
    <p>{{ $blog->desc }}</p>
    <a href="{{ route('dashboard.blogs.edit', ['id' => $blog->id]) }}">Edit</a>

    <button
        data-open-modal-confirm-delete
        data-blog="{{$blog->title}}"
        data-route="{{route('dashboard.blogs.destroy', ['blog' => $blog->id])}}"
    >Delete</button>

    @once
        <dialog id="modal-confirm-delete">
            <div>
                <form id="modal-confirm-delete-form" action="#" mehod="post">
                    @csrf

                    <p>Are you sure you want to delete "<span id="modal-confirm-delete-blog"></span>"?</p>
                    <small class="bold">This action has no rollback</small>

                    <!-- I'm pretty sure I've read something about this kind of modal.
                    It was about the order of the buttons. It said that when a modal appears,
                    the users usually click the right button without reading anything
                    so in these cases it's better to have the button that actually deletes
                    on the left (in this case is "delete", but it could be any other action)
                     -->
                    <button >Delete</button>
                    <button id="modal-confirm-delete-btn-close" type="button">Cancel</button>
                </form>
            </div>
        </dialog>

        <script defer>
            const $modalConfirmDelete = document.querySelector('#modal-confirm-delete')
            const $form = document.querySelector('#modal-confirm-delete-form')
            const $blog = document.querySelector('#modal-confirm-delete-blog')
            const $btnOpenModalConfirmDelete = document.querySelectorAll('[data-open-modal-confirm-delete]')
            const $btnCloseModalConfirmDelete = document.querySelector('#modal-confirm-delete-btn-close')

            let formAction = ''
            let blogName = ''



            $btnCloseModalConfirmDelete.addEventListener('click', () => $modalConfirmDelete.close())
            $btnOpenModalConfirmDelete.forEach($btn => $btn.addEventListener('click', handleClick))



            function handleClick(event) {
                const route = event.currentTarget.dataset.route
                const blog = event.currentTarget.dataset.blog

                $form.action = route
                $blog.innerText = blog

                $modalConfirmDelete.showModal()
            }
        </script>
    @endonce
</article>
