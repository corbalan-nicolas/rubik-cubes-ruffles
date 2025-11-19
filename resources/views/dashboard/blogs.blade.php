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

    <button data-open-form-create-blog>Write new blog</button>
    <x-blogs.form-create />

    @if (!$hasBlogs)
        <p>You don't have any blogs yet 🤸‍♂️</p>
    @endif

    @if (count($blogsDraft))
        <section>
            <h2>Drafts</h2>
            <div class="grid gap-4 grid-cols-[repeat(auto-fit,300px)]">
                @foreach($blogsDraft as $blog)
                    <x-blogs.card-draft :blog="$blog" />
                @endforeach
            </div>
        </section>
    @endif

    @if (count($blogsValidating))
        <section>
            <h2>Awaiting validation</h2>
            <div class="grid gap-4 grid-cols-[repeat(auto-fit,300px)]">
                @foreach($blogsValidating as $blog)
                    <x-blogs.card-validating :blog="$blog" />
                @endforeach
            </div>
        </section>
    @endif

    @if (count($blogsPublished))
        <section>
            <h2>Published</h2>
            <p>Thank you for being part of this!</p>

            {{-- Should I let the user unpublish any blog whenever they want? Or should this also be a request?
             Honestly, I'm not really sure tbh, but I'll allow it just to keep things simple 🤷‍♂️ --}}
            <div class="grid gap-4 grid-cols-[repeat(auto-fit,300px)]">
                @foreach($blogsPublished as $blog)
                    <x-blogs.card-published :blog="$blog" />
                @endforeach
            </div>
        </section>
    @endif

    <!-- MODAL CONFIRM DELETE -->
    <dialog id="modal-confirm-delete">
        <div>
            <form id="modal-confirm-delete-form" action="#" method="post">
                @csrf

                <p>
                    Are you sure you want to delete eliminate "<span id="modal-confirm-delete-blog"></span>"?
                    This action cannot be undone.
                </p>

                {{--<label>
                    <span>Just to make sure, type "delete" to confirm</span>
                    <input type="text" name="confirm">
                </label>--}}

                <!--
                Ok / Cancel, or Cancel / Okay
                https://ux.stackexchange.com/questions/112757/what-order-should-a-dialog-boxes-options-appear-in
                https://uxplanet.org/primary-secondary-action-buttons-c16df9b36150
                 -->
                <button>Delete</button>
                <button id="modal-confirm-delete-btn-close" type="button">Cancel</button>
            </form>
        </div>
    </dialog>
    {{-- I will be honest with you, I don't think this should be here,
    so if I forget to move it anywhere else, I'm sorry :( --}}
    <script defer>
        const $modalConfirmDelete = document.querySelector('#modal-confirm-delete')
        const $form = document.querySelector('#modal-confirm-delete-form')
        const $blog = document.querySelector('#modal-confirm-delete-blog')
        const $btnOpenModalConfirmDelete = document.querySelectorAll('[data-open-modal-confirm-delete]')
        const $btnCloseModalConfirmDelete = document.querySelector('#modal-confirm-delete-btn-close')



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


    <!-- MODAL CONFIRM CANCEL REQUEST -->
    <dialog id="modal-confirm-cancel-validation">
        <div>
            <form id="modal-confirm-cancel-validation-form" action="#" method="post">
                @csrf

                <p>Are you sure you want to move "<span id="modal-confirm-cancel-validation-blog"></span>" to your drafts?</p>

                <button>Move to draft</button>
                <button id="modal-confirm-cancel-validation-btn-close" type="button">Cancel</button>
            </form>
        </div>
    </dialog>

    <script defer>
        const $modalConfirmCancelValidation = document.querySelector('#modal-confirm-cancel-validation')
        const $formConfirmCancelValidation = document.querySelector('#modal-confirm-cancel-validation-form')
        const $blogConfirmCancelValidation = document.querySelector('#modal-confirm-cancel-validation-blog')
        const $btnOpenModalConfirmCancelValidation = document.querySelectorAll('[data-open-modal-confirm-cancel-validation]')
        const $btnCloseModalConfirmCancelValidation = document.querySelector('#modal-confirm-cancel-validation-btn-close')


        $btnCloseModalConfirmCancelValidation.addEventListener('click', () => $modalConfirmCancelValidation.close())
        $btnOpenModalConfirmCancelValidation.forEach($btn => $btn.addEventListener('click', handleClick))



        function handleClick(event) {
            const route = event.currentTarget.dataset.route
            const blog = event.currentTarget.dataset.blog

            $formConfirmCancelValidation.action = route
            $blogConfirmCancelValidation.innerText = blog

            $modalConfirmCancelValidation.showModal()
        }
    </script>
</x-layouts.dashboard>
