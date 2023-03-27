<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TimetableImport;
use App\Models\Timeslots;
use App\Models\Timetable;
use App\Models\Timetablesource;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\CellRange;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class TimetableController extends Controller
{
    public function index()
    {
        $date = Timetablesource::where('is_active', "1")->first();
        $data = Timetablesource::with('timetable')->where('is_active', "1")->first();
        return view('admin.timetable', compact('data', 'date'));
    }
    public function upload(Request $request)
    {
        $the_file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $update = Timetablesource::where('is_active', "1")->update(['is_active' => "0"]);
        $create = Timetablesource::create([
            'start_date' => Carbon::instance(Date::excelToDateTimeObject($sheet->getCell('J2')->getValue()))->format('Y-m-d'),
            'end_date' => Carbon::instance(Date::excelToDateTimeObject($sheet->getCell('K2')->getValue()))->format('Y-m-d'),
            'is_active' => "1"
        ]);
        if ($create) {
            $import = Excel::import(new TimetableImport, $request->file('excel_file'));
            if ($import) {
                return redirect()->back()->with(['success' => 'Success']);
            }
        }
        return redirect()->back()->with(['worng' => 'error']);
    }
    public function reset($id){
        $del=Timetable::where('timetablesources_id',$id)->delete();
        if($del){
            Timetablesource::find($id)->delete();
            return response()->json(["status"=>200]);
        }
    }
}
