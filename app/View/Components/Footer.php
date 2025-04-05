<?php

namespace App\View\Components;

use Closure;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $posts = Post::where('is_featured', true)
            ->latest()
            ->limit(5)
            ->get();
        $categories = Category::latest()->get();
        return view('components.footer', compact('categories', 'posts'));
    }
}
