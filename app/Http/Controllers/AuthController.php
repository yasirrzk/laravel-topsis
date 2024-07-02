<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function loginByGoogle(Request $request)
{
    $uid = $request->uid;
    $name = $request->name;
    $email = $request->email;

    // Cari pengguna berdasarkan uid
    $user = User::where('uid', $uid)->first();

    // Jika pengguna tidak ditemukan, buat pengguna baru
    if (!$user) {
        $user = User::create([
            'name' => $name,
            'uid' => $uid,
            'email' => $email,
            'password' => bcrypt($uid)
        ]);
    }

    // Pastikan $user tidak null sebelum mencoba login
        Auth::loginUsingId($user->id);

        return response()->json([
            'status' => 'success',
            'redirect' => route('dashboard')
        ]);
}

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);
  
        return redirect()->route('login');
    }
    
    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {   
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/');
    }


    public function profile()
    {
        return view('profile');
    }

}
