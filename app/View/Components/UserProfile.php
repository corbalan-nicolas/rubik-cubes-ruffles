<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserProfile extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public \Illuminate\Database\Eloquent\Model $user,
        public \Illuminate\Database\Eloquent\Collection $history,
        public $totalPaid = 0,
        public $totalOfTicketsBought = 0,
        /* Possible variables:
            ¿Participating on current raffle?
            Total amount of prizes won

        */
    ){
        foreach ($this->history as $payment) {
            $this->totalOfTicketsBought += count($payment['tickets']);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-profile');
    }
}
