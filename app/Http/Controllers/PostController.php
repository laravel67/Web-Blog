<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class PostController extends Controller
{
    public function posts(Request $request, $param = null)
    {
        $filters = [];
        $title = 'Semua Postingan';
        $banner = null;
        switch (true) {
            case $request->route()->named('posts.category'):
                $filters['category'] = $param;
                $category = Category::where('slug', $param)->firstOrFail();
                $title = "Kategori: {$category->name}";
                $banner = $category->banner;
                break;

            case $request->route()->named('posts.author'):
                $filters['author'] = $param;
                $author = User::where('username', $param)->firstOrFail();
                $title = "Postingan oleh: {$author->name}";
                break;

            case $request->route()->named('posts.popular'):
                $filters['popular'] = true;
                $title = "Postingan Populer";
                break;

            case $request->route()->named('posts.featured'):
                $filters['featured'] = true;
                $title = "Postingan Unggulan";
                break;

            case $request->route()->named('posts.search'):
                $filters['search'] = $request->query('search', '');
                $title = "Hasil pencarian: {$filters['search']}";
                break;
        }

        if ($request->has('search') && !$request->route()->named('posts.search')) {
            $filters['search'] = $request->search;
            $title = "Hasil pencarian: {$filters['search']}";
        }

        if ($request->has('popular') && !$request->route()->named('posts.popular')) {
            $filters['popular'] = true;
            $title .= " (Populer)";
        }

        if ($request->has('unggulan') && !$request->route()->named('posts.featured')) {
            $filters['featured'] = true;
            $title .= " (Unggulan)";
        }

        // Get filtered posts
        $posts = Post::with(['category', 'author'])
            ->filter($filters)
            ->paginate(9)
            ->appends($request->query());

        $authors = User::whereHas('posts')->get();
        $categories = Category::whereHas('posts')->get();

        // SEO Integration
        SEOTools::setTitle($title);
        SEOTools::setDescription('Temukan artikel terbaru tentang ' . $title);
        SEOTools::setCanonical(url()->current());

        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->setDescription('Temukan artikel terbaru tentang ' . $title);
        SEOTools::opengraph()->addProperty('image', asset('logo.png'));

        SEOTools::twitter()->setSite('@codesantri');
        SEOTools::twitter()->setTitle($title);
        SEOTools::twitter()->setDescription('Temukan artikel terbaru tentang ' . $title);
        SEOTools::twitter()->setImage(asset('logo.png'));

        return view('pages.posts', compact('posts', 'title', 'banner', 'authors', 'categories'));
    }


    public function post(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->increment('views');
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(4)
            ->get();

        $title = $post->title;
        $description = Str::limit(strip_tags($post->content), 100);
        $image = $post->image ? asset('storage/' . $post->image) : asset('logo.png');

        SEOTools::setTitle(config('app.name') . ' | ' . $title);
        SEOTools::setDescription($description);
        SEOTools::setCanonical(url()->current());

        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setTitle($title);
        SEOTools::opengraph()->setDescription($description);
        SEOTools::opengraph()->addProperty('image', $image);
        SEOTools::opengraph()->addProperty('type', 'article');

        SEOTools::twitter()->setSite('@codesantri');
        SEOTools::twitter()->setTitle(config('app.name') . ' | ' . $title);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setImage($image);
        return view('pages.post', compact('post', 'title', 'relatedPosts'));
    }
}
