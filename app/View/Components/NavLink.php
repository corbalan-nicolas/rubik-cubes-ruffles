<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $route,
        public string $class = '',
        public array $params = [],
        public bool|null $activeCondition = null
    ){
        if ($activeCondition === null) {
            $this->activeCondition = request()->routeIs($route);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
