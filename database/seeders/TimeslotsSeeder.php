<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timeslots;
use Illuminate\Support\Carbon;

class TimeslotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=8; $i <=17; $i++) { 
            Timeslots::create([
                'start_time'=> date('H:i', strtotime($i.':00:00')),
                'end_time'=> date('H:i', strtotime(1+$i.':00:00')),
                'is_active'=>'0'
            ]);
        }
        Timeslots::create([
            'start_time'=> date('H:i', strtotime('08:00:00')),
            'end_time'=> date('H:i', strtotime('09:30:00'))
        ]);
        Timeslots::create([
            'start_time'=> date('H:i', strtotime('09:30:00')),
            'end_time'=> date('H:i', strtotime('11:00:00'))
        ]);
        Timeslots::create([
            'start_time'=> date('H:i ', strtotime('11:00:00')),
            'end_time'=> date('H:i', strtotime('12:30:00'))
        ]);
        Timeslots::create([
            'start_time'=> date('H:i', strtotime('13:00:00')),
            'end_time'=> date('H:i', strtotime('14:30:00'))
        ]);
        Timeslots::create([
            'start_time'=> date('H:i', strtotime('14:30:00')),
            'end_time'=> date('H:i', strtotime('16:00:00'))
        ]);
        Timeslots::create([
            'start_time'=> date('H:i', strtotime('16:00:00')),
            'end_time'=> date('H:i', strtotime('17:30:00'))
        ]);
        for ($i=18; $i <=21; $i++) { 
            Timeslots::create([
                'start_time'=> date('H:i', strtotime($i.':00:00')),
                'end_time'=> date('H:i', strtotime(1+$i.':00:00')),
                'is_active'=>null
            ]);
        }
        
    }
}
