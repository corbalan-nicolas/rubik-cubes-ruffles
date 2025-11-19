<?php
/**
 * TODO: Layout documentation
 * @var $blog_name
 * @var $blog_id
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editing {{ $blog_name ?? 'blog' }} ¬ Qubo</title>

    <link rel="icon" href="{{ url('/images/brand/favicon-white.svg') }}" sizes="any" type="image/svg+xml" media="(prefers-color-scheme: light)">
    <link rel="icon" href="{{ url('/images/brand/favicon-dark.svg') }}" sizes="any" type="image/svg+xml" media="(prefers-color-scheme: dark)">

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <link rel="stylesheet" href="{{ url('css/styles.css') }}">

    {{-- Multi select --}}
    <link rel="stylesheet" href="{{ url('css/slimselect.css') }}">
    <script src="{{ url('js/slimselect.js') }}"></script>

    {{-- Tailwindcss --}}
    @vite('resources/css/app.css')
</head>
<body>
    <div id="app" class="grid max-w-[1680px] mx-auto grid-rows-[auto_1fr] min-h-dvh">
        {{ $slot }}
    </div>
</body>
</html>
