<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TimetableImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;

class TimetableController extends Controller
{
    public function index()
    {
        return view('admin.timetable');
    }
    public function upload(Request $request)
    {
        // return $request;
        Excel::import(new TimetableImport,$request->file('excel_file'));
        
    }
}
