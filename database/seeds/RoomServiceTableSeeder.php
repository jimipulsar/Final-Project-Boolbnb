<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();

        $data = [
            [
                'room_id' => 1,
                'service_id' => 1
            ]
        ];

        foreach ($rooms as $room){
            foreach ($data as $this_data){

                if($room->id === $this_data['service_id']){
                    $room->services()->attach($this_data['service_id']);
                }

            }
        }
  }
}

