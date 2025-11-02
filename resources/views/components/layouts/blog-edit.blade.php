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

    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('css/editor.css') }}">
</head>
<body>
    {{ $slot }}
</body>
</html>
