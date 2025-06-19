<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Kritik dan Saran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('sweetalert2@11.js') }}"></script>
    <!-- DataTables JS and CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    :root {
      --primary: #2ecc71; /* Emerald */
      --secondary: #f1c40f; /* Gold */
      --background: #f8f9fa; /* Light Gray */
      --text-dark: #2d3436; /* Dark Gray */
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: var(--background);
      color: var(--text-dark);
    }

    h1, h2, h3, .font-montserrat {
      font-family: 'Montserrat', sans-serif;
    }

    .btn-primary {
      background-color: var(--primary);
      color: white;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #27ae60;
    }

    .btn-secondary {
      background-color: var(--secondary);
      color: white;
      transition: all 0.3s ease;
    }

    .btn-secondary:hover {
      background-color: #d4ac0d;
    }
    .active {
        font-weight: bold;
        color: var(--primary);
    }
    .navbar {
      position: sticky;
      top: 0;
      z-index: 50; /* Ensure it stays above content */
      background-color: white; /* You can use Tailwind classes as well */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow */
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container mx-auto flex items-center justify-between py-4 px-2">
      <a href="#" class="text-2xl font-montserrat font-bold text-dark">Layanan Kritik dan Saran</a>
       <!-- Desktop Menu -->
        <div class="hidden md:flex flex-col md:flex-row md:space-x-8 space-y-4 md:space-y-0 mt-4 md:mt-0">
            <a href="{{ route('dekan.dashboard') }}" class="text-dark hover:text-gray-200 transition">Beranda</a>
            <a href="{{ route('dekan.manajemen') }}" class="text-dark hover:text-gray-200 transition active">Manajemen</a>
            <a href="{{ route('dekan.profil') }}" class="text-dark hover:text-gray-200 transition">Profil</a>
            <a href="{{ route('logout') }}" class="text-dark hover:text-gray-200 transition">Keluar</a>
        </div>
      <!-- Hamburger Icon -->
      <button id="menu-toggle" class="block md:hidden text-dark focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
    <!-- Dropdown Menu -->
    <div id="menu" class="hidden flex flex-col space-y-4 bg-white text-primary py-4 px-6 shadow-lg md:hidden">
      <a href="{{ route('dekan.dashboard') }}" class="hover:bg-gray-100 p-2 rounded transition">Beranda</a>
      <a href="{{ route('dekan.manajemen') }}" class="hover:bg-gray-100 p-2 rounded transition active">Manajemen</a>
      <a href="{{ route('dekan.profil') }}" class="hover:bg-gray-100 p-2 rounded transition">Profil</a>
      <a href="{{ route('logout') }}" class="hover:bg-gray-100 p-2 rounded transition">Keluar</a>
    </div>
  </nav>

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-green-400 to-teal-500 py-20">
      <div class="container mx-auto text-center">
          <h1 class="text-4xl font-montserrat font-bold text-white mb-4">Detail Kritik dan Saran</h1>
          <p class="text-lg text-white opacity-90">Berikut adalah rincian lengkap dari masukan yang telah sampaikan pengguna serta tanggapan.</p>
      </div>
  </header>
  
  
    <main class="bg-gradient-to-b from-gray-50 to-gray-200 min-h-screen py-10 px-4">
      <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden">
          <!-- Kop -->
          <div class="text-center bg-gradient-to-r from-green-700 to-yellow-400 text-white py-6 px-4">
              <img src="{{ asset('img/UNIMAL.png') }}" alt="Logo Perpustakaan" class="mx-auto h-20">
              <h1 class="text-2xl font-bold mt-4">Perpustakaan Universitas Malikussaleh</h1>
              <p class="text-sm opacity-90">Layanan Kritik dan Saran</p>
          </div>
  
          <!-- Informasi Formulir Kritik dan Saran -->
          <div class="p-8 space-y-6">
              <div class="border-b pb-4">
                  <h2 class="text-xl font-semibold text-gray-800">Nama</h2>
                  <p class="text-gray-700">{{ $kritiksaran->nama }}</p>
              </div>
              <div class="border-b pb-4">
                <h2 class="text-xl font-semibold text-gray-800">NIM</h2>
                <p class="text-gray-700">{{ $kritiksaran->nim }}</p>
            </div>
            <div class="border-b pb-4">
              <h2 class="text-xl font-semibold text-gray-800">Program Studi</h2>
              <p class="text-gray-700">{{ $kritiksaran->prodi }}</p>
          </div>
            
              <div class="border-b pb-4">
                  <h2 class="text-xl font-semibold text-gray-800">Judul Kritik/Saran</h2>
                  <p class="text-gray-700"> {{ $kritiksaran->judul }} </p>
              </div>
              <div class="border-b pb-4">
                  <h2 class="text-xl font-semibold text-gray-800">Deskripsi</h2>
                  <p class="text-gray-700">
                      {{ $kritiksaran -> deskripsi }}
                  </p>
              </div>
              <div class="border-b pb-4">
                  <h2 class="text-xl font-semibold text-gray-800">Tanggal Layanan</h2>
                  <p class="text-gray-700">{{ \Carbon\Carbon::parse($kritiksaran->tgl_layanan)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
              </div>
              <div class="border-b pb-4">
                  <h2 class="text-xl font-semibold text-gray-800">Status</h2>
                  @if ($kritiksaran->status == 'Baru')
                    <span class="bg-blue-100 text-blue-800 py-1 px-2 rounded-full text-xs">Baru</span>
                  @elseif ($kritiksaran->status == 'Proses')
                    <span class="bg-yellow-100 text-yellow-800 py-1 px-2 rounded-full text-xs">Proses</span>
                  @elseif ($kritiksaran->status == 'Selesai')
                    <span class="bg-green-100 text-green-800 py-1 px-2 rounded-full text-xs">Selesai</span>
                  @else
                    <span class="bg-gray-100 text-gray-800 py-1 px-2 rounded-full text-xs">Tidak Diketahui</span>
                  @endif
              </div>
              <div class="border-b pb-4">
                <h2 class="text-xl font-semibold text-gray-800">Tanggapan</h2>
                @if($kritiksaran->tanggapan)
                    <!-- Menampilkan tanggapan dan tanggal selesai jika sudah ada -->
                    <p class="text-gray-700">
                        {{ $kritiksaran->tanggapan }}
                    </p>
              </div>
                    <h2 class="text-xl font-semibold text-gray-800 mt-4">Tanggal Selesai</h2>
                    <p class="text-gray-700">
                      {{ \Carbon\Carbon::parse($kritiksaran->tgl_selesai)->locale('id')->isoFormat('D MMMM YYYY') }}
                    </p>
                @else
                    <!-- Menampilkan form untuk input tanggapan dan tanggal selesai -->
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea 
                            name="tanggapan" 
                            rows="4" 
                            class="w-full mt-2 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Masukkan tanggapan"></textarea>
                        <h2 class="text-xl font-semibold text-gray-800 mt-4">Tanggal Selesai</h2>
                        <input 
                            type="text" 
                            name="tgl_selesai" id="tgl_selesai"
                            class="w-full mt-2 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Pilih tanggal selesai" value="" readonly>
                        @if($kritiksaran->status === 'Proses')
                            
                        @endif
                    </form>
                @endif
            </div>
            
            
          </div>
  
          <!-- Tombol Kembali -->
          <div class="bg-gray-100 p-6 text-center">
              <a href="{{ route('dekan.manajemen') }}" 
                  class="px-6 py-3 bg-green-700 text-white rounded-lg shadow hover:bg-green-800 transition">
                  Kembali
              </a>
          </div>
      </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 py-6">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Perpustakaan Fisip | UNIMAL. Semua Hak Dilindungi.</p>
    </div>
  </footer>

   <!-- Script for setting the current date in "tgl_selesai" -->
   <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Mendapatkan tanggal saat ini dalam zona waktu Jakarta
      const now = new Date().toLocaleString('en-US', { timeZone: 'Asia/Jakarta' });
  
      // Membuat objek Date dari string yang sudah diformat
      const date = new Date(now);
  
      // Mendapatkan tanggal, bulan, dan tahun
      const day = String(date.getDate()).padStart(2, '0'); // Menambahkan leading zero jika hari < 10
      const month = String(date.getMonth() + 1).padStart(2, '0'); // Menambahkan leading zero jika bulan < 10
      const year = date.getFullYear();
  
      // Format tanggal dalam bentuk dd-mm-yyyy
      const formattedDate = `${day}-${month}-${year}`;
  
      // Mengatur nilai input dengan ID 'tgl_layanan' menggunakan tanggal yang sudah diformat
      document.getElementById('tgl_selesai').value = formattedDate;
    });
  </script>
  

  <!-- JavaScript for Menu Toggle -->
  <script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
      

      const menu = document.getElementById('menu');
      menu.classList.toggle('hidden');
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
            // Initialize DataTable
    $('#manajemen-table').DataTable();

      const menuItems = document.querySelectorAll('.menu-item');
      const currentPage = window.location.pathname; // Ambil URL saat ini
  
      menuItems.forEach(item => {
        const href = item.getAttribute('href');
        if (currentPage.includes(href)) {
          item.classList.add('active');
        } else {
          item.classList.remove('active');
        }
      });
    });
  </script>
  <script src="{{ asset('sweetalert2@11.js') }}"></script>
  @if (session('success'))
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '{{ session("success") }}',
          showConfirmButton: false,
          timer: 3000
      });
  });
  </script>
  @endif

  @if (session('error'))
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: '{{ session("error") }}',
          showConfirmButton: false,
          timer: 3000
      });
  });
  </script>
  @endif

</body>
</html>
