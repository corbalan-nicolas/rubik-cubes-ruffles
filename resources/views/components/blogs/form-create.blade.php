<button id="form-create-blog-open-dialog-btn">✍ Write new blog</button>

<!--TODO: Show feedback and open the modal if there's any error -->
<dialog id="form-create-blog-dialog">
    <div id="form-create-blog-dialog-container">
        <header>
            Create new blog
            <button type="button" id="form-create-blog-close-dialog-btn">Cancel</button>
        </header>
        <form action="{{ route('dashboard.blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="cover">
                    <span class="sr-only">Cover</span>
                </label>
                <input class="hidden" type="file" id="cover" name="cover">
            </div>

            <div>
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

            <div>
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

            <button>That's it, let me start writing!!</button>
        </form>
    </div>
</dialog>


<script defer>
    // Variables
    const $dialog = document.querySelector('#form-create-blog-dialog')
    const $dialogContainer = document.querySelector('#form-create-blog-dialog-container')
    const $btnOpen = document.querySelector('#form-create-blog-open-dialog-btn')
    const $btnClose = document.querySelector('#form-create-blog-close-dialog-btn')

    // Events
    $btnOpen.addEventListener('click', handleOpenDialog)
    $btnClose.addEventListener('click', handleCloseDialog)
    $dialog.addEventListener('click', handleCloseDialog)
    $dialogContainer.addEventListener('click', (event) => event.stopPropagation())

    // Methods
    function handleOpenDialog() {
        $dialog.showModal()
    }

    function handleCloseDialog() {
        $dialog.close()
    }

    // Init
    document.querySelector('#root-modal').append($dialog)
</script>

<style>

</style>
