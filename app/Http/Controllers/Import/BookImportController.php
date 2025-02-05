<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class BookImportController extends Controller
{
    public function index(){
        $showTable = false;
        return view('import.books.books', compact('showTable'));
    }
    public function upload(Request $request)
    {
        try{
            if($request->file('file') == null) return redirect()->route('import.import-books')->with('toast-warning', "Please select a file.");
            $showTable      = true;
            $file           = $request->file('file');
            $reader         = new ReaderXlsx();
            $spreadsheet    = $reader->load($file);
            $sheet          = $spreadsheet->getActiveSheet();
            $rows           = $sheet->toArray();
            $data           = array();    
            if($rows[0][0] == null){
                return redirect()->route('import.import-books')->with('toast-error', "Excel file is empty.");
            } else if(count($rows[0]) > 9 || count($rows[0]) < 9){
                return redirect()->route('import.import-books')->with('toast-error', "An error occurred while saving book: Wrong number of columns.");
            }
            for($i = 1; $i < count($rows); $i++){
                $data[] = array(
                    'accession'     => $rows[$i][0],
                    'call_number'   => $rows[$i][1],
                    'title'         => $rows[$i][3],
                    'edition'       => $rows[$i][4],
                    'publication'   => $rows[$i][5],
                    'publisher'     => $rows[$i][6],
                    'copyrights'    => $rows[$i][7],
                    'remarks'       => $rows[$i][8],
                    'authors'       => $rows[$i][2],
                );
            }
        } catch(\Exception $e){
            $errors = "An error occurred while loading the books";
            return redirect()->route('import.import-books')->with('toast-error', $errors);
        }
        return view('import.books.books', compact('showTable', 'data'));
    }
    public function store(Request $request)
    {
        $data       = $request->input('data');
        $dataArray  = json_decode($data, true);
        $errors     = "";
        foreach ($dataArray as $item) {
            try {
                DB::beginTransaction();
                Book::create([
                    'accession'             => $item['accession'],
                    'call_number'           => $item['call_number'],
                    'title'                 => $item['title'],
                    'edition'               => $item['edition'],
                    'place_of_publication'  => $item['publication'],
                    'publisher'             => $item['publisher'],
                    'copyrights'            => $item['copyrights'],
                    'remarks'               => $item['remarks'],
                    'authors'               => $item['authors'],
                    'cover_image'           => null,
                    'digital_copy_url'      => null,
                    'created_at'            => now(),
                    'updated_at'            => now()
                ]);
                DB::commit();
            } catch (\Illuminate\Database\QueryException $e) {
                DB::rollBack();
                if ($e->getCode() == 23000) {
                    $errors = "Duplicate ID found for Book: " . $item['first_name'] . " " . $item['last_name'];
                } else if ($e->getCode() == "HY000") {
                    $errors = $e->getMessage();
                } else {
                    $errors = "An error occurred while saving Book: " . $e->getMessage();
                }
                return redirect()->route('import.import-books')->with('toast-error', $errors);
            }
        }
        return redirect()->route('import.import-books')->with('toast-success', 'Books imported successfully');
    }
}
