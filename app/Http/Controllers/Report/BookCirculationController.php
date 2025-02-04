<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookCirculationController extends Controller
{
    public function index()
    {
        $barcode        = "";
        $title          = "";
        $availability   = "";
        $data           = array();
        return view('report.book-circulations.book-circulations', compact('data', 'barcode', 'title', 'availability'));
    }
    public function retrieve(Request $request)
    {
        $barcode        = $request->input('barcode');
        $title          = $request->input('title');
        $availability   = $request->input('availability');
        $findBtn        = $request->input('findBtn');
        $findAllBtn     = $request->input('findAllBtn');
        $data           = array();
        if($findBtn == 'activated'){
            if(strlen($barcode) == 0 && strlen($title) == 0 && $availability == 'Choose availability status'){
                return redirect()->route('report.book-circulation')->with('toast-warning', 'Please enter at least one search criteria.');
            } else if(strlen($barcode) != 0 || strlen($title) != 0 || strlen($availability) != 0){
                $data = $this->generateData($request);
            }
        } else if($findAllBtn == 'activated'){
            $barcode        = "";
            $title          = "";
            $availability   = "";
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->orderBy('book.title', 'asc')
                    ->get();
        }
        if(!count($data)) return redirect()->route('report.book-circulation')->with('toast-error', 'No data found.');
        return view('report.book-circulations.book-circulations', compact('data', 'barcode', 'title', 'availability'));
    }
    private function generateData(Request $request)
    {
        $barcode        = $request->input('barcode');
        $title          = $request->input('title');
        $availability   = $request->input('availability');
        $data           = array();
        if(strlen($barcode) > 0 && strlen($title) > 0 && strlen($availability) > 0 && $availability != 'Choose availability status'){
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->where('book.title', 'like', '%'.$title.'%')
                    ->where('c.barcode', $barcode)
                    ->where('c.availability_status', $availability)
                    ->orderBy('book.title', 'asc')
                    ->get();
        } else if(strlen($barcode) > 0 && strlen($title) > 0){
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->where('book.title', 'like', '%'.$title.'%')
                    ->where('c.barcode', $barcode)
                    ->orderBy('book.title', 'asc')
                    ->get();
        } else if(strlen($title) > 0 && strlen($availability) > 0 && $availability != 'Choose availability status'){
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->where('book.title', 'like', '%'.$title.'%')
                    ->where('c.availability_status', $availability)
                    ->orderBy('book.title', 'asc')
                    ->get();
        } else if(strlen($barcode) > 0 && strlen($availability) > 0 && $availability != 'Choose availability status'){
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->where('c.barcode', $barcode)
                    ->where('c.availability_status', $availability)
                    ->orderBy('book.title', 'asc')
                    ->get();
        } else if(strlen($title) > 0){
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->where('book.title', 'like', '%'.$title.'%')
                    ->orderBy('book.title', 'asc')
                    ->get();
        } else if(strlen($barcode) > 0){
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->where('c.barcode', $barcode)
                    ->orderBy('book.title', 'asc')
                    ->get();
        } else if(strlen($availability) > 0 && $availability != 'Choose availability status'){
            $data = Book::join('copies as c', 'c.book_id', '=','book.book_id')
                    ->select('c.book_id',
                            'c.copy_id', 
                            'book.title',
                            'c.barcode', 
                            'c.availability_status',
                            'c.condition_status')
                    ->where('c.availability_status', $availability)
                    ->orderBy('book.title', 'asc')
                    ->get();
        }
        return $data;
    }
}
