<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookMaintenanceController extends Controller
{
    public function index()
    {
        $books = Book::orderBy(DB::raw('DATE(updated_at)'), 'desc')
                    ->orderBy(DB::raw('TIME(updated_at)'), 'desc')->get();
        return view('maintenance.books.books', compact('books'));
    }
    public function create()
    {
        return view('maintenance.books.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'accession'         => 'required|string|max:50',
            'call_number'       => 'required|string|max:50',
            'title'             => 'required|string|max:255',
            'authors'           => 'sometimes',
            'edition'           => 'sometimes',
            'publication'       => 'required|string|max:255',
            'publisher'         => 'required|string|max:255',
            'copyright'         => 'required|string|max:50',
            'remarks'           => 'required',
            'cover_image'       => 'sometimes',
            'digital_copy_url'  => 'sometimes'
        ]);
        DB::beginTransaction();
        try{
            Book::create([
                'accession'             => $request->input('accession'),
                'call_number'           => $request->input('call_number'),
                'title'                 => $request->input('title'),
                'authors'               => $request->input('authors'),
                'edition'               => $request->input('edition'),
                'place_of_publication'  => $request->input('publication'),
                'publisher'             => $request->input('publisher'),
                'copyrights'            => $request->input('copyright'),
                'remarks'               => $request->input('remarks'),
                'cover_image'            => $request->input('cover_image'),
                'digital_copy_url'      => $request->input('digital_copy_url'),
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            return redirect()->back()->with('toast-error', 'Something went wrong!');
        }
        DB::commit();
        return redirect()->back()->with('toast-success', 'Book added successfully');
    }
    public function edit(Request $request)
    {
        $book = null;
        DB::beginTransaction();
        try{
            $accession = array_keys($request->all())[0]; 
            $book = Book::where('accession', $accession)->first();
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('toast-error', 'Something went wrong!');
        }
        DB::commit();
        return view('maintenance.books.edit', compact('book'));
    }
    public function show(Request $request)
    {
        $books = Book::where('accession', $request->input('search-accession'))->get();
        return view('maintenance.books.books', compact('books'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'accession'         => 'required|string|max:50',
            'call_number'       => 'required|string|max:50',
            'title'             => 'required|string|max:255',
            'authors'           => 'sometimes',
            'edition'           => 'sometimes',
            'publication'       => 'required|string|max:255',
            'publisher'         => 'required|string|max:255',
            'copyright'         => 'required|string|max:50',
            'remarks'           => 'required',
            'cover_image'       => 'sometimes',
            'digital_copy_url'  => 'sometimes'
        ]);
        DB::beginTransaction();
        try{
            $book = Book::where('accession', $request->input('id'));
            $book->update([
                'accession'             => $request->input('accession'),
                'call_number'           => $request->input('call_number'),
                'title'                 => $request->input('title'),
                'authors'               => $request->input('authors'),
                'edition'               => $request->input('edition'),
                'place_of_publication'  => $request->input('publication'),
                'publisher'             => $request->input('publisher'),
                'copyrights'            => $request->input('copyright'),
                'remarks'               => $request->input('remarks'),
                'cover_image'           => $request->input('cover_image'),
                'digital_copy_url'      => $request->input('digital_copy_url')
            ]);
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            return redirect()->back()->with('toast-error', 'Something went wrong!');
        }
        DB::commit();
        return redirect()->back()->with('toast-success', 'Book updated successfully');
    }
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = array_keys($request->all())[0];
            Book::find($id)->delete();
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            return redirect()->route('books')->with('toast-error', 'Something went wrong!');
        }
        DB::commit();
        return redirect()->route('books')->with('toast-success', 'Book deleted successfully');
    }
}
