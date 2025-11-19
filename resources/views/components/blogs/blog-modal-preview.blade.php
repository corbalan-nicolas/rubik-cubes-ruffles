<?php
/**
 * This component is meant to be with the component blog-modal-preview-card,
 * this is the component that will provide all the information to this one
 */

$modalSelector = 'blog-modal-preview';
?>

<dialog id="{{ $modalSelector }}" class="m-auto backdrop:bg-black/60">
    <div class="bg-neutral">
        <div class="flex justify-between items-center border-b border-black/10 bg-neutral-lighter">
            <div class="py-2 px-4">
                <h2 id="{{ $modalSelector }}__title" class="text-xl">__BLOG_TITLE__</h2>
                <p class="text-sm">Wrote it by <span id="{{ $modalSelector }}__author">__AUTHOR__</span></p>
            </div>

            <button
                class="px-4 block border"
                data-close-modal
                aria-label="Close modal">
                <x-icons.close />
            </button>
        </div>

        <div id="{{ $modalSelector }}__body" class="py-2 px-4">
            __BLOG_BODY__
        </div>


        <footer class="bg-neutral-light py-2 px-4">
            <form id="{{ $modalSelector }}__form" action="#" method="post">
                @csrf

                <div class="flex justify-start items-center gap-4 mb-4">
                    <label class="py-1 px-3 border has-checked:bg-red-300 has-focus-visible:ring-1 ring-blue-300">
                        <input class="sr-only" type="radio" name="result" value="deny">
                        <span>Deny</span>
                    </label>

                    <label class="py-1 px-3 border has-checked:bg-blue-300 has-focus-visible:ring-1 ring-blue-300">
                        <input class="sr-only" type="radio" name="result" value="allow">
                        <span>Allow</span>
                    </label>
                </div>

                <label for="message">Message (optional)</label>
                <textarea id="message" name="message" placeholder="Tell the user something"></textarea>

                <div class="flex justify-end items-center gap-4">
                    <button class="py-1 px-3 border" type="button" data-close-modal>Cancel</button>
                    <button class="py-1 px-3 border">Send result</button>
                </div>
            </form>
        </footer>
    </div>
</dialog>

<script defer>
    // Component object
    const BlogModalPreview = {
        blog: {
            title: '',
            body: '',
            author: {
                display_name: ''
            }
        },
        baseURL: '{{ route('dashboard.blogs.handle_publish_request_result', ['blog' => '__ID__']) }}',

        $modal: document.querySelector('[id="{{ $modalSelector }}"]'),
        $closeModal: document.querySelectorAll('[data-close-modal]'),

        $title: document.querySelector('#{{ $modalSelector }}__title'),
        $author: document.querySelector('#{{ $modalSelector }}__author'),
        $body: document.querySelector('#{{ $modalSelector }}__body'),
        $form: document.querySelector('#{{ $modalSelector }}__form'),

        $providers: document.querySelectorAll('[data-blog-modal-preview-provider]'),

        receiveBlog(event) {
            BlogModalPreview.blog = JSON.parse(event.currentTarget.dataset.blog)
        },

        updateModalInfo() {
            console.log('Blog info:', this.blog)
            // console.log('base url:', this.baseURL)

            this.$title.innerText = this.blog.title
            this.$author.innerText = this.blog.author?.display_name
            this.$body.innerHTML = this.blog.body
            this.$form.action = this.baseURL.replace('__ID__', this.blog.id)
        }
    }

    // Providers
    BlogModalPreview.$providers.forEach($provider => {

        $provider.addEventListener('click', (e) => {

            BlogModalPreview.receiveBlog(e)
            BlogModalPreview.updateModalInfo()

            BlogModalPreview.$modal.showModal()
        })
    })

    // Close modal
    BlogModalPreview.$closeModal.forEach(($close) => {
        $close.addEventListener('click', () => BlogModalPreview.$modal.close())
    })
</script>
