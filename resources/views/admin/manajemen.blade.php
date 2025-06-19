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
            <a href="{{ route('admin.dashboard') }}" class="text-dark hover:text-gray-200 transition">Beranda</a>
            <a href="{{ route('admin.manajemen') }}" class="text-dark hover:text-gray-200 transition active">Manajemen</a>
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
      <a href="{{ route('admin.dashboard') }}" class="hover:bg-gray-100 p-2 rounded transition">Beranda</a>
      <a href="{{ route('admin.manajemen') }}" class="hover:bg-gray-100 p-2 rounded transition active">Manajemen</a>
      <a href="{{ route('admin.profil') }}" class="hover:bg-gray-100 p-2 rounded transition">Profil</a>
      <a href="{{ route('logout') }}" class="hover:bg-gray-100 p-2 rounded transition">Keluar</a>
    </div>
  </nav>

  <!-- Hero Section -->
<header class="bg-gradient-to-r from-green-400 to-teal-500 py-20">
  <div class="container mx-auto text-center">
    <h1 class="text-5xl font-montserrat font-bold text-white mb-6">Manajemen Kritik dan Saran</h1>
    <p class="text-lg text-white">Kelola dan tindak lanjuti masukan yang telah diberikan oleh pengguna untuk meningkatkan kualitas layanan.</p>
  </div>
</header>


<!-- Main Content -->
<main class="container mx-auto py-16">
    <div class="grid gap-10">
      <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Manajemen Kritik dan Saran</h2>
        
        <table id="manajemen-table" class="min-w-full table-auto border-collapse">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-4 py-2 border">No</th>
              <th class="px-4 py-2 border">Tanggal Layanan</th>
              <th class="px-4 py-2 border">Judul</th>
              <th class="px-4 py-2 border">Status</th>
              <th class="px-4 py-2 border">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kritiksarans as $index => $kritiksaran)
            <tr class="odd:bg-gray-50">
              <td class="px-4 py-2 border text-center" width="25px">{{ $index + 1 }}</td>
              <td class="px-4 py-2 border text-center" width="250px">
                {{ \Carbon\Carbon::parse($kritiksaran->tgl_layanan)->locale('id')->isoFormat('D MMMM YYYY') }}
              </td>
            
              <td class="px-4 py-2 border">{{ $kritiksaran->judul }}</td>
              <td class="px-4 py-2 border text-center" width="130px">
                @if ($kritiksaran->status == 'Baru')
                  <span class="bg-blue-100 text-blue-800 py-1 px-2 rounded-full text-xs">Baru</span>
                @elseif ($kritiksaran->status == 'Proses')
                  <span class="bg-yellow-100 text-yellow-800 py-1 px-2 rounded-full text-xs">Proses</span>
                @elseif ($kritiksaran->status == 'Selesai')
                  <span class="bg-green-100 text-green-800 py-1 px-2 rounded-full text-xs">Selesai</span>
                @else
                  <span class="bg-gray-100 text-gray-800 py-1 px-2 rounded-full text-xs">Tidak Diketahui</span>
                @endif
              </td>
              <td class="px-4 py-2 border text-center" width="200px">
                <!-- Tombol Lihat -->
                <a href="{{ route('admin.manajemen.detail', $kritiksaran->id) }}" title="Lihat"
                  class="bg-green-500 hover:bg-green-600 mx-2 focus:ring-4 focus:ring-green-200 focus:outline-none text-white font-semibold py-2 px-3 rounded-md transition duration-300 ease-in-out">
                <i class="bi bi-eye"></i>
                </a>

                <!-- Tombol Proses -->
                @if ($kritiksaran->status === 'Baru')
                <form action="{{ route('admin.manajemen.proses') }}" method="POST" style="display: inline;">
                  @csrf
                  <input type="hidden" name="kritik_id" value="{{ $kritiksaran->id }}">
                  <button type="submit" title="Proses" class="bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-200 focus:outline-none text-white font-semibold py-2 px-3 rounded-md transition duration-300 ease-in-out">
                    <i class="bi bi-hourglass-split" ></i>
                  </button>
                </form>
                @endif

                <!-- Tombol Selesai -->
                @if ($kritiksaran->status === 'Proses')
                <form action="{{ route('admin.manajemen.selesai') }}" method="POST" style="display: inline;">
                  @csrf
                  <input type="hidden" name="kritik_id" value="{{ $kritiksaran->id }}">
                  <button type="submit" title="Selesai" class="bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-200 focus:outline-none text-white font-semibold py-2 px-3 rounded-md transition duration-300 ease-in-out">
                    <i class="bi bi-check-circle-fill"></i>
                  </button>
                </form>
                @endif

                <!-- Jika status 'Selesai', keduanya disembunyikan -->
                @if ($kritiksaran->status === 'Selesai')
                <style>
                  .proses-btn, .selesai-btn {
                    display: none;
                  }
                </style>
                @endif


              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
