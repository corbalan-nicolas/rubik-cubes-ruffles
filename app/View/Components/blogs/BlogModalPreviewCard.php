<?php

namespace App\View\Components\blogs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogModalPreviewCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public \Illuminate\Database\Eloquent\Model $blog
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blogs.blog-modal-preview-card');
    }
}
