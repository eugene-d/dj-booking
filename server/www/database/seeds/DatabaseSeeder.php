<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();
        $this->call('RolesTableSeeder'); //must be before UsersTableSeeder
        $this->call('UsersTableSeeder'); //must be after RolesTableSeeder
    }

}
