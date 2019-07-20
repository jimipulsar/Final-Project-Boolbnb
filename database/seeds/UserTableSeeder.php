<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Faker\Generator as Faker;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = new User();
        $user->name = 'Admin Root';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('administrator');
        $user->save();
        $user->assignRole('Admin Root');
    //     $newUser = new User;

    //   $newUser->name = 'Super';
    //   $newUser->surname = 'Admin';
    //   $newUser->email = 'example@example.it';
    //   $newUser->password = Hash::make("esempio");


    //   $newUser->save();


        for ($i=0; $i < 10; $i++) {
          $newUser = new User;

          $newUser->name = $faker->firstName;
          $newUser->surname = $faker->lastName;
          $newUser->email = $faker->unique()->email;
          $newUser->password = Hash::make("esempio");


          $newUser->save();
        
    }
    }
}
