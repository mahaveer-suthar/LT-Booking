<?php

namespace App\Imports;

use App\Models\Lt_rooms;
use App\Models\Timeslots;
use App\Models\Timetable;
use App\Models\Timetablesource;
use Database\Seeders\LtSeeder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TimetableImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        // dd(Lt_rooms::where('room_name',$row['lt_name'])->first()->id);
        return new Timetable([
            'timetablesources_id'=>Timetablesource::where('is_active',1)->first()->id,
            'day'=>$row['day'],
            'timeslots_id'=>Timeslots::where('start_time',gmdate("H:i:s", ($row['start_time']-25579) * 86400))->where('end_time',gmdate("H:i:s", ($row['end_time']-25579) * 86400))->first()->id,
            'lt_id'=>Lt_rooms::where('room_name',$row['lt_name'])->first()->id,
            'teacher_name'=>$row['teacher_name'],
            'designation'=>$row['designation'],
            'branch'=>$row['branch'],
            'batch'=>$row['batch'],
            'course'=>$row['course']
        ]);
        
    }
    // public function rules(): array
    // {
    //     return [
    //         'lt_room' => 'exists:lt_rooms,room_name',
    //     ];
    // }
}
