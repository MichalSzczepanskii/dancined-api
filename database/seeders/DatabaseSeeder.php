<?php

namespace Database\Seeders;

use Database\Seeders\auth\PermisionSeeder;
use Database\Seeders\auth\RoleSeeder;
use Database\Seeders\auth\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        DB::table('users')->insert([
//            'name' => 'admin',
//            'email' => 'admin@localhost',
//            'password' => Hash::make('root12')
//        ]);

        $this->call([
            PersonSeeder::class,
            RoleSeeder::class,
            PermisionSeeder::class,
            UserSeeder::class,
            LocationSeeder::class,
            LessonTypeSeeder::class,
            RoomSeeder::class,
            ParticipantSeeder::class,
        ]);
    }
}
