<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder {
    /**
     * Run table seeder.
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $owner = new Role();
        $owner->name         = 'admin';
        $owner->display_name = 'Administrator';
        $owner->description  = 'User is the owner of a given project';
        $owner->save();

        $admin = new Role();
        $admin->name         = 'client';
        $admin->display_name = 'Bar/Client';
        $admin->description  = 'User is allowed to manage and edit content';
        $admin->save();

        $admin = new Role();
        $admin->name         = 'user';
        $admin->display_name = 'User';
        $admin->description  = 'User is allowed to view content';
        $admin->save();
    }
}