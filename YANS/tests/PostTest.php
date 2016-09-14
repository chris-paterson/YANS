<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Post;

class PostTest extends TestCase
{
    public function setUp() 
    {
        parent::setUp();
        $this->prepareForTests();
    }

    public function prepareForTests()
    { 
        Config::set('database.default', 'mysql_testing');
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }


    public function testCorrectUserCanCreatePost()
    {
        $user = User::first();
        $this->actingAs($user);

        $this->visitRoute('posts.create')
            ->type('This is a test title', 'postTitle')
            ->type('## Here is a markdown heading', 'postBody')
            ->type('preview', 'preview')
            ->check('publish')
            ->type('3.00', 'price')
            ->press('Submit')
            ->seePageIs('posts/5') // Seeder creates 4, so look for 5.
            ->assertResponseOk()
            ->see('This is a test title')
            ->see('Here is a markdown heading')
            ->dontSee('You must log in to purchase this post')
            ->dontSee('Purchase the rest of this post for');
    }

    public function testCorrectUserCanEditPost() 
    {
        $user = App\User::find(1);
        $this->be($user);
        $post = $user->posts()->first();

        $this->visitRoute('posts.edit', $post->id)
            ->type('This is an updated test title', 'postTitle')
            ->type('## Here is an updated markdown heading', 'postBody')
            ->press('Save')
            ->seePageIs('posts/1')
            ->see('This is an updated test title')
            ->see('Here is an updated markdown heading');
    }

    public function testCorrectUsersCanDeletePost()
    {
        $user = App\User::find(1);
        $this->be($user);
        $post = $user->posts()->first();

        $numberOfPosts = $user->posts()->count();

        $response = $this->action('DELETE', 'PostController@show', ['id' => $post->id]);
        $this->assertEquals(302, $response->getStatusCode());

        assert($user->posts()->count() == $numberOfPosts - 1);
    }

    public function testIncorrectUserCanEditPost() 
    {
        $user = App\User::find(1);
        $this->be($user);
        $post = User::find(2)->posts()->first();

        // $response = $this->call('GET', 'posts.edit', [$post->id]);
        // $this->assertEquals(403, $response->getStatusCode());

        $response = $this->call( 'GET', 'PostController@edit', ['id' => $post->id]);
        $this->assertEquals(403, $response->getStatusCode());
    }
}
