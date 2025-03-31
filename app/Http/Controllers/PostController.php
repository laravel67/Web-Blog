<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

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

        // Additional filters from query parameters
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

        return view('pages.posts', compact('posts', 'title', 'banner', 'authors', 'categories'));
    }

    public function post(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        // Increment views counter
        $post->increment('views');
        // Atau alternatif lebih terkontrol:
        // $post->timestamps = false; // Optional: jika tidak ingin updated_at berubah
        // $post->views += 1;
        // $post->save();
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id) // Exclude current post
            ->latest()
            ->take(4)
            ->get();
        $title = $post->title;
        return view('pages.post', compact('post', 'title', 'relatedPosts'));
    }
}
