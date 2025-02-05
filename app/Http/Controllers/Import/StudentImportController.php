<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class StudentImportController extends Controller
{
    public function index()
    {
        $showTable = false;
        return view("import.students.students", compact('showTable'));
    }
    public function store(Request $request)
    {
        $data       = $request->input('data');
        $dataArray  = json_decode($data, true);
        $errors     = "";
        foreach ($dataArray as $item) {
            DB::beginTransaction();
            try {
                User::create([
                    'lrn'           => $item['lrn'],
                    'employee_id'   => $item['employee_id'],
                    'rfid_tag'      => $item['rfid'],
                    'first_name'    => $item['first_name'],
                    'middle_name'   => $item['middle_name'],
                    'last_name'     => $item['last_name'],
                    'suffix'        => $item['suffix'],
                    'grade_level'   => $item['grade_level'],
                    'section'       => $item['section'],
                    'role_id'       => $item['role_id'],
                    'email'         => $item['email'],
                    'profile_image' => $item['profile_image'],
                    'password'      => Hash::make($item['password']),
                    'created_at'    => now(),
                    'updated_at'    => now()
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                if ($e->getCode() == 23000) {
                    $errors = "Duplicate ID found for student: " . $item['first_name'] . " " . $item['last_name'];
                } else if ($e->getCode() == "HY000") {
                    $errors = "An error occurred while saving student: Wrong format of excel file";
                } else {
                    $errors = "An error occurred while saving student: " . $e->getMessage();
                }
                return redirect()->route('import.import-students')->with('toast-error', $errors);
            }
            DB::commit();
        }
        return redirect()->route('import.import-students')->with('toast-success', 'Students imported successfully');
    }
    public function upload(Request $request)
    {
        try{

            if($request->file('file') == null) return redirect()->route('import.import-students')->with('toast-warning', "Please select a file.");
            $showTable      = true;
            $file           = $request->file('file');
            $reader         = new ReaderXlsx();
            $spreadsheet    = $reader->load($file);
            $sheet          = $spreadsheet->getActiveSheet();
            $rows           = $sheet->toArray();
            $data           = array();
            if($rows[0][0] == null){
                return redirect()->route('import.import-students')->with('toast-error', "Excel file is empty.");
            } else if(count($rows[0]) > 13 || count($rows[0]) < 13){
                return redirect()->route('import.import-students')->with('toast-error', "An error occurred while saving student: Wrong number of columns.");
            }
            for($i = 1; $i < count($rows); $i++){
                $data[] = array(
                    'lrn'           => $rows[$i][0],
                    'employee_id'   => $rows[$i][1],
                    'rfid'          => $rows[$i][2],
                    'first_name'    => $rows[$i][3],
                    'middle_name'   => $rows[$i][4],
                    'last_name'     => $rows[$i][5],
                    'suffix'        => $rows[$i][6],
                    'grade_level'   => $rows[$i][7],
                    'section'       => $rows[$i][8],
                    'role_id'       => $rows[$i][9],
                    'email'         => $rows[$i][10],
                    'profile_image' => $rows[$i][11],
                    'password'      => $rows[$i][12]
                );
            }
        } catch(\Exception $e){
            $errors = "An error occurred while loading the students";
            return redirect()->route('import.import-students')->with('toast-error', $errors);
        }
        return view('import.students.students', compact('showTable', 'data'));
    }
}
