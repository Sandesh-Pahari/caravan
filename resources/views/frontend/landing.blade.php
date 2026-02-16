<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caravan — Choose Your Adventure</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .panel { transition: flex 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        .split-container:hover .panel { flex: 0.6; }
        .split-container .panel:hover { flex: 1.4; }
        .panel-overlay { transition: opacity 0.4s ease; }
        .panel:hover .panel-overlay { opacity: 1; }
        .panel-content { transition: transform 0.4s ease, opacity 0.4s ease; }
        .panel:hover .panel-content { transform: translateY(-6px); }
        .panel-label { transition: letter-spacing 0.4s ease; }
        .panel:hover .panel-label { letter-spacing: 0.08em; }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden bg-gray-900">

    {{-- Logo bar --}}
    <div class="absolute top-0 left-0 right-0 z-20 flex items-center justify-center py-6 pointer-events-none">
        <div class="flex items-center gap-2.5 bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 shadow-lg">
            <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center">
                <i class="fas fa-mountain-sun text-white text-xs"></i>
            </div>
            <span class="text-white font-bold text-sm tracking-wide">Caravan</span>
        </div>
    </div>

    {{-- Split panels --}}
    <div class="split-container flex h-full w-full">

        {{-- Left — Adventures Trekking Tours --}}
        <a href="#"
           class="panel relative flex-1 flex items-center justify-center overflow-hidden cursor-pointer group">
            {{-- Background image layer --}}
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1200&q=80')">
            </div>
            {{-- Dark overlay base --}}
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-950/80 via-green-900/70 to-black/80"></div>
            {{-- Hover overlay --}}
            <div class="panel-overlay absolute inset-0 bg-emerald-900/20 opacity-0"></div>
            {{-- Divider glow line --}}
            <div class="absolute right-0 top-0 bottom-0 w-px bg-white/20"></div>

            {{-- Content --}}
            <div class="panel-content relative z-10 text-center px-8 max-w-sm">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 mb-6 shadow-lg">
                    <i class="fas fa-mountain-sun text-white text-2xl"></i>
                </div>
                <p class="text-emerald-300 text-xs font-semibold uppercase tracking-widest mb-3">Explore the Himalayas</p>
                <h2 class="panel-label text-3xl md:text-4xl font-extrabold text-white leading-tight mb-4 tracking-tight">
                    Adventures &<br>Trekking Tours
                </h2>
                <p class="text-white/55 text-sm leading-relaxed mb-8">
                    Guided treks, expedition packages, and cultural journeys across Nepal's breathtaking trails.
                </p>
                <span class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shadow-lg shadow-emerald-900/50">
                    <i class="fas fa-arrow-right"></i>
                    Explore Tours
                </span>
                <p class="mt-4 text-white/30 text-xs">Coming soon</p>
            </div>
        </a>

        {{-- Right — Vehicle Rental --}}
        <a href="{{ route('home') }}"
           class="panel relative flex-1 flex items-center justify-center overflow-hidden cursor-pointer group">
            {{-- Background image layer --}}
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=1200&q=80')">
            </div>
            {{-- Dark overlay base --}}
            <div class="absolute inset-0 bg-gradient-to-bl from-blue-950/80 via-brand-slate/70 to-black/80"></div>
            {{-- Hover overlay --}}
            <div class="panel-overlay absolute inset-0 bg-blue-900/20 opacity-0"></div>

            {{-- Content --}}
            <div class="panel-content relative z-10 text-center px-8 max-w-sm">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 mb-6 shadow-lg">
                    <i class="fas fa-van-shuttle text-white text-2xl"></i>
                </div>
                <p class="text-sky-300 text-xs font-semibold uppercase tracking-widest mb-3">Nepal's Trusted Fleet</p>
                <h2 class="panel-label text-3xl md:text-4xl font-extrabold text-white leading-tight mb-4 tracking-tight">
                    Vehicle<br>Rental
                </h2>
                <p class="text-white/55 text-sm leading-relaxed mb-8">
                    Self-drive or with driver. Cars, vans, jeeps — for city runs or remote mountain roads.
                </p>
                <span class="inline-flex items-center gap-2 bg-brand-maroon hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shadow-lg shadow-red-900/50">
                    <i class="fas fa-arrow-right"></i>
                    Browse Vehicles
                </span>
            </div>
        </a>

    </div>

    {{-- Mobile layout — stack vertically --}}
    <style>
        @media (max-width: 640px) {
            .split-container { flex-direction: column; }
            .split-container:hover .panel { flex: 0.8; }
            .split-container .panel:hover { flex: 1.2; }
        }
    </style>

</body>
</html>
