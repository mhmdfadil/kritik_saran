<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hubungi Kami - Layanan Kritik dan Saran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('sweetalert2@11.js') }}"></script>
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
      z-index: 90;
      background-color: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Carousel */
    .carousel-wrapper {
      position: relative;
      width: 100%;
      overflow: hidden;
      height: 500px; /* Adjust height as needed */
      z-index: 0; /* Ensure it stays behind the navbar and content */
    }

    .carousel-slide {
      display: flex;
      width: 100%; /* Adjust to full width */
      transition: transform 1s ease-in-out; /* Smoother transition */
    }

    .carousel-slide img {
      width: 100vw; /* Full width of the screen */
      height: 500px; /* Set fixed height */
      object-fit: cover;
    }

    .carousel-buttons {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      transform: translateY(-50%);
      z-index: 10; /* Ensure the buttons are above the carousel images */
    }

    .carousel-button {
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 10px;
      border: none;
      cursor: pointer;
    }

    /* Contact Section */
    .contact-info {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 1; /* Ensure it stays above the carousel */
    }

    .contact-info i {
      color: var(--primary);
    }

    .contact-info ul {
      list-style-type: none;
      padding: 0;
    }

    .contact-info li {
      margin-bottom: 15px;
      font-size: 1.2rem;
    }
  </style>
</head>
<body>

   <!-- Navbar -->
   <nav class="navbar">
    <div class="container mx-auto flex items-center justify-between py-4 px-2">
      <a href="#" class="text-2xl font-montserrat font-bold text-dark">Layanan Kritik dan Saran</a>
      <div class="hidden md:flex flex-col md:flex-row md:space-x-8 space-y-4 md:space-y-0 mt-4 md:mt-0">
            <a href="{{ route('user.dashboard') }}" class="text-dark hover:text-gray-200 transition">Beranda</a>
            <a href="{{ route('user.kritiksaran') }}" class="text-dark hover:text-gray-200 transition">Kritik & Saran</a>

            <a href="{{ route('user.hubungi') }}" class="text-dark hover:text-gray-200 transition active">Hubungi Kami</a>

        </div>
      <button id="menu-toggle" class="block md:hidden text-dark focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
    <div id="menu" class="hidden flex flex-col space-y-4 bg-white text-primary py-4 px-6 shadow-lg md:hidden">
      <a href="{{ route('user.dashboard') }}" class="hover:bg-gray-100 p-2 rounded transition ">Beranda</a>
      <a href="{{ route('user.kritiksaran') }}" class="hover:bg-gray-100 p-2 rounded transition">Kritik & Saran</a>

      <a href="{{ route('user.hubungi') }}" class="hover:bg-gray-100 p-2 rounded transition active">Hubungi Kami</a>

    </div>
  </nav>

  <!-- Hero Section with Image Slider -->
  <header class="relative bg-gradient-to-r from-green-400 to-teal-500 py-20">
    <div class="absolute inset-0 carousel-wrapper">
      <div id="image-slider" class="carousel-slide">
        <img src="{{ asset('img/FISIP1.jpg') }}" class="object-cover">
        <img src="{{ asset('img/FISIP3.jpg') }}" class="object-cover">
        <img src="{{ asset('img/FISIP2.png') }}" class="object-cover">
        <img src="{{ asset('img/FISIP5.jpg') }}" class="object-cover">
        <img src="{{ asset('img/FISIP4.jpg') }}" class="object-cover">
      </div>
      <div class="carousel-buttons">
        <button class="carousel-button" onclick="prevSlide()">&#8249;</button>
        <button class="carousel-button" onclick="nextSlide()">&#8250;</button>
      </div>
    </div>
    <div class="container mx-auto text-center relative z-50 bg-white/75 p-4 rounded-lg shadow-lg">
      <h1 class="text-5xl font-montserrat font-bold text-dark mb-4">Layanan Kritik dan Saran</h1>
      <p class="text-lg text-dark mb-2">
        Kami ingin mendengar pendapat Anda! Sampaikan kritik dan saran Anda untuk membantu kami memperbaiki layanan kami.
      </p>
    </div>
    

  </header>

  <!-- Main Content -->
  <main class="container mx-auto py-16 mt-20">
    <div class="grid gap-10">
      <div class="contact-info">
        <h2 class="text-2xl font-montserrat font-bold text-dark mb-6">Hubungi Kami</h2>
        <p class="text-lg text-gray-700 mb-4">Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, silakan hubungi kami melalui informasi berikut:</p>
        <ul class="space-y-4 text-lg text-gray-700">
          <li><i class="bi bi-telephone-fill"></i> <strong>Telepon:</strong> (021) 123-4567</li>
          <li><i class="bi bi-envelope-fill"></i> <strong>Email:</strong> info@perpustakaan.com</li>
          <li><i class="bi bi-geo-alt-fill"></i> <strong>Alamat:</strong> Jl. Perpustakaan No. 123, Jakarta</li>
        </ul>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Perpustakaan Fisip | UNIMAL. Semua Hak Dilindungi.</p>
    </div>
  </footer>

  <!-- JavaScript for Menu Toggle and Image Slider -->
  <script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
      const menu = document.getElementById('menu');
      menu.classList.toggle('hidden');
    });

    let currentSlide = 0;
    const slides = document.querySelector('#image-slider');
    const totalSlides = 3;

    function nextSlide() {
      currentSlide = (currentSlide + 1) % totalSlides;
      slides.style.transition = 'transform 0.8s ease-in-out'; // Apply smooth transition
      slides.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
      slides.style.transition = 'transform 0.8s ease-in-out'; // Apply smooth transition
      slides.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    // Reset transition after the last image to avoid any blank space between the last and first image
    slides.addEventListener('transitionend', function() {
      if (currentSlide === 0) {
        slides.style.transition = 'none'; // Disable transition to avoid sudden jump
        slides.style.transform = `translateX(0%)`; // Immediately reset to first image
        setTimeout(() => {
          slides.style.transition = 'transform 0.8s ease-in-out'; // Re-enable smooth transition
        }, 4000); // Small timeout to ensure the transition gets re-enabled after the reset
      }
    });

    // Automatically change slides every 3 seconds
    setInterval(nextSlide, 4000); // Change slide every 4 seconds

  </script>
</body>
</html>
