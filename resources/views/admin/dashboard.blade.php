<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.Name','School_Of_Baking_&_Pastry_Technology')}}</title>
  <link rel="icon" type="image/png" href="{{asset('frontend/images/logo/logo.png')}}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-0 invisible transition-opacity duration-200 z-40"></div>

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 space-y-2 py-4 px-2 fixed h-full transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-50">
    <div class="text-xl font-bold text-center  flex items-center justify-between px-4">
        <span class="text-orange-400"> Admin Dashboard</span>
        <!-- Close button for mobile -->
        <button id="closeSidebar" class="md:hidden text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav>
        <a href="{{url('/')}}" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Home</span>
        </a>

        <!-- About Us -->
        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>About Us</span>
        </a>

        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span>Our Courses</span>
        </a>


        <!-- Menu -->
        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span>Menu</span>
        </a>

        <!-- Alumni -->
        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span>Alumni</span>
        </a>

       <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 5h16c.552 0 1 .448 1 1v12c0 .552-.448 1-1 1H4c-.552 0-1-.448-1-1V6c0-.552.448-1 1-1z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 15l4-4 4 4 4-4 4 4" />
                <circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="2"/>
            </svg>
            <span>Gallery</span>
        </a>

         <!-- FAQs -->
        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>FAQs</span>
        </a>


            

        {{-- <a href="{{ route('aboutus') }}" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M8 11h.01M16 11h.01M12 17c2.5 0 4.5-1.5 5.5-3.5M6.5 13.5C7.5 15.5 9.5 17 12 17m0 0c-2.5 0-4.5-1.5-5.5-3.5M12 17v4m-6-8c0 4.418 3.582 8 8 8s8-3.582 8-8" />
            </svg>
            <span>Endorsed Brands</span>
        </a> --}}

        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.286 7.049 7.392.107c.969.014 1.371 1.24.588 1.81l-5.986 4.347 2.249 7.073c.285.898-.755 1.64-1.54 1.105L12 18.896l-6.94 4.522c-.784.535-1.825-.207-1.54-1.105l2.25-7.073-5.987-4.347c-.782-.57-.38-1.796.588-1.81l7.392-.107 2.286-7.049z" />
            </svg>
            <span>Placement Partners</span>
        </a>

        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 2l3 6 6 .5-4.5 4.5 1 6-5.5-3-5.5 3 1-6L3 8.5 9 8l3-6z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M9 12l2 2 4-4" />
            </svg>
            <span>Endorsed Brands</span>
        </a>

        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M7 8h10M7 12h6m-6 4h10M5 4h14a2 2 0 012 2v12a2 2 0 
                        01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
            </svg>
            <span>Blogs</span>
        </a>

        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 
                        012-2h14a2 2 0 012 2v8a2 2 0 
                        01-2 2h-3l-4 4z" />
            </svg>
            <span>Testimonials</span>
        </a>

        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 
                    2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span>Program Calendar</span>
        </a>

        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 21h8m-4-4v4m-6-12a4 4 0 01-4-4V5a2 2 0 
                    012-2h2V2h2v1h6V2h2v1h2a2 2 0 012 2v1a4 4 0 
                    01-4 4H6z" />
            </svg>
            <span>Award</span>
        </a>



        <a href="" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 
                002 2h2a2 2 0 002-2zm7 0v-2a2 2 0 00-2-2h-2a2 
                2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2zm7 
                0v-10a2 2 0 00-2-2h-2a2 2 0 00-2 2v10a2 
                2 0 002 2h2a2 2 0 002-2z" />
        </svg>
        <span> Add Statistics</span>
    </a>





        






       
        <!-- Our Courses -->
        
        

        <!-- Trekking Department -->
        <a href="{{ route('admin.trekking.index') }}" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l4-8 4 4 3-6 4 10" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20h18" />
            </svg>
            <span>Trekking Dept.</span>
            @if(isset($unreadTrekkingCount) && $unreadTrekkingCount > 0)
                <span class="bg-red-500 text-white text-xs rounded-full px-2 py-0.5 ml-auto">
                    {{ $unreadTrekkingCount }}
                </span>
            @endif
        </a>

        <!-- Rental Department -->
        <a href="{{ route('admin.rental.index') }}" class="flex items-center space-x-2 px-4 py-3 hover:bg-gray-700 rounded">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h4l2 5h6l2-5h4M5 17a2 2 0 104 0 2 2 0 00-4 0zm10 0a2 2 0 104 0 2 2 0 00-4 0z" />
            </svg>
            <span>Rental Dept.</span>
            @if(isset($unreadRentalCount) && $unreadRentalCount > 0)
                <span class="bg-red-500 text-white text-xs rounded-full px-2 py-0.5 ml-auto">
                    {{ $unreadRentalCount }}
                </span>
            @endif
        </a>
    </nav>
</aside>

        <!-- Main Content -->
        <div class="ml-0 md:ml-64 flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm z-30 relative">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <!-- Hamburger button for mobile -->
                        <button id="menuBtn" class="md:hidden mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        
                    </div>
                    <!-- Header right content -->
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-600 hover:text-gray-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <div class="relative">
                            <button class="flex items-center space-x-2">
                               
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-700 font-bold hover:text-gray-900">
                                        Log Out
                                    </button>
                                </form>
                                
                            </button>
                        </div>
                    </div>


                </div>
            </header>

            <!-- Dashboard Stats Boxes -->
<article class="max-w-[90%] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8"> <!-- Increased gap to 8 -->
        

        <!-- Trekking Department Box -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-8 text-white hover:bg-gray-700 transition duration-200 h-full min-h-[180px] flex flex-col justify-between">
            <a href="{{ route('admin.trekking.index') }}" class="flex flex-col h-full justify-between">
                <div class="flex items-center space-x-6">
                    <div class="p-4 rounded-full bg-gray-700 relative">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l4-8 4 4 3-6 4 10" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20h18" />
                        </svg>
                        @if(isset($unreadTrekkingCount) && $unreadTrekkingCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-sm rounded-full h-6 w-6 flex items-center justify-center animate-pulse">
                            {{ $unreadTrekkingCount }}
                        </span>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Trekking Department</h3>
                        <p class="text-gray-300 text-base mt-2">{{ $unreadTrekkingCount ?? 0 }} New Requests</p>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>

        <!-- Rental Department Box -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-8 text-white hover:bg-gray-700 transition duration-200 h-full min-h-[180px] flex flex-col justify-between">
            <a href="{{ route('admin.rental.index') }}" class="flex flex-col h-full justify-between">
                <div class="flex items-center space-x-6">
                    <div class="p-4 rounded-full bg-gray-700 relative">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h4l2 5h6l2-5h4M5 17a2 2 0 104 0 2 2 0 00-4 0zm10 0a2 2 0 104 0 2 2 0 00-4 0z" />
                        </svg>
                        @if(isset($unreadRentalCount) && $unreadRentalCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-sm rounded-full h-6 w-6 flex items-center justify-center animate-pulse">
                            {{ $unreadRentalCount }}
                        </span>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Rental Department</h3>
                        <p class="text-gray-300 text-base mt-2">{{ $unreadRentalCount ?? 0 }} New Requests</p>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>
    </div>
</article>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menuBtn');
            const closeSidebarBtn = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('aside');
            const overlay = document.getElementById('overlay');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('opacity-0', 'invisible');
                overlay.classList.add('opacity-50', 'visible');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('opacity-0', 'invisible');
                overlay.classList.remove('opacity-50', 'visible');
            }

            // Event listeners
            menuBtn.addEventListener('click', openSidebar);
            closeSidebarBtn.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Close sidebar when clicking nav links on mobile
            document.querySelectorAll('nav a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) closeSidebar();
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    // Reset desktop styles
                    sidebar.classList.remove('-translate-x-full', 'translate-x-0');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.add('opacity-0', 'invisible');
                } else {
                    // Ensure mobile state if resized smaller
                    if (!sidebar.classList.contains('-translate-x-full')) {
                        closeSidebar();
                    }
                }
            });
        });
    </script>
</body>

</html>