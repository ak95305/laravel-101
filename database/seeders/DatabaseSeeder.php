<?php

namespace Database\Seeders;

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
        $users = \App\Models\User::factory(5)->create();
        $posts = \App\Models\Post::factory(20)->create();

        $posts->each(function ($post) use ($users) {
            $post->users()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(PostSeeder::class);
    }
}
