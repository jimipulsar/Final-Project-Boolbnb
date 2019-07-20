<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\User;
use Faker\Generator as Faker;

class RoomTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
 
        


        public function run(Faker $faker) {
        
			
            $this->users = User::all();
            $json = File::get("database/data/comuni.json"); 
            
            $cities = json_decode($json);
    
            foreach ($cities as $city) {
                $gapi = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . floatval($city->lat) .',' . floatval($city->lon) . '&key=' . config('app.google_api_key');
                $json_resp = file_get_contents($gapi);
                $adress = json_decode($json_resp, true);
                if($adress['results'] > 0){
                    foreach ($adress['results'][0]['address_components'] as $address_component) {
                        if(in_array("street_number", $address_component['types'] )){
                            $number = intval($address_component['long_name']);
                        }
                        if(in_array("route", $address_component['types'] )){
                            $street = $address_component['long_name'];
                        }
                    }
                }
                $imageNames = ['image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.jpg', 'image6.jpg', 'image7.jpg', 'image8.jpg', 'image9.jpg', 'image10.jpg',  'image11.jpg', 'image12.jpg', 'image13.jpg', 'image14.jpg'];

                $room = new Room;
                $room->user_id = $this->users[rand(0, count($this->users) - 1)]->id;
                $room->title = $faker->sentence(4);
                $room->description = $faker->paragraph(10);
                $room->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 12, $max = 400);
                $room->n_rooms = $faker->numberBetween($min = 1, $max = 15);
                $room->n_beds = $faker->numberBetween($min = 1, $max = 10);
                $room->n_baths = $faker->numberBetween($min = 1, $max = 10);
                $room->metri_quadrati = $faker->numberBetween($min = 30, $max = 400);
                $room->street = $street;
                $room->locality = $city->city;
                $room->house_number = $number;
                $room->postal_code = intval($city->cap);
                $room->state = 'Italy';
                $room->latitude = floatval($city->lat);
                $room->longitude = floatval($city->lon);
                $room->cover = $imageNames[rand(0, count($imageNames) - 1)];
                $room->published = $faker->numberBetween($min = 0, $max = 1);
                $room->service_id = $faker->randomElement(['Wifi', 'Parcheggio', 'Piscina', 'Aria condizionata']);
    
                $room->save();
            }
        }
    }      

		

