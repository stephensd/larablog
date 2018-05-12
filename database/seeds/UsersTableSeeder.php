<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user_one = new User();
      $user_one->role_id = 1;
      $user_one->name = 'Darren Stephenson';
      $user_one->slug = 'darren-stephenson';
      $user_one->email = 'test@test.com';
      $user_one->password = bcrypt('123456');
      $user_one->save();
    }
}
