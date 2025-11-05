<?php
/**
 * @var string $route
 * @var string $class
 */
?>

<a
    @class([
        "nav-link",
        $class,
        "active" => request()->routeIs($route)
    ])
    {{ request()->routeIs($route) ? 'aria-current=page' : ''  }}
    href="{{ route($route) }}"
>{{ $slot }}</a>
