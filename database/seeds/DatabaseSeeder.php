<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        // $this->call(ImagesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SponsorshipsTypeTableSeeder::class);
         $this->call(RoomTableSeeder::class);
         $this->call(SponsorshipsTableSeeder::class);
        $this->call(RoomServiceTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(VisitsTableSeeder::class);


    }
}
