<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->save();

        $author = new Role();
        $author->name = 'Author';
        $author->save();

        $sub = new Role();
        $sub->name = 'Subscriber';
        $sub->save();
    }
}
