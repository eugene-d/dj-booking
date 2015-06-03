<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder {
    /**
     * Run table seeder.
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //create user admin and attach admin role
        $name = 'admin';
        $user = User::create([
            'name' => $name,
            'email' => $name . '@test.net',
        ]);
        $role = Role::where('name', '=', $name)->first();
        $user->attachRole($role);

        //create user client and attach client role
        $name = 'client';
        $user = User::create([
            'name' => $name,
            'email' => $name . '@test.net',
        ]);
        $role = Role::where('name', '=', $name)->first();
        $user->attachRole($role);

        //create user and attach user role
        $name = 'user';
        $user = User::create([
            'name' => $name,
            'email' => $name . '@test.net',
        ]);
        $role = Role::where('name', '=', $name)->first();
        $user->attachRole($role);
    }
}