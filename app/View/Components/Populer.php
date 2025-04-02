<?php

namespace App\View\Components;

use Closure;
use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Populer extends Component
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
        $posts = Post::where('views', '!=', 0)
            ->orderBy('views', 'desc')
            ->take(4) // Opsional, ambil hanya 5 postingan terpopuler
            ->get();

        return view('components.populer', compact('posts'));
    }
}
