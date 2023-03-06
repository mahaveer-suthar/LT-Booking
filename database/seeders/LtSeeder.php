<?php

namespace Database\Seeders;

use App\Models\Lt_rooms;
use Illuminate\Database\Seeder;

class LtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
    {
        $LT=['01','02','03','04','05','06','07','08','09','10','11','12','13','16','17','18','19'];
        foreach ($LT as $key => $value) {
            Lt_rooms::create([
                'room_name'=>'LT-'.$value
            ]);
        }
    }
}
