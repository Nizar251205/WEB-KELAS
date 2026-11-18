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
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
            }
            .main-content-wrapper {
                padding-left: 0 !important;
            }
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased selection:bg-brand-600 selection:text-white bg-slate-50 flex">

    @if(session()->has('auth_user'))
        <!-- BACKDROP MOBILE SIDEBAR OVERLAY -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden md:hidden transition-opacity" onclick="toggleSidebar()"></div>

        <!-- SIDEBAR NAVIGATION (Activity Diagram: "pada sidebar") -->
        <aside id="main-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 lg:w-72 bg-white border-r border-slate-200/90 flex flex-col justify-between transition-transform duration-300 -translate-x-full md:translate-x-0 shadow-sm no-print">
            
            <!-- Sidebar Top: Brand & User Profile -->
            <div class="flex flex-col">
                <!-- Brand Header -->
                <div class="h-20 px-6 flex items-center justify-between border-b border-slate-100">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-700 to-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform duration-200">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <div class="flex items-center space-x-1.5">
                                <span class="font-extrabold text-slate-900 text-lg leading-tight group-hover:text-brand-600 transition-colors">
                                    SI2A
                                </span>
                                <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-brand-100 text-brand-800">POLSUB</span>
                            </div>
                            <span class="block text-[11px] font-medium text-slate-400">
                                Sistem Struktur Kelas
                            </span>
                        </div>
                    </a>

                    <!-- Close button on mobile -->
                    <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- User Profile Card in Sidebar -->
                <div class="p-4 mx-3 my-3 rounded-2xl bg-slate-50 border border-slate-100 flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl {{ session('auth_user.role') === 'admin' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }} flex items-center justify-center text-sm font-extrabold flex-shrink-0 shadow-xs">
                        <i class="fa-solid {{ session('auth_user.role') === 'admin' ? 'fa-user-shield' : 'fa-user-graduate' }}"></i>
                    </div>
                    <div class="min-w-0 flex-grow">
                        <span class="block text-xs font-bold text-slate-800 truncate leading-snug">
                            {{ session('auth_user.name') }}
                        </span>
                        <span class="inline-block text-[10px] font-extrabold uppercase tracking-wider px-1.5 py-0.2 rounded mt-0.5 {{ session('auth_user.role') === 'admin' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                            {{ session('auth_user.role') }}
                        </span>
                    </div>
                </div>

                <!-- Sidebar Navigation Links -->
                <div class="px-3 py-2 space-y-6 overflow-y-auto">
                    
                    <!-- Kategori: Menu Utama -->
                    <div>
                        <span class="px-3 text-[10px] font-extrabold uppercase tracking-widest text-slate-400 block mb-2">
                            Menu Utama
                        </span>
                        <nav class="space-y-1">
                            
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-brand-600 text-white shadow-md shadow-brand-500/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                                <i class="fa-solid fa-chart-pie w-5 text-center text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Dashboard</span>
                            </a>

                            <!-- Profil Kelas (Activity Diagram: "Memilih menu Profil Kelas pada sidebar") -->
                            <a href="{{ route('profil.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-150 {{ request()->routeIs('profil.*') ? 'bg-brand-600 text-white shadow-md shadow-brand-500/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                                <i class="fa-solid fa-id-card w-5 text-center text-sm {{ request()->routeIs('profil.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Profil Kelas</span>
                            </a>

                            <!-- Data Mahasiswa -->
                            <a href="{{ route('mahasiswa.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-150 {{ request()->routeIs('mahasiswa.*') ? 'bg-brand-600 text-white shadow-md shadow-brand-500/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                                <i class="fa-solid fa-users w-5 text-center text-sm {{ request()->routeIs('mahasiswa.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Data Mahasiswa</span>
                            </a>

                            <!-- Struktur Kelas -->
                            <a href="{{ route('struktur.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-150 {{ request()->routeIs('struktur.*') ? 'bg-brand-600 text-white shadow-md shadow-brand-500/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                                <i class="fa-solid fa-sitemap w-5 text-center text-sm {{ request()->routeIs('struktur.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Struktur Kelas</span>
                            </a>

                        </nav>
                    </div>

                    <!-- Kategori: Laporan & Administrasi -->
                    <div>
                        <span class="px-3 text-[10px] font-extrabold uppercase tracking-widest text-slate-400 block mb-2">
                            Laporan & Cetak
                        </span>
                        <nav class="space-y-1">
                            
                            <!-- Generate Laporan (Activity Diagram: "Memilih menu Generate Laporan pada sidebar") -->
                            <a href="{{ route('laporan.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-150 {{ request()->routeIs('laporan.*') ? 'bg-brand-600 text-white shadow-md shadow-brand-500/20' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                                <i class="fa-solid fa-file-lines w-5 text-center text-sm {{ request()->routeIs('laporan.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Generate Laporan</span>
                            </a>

                        </nav>
                    </div>

                </div>
            </div>

            <!-- Sidebar Bottom: Status & Logout -->
            <div class="p-4 border-t border-slate-100">
                <div class="mb-3 px-2 flex items-center justify-between text-[11px] text-slate-400">
                    <span>TA 2026 / 2027</span>
                    <span class="text-emerald-600 font-semibold">● No-DB Store</span>
                </div>
                <a href="{{ route('logout') }}" 
                   class="w-full py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-700 text-xs font-bold transition-colors flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar dari Sistem</span>
                </a>
            </div>

        </aside>

        <!-- MAIN CONTENT WRAPPER (Shifted for Sidebar) -->
        <div class="flex-1 flex flex-col min-h-screen md:pl-64 lg:pl-72 main-content-wrapper">
            
            <!-- Top Mobile Bar / Content Header -->
            <header class="h-16 bg-white border-b border-slate-200/80 px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs no-print">
                <div class="flex items-center space-x-3">
                    <!-- Hamburger Toggle on Mobile -->
                    <button type="button" onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Sidebar">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h2 class="text-xs sm:text-sm font-bold text-slate-800 leading-tight">
                            Politeknik Negeri Subang
                        </h2>
                        <span class="text-[11px] text-slate-400">
                            Kelas SI2A • D-III Sistem Informasi
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-brand-50 text-brand-700 border border-brand-200">
                        <i class="fa-solid fa-code mr-1.5 text-brand-600"></i> Pemrograman Website [PSI3310]
                    </span>
                    <div class="w-8 h-8 rounded-full {{ session('auth_user.role') === 'admin' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }} flex items-center justify-center text-xs font-black" title="{{ session('auth_user.name') }}">
                        <i class="fa-solid {{ session('auth_user.role') === 'admin' ? 'fa-user-shield' : 'fa-user-graduate' }}"></i>
                    </div>
                </div>
            </header>

            <!-- Global Notification Alerts -->
            <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 pt-4 no-print">
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

            <!-- Page Content -->
            <main class="flex-grow">
                @yield('content')
            </main>

            <!-- Footer in Main Content Area -->
            <footer class="bg-white border-t border-slate-200 mt-auto py-6 px-4 sm:px-6 lg:px-8 no-print">
                <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                    <div>
                        <strong class="text-slate-700">SI2A POLSUB</strong> • Sistem Informasi Struktur Kelas (Kelompok 4)
                    </div>
                    <div>
                        Dosen Pengampu: <strong>Rahmat Irsyada, M.Pd.</strong> & <strong>Usep Abdul Rosid, M.Kom.</strong>
                    </div>
                </div>
            </footer>

        </div>

    @else
        <!-- TAMPILAN GUEST (LOGIN SCREEN): Fullscreen tanpa sidebar -->
        <div class="w-full min-h-screen flex flex-col justify-between">
            <main class="flex-grow flex items-center justify-center">
                @yield('content')
            </main>
            <footer class="py-4 text-center text-xs text-slate-400 no-print">
                Sistem Informasi Struktur Kelas SI2A • Politeknik Negeri Subang
            </footer>
        </div>
    @endif

    <!-- Sidebar Toggle Script (Mobile) -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('main-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar && overlay) {
                const isOpen = !sidebar.classList.contains('-translate-x-full');
                if (isOpen) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                } else {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                }
            }
        }
    </script>
</body>
</html>
