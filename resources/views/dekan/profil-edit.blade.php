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
            <a href="{{ route('dekan.dashboard') }}" class="text-dark hover:text-gray-200 transition ">Beranda</a>
            <a href="{{ route('dekan.manajemen') }}" class="text-dark hover:text-gray-200 transition">Manajemen</a>
            <a href="{{ route('dekan.profil') }}" class="text-dark hover:text-gray-200 transition active">Profil</a>
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
      <a href="{{ route('dekan.manajemen') }}" class="hover:bg-gray-100 p-2 rounded transition">Manajemen</a>
      <a href="{{ route('dekan.profil') }}" class="hover:bg-gray-100 p-2 rounded transition active">Profil</a>
      <a href="{{ route('logout') }}" class="hover:bg-gray-100 p-2 rounded transition">Keluar</a>
    </div>
  </nav>

   <!-- Header Section -->
<header class="bg-gradient-to-r from-green-400 to-teal-500 py-20">
  <div class="container mx-auto text-center">
    <h1 class="text-5xl font-montserrat font-bold text-white mb-6">Ubah Profil</h1>
    <p class="text-lg text-white">Perbarui informasi pribadi Anda di sini. Pastikan data Anda selalu terbaru untuk pengalaman layanan terbaik.</p>
  </div>
</header>

<!-- Main Content -->
<main class="container mx-auto py-16 content">
  <div class="grid gap-10">
    <div class="col-span-1 bg-white p-8 rounded-xl shadow-lg">
      <h2 class="text-2xl font-semibold mb-6 flex items-center">
        Ubah Profil
      </h2>
      <form method="POST" action="{{ route('dekan.profil') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}" >
        <ul class="space-y-4">
          <li>
            <label for="nama" class="block text-sm font-semibold">Nama:</label>
            <input type="text" id="nama" name="nama" value="{{ $user->nama }}" class="w-full px-4 py-2 border rounded-lg" required>
          </li>
          <li>
            <label for="email" class="block text-sm font-semibold">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-lg" required>
          </li>
          <li>
            <label for="alamat" class="block text-sm font-semibold">Alamat:</label>
            <textarea id="alamat" name="alamat" class="w-full px-4 py-2 border rounded-lg" required>{{ $user->alamat }}</textarea>
          </li>
          <li>
            <label for="no_hp" class="block text-sm font-semibold">No HP:</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" class="w-full px-4 py-2 border rounded-lg" required>
          </li>
          <li>
            <label for="tgl_lahir" class="block text-sm font-semibold">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ $user->tgl_lahir }}" class="w-full px-4 py-2 border rounded-lg" required>
          </li>
        </ul>
        <div class="mt-6 flex justify-between">
          <a href="{{ url()->previous() }}" class="px-6 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">
            Kembali
          </a>
          <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</main>


  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 py-6">
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
