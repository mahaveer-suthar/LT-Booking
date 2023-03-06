<?php

namespace App\Imports;

use App\Models\Timetable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TimetableImport implements ToModel,WithHeadingRow,WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        // dd(date('N', strtotime($row('day'))));
    dd($row);           
        // switch ($row('L')) {
        //     case 'monday':
        //         $day=1;
        //         break;
        //     case 'tuesday':
        //         $day=1;
        //         break;
        //     case 'monday':
        //         $day=1;
        //         break;
        //     case 'monday':
        //         $day=1;
        //         break;
        //     case 'monday':
        //         $day=1;
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }
        return new Timetable([
            // 'day'=>date('N', strtotime($row('day'))),
            'day'=>1,
            'timeslots_id'=>1,
            'lt_id'=>1,
            
        ]);
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
