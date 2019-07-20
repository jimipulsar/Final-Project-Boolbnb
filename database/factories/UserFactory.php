<?php

use Faker\Generator as Faker;
use App\User;
use App\Room;
use App\Service;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


// $factory->define(App\Room::class, function(Faker $faker) {

// return [
// 'title' => $faker->text(20),
// 'user_id' => $faker->numberBetween($min = 1, $max = 10),
// 'cover' => $faker->image('public/storage/images',400,300, null, false),
// 'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 25, $max = 150),
// 'description' => $faker->text(100),
// 'n_rooms' => $faker->randomDigitNotNull(5),
// 'n_beds' => $faker->randomDigitNotNull(5),
// 'house_number' => $faker->randomDigitNotNull(5),
// 'postal_code' => $faker->randomDigitNotNull(5),
//  'latitude' => $faker->latitude($min = -90, $max = 90),
// 'locality' => $faker->text(14),
// 'state' => $faker->text(20),
// 'longitude' => $faker->longitude($min = -180, $max = 180),
// 'published' => $faker->numberBetween($min = 0, $max = 1),
// 'n_baths' => $faker->randomDigitNotNull(2),
// 'metri_quadrati' => $faker->numberBetween($min = 30, $max = 400),
//  'street' => $faker->streetAddress(),
// 'service_id' => $faker->randomElement(['Wifi', 'Parcheggio', 'Piscina', 'Aria condizionata']) ,
// ];
// });
