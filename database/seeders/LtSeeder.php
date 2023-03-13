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
        $LT=['1','2','3','4','5','6','7','8','9','10','11','12','13','16','17','18','19'];
        foreach ($LT as $key => $value) {
            Lt_rooms::create([
                'room_name'=>'LT-'.$value
            ]);
        }
    }
}
