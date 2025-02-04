<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use ErrorException;
use DateTime;

class VisitorLogsController extends Controller
{
    public function index(){
        $inputName      = "";
        $inputLastName  = "";
        $fromInputDate  = "";
        $toInputDate    = "";
        $showTable      = false;
        $peak_hour      = "00:00";
        $data           = array();
        return view('report.visitors.visitor-logs', compact('data', 'inputName', 'inputLastName', 'fromInputDate', 'toInputDate', 'showTable', 'peak_hour'));
    }
    public function retrieve(Request $request)
    {
        $pdfBtn         = $request->input('pdfBtn');
        $excelBtn       = $request->input('excelBtn');
        $findBtn        = $request->input('findBtn');
        $findAllBtn     = $request->input('findAllBtn');
        $inputName      = $request->input('first-name');
        $inputLastName  = $request->input('last-name');
        $fromInputDate  = $request->input('start');
        $toInputDate    = $request->input('end');
        $shownData    = $request->input('shownData');
        $initialData    = json_decode($shownData);
        $data           = array();
        $peak_hour      = "00:00";
        $time_in_arr    = [];
        if($pdfBtn == 'activated'){
            if(strlen($fromInputDate) != 0 || strlen($inputName) != 0 || strlen($inputLastName) != 0){
                $data = $this->generateData($request);
            } else {
                if($initialData != null){
                    $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                                ->select('userlogs.log_id', 
                                    'v.email', 
                                    'v.first_name', 
                                    'v.middle_name', 
                                    'v.last_name', 
                                    DB::raw('DATE(userlogs.timestamp) as log_date'), 
                                    DB::raw('TIME(userlogs.timestamp) as log_time'), 
                                    'userlogs.actiontype')
                                ->get();
                }
            }
            if(!count($data)) return redirect()->route('report.visitor')->with('toast-error', 'There are no data to generate.');
            $this->generatePDF($data);
            return redirect()->route('report.visitor')->with('toast-success', 'PDF successfully generated.');
        } else if($findBtn == 'activated'){
            if(strlen($fromInputDate) != 0 || strlen($inputName) != 0 || strlen($inputLastName) != 0){
                $data = $this->generateData($request);
            } else {
                return redirect()->route('report.visitor')->with('toast-warning', 'Please enter at least one search criteria.');
            }
        } else if($findAllBtn == 'activated'){
            $inputName      = "";
            $inputLastName  = "";
            $fromInputDate  = "";
            $toInputDate    = "";
            $data           = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                                    ->select('userlogs.log_id',
                                        'v.email',
                                        'v.first_name',
                                        'v.middle_name',
                                        'v.last_name',
                                        DB::raw('DATE(userlogs.timestamp) as log_date'), 
                                        DB::raw('TIME(userlogs.timestamp) as log_time'), 
                                        'userlogs.actiontype')
                                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                                    ->get();
        } else if($excelBtn == 'activated'){
            if(strlen($fromInputDate) != 0 || strlen($inputName) != 0 || strlen($inputLastName) != 0){
             $data = $this->generateData($request);
            } else {
                if($initialData != null){
                    $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                                ->select('userlogs.log_id', 
                                    'v.email', 
                                    'v.first_name', 
                                    'v.middle_name', 
                                    'v.last_name', 
                                    DB::raw('DATE(userlogs.timestamp) as log_date'), 
                                    DB::raw('TIME(userlogs.timestamp) as log_time'), 
                                    'userlogs.actiontype')
                                ->get();
                }
            }
            if(!count($data)) return redirect()->route('report.visitor')->with('toast-error', 'There are no data to generate.');
            $this->exportExcel($data);
            return redirect()->route('report.visitor')->with('toast-success', 'Excel successfully generated.');
        }
        if(!count($data)) return redirect()->route('report.visitor')->with('toast-error', 'No data found.');
        if(count($data) > 0) $time_in_arr = $data->pluck('log_time')->toArray();
        $peak_hour = $this->findPeakHour($time_in_arr) . ":00";
        return view('report.visitors.visitor-logs', compact('data', 'inputName', 'inputLastName', 'fromInputDate', 'toInputDate', 'peak_hour'));
    }
    private function findPeakHour($times)
    {
        $hourCounts = array();
        foreach ($times as $time) {
            $hour = substr($time, 0, 2);
            $hourCounts[$hour] = isset($hourCounts[$hour]) ? $hourCounts[$hour] + 1 : 1;
        }
        if(count($hourCounts) == 0) return "00";
        $maxCount = 0;
        foreach ($hourCounts as $hour => $count) {
            if ($count > $maxCount) {
                $maxCount = $count;
                $peakHour = $hour;
            }
        }
        return $peakHour;
    }
    private function generatePDF($data)
    {
        $PDFData   = $data;
        $PDFData   = $PDFData->chunk(25);
        $arrayPdf   = array( 'data' => $PDFData );
        $pdf        = Pdf::loadView('pdf.visitor-pdf-report-format', $arrayPdf);
        $directory  = 'C:/Users/tyron/Downloads';
        $pdf->save($directory . '/visitors-report_' . date('Y-m-d') . '.pdf');
    }
    private function exportExcel($data)
    {
        try{
            $spreadsheet    = new Spreadsheet(); 
            $sheet          = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Log ID');
            $sheet->setCellValue('B1', 'Email');
            $sheet->setCellValue('C1', 'Name');
            $sheet->setCellValue('D1', 'Middle Name');
            $sheet->setCellValue('E1', 'Surname');
            $sheet->setCellValue('F1', 'Date');
            $sheet->setCellValue('G1', 'Time');
            $sheet->setCellValue('H1', 'Action');
            $row = 2;
            foreach($data as $item){
                $sheet->setCellValue('A' . $row, $item->log_id);
                $sheet->setCellValue('B' . $row, $item->email);
                $sheet->setCellValue('C' . $row, $item->first_name);
                $sheet->setCellValue('D' . $row, $item->middle_name);
                $sheet->setCellValue('E' . $row, $item->last_name);
                $sheet->setCellValue('F' . $row, $item->log_date);
                $sheet->setCellValue('G' . $row, $item->log_time);
                $sheet->setCellValue('H' . $row, $item->actiontype);
                $row++;
            }
            $writer     = new WriterXlsx($spreadsheet);
            $directory  = 'C:/Users/tyron/Downloads';
            $filename   = $directory . '/visitors-report_' . date('Y-m-d') . '.xlsx';
            $writer->save($filename);
        } catch(ErrorException $e){
            return redirect()->route('report.visitor')->with('toast-error', 'Error generating excel file.');
        }
    }
    private function generateData(Request $request)
    {
        $fromInputDate  = $request->input('start');
        $toInputDate    = $request->input('end');
        $inputName      = strtolower($request->input('first-name'));
        $inputLastName  = strtolower($request->input('last-name'));
        $data           = array();
        if(strlen($fromInputDate) > 0){
            $fromInputDate = DateTime::createFromFormat('m/d/Y', $fromInputDate);
            $fromInputDate = $fromInputDate->format('Y-m-d');
            $toInputDate = DateTime::createFromFormat('m/d/Y', $toInputDate);
            $toInputDate = $toInputDate->format('Y-m-d');
        }
        if(strlen($fromInputDate) > 0 && strlen($inputName) > 0 && strlen($inputLastName) > 0){
            $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                    ->select('userlogs.log_id', 
                            'v.email', 
                            'v.first_name', 
                            'v.middle_name', 
                            'v.last_name', 
                            DB::raw('DATE(userlogs.timestamp) as log_date'), 
                            DB::raw('TIME(userlogs.timestamp) as log_time'), 
                            'userlogs.actiontype')
                    ->whereBetween(DB::raw('DATE(userlogs.timestamp)'), [$fromInputDate, $toInputDate])
                    ->where(DB::raw('lower(first_name)'), 'like', '%'.$inputName.'%')
                    ->where(DB::raw('lower(last_name)'), 'like', '%'.$inputLastName.'%')
                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                    ->orderBy('first_name', 'asc')
                    ->orderBy('last_name', 'asc')
                    ->get();
        } else if(strlen($inputName) > 0 && strlen($inputLastName) > 0){
            $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                    ->select('userlogs.log_id', 
                            'v.email', 
                            'v.first_name', 
                            'v.middle_name', 
                            'v.last_name', 
                            DB::raw('DATE(userlogs.timestamp) as log_date'), 
                            DB::raw('TIME(userlogs.timestamp) as log_time'), 
                            'userlogs.actiontype')
                    ->where(DB::raw('lower(first_name)'), 'like', '%'.$inputName.'%')
                    ->where(DB::raw('lower(last_name)'), 'like', '%'.$inputLastName.'%')
                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                    ->orderBy('last_name', 'asc')
                    ->orderBy('first_name', 'asc')
                    ->get();
        } else if(strlen($fromInputDate) > 0 && strlen($inputName) > 0){
            $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                    ->select('userlogs.log_id', 
                            'v.email', 
                            'v.first_name', 
                            'v.middle_name', 
                            'v.last_name', 
                            DB::raw('DATE(userlogs.timestamp) as log_date'), 
                            DB::raw('TIME(userlogs.timestamp) as log_time'), 
                            'userlogs.actiontype')
                    ->whereBetween(DB::raw('DATE(userlogs.timestamp)'), [$fromInputDate, $toInputDate])
                    ->where(DB::raw('lower(first_name)'), 'like', '%'.$inputName.'%')
                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                    ->orderBy('last_name', 'asc')
                    ->orderBy('first_name', 'asc')
                    ->get();
        } else if(strlen($fromInputDate) > 0 && strlen($inputLastName) > 0){
            $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                    ->select('userlogs.log_id', 
                            'v.email', 
                            'v.first_name', 
                            'v.middle_name', 
                            'v.last_name', 
                            DB::raw('DATE(userlogs.timestamp) as log_date'), 
                            DB::raw('TIME(userlogs.timestamp) as log_time'), 
                            'userlogs.actiontype')
                    ->whereBetween(DB::raw('DATE(userlogs.timestamp)'), [$fromInputDate, $toInputDate])
                    ->where(DB::raw('lower(last_name)'), 'like', '%'.$inputLastName.'%')
                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                    ->orderBy('last_name', 'asc')
                    ->orderBy('first_name', 'asc')
                    ->get();
        } else if(strlen($inputName) > 0){
            $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                    ->select('userlogs.log_id', 
                            'v.email', 
                            'v.first_name', 
                            'v.middle_name', 
                            'v.last_name', 
                            DB::raw('DATE(userlogs.timestamp) as log_date'), 
                            DB::raw('TIME(userlogs.timestamp) as log_time'), 
                            'userlogs.actiontype')
                    ->where(DB::raw('lower(first_name)'), 'like', '%'.$inputName.'%')
                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                    ->orderBy('last_name', 'asc')
                    ->orderBy('first_name', 'asc')
                    ->get();
        } else if(strlen($inputLastName) > 0){
            $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                    ->select('userlogs.log_id', 
                            'v.email', 
                            'v.first_name', 
                            'v.middle_name', 
                            'v.last_name', 
                            DB::raw('DATE(userlogs.timestamp) as log_date'), 
                            DB::raw('TIME(userlogs.timestamp) as log_time'), 
                            'userlogs.actiontype')
                    ->where(DB::raw('lower(last_name)'), 'like', '%'.$inputLastName.'%')
                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                    ->orderBy('last_name', 'asc')
                    ->orderBy('first_name', 'asc')
                    ->get();
        } else if(strlen($fromInputDate) > 0){
            $data = Log::join('visitor as v', 'v.visitor_id', '=', 'userlogs.visitor_id')
                    ->select('userlogs.log_id', 
                            'v.email', 
                            'v.first_name', 
                            'v.middle_name', 
                            'v.last_name', 
                            DB::raw('DATE(userlogs.timestamp) as log_date'), 
                            DB::raw('TIME(userlogs.timestamp) as log_time'), 
                            'userlogs.actiontype')
                    ->whereBetween(DB::raw('DATE(userlogs.timestamp)'), [$fromInputDate, $toInputDate])
                    ->orderBy(DB::raw('DATE(userlogs.timestamp)'), 'asc')
                    ->orderBy('last_name', 'asc')
                    ->orderBy('first_name', 'asc')
                    ->get();
        }
        return $data;
    }
}
