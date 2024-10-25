<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class LoginController extends Controller
{
   // Menampilkan form login
   public function showLoginForm()
   {
       return view('auth.login');
   }

   // Proses login
   public function login(Request $request)
   {
       // Validasi input login
       $credentials = $request->validate([
           'email' => 'required|email',
           'password' => 'required|string',
       ]);

       // Attempt login
       if (Auth::attempt($credentials)) {
           $user = Auth::user();
           
           // Redirect berdasarkan role
           if ($user->role === 'admin') {
               return redirect()->route('dashboard-admin');
           } elseif ($user->role === 'mentor') {
               return redirect()->route('mentor.dashboard');
           } else {
               return redirect()->route('user.dashboard');
           }
       }

       // Jika gagal login
       return back()->withErrors([
           'email' => 'Email atau password salah.',
       ]);
   }

   // Proses logout
   public function logout(Request $request)
   {
       Auth::logout();
       return redirect('/');
   }
}
