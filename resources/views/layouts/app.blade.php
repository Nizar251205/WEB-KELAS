<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Web Kelas') - {{ config('classdata.info.code') }}</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-slate-800 antialiased selection:bg-brand-500 selection:text-white">

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 glass-nav border-b border-slate-200/80 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand / Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-500 flex items-center justify-center text-white font-extrabold text-lg shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform duration-200">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <span class="block font-bold text-slate-900 text-lg leading-tight group-hover:text-brand-600 transition-colors">
                            {{ config('classdata.info.code') }}
                        </span>
                        <span class="block text-xs font-medium text-slate-500">
                            {{ config('classdata.info.school') }}
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-2 {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-table-columns text-base {{ request()->routeIs('dashboard') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('profile') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-2 {{ request()->routeIs('profile') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-id-card text-base {{ request()->routeIs('profile') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Profil Kelas</span>
                    </a>

                    <a href="{{ route('jabatan') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-2 {{ request()->routeIs('jabatan') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-sitemap text-base {{ request()->routeIs('jabatan') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Struktur Jabatan</span>
                    </a>
                </nav>

                <!-- Status Badge -->
                <div class="hidden lg:flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse mr-2"></span>
                        TA {{ config('classdata.info.academic_year') }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                        <i class="fa-solid fa-database text-slate-400 mr-1.5"></i> Mode No-DB (GitHub Ready)
                    </span>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobile-menu-btn" class="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Menu">
                        <i class="fa-solid fa-bars text-xl" id="menu-icon-bars"></i>
                        <i class="fa-solid fa-xmark text-xl hidden" id="menu-icon-close"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white/95 backdrop-blur-md px-4 pt-2 pb-4 space-y-1 shadow-lg">
            <a href="{{ route('dashboard') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-table-columns w-5 text-center text-brand-600"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('profile') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('profile') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-id-card w-5 text-center text-brand-600"></i>
                <span>Profil Kelas</span>
            </a>
            <a href="{{ route('jabatan') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('jabatan') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-sitemap w-5 text-center text-brand-600"></i>
                <span>Struktur Jabatan</span>
            </a>
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>TA {{ config('classdata.info.academic_year') }}</span>
                <span class="text-emerald-600 font-semibold">● Mode Statis (No-DB)</span>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center text-white text-sm font-bold">
                        {{ substr(config('classdata.info.code'), 0, 3) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">
                            {{ config('classdata.info.name') }}
                        </p>
                        <p class="text-xs text-slate-500">
                            {{ config('classdata.info.school') }} • Tahun Ajaran {{ config('classdata.info.academic_year') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-slate-500">
                    <a href="{{ route('dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard</a>
                    <span class="text-slate-300">•</span>
                    <a href="{{ route('profile') }}" class="hover:text-brand-600 transition-colors">Profil Kelas</a>
                    <span class="text-slate-300">•</span>
                    <a href="{{ route('jabatan') }}" class="hover:text-brand-600 transition-colors">Struktur Jabatan</a>
                </div>

                <div class="text-xs text-slate-400 text-center md:text-right">
                    <span>Dibuat dengan <strong class="text-slate-600 font-semibold">Laravel</strong> & <strong class="text-slate-600 font-semibold">Tailwind CSS</strong></span>
                    <span class="block text-[11px] text-slate-400 mt-0.5">Siap di-migrasikan / push ke GitHub</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const iconBars = document.getElementById('menu-icon-bars');
        const iconClose = document.getElementById('menu-icon-close');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            iconBars.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>
</body>
</html>
