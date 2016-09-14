<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class PostTest extends TestCase
{
    public function setUp(){
        parent::setUp();

        $this->prepareForTests();
    }

    public function prepareForTests(){
        Config::set('database.default', 'mysql_testing');
        Artisan::call('migrate');

        $this->createUser();
    }

    public function createUser() {
        $user = new User;
        $user->name = 'Chucka lways';
        $user->email = 'chucka@mail.com';
        $user->password = Hash::make('hunter2');
        $user->save();
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

        // $this->visitRoute('posts.create')
        //     ->type('This is a test title', 'postTitle')
        //     ->type('## Here is a markdown heading', 'postBody')
        //     ->type('preview', 'preview')
        //     ->check('publish')
        //     ->type('3.00', 'price')
        //     ->press('Submit')
        //     ->seePageIs('posts.show');
    }
}
