<?php

namespace Database\Seeders;


use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
USE Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('public/posts');
        Storage::makeDirectory('public/posts');

        //permisos
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        Category::factory(5)->create();
        Tag::factory(10)->create();
        $this->call(PostSeeder::class);
    }
}
