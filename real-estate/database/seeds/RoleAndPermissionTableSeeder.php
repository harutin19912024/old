<?php

use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionTableSeeder extends Seeder {

    public function run()
    {
        $broker = Role::where('name', '=', 'broker')->first();
        if (!$broker) {
            $broker = new Role();
        }
        $broker->name         = 'broker';
        $broker->display_name = 'broker';
        $broker->description  = 'has admin rights and can see activity of all agents';
        $broker->save();

        $agents = Role::where('name', '=', 'agents')->first();
        if (!$agents) {
            $agents = new Role();
        }
        $agents->name         = 'agent';
        $agents->display_name = 'agent';
        $agents->description  = 'can only see their activity';
        $agents->save();

        $user = Role::where('name', '=', 'User')->first();
        if (!$user) {
            $user = new Role();
        }

        $user->name         = 'user';
        $user->display_name = 'user';
        $user->description  = 'read only';
        $user->save();


        $admin = User::where('username', '=', 'admin')->first();
        if ($admin) {
            if (!$admin->hasRole('broker')) {
                $admin->attachRole($broker);
            }
        }

    }

}
