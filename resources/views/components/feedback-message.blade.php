<?php
    $message = null;
    $type = null;
    $hasFeedbackMessage = false;

    if (session()->has('feedback.message')) {
        $hasFeedbackMessage = true;
        $message = session()->get('feedback.message');
        $type = session()->get('feedback.type') ?? 'success';
    }
?>

@if($hasFeedbackMessage)
    <div
        @class([
            "py-3 px-4 my-2 flex justify-start items-center gap-2",
            "bg-red-200" => $type === 'danger',
            "bg-green-200" => $type === 'success'
        ])
    >
        {{-- ICON --}}
        @if ($type === 'success')
            <x-icons.success />
        @elseif ($type === 'danger')
            <x-icons.danger />
        @endif

        {{-- MESSAGE --}}
        {{ $message }}
    </div>
@endif

