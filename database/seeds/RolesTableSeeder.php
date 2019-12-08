<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate table
        Role::truncate();

        //create some sample rolls
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'author']);
        Role::create(['name'=>'user']);
    }
}
