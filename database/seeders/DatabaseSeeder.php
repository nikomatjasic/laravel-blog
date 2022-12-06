<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(20)->create();
//        User::truncate();
//        Category::truncate();
//
//        $user = User::factory()->create();
//
//        User::factory(3)->create();
//        $family = Category::create([
//            'name' => 'Family',
//            'slug' => 'family'
//        ]);
//
//        $work = Category::create([
//            'name' => 'Work',
//            'slug' => 'work'
//        ]);
//        $hobby = Category::create([
//            'name' => 'Hobby',
//            'slug' => 'hobbies'
//        ]);
//
//        Post::create([
//            'user_id' => $user->id,
//            'category_id' => $family->id,
//            'title' => 'My family post',
//            'slug' => 'my-family-post',
//            'excerpt' => 'Excerpt for family post',
//            'body' => 'There is some nice snow outside, not taht yellow though.'
//        ]);
//
//        Post::create([
//            'user_id' => $user->id,
//            'category_id' => $work->id,
//            'title' => 'My work post',
//            'slug' => 'my-work-post',
//            'excerpt' => 'Excerpt for work post',
//            'body' => 'There is some nice snow outside, not taht yellow though.'
//        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
