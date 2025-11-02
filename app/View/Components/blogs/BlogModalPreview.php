<?php

namespace App\View\Components\blogs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class BlogModalPreview extends Component
{
    public string $html_body;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public \Illuminate\Database\Eloquent\Model $blog,
    ){
        $this->html_body = Str::of($blog->body)->markdown([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 10, // 10 - 50
            'max_delimiters_per_line' => 100 // 100 - 1_000
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blogs.blog-modal-preview');
    }
}
