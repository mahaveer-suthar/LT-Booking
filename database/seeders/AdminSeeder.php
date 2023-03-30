<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=>'lnm.ltbooking@gmail.com',
            'password'=>Hash::make('admin@123'),
            'role'=>1
        ]);
        User::create([
            'name'=>'Dean',
            'email'=>'dean.ltbooking@gmail.com',
            'password'=>Hash::make('dean@123'),
            'role'=>5
        ]);
    }
}
