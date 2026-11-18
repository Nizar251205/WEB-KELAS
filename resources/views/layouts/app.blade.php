<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Struktur Kelas') - SI2A POLSUB</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 Icons -->
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
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
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
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-slate-800 antialiased selection:bg-brand-600 selection:text-white">

    <!-- Top Navigation Bar (no-print) -->
    <header class="sticky top-0 z-50 glass-nav border-b border-slate-200/80 transition-all duration-300 shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Brand / Logo -->
                <a href="{{ session()->has('auth_user') ? route('dashboard') : route('login') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-700 to-indigo-600 flex items-center justify-center text-white font-extrabold text-lg shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform duration-200">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <div class="flex items-center space-x-1.5">
                            <span class="font-extrabold text-slate-900 text-lg leading-tight group-hover:text-brand-600 transition-colors">
                                SI2A
                            </span>
                            <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-brand-100 text-brand-800">POLSUB</span>
                        </div>
                        <span class="block text-xs font-medium text-slate-500">
                            Sistem Informasi Struktur Kelas
                        </span>
                    </div>
                </a>

                @if(session()->has('auth_user'))
                <!-- Desktop Navigation Links (Hanya muncul jika sudah login) -->
                <nav class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-1.5 {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-chart-pie text-sm {{ request()->routeIs('dashboard') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('profil.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-1.5 {{ request()->routeIs('profil.*') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-id-card text-sm {{ request()->routeIs('profil.*') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Profil Kelas</span>
                    </a>

                    <a href="{{ route('mahasiswa.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-1.5 {{ request()->routeIs('mahasiswa.*') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-users text-sm {{ request()->routeIs('mahasiswa.*') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Daftar Mahasiswa</span>
                    </a>

                    <a href="{{ route('struktur.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-1.5 {{ request()->routeIs('struktur.*') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-sitemap text-sm {{ request()->routeIs('struktur.*') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Struktur Kelas</span>
                    </a>

                    <a href="{{ route('laporan.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center space-x-1.5 {{ request()->routeIs('laporan.*') ? 'bg-brand-50 text-brand-700 shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-file-lines text-sm {{ request()->routeIs('laporan.*') ? 'text-brand-600' : 'text-slate-400' }}"></i>
                        <span>Laporan</span>
                    </a>
                </nav>

                <!-- Auth / User Info -->
                <div class="hidden md:flex items-center space-x-3">
                    <div class="flex items-center space-x-2 pl-2 border-l border-slate-200">
                        <span class="w-8 h-8 rounded-full {{ session('auth_user.role') === 'admin' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }} flex items-center justify-center text-xs font-extrabold shadow-sm">
                            <i class="fa-solid {{ session('auth_user.role') === 'admin' ? 'fa-user-shield' : 'fa-user-graduate' }}"></i>
                        </span>
                        <div class="text-left">
                            <span class="block text-xs font-bold text-slate-800 leading-tight">
                                {{ session('auth_user.name') }}
                            </span>
                            <span class="block text-[10px] font-semibold uppercase tracking-wider {{ session('auth_user.role') === 'admin' ? 'text-rose-600' : 'text-emerald-600' }}">
                                Role: {{ session('auth_user.role') }}
                            </span>
                        </div>

                        <a href="{{ route('logout') }}" class="ml-2 p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobile-menu-btn" class="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Menu">
                        <i class="fa-solid fa-bars text-xl" id="menu-icon-bars"></i>
                        <i class="fa-solid fa-xmark text-xl hidden" id="menu-icon-close"></i>
                    </button>
                </div>
                @else
                <!-- Indikator saat Belum Login -->
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                        <i class="fa-solid fa-lock text-amber-600 mr-1.5"></i> Sistem Terproteksi (Wajib Login)
                    </span>
                </div>
                @endif

            </div>
        </div>

        @if(session()->has('auth_user'))
        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 bg-white/95 backdrop-blur-md px-4 pt-2 pb-4 space-y-1 shadow-lg">
            <a href="{{ route('dashboard') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('dashboard') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center text-brand-600"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('profil.index') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('profil.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-id-card w-5 text-center text-brand-600"></i>
                <span>Profil Kelas</span>
            </a>
            <a href="{{ route('mahasiswa.index') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('mahasiswa.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-users w-5 text-center text-brand-600"></i>
                <span>Daftar Mahasiswa</span>
            </a>
            <a href="{{ route('struktur.index') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('struktur.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-sitemap w-5 text-center text-brand-600"></i>
                <span>Struktur Kelas</span>
            </a>
            <a href="{{ route('laporan.index') }}" 
               class="block px-3 py-2.5 rounded-lg text-base font-semibold transition-colors flex items-center space-x-3 {{ request()->routeIs('laporan.*') ? 'bg-brand-50 text-brand-700' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-file-lines w-5 text-center text-brand-600"></i>
                <span>Generate Laporan</span>
            </a>

            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-600 font-medium">Masuk: <strong>{{ session('auth_user.name') }}</strong> ({{ session('auth_user.role') }})</span>
                <a href="{{ route('logout') }}" class="text-xs text-rose-600 font-bold hover:underline">Logout</a>
            </div>
        </div>
        @endif
    </header>

    <!-- Global Notification Alerts -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 no-print">
        @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm mb-4">
            <div class="flex items-center space-x-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 text-sm">&times;</button>
        </div>
        @endif

        @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between shadow-sm mb-4">
            <div class="flex items-center space-x-2.5">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 text-sm">&times;</button>
        </div>
        @endif

        @if($errors->any())
        <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-sm shadow-sm mb-4">
            <div class="flex items-center space-x-2.5 mb-1">
                <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                <span class="font-bold">Mohon periksa kembali kolom input berikut:</span>
            </div>
            <ul class="list-disc list-inside text-xs space-y-0.5 ml-5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer (no-print) -->
    <footer class="bg-white border-t border-slate-200 mt-16 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-brand-700 flex items-center justify-center text-white text-xs font-bold">
                        SI2A
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">
                            Sistem Informasi Struktur Kelas SI2A
                        </p>
                        <p class="text-xs text-slate-500">
                            Politeknik Negeri Subang • Jurusan Teknologi Informasi dan Komputer
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 text-xs font-medium text-slate-500">
                    <span>Mata Kuliah: <strong>Pemrograman Website [PSI3310]</strong></span>
                    <span class="text-slate-300">•</span>
                    <span>Kelompok 4</span>
                </div>

                <div class="text-xs text-slate-400 text-center md:text-right">
                    <span>Dosen: Rahmat Irsyada, M.Pd. & Usep Abdul Rosid, M.Kom.</span>
                    <span class="block text-[11px] text-emerald-600 font-semibold mt-0.5">● Siap Migrasi GitHub (No-DB Architecture)</span>
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

        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
                iconBars.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
