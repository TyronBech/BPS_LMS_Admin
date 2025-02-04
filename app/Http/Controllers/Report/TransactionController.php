<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use DateTime;

class TransactionController extends Controller
{
    public function index()
    {
        $fromInputDate  = "";
        $toInputDate    = "";
        $inputName      = "";
        $inputLastName  = "";
        $data           = array();
        return view('report.transactions.transactions' , compact('data', 'inputName', 'inputLastName', 'fromInputDate', 'toInputDate'));
    }
    public function retrieve(Request $request)
    {
        $fromInputDate  = $request->input('start');
        $toInputDate    = $request->input('end');
        $inputName      = $request->input('first-name');
        $inputLastName  = $request->input('last-name');
        $findBtn        = $request->input('findBtn');
        $findAllBtn     = $request->input('findAllBtn');
        $data           = array();
        if($findBtn == 'activated'){
            if(strlen($fromInputDate) != 0 || strlen($inputName) != 0 || strlen($inputLastName) != 0){
                $data = $this->generateData($request);
            } else {
                return redirect()->route('report.transaction')->with('toast-warning', 'Please enter at least one search criteria.');
            }
        } else if($findAllBtn == 'activated'){
            $inputName      = "";
            $inputLastname  = "";
            $fromInputDate  = "";
            $toInputDate    = "";
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        }
        if(!count($data)) return redirect()->route('report.transaction')->with('toast-error', 'No data found.');
        return view('report.transaction.transactions' , compact('data', 'inputName', 'inputLastName', 'fromInputDate', 'toInputDate'));
    }
    private function generateData(Request $request)
    {
        $fromInputDate  = $request->input('start');
        $toInputDate    = $request->input('end');
        $inputName      = $request->input('first-name');
        $inputLastName  = $request->input('last-name');
        $data           = array();
        if(strlen($fromInputDate) > 0){
            $fromInputDate = DateTime::createFromFormat('m/d/Y', $fromInputDate);
            $fromInputDate = $fromInputDate->format('Y-m-d');
            $toInputDate = DateTime::createFromFormat('m/d/Y', $toInputDate);
            $toInputDate = $toInputDate->format('Y-m-d');
        }
        if(strlen($fromInputDate) > 0 && strlen($inputName) > 0 && strlen($inputLastName) > 0){
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->whereBetween('transaction.date_borrowed', [$fromInputDate, $toInputDate])
                    ->where('a.last_name', $inputLastName)
                    ->where('a.first_name', $inputName)
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        } else if(strlen($inputName) > 0 && strlen($inputLastName) > 0){
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->where('a.last_name', $inputLastName)
                    ->where('a.first_name', $inputName)
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        } else if(strlen($fromInputDate) > 0 && strlen($inputName) > 0){
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->whereBetween('transaction.date_borrowed', [$fromInputDate, $toInputDate])
                    ->where('a.first_name', $inputName)
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        } else if(strlen($fromInputDate) > 0 && strlen($inputLastName) > 0){
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->whereBetween('transaction.date_borrowed', [$fromInputDate, $toInputDate])
                    ->where('a.last_name', $inputLastName)
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        } else if(strlen($inputName) > 0){
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->where('a.first_name', $inputName)
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        } else if(strlen($inputLastName) > 0){
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->where('a.last_name', $inputLastName)
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        } else if(strlen($fromInputDate) > 0){
            $data = Transaction::join('users as a', 'a.user_id', '=', 'transaction.user_id')
                    ->select('transaction.copy_id', 
                            'transaction.user_id', 
                            'a.last_name', 
                            'a.first_name',
                            'transaction.transaction_type',
                            'transaction.date_borrowed',
                            'transaction.due_date',
                            'transaction.return_date')
                    ->whereBetween('transaction.date_borrowed', [$fromInputDate, $toInputDate])
                    ->orderBy('transaction.updated_at', 'desc')
                    ->get();
        }
        return $data;
    }
}
