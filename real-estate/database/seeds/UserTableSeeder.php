<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1'),
        ]);


    }


}
