<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Filament\Notifications\Notification;

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
                $title = "{$category->name}";
                // $banner = $category->banner;
                break;

            case $request->route()->named('posts.author'):
                $filters['author'] = $param;
                $author = User::where('username', $param)->firstOrFail();
                // $title = "Oleh: {$author->name}";
                $banner = asset('img/author.jpeg');
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

                $svg = '<svg class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1 0 5.25 5.25a7.5 7.5 0 0 0 11.4 11.4z" />
    </svg>';

                // Escaping biar aman dari XSS, unless emang pengen raw HTML
                $searchTerm = htmlspecialchars($filters['search'], ENT_QUOTES, 'UTF-8');

                $title = $svg . $searchTerm;
                break;
        }

        if ($request->has('search') && !$request->route()->named('posts.search')) {
            $filters['search'] = $request->search;
            $title = "{$filters['search']}";
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
            ->paginate(8)
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
            ->paginate(4);

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

    public function comment(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'content' => 'required|string|min:3',
            'post_id' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'content.required' => 'Komentar tidak boleh kosong.',
            'content.min' => 'Komentar minimal 3 karakter.',
            'post_id.required' => 'Post tidak valid.',
        ]);

        Comment::create([
            'post_id' => $validated['post_id'],
            'name'    => $validated['name'],
            'content' => $validated['content'],
        ]);
        return back();

        Notification::make()
            ->title('Komentar berhasil dikirim!')
            ->success()
            ->body('Terima kasih sudah berkomentar 🙏')
            ->persistent()
            ->send();
    }
}
