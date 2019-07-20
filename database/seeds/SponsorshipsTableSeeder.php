<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Sponsorship;
use App\Room;
use App\SponsorshipsType;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          $data = [];
          $rooms = [];

          do {
          $now = Carbon::now();
          $room = Room::inRandomOrder()->first();
          if (!in_array($room["id"],$rooms)) {

            $sponsorId = SponsorshipsType::inRandomOrder()->first();
            $period = $now->addHours($sponsorId["period"]);

            $data[] = [
              "room_id" => $room["id"],
              "sponsorships_type_id" => $sponsorId["id"],
              "sponsor_expired" =>$period
            ];

            $rooms[] = $room["id"];

          }

        } while (count($rooms)< 10);


        Sponsorship::insert($data);
        

    }
}
