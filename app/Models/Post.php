<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $guarded = [''];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function banner(): HasOne
    {
        return $this->hasOne(Banner::class);
    }

    public function scopeFilter($query, array $filters)
    {
        // Filter by category
        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
            $query->whereHas(
                'category',
                fn($query) =>
                $query->where('slug', $category)
            )
        );

        // Filter by author
        $query->when(
            $filters['author'] ?? false,
            fn($query, $author) =>
            $query->whereHas(
                'author',
                fn($query) =>
                $query->where('username', $author)
            )
        );

        // Search filter
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where(
                fn($query) =>
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas(
                        'author',
                        fn($query) =>
                        $query->where('name', 'like', "%{$search}%")
                    )
            )
        );

        // Featured filter
        $query->when(
            $filters['featured'] ?? false,
            fn($query) =>
            $query->where('is_featured', true)
        );

        // Popular filter
        $query->when(
            $filters['popular'] ?? false,
            fn($query) =>
            $query->orderBy('views', 'desc')
        );

        // Default sorting
        $query->when(
            !isset($filters['popular']),
            fn($query) =>
            $query->latest()
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
