<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index()
    {
        $title = config('app.name') . ' | Artikel dan Tutorial Terbaru';
        $description = 'Dapatkan tutorial dan artikel terbaru tentang pengembangan web dan teknologi di ' . config('app.name') . '.';
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->setDescription($description);
        SEOTools::opengraph()->addProperty('image', asset('logo.png'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@codesantri');
        SEOTools::twitter()->setTitle($title);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setImage(asset('logo.png'));
        $posts = Post::latest()->paginate(4);
        $authors = User::latest()->get();
        return view('pages.home', compact('title', 'posts', 'authors'));
    }
}
