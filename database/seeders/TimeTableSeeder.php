<?php

namespace Database\Seeders;

use App\Models\Timetable;
use Illuminate\Database\Seeder;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timetable::create([
            'day'=>1,
            'timeslots_id'=>1,
            'lt_id'=>1
        ]);
    }
}
