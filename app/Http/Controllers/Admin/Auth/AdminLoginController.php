<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
        $remember = $request->has('remember');
        $email = Admin::where('email', $credentials['email'])->first();
        if (!$email) return redirect()->back()->with('toast-warning', 'Email not found');
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('toast-warning', 'Invalid credentials');
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $sessionPath = config('session.files');
        $files = File::files($sessionPath);
        foreach ($files as $file) {
            File::delete($file);
        }
        return redirect()->route('welcome');
    }
    public function test(){
        // sample function testing
    }
}
