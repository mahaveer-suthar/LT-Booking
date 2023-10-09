<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
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
            'email'=>'lnm.ltbooking@lnmiit.ac.in',
            'password'=>Hash::make('admin@123'),
            'role'=>1,
            'email_verified_at'=>Carbon::now(),
            'pw_change' => Carbon::now()
        ]);
        User::create([
            'name'=>'Dean',
            'email'=>'dean.ltbooking@lnmiit.ac.in',
            'password'=>Hash::make('dean@123'),
            'role'=>5,
            'email_verified_at'=>Carbon::now(),
            'pw_change' => Carbon::now()
        ]);
    }
}
