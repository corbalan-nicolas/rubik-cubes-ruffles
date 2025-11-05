<?php
/**
 * TODO view documentation
 * @var $blog
 * @var $html_body
 */
?>

<x-layouts.main>
    <x-slot:title>{{ $blog->title }}</x-slot:title>
    <x-slot:desc>{{ $blog->desc }}</x-slot:desc>

    {!! $blog->body !!}

    <form action="#">
        <p>Do you like this blog?</p>
        <button>Like it!</button>
    </form>

    <a id="go-up" href="#">Go up</a>

    <aside>

    </aside>
</x-layouts.main>
