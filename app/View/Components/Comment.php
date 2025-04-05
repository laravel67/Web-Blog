<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Comment as ModelComment;


class Comment extends Component
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $comments = ModelComment::where('post_id', $this->id)->get();
        return view('components.comment', compact('comments'));
    }
}
