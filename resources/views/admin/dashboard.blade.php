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
            <a href="{{ route('admin.dashboard') }}" class="text-dark hover:text-gray-200 transition active">Beranda</a>
            <a href="{{ route('admin.manajemen') }}" class="text-dark hover:text-gray-200 transition">Manajemen</a>
            <a href="{{ route('admin.profil') }}" class="text-dark hover:text-gray-200 transition">Profil</a>
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
      <a href="{{ route('admin.dashboard') }}" class="hover:bg-gray-100 p-2 rounded transition active">Beranda</a>
      <a href="{{ route('admin.manajemen') }}" class="hover:bg-gray-100 p-2 rounded transition">Manajemen</a>
      <a href="{{ route('admin.profil') }}" class="hover:bg-gray-100 p-2 rounded transition">Profil</a>
      <a href="{{ route('logout') }}" class="hover:bg-gray-100 p-2 rounded transition">Keluar</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="bg-gradient-to-r from-green-400 to-teal-500 py-20">
    <div class="container mx-auto text-center text-white">
      <h1 class="text-5xl font-montserrat font-bold mb-6">Layanan Kritik & Saran Perpustakaan</h1>
      <p class="text-lg">Kelola dan pantau semua masukan untuk meningkatkan layanan perpustakaan.</p>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
      <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-montserrat font-bold mb-4 text-primary">Total Kritik & Saran</h2>
        <p class="text-gray-600 mb-6">Jumlah total kritik dan saran yang telah diterima dan dikelola.</p>
        <div class="bg-green-100 p-4 rounded-lg">
          <h3 class="text-2xl font-montserrat font-bold text-primary"> {{ $kritiksaranCount }}</h3>
          <p class="text-gray-600">Kritik dan Saran Terhitung</p>
        </div>
      </div>
      <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-montserrat font-bold mb-4 text-primary">Kelola Manajemen</h2>
        <p class="text-gray-600 mb-6">Manajemen masukan yang telah diterima untuk ditindaklanjuti.</p>
        <a href="{{ route('admin.manajemen') }}" class="btn-primary px-6 py-3 rounded-lg inline-block text-center">Kelola Masukan</a>
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
