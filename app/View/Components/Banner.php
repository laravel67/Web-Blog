<?php

namespace App\View\Components;

use App\Models\Banner as ModelsBanner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
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
        $banners = ModelsBanner::latest()->get();
        return view('components.banner', compact('banners'));
    }
}
