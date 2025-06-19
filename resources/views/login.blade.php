<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Layanan Kritik dan Saran Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('sweetalert2@11.js') }}"></script>
</head>
<body class="bg-gradient-to-r from-green-700 via-purple-800 to-blue-900 h-screen flex items-center justify-center">

    <div class="w-full max-w-sm bg-white/90 p-8 rounded-2xl shadow-lg backdrop-blur-md transform transition-all hover:scale-105">
        <div class="text-center mb-6">
            <img src="{{ asset('img/UNIMAL.png') }}" alt="Logo Universitas" class="mx-auto h-20 animate__animated animate__fadeIn">
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-blue-600 mt-4">Layanan Kritik dan Saran</h1>
            <p class="text-gray-700 font-semibold">Perpustakaan Universitas Malikussaleh</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
            <div class="relative">
                <label for="email" class="block text-gray-800 font-semibold">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-6 py-3 mt-2 text-gray-900 bg-gray-50 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-teal-500 shadow-md transition-all">
            </div>

            <div class="relative">
                <label for="password" class="block text-gray-800 font-semibold">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-6 py-3 mt-2 text-gray-900 bg-gray-50 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-teal-500 shadow-md transition-all">
            </div>

            <button type="submit" 
                class="w-full py-3 text-white bg-gradient-to-r from-teal-500 to-blue-600 rounded-lg font-bold tracking-wider shadow-md transform transition-all hover:scale-105 hover:from-teal-600 hover:to-blue-700">LOGIN</button>
        </form>

      

        <footer class="text-center text-gray-600 mt-4 text-xs">
            &copy; 2024 Perpustakaan Fisip | UNIMAL. Semua Hak Dilindungi.
        </footer>
    </div>

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
