<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    public function setUp(){
        parent::setUp();

        $this->prepareForTests();
    }
    
    public function prepareForTests(){
        Config::set('database.default', 'mysql_testing');
        Artisan::call('migrate');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanCreatePost()
    {
        $user = App\User::find(1);
        $this->be($user);

        $this->visitRoute('posts.create')
            ->type('This is a test title', 'postTitle')
            ->type('## Here is a markdown heading', 'postBody')
            ->type('preview', 'preview')
            ->check('publish')
            ->type('3.00', 'price')
            ->press('Submit')
            ->seePageIs('posts.show');
    }
}
