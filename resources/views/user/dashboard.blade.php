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
      flex-grow: 1; /* Ensure content area takes up remaining space */
    }

    h1, h2, h3, .font-montserrat {
      font-family: 'Montserrat', sans-serif;
    }

    .btn-primary {
      background-color: var(--primary);
      color: white;
      transition: all 0.3s ease;
    }
    .content {
  flex-grow: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}
.grid {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
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
            <a href="{{ route('user.dashboard') }}" class="text-dark hover:text-gray-200 transition active">Beranda</a>
            <a href="{{ route('user.kritiksaran') }}" class="text-dark hover:text-gray-200 transition">Kritik & Saran</a>
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
      <a href="{{ route('user.dashboard') }}" class="hover:bg-gray-100 p-2 rounded transition active">Beranda</a>
      <a href="{{ route('user.kritiksaran') }}" class="hover:bg-gray-100 p-2 rounded transition">Kritik & Saran</a>
      <a href="{{ route('user.hubungi') }}" class="hover:bg-gray-100 p-2 rounded transition">Hubungi Kami</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="bg-gradient-to-r from-green-400 to-teal-500 py-20">
    <div class="container mx-auto text-center text-white">
      <h1 class="text-5xl font-montserrat font-bold mb-6">Layanan Kritik & Saran Perpustakaan</h1>
      <p class="text-lg">Kami siap mendengarkan Anda untuk menciptakan layanan perpustakaan yang lebih baik.</p>
    </div>
  </header>

  <main class="container mx-auto py-20 content justify-center items-center">
    <div class="grid grid-cols-1 justify-center items-center">
      <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-montserrat font-bold mb-4 text-primary">Kirim Kritik & Saran</h2>
        <p class="text-gray-600 mb-6">Sampaikan pendapat Anda dengan mudah melalui formulir kami. Masukan Anda sangat berarti.</p>
        <a href="{{ route('user.kritiksaran') }}" class="btn-primary px-6 py-3 rounded-lg inline-block text-center">Mulai Sekarang</a>
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
