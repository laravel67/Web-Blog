<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Berita & Artikel Online';
        $posts = Post::latest()->paginate(4);
        $authors = User::latest()->get();
        return view('pages.home', compact('title', 'posts', 'authors'));
    }
}
