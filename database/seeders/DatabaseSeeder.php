<?php

namespace Database\Seeders;

use App\Models\Timeslots;
use Illuminate\Database\Seeder;
use Database\Seeders\TimeTableSeeder;

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
        $this->call(AdminSeeder::class);
        $this->call(TimeslotsSeeder::class);
        $this->call(LtSeeder::class);
        // $this->call(TimeTableSeeder::class);
    }
}
