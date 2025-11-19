<?php
/**
 * This modal has to be open through an HTML element that has a
 * data-open-form-create-blog attribute. For now, it's meant to be
 * open with 1 single button / element, so if you have multiple
 * elements with data-open-form-create-blog it will only take the
 * first one founded
 */

$dialogSelector = \Illuminate\Support\Str::uuid();
$dialogSelector= 'hola-mundo';
?>

<!--TODO: Show feedback and open the modal if there's any error -->
<dialog id="{{ $dialogSelector }}" class="m-auto">
    <div id="form-create-blog-dialog-container" class="bg-neutral">
        <header class="flex justify-between items-center">
            <h2 class="px-2 text-xl">Create new blog</h2>
            <button
                class="btn btn-icon modal__btn-close"
                type="button"
                data-close-form-create-blog
            >
                <x-icons.close />
                <span class="sr-only">Close</span>
            </button>
        </header>
        <form class="p-4" action="{{ route('dashboard.blogs.store') }}" method="post">
            @csrf

            <div>
                <div class="mb-4">
                    <label for="title">Title <span>*</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        @error('title')
                        aria-invalid="true"
                        aria-errormessage="title-error"
                        @enderror
                    >
                    @error('title')
                    <small id="title-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="desc">Description <span>*</span></label>
                    <textarea
                        name="desc"
                        id="desc"
                        @error('desc')
                        aria-invalid="true"
                        aria-errormessage="desc-error"
                    @enderror
                >{{ old('desc') }}</textarea>
                    @error('desc')
                    <small id="desc-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div>
                <button class="btn btn-full btn-primary">That's it, let me start writing!!</button>
            </div>
        </form>
    </div>
</dialog>


<script defer>
    const FormCreate = {
        $dialog: document.querySelector('[id="{{ $dialogSelector }}"]'),
        $opener: document.querySelector('[data-open-form-create-blog]'),
        $closer: document.querySelector('[data-close-form-create-blog]'),

        handleOpen() {
            this.$dialog.showModal()
        },

        handleClose() {
            this.$dialog.close()
        }
    }

    FormCreate.$opener.addEventListener('click', () => FormCreate.handleOpen())
    FormCreate.$closer.addEventListener('click', () => FormCreate.handleClose())
</script>

<style>

</style>
