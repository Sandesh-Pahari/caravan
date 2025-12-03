<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Caravan Tours and Travels') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
          integrity="sha512-..." 
          crossorigin="anonymous" 
          referrerpolicy="no-referrer" />

    {{-- Laravel Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    {{-- @php
        $headerCourses = App\Models\Course::all(); // Fetch all courses for the header
    @endphp --}}
<section id="header">
    @include('layouts.header')
  </section>
 <section id="pagecontent" class="mt-16">
    @yield('pagecontent')
  </section>
  <section id="footer">
    @include('layouts.footer')
  </section>
  <!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="fixed bottom-6 right-6 z-50 bg-[#8B4513] text-white text-xl rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-[#A0522D] transition">
    <i class="fas fa-arrow-up"></i>
</button>
<script>
    // Scroll to Top Button Functionality
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.remove('hidden');
        } else {
            scrollTopBtn.classList.add('hidden');
        }
    });

    scrollTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
</body>
</html>