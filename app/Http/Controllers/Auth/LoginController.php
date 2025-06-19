<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\KritikSaran;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('login');
    }

   
    // Tampilkan halaman dashboard (untuk fleksibilitas)
    public function user_dashboard() 
    {
    
        return view('user/dashboard');
    }

    public function admin_dashboard() 
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 

        // Hitung jumlah Kritiksaran dengan tgl_selesainya tidak null
        $kritiksaranCount = KritikSaran::whereNotNull('tgl_selesai')->count();

        return view('admin/dashboard', compact('user', 'kritiksaranCount'));
    }

    public function dekan_dashboard() 
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 

        // Hitung jumlah Kritiksaran dengan tgl_selesainya tidak null
        $kritiksaranCount = KritikSaran::whereNotNull('tgl_selesai')->count();

        return view('dekan/dashboard', compact('user', 'kritiksaranCount'));
    }

    // Proses login
    public function login(Request $request)
    {        
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil
            $user = Auth::user(); 

            // Cek level pengguna dan arahkan ke dashboard yang sesuai
            if ($user->level === 'Admin') {
                return redirect()->route('admin.dashboard')->with('success', "Selamat datang, $user->nama!");
            } elseif ($user->level === 'Dekan') {
                return redirect()->route('dekan.dashboard')->with('success', "Selamat datang, $user->nama!");
            } else {
                // Jika level tidak dikenali, logout dan beri pesan kesalahan
                Auth::logout();
                return redirect()->route('login')->with('error', 'Hak akses tidak valid.');
            }
        } else {
            // Jika login gagal
            return redirect()->back()->with('error', 'Email atau password salah!');
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
