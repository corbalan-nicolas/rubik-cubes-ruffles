<?php
/**
 * @var string $route
 * @var string $class
 * @var array $params
 * @var boolean $activeCondition
 */
?>

<a
    @class([
        "nav-link",
        $class,
        "active" => $activeCondition
    ])
    {{ request()->routeIs($route) ? 'aria-current=page' : ''  }}
    href="{{ route($route, $params) }}"
>{{ $slot }}</a>
