<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentMaintenanceController extends Controller
{
    public function index()
    {
        $students = User::orderBy(DB::raw('DATE(updated_at)'), 'desc')
                    ->orderBy(DB::raw('TIME(updated_at)'), 'desc')->get();
        return view('maintenance.students.students', compact('students'));
    }
    public function create()
    {
        return view('maintenance.students.create');
    }
    public function show(Request $request)
    {
        $students = User::where('rfid_tag', $request->input('search-users'))->get();
        return view('maintenance.students.students', compact('students'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'rfid'          => 'required|string|max:50',
            'first-name'    => 'required|string|max:50',
            'middle-name'   => 'max:50',
            'last-name'     => 'required|string|max:50',
            'suffix'        => 'sometimes|max:10',
            'grade'         => 'sometimes|max:10',
            'section'       => 'sometimes|max:50',
            'role'          => 'required',
            'email'         => 'required|email',
            'profile-image' => 'sometimes|image|mimes:jpeg,png,jpg',
        ]);
        if(!preg_match('/^[0-9]+$/', $request->input('rfid'))){
            return redirect()->back()->with('toast-warning', 'RFID number is invalid');
        } else if($this->has_invalid_characters($request->input('first-name'))){
            return redirect()->back()->with('toast-warning', 'User\'s name contains invalid characters');
        } else if($request->input('middle-name') != null && $this->has_invalid_characters($request->input('middle-name'))){
            return redirect()->back()->with('toast-warning', 'User\'s middle name contains invalid characters');
        } else if($this->has_invalid_characters($request->input('last-name'))){
            return redirect()->back()->with('toast-warning', 'User\'s last name contains invalid characters');
        } else if(!in_array($request->input('suffix'), ['Jr.', 'Sr.', 'II', 'III', 'IV', ''])){
            return redirect()->back()->with('toast-warning', 'User\'s suffix is invalid');
        } else if($request->input('grade') != null && !in_array($request->input('grade'), ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', ''])){
            return redirect()->back()->with('toast-warning', 'User\'s grade is invalid');
        } else if($request->input('section') != null && !preg_match('/^[A-Z]$/', $request->input('section'))){
            return redirect()->back()->with('toast-warning', 'User\'s section contains invalid characters');
        }
        DB::beginTransaction();
        try{
            User::create([
                'lrn'           => $request->input('lrn') == '' ? null : $request->input('lrn'),
                'rfid_tag'      => $request->input('rfid'),
                'employee_id'   => $request->input('employeeID') == '' ? null : $request->input('employeeID'),
                'first_name'    => $request->input('first-name'),
                'middle_name'   => $request->input('middle-name'),
                'last_name'     => $request->input('last-name'),
                'suffix'        => $request->input('suffix')    == '' ? null : $request->input('suffix'),
                'grade_level'   => $request->input('grade')     == '' ? null : $request->input('grade'),
                'section'       => $request->input('section')   == '' ? null : $request->input('section'),
                'role_id'       => $request->input('role') == 'Student' ? 5 : ($request->input('role') == 'Faculty' ? 3 : ($request->input('role') == 'Admin' ? 1 : ($request->input('role') == 'Librarian' ? 2 : 4))),
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('password')),
                'profile_image' => $request->input('profile-image') == '' ? null : $request->input('profile-image'),
                'penalty_total' => 0
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('toast-error', 'User with RFID or email ' . $request->input('rfid') . ' already exists. Error code: ' . $e->getMessage());
        }
        DB::commit();
        return redirect()->back()->with('toast-success', 'User added successfully');
    }
    public function edit(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = array_keys($request->all())[0];
            $user = User::where('user_id', $id)->first();
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            return redirect()->back()->with('toast-error', 'Something went wrong!');
        }
        DB::commit();
        return view('maintenance.students.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'rfid'          => 'required|string|max:50',
            'first-name'    => 'required|string|max:50',
            'middle-name'   => 'max:50',
            'last-name'     => 'required|string|max:50',
            'suffix'        => 'sometimes|max:10',
            'grade'         => 'sometimes|max:10',
            'section'       => 'sometimes|max:50',
            'role'          => 'required',
            'email'         => 'required|email',
            'profile-image' => 'sometimes|image|mimes:jpeg,png,jpg',
        ]);
        if(!preg_match('/^[0-9]+$/', $request->input('rfid'))){
            return redirect()->back()->with('toast-warning', 'RFID number is invalid');
        } else if($this->has_invalid_characters($request->input('first-name'))){
            return redirect()->back()->with('toast-warning', 'User\'s name contains invalid characters');
        } else if($this->has_invalid_characters($request->input('middle-name'))){
            return redirect()->back()->with('toast-warning', 'User\'s middle name contains invalid characters');
        } else if($this->has_invalid_characters($request->input('last-name'))){
            return redirect()->back()->with('toast-warning', 'User\'s last name contains invalid characters');
        } elseif(!in_array($request->input('suffix'), ['Jr.', 'Sr.', 'II', 'III', 'IV', ''])){
            return redirect()->back()->with('toast-warning', 'User\'s suffix is invalid');
        } elseif($request->input('grade') != null && !in_array($request->input('grade'), ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', ''])){
            return redirect()->back()->with('toast-warning', 'User\'s grade is invalid');
        } else if($request->input('section') != null && !preg_match('/^[A-Z]$/', $request->input('section'))){
            return redirect()->back()->with('toast-warning', 'User\'s section contains invalid characters');
        }
        DB::beginTransaction();
        try{
            $user = User::where('user_id', $request->input('id'))->first();
            $user->update([
                'lrn'           => $request->input('lrn'),
                'rfid_tag'      => $request->input('rfid'),
                'employee_id'   => $request->input('employeeID'),
                'first_name'    => $request->input('first-name'),
                'middle_name'   => $request->input('middle-name'),
                'last_name'     => $request->input('last-name'),
                'suffix'        => $request->input('suffix')    == '' ? null : $request->input('suffix'),
                'grade_level'   => $request->input('grade')     == '' ? null : $request->input('grade'),
                'section'       => $request->input('section')   == '' ? null : $request->input('section'),
                'role_id'       => $request->input('role') == 'Student' ? 5 : ($request->input('role') == 'Faculty' ? 3 : ($request->input('role') == 'Admin' ? 1 : ($request->input('role') == 'Librarian' ? 2 : 4))),
                'email'         => $request->input('email'),
                'password'      => Hash::make($request->input('password')),
                'profile_image' => $request->input('profile-image') == '' ? null : $request->input('profile-image'),
                'penalty_total' => 0
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('toast-error', 'Something went wrong!');
        }
        DB::commit();
        return redirect()->back()->with('toast-success', 'User updated successfully');
    }
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = array_keys($request->all())[0];
            User::find($id)->delete();
        } catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            return redirect()->back()->with('delete-error', $e->getMessage());
        }
        DB::commit();
        return redirect()->back()->with('toast-success', 'User deleted successfully');
    }
    private function has_invalid_characters($name) {
        $pattern = '/^[a-zA-ZáéíóúñÁÉÍÓÚÑ]+$/';
        return !(bool) preg_match($pattern, $name); 
    }
}
