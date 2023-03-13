<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TimetableImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use PhpOffice\PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\CellRange;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;


class TimetableController extends Controller
{
    public function index()
    {
        return view('admin.timetable');
    }
    public function upload(Request $request)
    {
        // return $request;
        $import=Excel::import(new TimetableImport,$request->file('excel_file'));
        if ($import) {
            return redirect()->back()->with(['success' => 'Success']);
        }
        return redirect()->back()->with(['worng' => 'error']);
        // $this->validate($request, [
        //     'file' => 'required|file|mimes:xls,xlsx'
        // ]);
        // $the_file = $request->file('excel_file');
        // return $request;
        // try{
        //     $spreadsheet = IOFactory::load($the_file->getRealPath());
        //     $sheet        = $spreadsheet->getActiveSheet();
        //     $maxCell = $sheet->getHighestRowAndColumn();
        //     $data = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row']);
            
        //     return $data;
            // $row_limit    = $sheet->getHighestDataRow();
            // $column_limit = $sheet->getHighestDataColumn();
            // $row_range    = range( 2, $row_limit );
            // $column_range = range( 'A', $column_limit );
            // $startcount = 2;
            // $data = array();
            // foreach ( $row_range as $row ) {
            //     $data[] = [
            //         'day' =>$sheet->getCell( 'A' . $row )->getValue(),
            //         'timeslots_id' => $sheet->getCell( 'B' . $row )->getValue(),
            //         'lt_id' => $sheet->getCell( 'B' . $row )->getValue(),
            //     ];
            //     // $startcount++;
            // }
            // return $data;
            // DB::table('tbl_customer')->insert($data);
        // } catch (Exception $e) {
        //     $error_code = $e->errorInfo[1];
        //     return back()->withErrors('There was a problem uploading the data!');
        // }
        // return back()->withSuccess('Great! Data has been successfully uploaded.');
    }
}
