<?php

namespace App\View\Components;

use App\Models\Raffle;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RaffleBanners extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Raffle $raffle,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.raffle-banners');
    }
}
