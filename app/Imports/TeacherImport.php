<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return User::updateOrCreate([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'password'=>Hash::make($row['password']),
            'contact_no'=>$row['mobile_no']
        ],['role'=>2]);
    }
}
