<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $alice = User::find(1);
        $bob = User::find(2);

        Post::create([
            'user_id' => $alice->id,
            'title' => 'Test Title 1',
            'body' => 'Test Body 1',
            'isPublished' => 1,
            'price' => 3.99,
            'preview' => 'Preview'
        ]);

        Post::create([
            'user_id' => $alice->id,
            'title' => 'Test Title 2',
            'body' => 'Test Body 2',
            'isPublished' => 1,
            'price' => 0.00,
            'preview' => ''
        ]);

        Post::create([
            'user_id' => $bob->id,
            'title' => 'Test Title 1',
            'body' => 'Test Body 1',
            'isPublished' => 0,
            'price' => 2.99,
            'preview' => 'preview'
        ]);

        Post::create([
            'user_id' => $bob->id,
            'title' => 'Test Title 2',
            'body' => 'Test Body 2',
            'isPublished' => 1,
            'price' => 0.00,
            'preview' => ''
        ]);
    }
}
