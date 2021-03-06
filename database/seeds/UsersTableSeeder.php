<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'Alice McAliceface',
            'email' => 'alice@testmail.wow',
            'password' => bcrypt('hunter2'),
        ]);

        User::create([
            'name' => 'Bob McBobface',
            'email' => 'bob@testmail.wow',
            'password' => bcrypt('hunter2'),
        ]);
    }
}
