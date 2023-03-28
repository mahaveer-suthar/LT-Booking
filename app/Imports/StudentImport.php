<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel,WithHeadingRow
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
            'password'=>$row['password'],
            'contact_no'=>$row['mobile_no']
        ],['role'=>3]);
    }
}
