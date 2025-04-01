<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;     // Tambahkan model User
use App\Models\Category;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // 🔥 Buat user dummy kalau belum ada
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Murtaki', 'username' => 'murtaki99', 'password' => bcrypt('password')]
        );

        // 🔥 Insert unique categories
        $categories = [
            'Programmer',
            'Microsoft',
            'Tutorial & Tips',
            'Pendidikan',
            'Coding'
        ];

        $categoryIds = [];
        foreach ($categories as $category) {
            $categoryModel = Category::firstOrCreate(
                ['slug' => Str::slug($category)],
                ['name' => $category]
            );
            $categoryIds[] = $categoryModel->id;
        }

        // 🔥 Insert posts
        for ($i = 1; $i <= 10; $i++) {
            $title = $faker->sentence(6);

            Post::create([
                'user_id' => $user->id, // 🔥 Pakai user dummy yang sudah dibuat
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'title' => $title,
                'slug' => Str::slug($title),
                'image' => null,
                'content' => '<p>' . implode('</p><p>', $faker->paragraphs(5)) . '</p>',
                'is_featured' => rand(0, 1),
                'views' => rand(0, 1000),
            ]);
        }
    }
}
