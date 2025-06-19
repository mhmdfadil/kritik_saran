<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Kritik dan Saran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('sweetalert2@11.js') }}"></script>
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
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .content {
      flex-grow: 1;
    }

    h1, h2, h3 {
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
      z-index: 50;
      background-color: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            <a href="{{ route('user.dashboard') }}" class="text-dark hover:text-gray-200 transition">Beranda</a>
            <a href="{{ route('user.kritiksaran') }}" class="text-dark hover:text-gray-200 transition active">Kritik & Saran</a>

            <a href="{{ route('user.hubungi') }}" class="text-dark hover:text-gray-200 transition">Hubungi Kami</a>

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
      <a href="{{ route('user.dashboard') }}" class="hover:bg-gray-100 p-2 rounded transition ">Beranda</a>
      <a href="{{ route('user.kritiksaran') }}" class="hover:bg-gray-100 p-2 rounded transition active">Kritik & Saran</a>
      <a href="{{ route('user.hubungi') }}" class="hover:bg-gray-100 p-2 rounded transition">Hubungi Kami</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="bg-gradient-to-r from-green-400 to-teal-500 py-20">
    <div class="container mx-auto text-center">
      <h1 class="text-5xl font-montserrat font-bold text-white mb-6">Formulir Kritik dan Saran</h1>
      <p class="text-lg text-white">Kami siap mendengarkan Anda untuk menciptakan layanan perpustakaan yang lebih baik. Sampaikan pendapat Anda dengan mudah melalui formulir kami. Masukan Anda sangat berarti.</p>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto py-16 content">
    <div class="grid  gap-10">
      <div class="col-span-1 bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Formulir Kritik dan Saran</h2>
        <form action="{{ route('user.kritiksaran') }}" method="POST">
          @csrf

          <div class="mb-6">
            <label for="nama" class="block text-lg font-semibold text-gray-700">Nama</label>
            <input type="text" id="nama" name="nama" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md" required>
          </div>

          <div class="mb-6">
            <label for="nim" class="block text-lg font-semibold text-gray-700">NIM</label>
            <input type="text" id="nim" name="nim" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md" required>
          </div>

          <div class="mb-6">
            <label for="prodi" class="block text-lg font-semibold text-gray-700">Program Studi</label>
            <select class="form-select w-full mt-2 px-4 py-2 border border-gray-300 rounded-md" name="prodi">
              <option value="">Pilih Program Studi</option>
              <option value="S-1 Administrasi Publik">S-1 Administrasi Publik</option>
              <option value="S-1 Administrasi Bisnis">S-1 Administrasi Bisnis</option>
              <option value="S-2 Magister Administrasi Publik">S-2 Magister Administrasi Publik</option>
              <option value="S-1 Ilmu Politik">S-1 Ilmu Politik</option>
              <option value="S-1 Ilmu Komunikasi">S-1 Ilmu Komunikasi</option>
              <option value="S-1 Antropologi">S-1 Antropologi</option>
              <option value="S-1 Sosiologi">S-1 Sosiologi</option>
              <option value="S-2 Magister Sosiologi">S-2 Magister Sosiologi</option>
          </select>
          </div>

          <div class="mb-6">
            <label for="judul" class="block text-lg font-semibold text-gray-700">Judul</label>
            <select id="judul" name="judul" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md" required>
                <option value="">Pilih Judul</option>
                <option value="Saran Peningkatan Pelayanan">Saran Peningkatan Pelayanan</option>
                <option value="Kritik Tentang Fasilitas">Kritik Tentang Fasilitas</option>
                <option value="Keluhan Layanan Pinjaman">Keluhan Layanan Pinjaman</option>
                <option value="Saran Peningkatan Koleksi Buku">Saran Peningkatan Koleksi Buku</option>
                <option value="Pengalaman Pelayanan">Pengalaman Pelayanan</option>
                <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                <option value="asalah Waktu Pelayanan">Masalah Waktu Pelayanan</option>
                <option value="Permintaan Fasilitas Tambahan">Permintaan Fasilitas Tambahan</option>
                <option value="Apresiasi Pelayanan">Apresiasi Pelayanan</option>
                <option value="Usulan Program Edukasi">Usulan Program Edukasi</option>
            </select>
        </div>
        
          
          <div class="mb-6">
            <label for="deskripsi" class="block text-lg font-semibold text-gray-700">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md" rows="4" required></textarea>
          </div>
          
          <div class="mb-6">
            <label for="tgl_layanan" class="block text-lg font-semibold text-gray-700">Tanggal Layanan</label>
            <input type="text" id="tgl_layanan" name="tgl_layanan" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md" value="" readonly required>
          </div>
          
          <div>
            <button type="submit" class="btn-primary py-2 px-4 rounded-md">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Perpustakaan Fisip | UNIMAL. Semua Hak Dilindungi.</p>
    </div>
  </footer>

  <!-- JavaScript for Menu Toggle -->
  <script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
      const menu = document.getElementById('menu');
      menu.classList.toggle('hidden');
    });
  </script>
  
  <!-- Script for setting the current date in "tgl_layanan" -->
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
      document.getElementById('tgl_layanan').value = formattedDate;
    });
  </script>
  

  <script>
    document.addEventListener('DOMContentLoaded', function () {
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
