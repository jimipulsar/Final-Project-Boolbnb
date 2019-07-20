<?php

use Illuminate\Database\Seeder;
use App\Service;
use Illuminate\Support\Str;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'title' => 'WiFi',
                'icon' => 'fas fa-wifi',
            ],
            [
                'title' => 'Piscina',
                'icon' => 'fas fa-swimming-pool',
            ],
            [
                'title' => 'Aria condizionata',
                'icon' => 'fas fa-snowflake',
            ],
            [
                'title' => 'Parcheggio',
                'icon' => 'fas fa-utensils',
            ]

        ];
        foreach ($services as $service) {
          $newService = new Service ;
 
          $newService->title = $service['title'];
          $newService->icon = $service['icon'];
 
          $newService->save();
 
 
 
        }
    }
    
}
