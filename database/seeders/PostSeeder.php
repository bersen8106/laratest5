<?php

namespace Database\Seeders;

use App\Models\Post;  // Добавьте эту строку
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вот здесь нужно создать посты
        Post::factory(30)->create();  // Добавьте эту строку
    }
}
