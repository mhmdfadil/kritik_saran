<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;

class KritikSaranController extends Controller
{
    public function user_index()
    {

        return view('user/kritiksaran');
    }

    public function user_hubungi()
    {

        return view('user/hubungi');
    }

    public function user_store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tgl_layanan' => 'required|date_format:d-m-Y', // Validasi format dd-mm-yyyy
        ]);

        // Mengubah tanggal 'tgl_layanan' dari dd-mm-yyyy ke yyyy-mm-dd menggunakan Carbon
        $tgl_layanan = Carbon::createFromFormat('d-m-Y', $request->tgl_layanan)->format('Y-m-d');

        // Menyimpan data kritik dan saran ke database
        $kritikSaran = new KritikSaran();
        $kritikSaran->nama = $request->nama;
        $kritikSaran->nim = $request->nim;
        $kritikSaran->prodi = $request->prodi;
        $kritikSaran->judul = $request->judul;
        $kritikSaran->deskripsi = $request->deskripsi;
        $kritikSaran->tgl_layanan = $tgl_layanan; // Menyimpan tanggal dalam format yyyy-mm-dd
        $kritikSaran->save();

        // Mengirimkan response sukses dengan pesan
        return redirect()->route('user.kritiksaran')->with('success', 'Kritik dan Saran Anda telah berhasil disimpan.');
    }

    public function admin_profil()
    {
        $userId = Auth::id();  
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $user = Auth::user(); 

        return view('admin/profil', compact('user'));
    }

    public function admin_profiledit()
    {
        $userId = Auth::id();  
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $user = Auth::user(); 

        return view('admin/profil-edit', compact('user'));
    }

   // Menangani perubahan profil 
    public function admin_profilupdate(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'user_id' => 'required|exists:tb_users,id',  // Validasi user_id
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tb_users,email,' . $request->input('user_id'),
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
        ]);

        // Mendapatkan pengguna berdasarkan user_id
        $user = User::findOrFail($request->input('user_id'));

        // Mengupdate data profil pengguna
        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'tgl_lahir' => $request->input('tgl_lahir'),
        ]);

        // Mengalihkan ke halaman profil dengan pesan sukses
        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function admin_manajemen()
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 
        $kritiksarans = KritikSaran::orderBy('created_at', 'desc')
                           ->get();

        return view('admin/manajemen', compact('user', 'kritiksarans')); // Pass the kritiksarans to the view
    }
    
    public function admin_manajemendetail($id)
    {
        // Pastikan pengguna telah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $userId = Auth::id();
    
        // Ambil kritik saran berdasarkan ID dan pastikan ID pengguna cocok
        $kritiksaran = KritikSaran::with('_user')
            ->where('id', $id) 
            ->first();
    
        // Jika data tidak ditemukan, tampilkan error
        if (!$kritiksaran) {
            return redirect()->route('admin.manajemen')->with('error', 'Data tidak ditemukan.');
        }
    
        return view('admin.manajemen-detail', [
            'user' => Auth::user(),
            'kritiksaran' => $kritiksaran
        ]);
    }

    public function updateTanggapan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggapan' => 'required|string|max:255',
            'tgl_selesai' => 'required|date_format:d-m-Y', // Validasi format dd-mm-yyyy
        ]);
        
         // Mengubah tanggal 'tgl_layanan' dari dd-mm-yyyy ke yyyy-mm-dd menggunakan Carbon
         $tgl_selesai = Carbon::createFromFormat('d-m-Y', $request->tgl_selesai)->format('Y-m-d');

        // Cari data berdasarkan ID
        $kritikSaran = KritikSaran::findOrFail($id);

        // Update tanggapan dan tanggal selesai
        $kritikSaran->update([
            'tanggapan' => $request->input('tanggapan'),
            'tgl_selesai' => $tgl_selesai,
            'status' => 'Selesai', // Set status menjadi Selesai
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.manajemen')->with('success', 'Tanggapan berhasil diperbarui.');
    }

    // Proses kritik saran
    public function admin_manajemenproses(Request $request)
    {
        // Ambil ID dari request
        $kritik_id = $request->input('kritik_id'); 

        // Temukan kritik saran berdasarkan ID yang dikirim dari form
        $kritiksaran = KritikSaran::findOrFail($kritik_id);

        // Update status menjadi "Proses"
        $kritiksaran->status = 'Proses';
        $kritiksaran->save();

        // Redirect ke halaman detail dengan pesan sukses
        return redirect()->route('admin.manajemen.detail', $kritik_id)
            ->with('success', 'Kritik Saran berhasil diproses.');
    }

    public function admin_manajemenselesai(Request $request)
    {
        // Ambil ID dari request
        $kritik_id = $request->input('kritik_id');
    
        // Temukan kritik saran berdasarkan ID yang dikirim dari form
        $kritiksaran = KritikSaran::findOrFail($kritik_id);
    
        // Set tanggal selesai ke waktu sekarang di zona waktu Asia/Jakarta
        $tgl_selesai = Carbon::now('Asia/Jakarta')->toDateString();
    
        // Update status menjadi "Selesai"
        $kritiksaran->tanggapan = ' - ';
        $kritiksaran->status = 'Selesai';
        $kritiksaran->tgl_selesai = $tgl_selesai;
        $kritiksaran->save();
    
        // Redirect ke halaman detail dengan pesan sukses
        return redirect()->route('admin.manajemen.detail', $kritik_id)
            ->with('success', 'Kritik Saran berhasil ditandai selesai.');
    }

    public function dekan_manajemen()
    {
        $userId = Auth::id();  

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user(); 
        $kritiksarans = KritikSaran::orderBy('created_at', 'desc')
                           ->get();

        return view('dekan/manajemen', compact('user', 'kritiksarans')); // Pass the kritiksarans to the view
    }
    
    public function dekan_manajemendetail($id)
    {
        // Pastikan pengguna telah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $userId = Auth::id();
    
        // Ambil kritik saran berdasarkan ID dan pastikan ID pengguna cocok
        $kritiksaran = KritikSaran::with('_user')
            ->where('id', $id) 
            ->first();
    
        // Jika data tidak ditemukan, tampilkan error
        if (!$kritiksaran) {
            return redirect()->route('dekan.manajemen')->with('error', 'Data tidak ditemukan.');
        }
    
        return view('dekan.manajemen-detail', [
            'user' => Auth::user(),
            'kritiksaran' => $kritiksaran
        ]);
    }

    public function dekan_profil()
    {
        $userId = Auth::id();  
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $user = Auth::user(); 

        return view('dekan/profil', compact('user'));
    }

    public function dekan_profiledit()
    {
        $userId = Auth::id();  
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $user = Auth::user(); 

        return view('dekan/profil-edit', compact('user'));
    }

   // Menangani perubahan profil 
    public function dekan_profilupdate(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'user_id' => 'required|exists:tb_users,id',  // Validasi user_id
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tb_users,email,' . $request->input('user_id'),
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'tgl_lahir' => 'required|date',
        ]);

        // Mendapatkan pengguna berdasarkan user_id
        $user = User::findOrFail($request->input('user_id'));

        // Mengupdate data profil pengguna
        $user->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'tgl_lahir' => $request->input('tgl_lahir'),
        ]);

        // Mengalihkan ke halaman profil dengan pesan sukses
        return redirect()->route('dekan.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    
}
