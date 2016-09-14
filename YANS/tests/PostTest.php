<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanCreatePost()
    {
        $user = App\User::all()->first();
        $this->be($user);

        $this->visitRoute('posts.create')
            ->type('This is a test title', 'postTitle')
            ->type('## Here is a markdown heading', 'postBody')
            ->type('preview', 'preview')
            ->check('publish')
            ->type('3.00', 'price')
            ->press('Submit')
            ->seePageIs('posts/1');
    }

    public function userCanEditPost() 
    {

    }
}
