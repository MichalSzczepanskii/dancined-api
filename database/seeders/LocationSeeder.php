<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Location::create([
//            'name' => 'Kalisz',
//            'description' => '',
//            'address' => 'Kalisz',
//        ]);
//
//        Location::create([
//            'name' => 'Jarocin',
//            'description' => '',
//            'address' => 'Jarocin',
//        ]);
//
//        Location::create([
//            'name' => 'Kalisz CKIS',
//            'description' => '',
//            'address' => 'Kalisz',
//        ]);

        Location::factory(50)->create();
    }
}
