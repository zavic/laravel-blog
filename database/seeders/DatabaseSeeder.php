<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => User::ROLE_ADMIN,
        ]);

        // $categories = Category::factory(8)->create();
        // $posts = Post::factory(16)->create();

        // foreach ($posts as $post) {
        //     $post->categories()->attach(
        //         $categories->random(rand(1, 3))->pluck('id')
        //     );
        // }
    }
}
