<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = ['BMW','Mercedes','FIAT','PORSCHE','Ferrari'];

        foreach($cars as $car) : 
            
            Car::create([
                'name'  => $car,
                'price' => rand(100,999).'000000',
                'stock' => rand(10,100)
            ]);

        endforeach;
    }
}
