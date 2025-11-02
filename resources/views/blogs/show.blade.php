<?php
/**
 * TODO view documentation
 * @var $blog
 * @var $html_body
 */
?>

<x-layouts.main>
    <x-slot:title>Nuestros Blogs</x-slot:title>
    {!! $html_body !!}

    <form action="#">
        <p>Do you like this blog?</p>
        <button>Like it!</button>
    </form>

    <a href="#">Go up</a>

    <aside>

    </aside>
</x-layouts.main>
