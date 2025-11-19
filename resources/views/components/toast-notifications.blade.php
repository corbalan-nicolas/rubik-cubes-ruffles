<?php
    $hasToasts = session()->has('toast.message');
?>

<div class="fixed right-4 bottom-4" aria-live="polite">
    <h2 class="sr-only">Notifications</h2>
    @if($hasToasts)
        <div class="bg-neutral-light shadow-sm" data-toast>

            <div class="flex justify-between items-center gap-20 border-b border-black/10 py-2 px-4 bg-neutral-lighter">
                <span class="font-semibold">Qubo</span>

                <div class="flex justify-end items-center gap-2 text-sm font-regular">
                    <span>Just now</span>
                    <button
                        class="border w-6"
                        type="button"
                        data-dismiss-toast
                        aria-label="Cerrar"
                    >
                        <x-icons.close />
                    </button>
                </div>
            </div>

            <div class="py-2 px-4">
{{--                @if(session()->get('toast.type') == 'danger')--}}
{{--                    <x-icons.danger />--}}
{{--                @elseif(session()->get('toast.type') == 'success')--}}
{{--                    <x-icons.success />--}}
{{--                @endif--}}

                <p class="toast__p">{{ session()->get('toast.message') }}</p>
            </div>
        </div>
    @endif
</div>

<script defer>
    const ToastNotifications = {
        dismissToast: document.querySelectorAll('[data-dismiss-toast]'),

        handleClose(event) {
            event.currentTarget.closest('[data-toast]').remove()
        },

        init() {
            this.dismissToast.forEach(dismiss => {

                dismiss.addEventListener('click', this.handleClose)
            })
        }
    }

    ToastNotifications.init()
</script>
