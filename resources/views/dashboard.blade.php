@extends('layouts.app')

@section('title', 'Dashboard - Sistem Informasi 2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- WELCOME HERO BANNER -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-indigo-950 text-white shadow-xl mb-8 border border-slate-800/80">
        <!-- Ambient Cyber Glows -->
        <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-brand-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -top-16 w-72 h-72 bg-indigo-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative p-6 sm:p-8 lg:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-xs font-bold mb-3 border border-white/15 text-brand-300">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    <span>Portal Resmi Kelas • {{ $profile['angkatan'] ?? '2025' }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-white">
                    Sistem Informasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-brand-400 to-indigo-300">2A</span>
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                    {{ $profile['prodi'] ?? 'D-III Sistem Informasi' }} • {{ $profile['institusi'] ?? 'Politeknik Negeri Subang' }}
                </p>
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <a href="{{ route('profil.index') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white font-bold text-xs shadow-lg shadow-brand-500/25 transition-all">
                        <i class="fa-solid fa-id-card"></i>
                        <span>Lihat Profil Kelas</span>
                    </a>
                    <a href="{{ route('struktur.index') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 text-slate-200 font-bold text-xs backdrop-blur-sm transition-all">
                        <i class="fa-solid fa-sitemap"></i>
                        <span>Struktur Organisasi</span>
                    </a>
                </div>
            </div>

            <!-- Quick Info Badge in Banner -->
            <div class="flex flex-col items-start md:items-end bg-white/5 backdrop-blur-md border border-white/10 p-5 rounded-2xl min-w-[220px]">
                <span class="text-[10px] text-brand-300 uppercase tracking-widest font-black">Mata Kuliah</span>
                <span class="text-base font-bold text-white mt-0.5">{{ $profile['mata_kuliah'] ?? 'Pemrograman Website' }}</span>
                <div class="mt-3 pt-3 border-t border-white/10 w-full flex items-center justify-between text-xs text-slate-300">
                    <span>Pengembang</span>
                    <span class="font-extrabold text-cyan-300">{{ $profile['kelompok'] ?? 'Kelompok 4' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- QUICK STAT METRIC CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs glow-card flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-slate-400 tracking-wider">Total Mahasiswa</span>
                <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalMahasiswa }}</h3>
                <p class="text-[11px] text-slate-500 mt-0.5">{{ $totalMahasiswa > 0 ? 'Siswa Terdaftar' : 'Belum Ada Siswa' }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center text-xl shadow-xs">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs glow-card flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-slate-400 tracking-wider">Pengurus Kelas</span>
                <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalPengurus }}</h3>
                <p class="text-[11px] text-slate-500 mt-0.5">{{ $totalPengurus > 0 ? 'Jabatan Terisi' : 'Belum Ditentukan' }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center text-xl shadow-xs">
                <i class="fa-solid fa-users-gear"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs glow-card flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-slate-400 tracking-wider">Profil Kelas</span>
                <h3 class="text-xl font-black {{ !empty($profile) ? 'text-emerald-600' : 'text-slate-400' }} mt-2">
                    {{ !empty($profile) ? 'Terverifikasi' : 'Belum Diisi' }}
                </h3>
                <p class="text-[11px] text-slate-500 mt-0.5">{{ $profile['nama_kelas'] ?? 'Sistem Informasi 2A' }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center text-xl shadow-xs">
                <i class="fa-solid fa-id-card"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs glow-card flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-slate-400 tracking-wider">Tahun Angkatan</span>
                <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $profile['angkatan'] ?? '2025' }}</h3>
                <p class="text-[11px] text-slate-500 mt-0.5">Tingkat Akademik POLSUB</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center text-xl shadow-xs">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>

    </div>

    @if(!$dataAvailable)
        <!-- CYBER-GLASS EMPTY STATE HERO NOTICE -->
        <div class="p-8 sm:p-10 rounded-3xl bg-white border border-slate-200/90 shadow-sm mb-8 relative overflow-hidden">
            <div class="max-w-2xl mx-auto text-center">
                <div class="w-16 h-16 rounded-3xl bg-cyan-50 border border-cyan-200 text-cyan-600 flex items-center justify-center text-2xl mx-auto mb-4 shadow-sm">
                    <i class="fa-solid fa-database"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                    Basis Data Sistem Siap Digunakan
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Seluruh data kelas dan mahasiswa saat ini dikosongkan. Anda dapat mulai menginput data mahasiswa baru atau memuat profil kelas secara instan.
                </p>

                <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white font-extrabold text-xs shadow-md shadow-brand-500/25 transition">
                        <i class="fa-solid fa-user-plus mr-1.5"></i> Tambah Mahasiswa Pertama
                    </a>
                    <a href="{{ route('profil.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold text-xs transition border border-slate-300">
                        <i class="fa-solid fa-pen-to-square mr-1.5"></i> Lengkapi Profil Kelas
                    </a>
                    <form action="{{ route('profil.reset') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-extrabold text-xs transition border border-emerald-200">
                            <i class="fa-solid fa-rotate-left mr-1.5"></i> Muat Profil Default SI2A
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- DUAL COLUMN LAYOUT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Komposisi & Mahasiswa Terdaftar -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Grafik / Diagram Komposisi Mahasiswa -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-7">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-base">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">Grafik Komposisi Mahasiswa</h2>
                            <p class="text-xs text-slate-400">Distribusi perbandingan gender mahasiswa aktif</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-extrabold bg-slate-100 text-slate-700">
                        {{ $totalMahasiswa }} Siswa
                    </span>
                </div>

                @if($totalMahasiswa > 0)
                    <!-- Visual Progress Bar -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between text-xs font-bold text-slate-700">
                            <span class="flex items-center text-blue-600">
                                <i class="fa-solid fa-mars mr-1.5"></i> Laki-laki: {{ $maleCount }} Siswa ({{ $malePercent }}%)
                            </span>
                            <span class="flex items-center text-rose-500">
                                <i class="fa-solid fa-venus mr-1.5"></i> Perempuan: {{ $femaleCount }} Siswi ({{ $femalePercent }}%)
                            </span>
                        </div>
                        <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden flex shadow-inner">
                            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 h-full transition-all duration-500" style="width: {{ $malePercent }}%"></div>
                            <div class="bg-gradient-to-r from-rose-400 to-pink-500 h-full transition-all duration-500" style="width: {{ $femalePercent }}%"></div>
                        </div>
                    </div>

                    <!-- Visual Stats Breakdown Pills -->
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="p-3.5 rounded-2xl bg-blue-50/60 border border-blue-100 flex items-center justify-between">
                            <div>
                                <span class="font-bold text-blue-900 block">Laki-laki</span>
                                <span class="text-[11px] text-blue-600">{{ $malePercent }}% dari total</span>
                            </div>
                            <span class="text-lg font-black text-blue-700">{{ $maleCount }}</span>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-rose-50/60 border border-rose-100 flex items-center justify-between">
                            <div>
                                <span class="font-bold text-rose-900 block">Perempuan</span>
                                <span class="text-[11px] text-rose-600">{{ $femalePercent }}% dari total</span>
                            </div>
                            <span class="text-lg font-black text-rose-700">{{ $femaleCount }}</span>
                        </div>
                    </div>
                @else
                    <div class="py-8 text-center text-slate-400 text-xs">
                        <i class="fa-solid fa-chart-column text-3xl block mb-2 opacity-30"></i>
                        Grafik komposisi gender akan muncul secara otomatis setelah data mahasiswa ditambahkan.
                    </div>
                @endif
            </div>

            <!-- Mahasiswa Terdaftar (Recent Sample) -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-7">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900">Daftar Mahasiswa Kelas</h3>
                            <p class="text-xs text-slate-400">Direktori siswa aktif SI2A</p>
                        </div>
                    </div>
                    <a href="{{ route('mahasiswa.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700">
                        Lihat Semua &rarr;
                    </a>
                </div>

                @if(count($recentStudents) > 0)
                    <div class="divide-y divide-slate-100">
                        @foreach($recentStudents as $mhs)
                        <div class="py-3 flex items-center justify-between hover:bg-slate-50/80 px-2 rounded-xl transition">
                            <div class="flex items-center space-x-3 min-w-0">
                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                    {{ substr($mhs['nama'], 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-900 truncate">{{ $mhs['nama'] }}</h4>
                                    <span class="text-[11px] text-slate-400 font-mono">{{ $mhs['nim'] }} • {{ $mhs['gender'] ?? 'Laki-laki' }}</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-extrabold flex-shrink-0
                                {{ $mhs['jabatan'] === 'Ketua Kelas' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600' }}">
                                {{ $mhs['jabatan'] }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-10 text-center text-slate-400 text-xs">
                        <i class="fa-solid fa-user-slash text-3xl block mb-2 opacity-30"></i>
                        Belum ada mahasiswa yang terdaftar di sistem.
                        <div class="mt-3">
                            <a href="{{ route('mahasiswa.index') }}" class="text-xs font-bold text-brand-600 hover:underline">
                                + Tambah Mahasiswa Sekarang
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </div>

        <!-- Right 1 Col: Dosen Wali & Status Kepengurusan -->
        <div class="space-y-6">

            <!-- Card Dosen Wali -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 relative overflow-hidden">
                <div class="flex items-center space-x-2 text-xs font-black uppercase tracking-wider text-brand-600 mb-4">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Dosen Pembimbing / Wali</span>
                </div>

                <div class="p-4 rounded-2xl bg-gradient-to-br from-slate-50 to-brand-50/50 border border-slate-100">
                    <h4 class="text-base font-black text-slate-900 leading-snug">
                        {{ $profile['dosen_wali'] ?? 'Belum ditentukan' }}
                    </h4>
                    <p class="text-xs text-slate-500 mt-1">D-III Sistem Informasi • POLSUB</p>
                    <p class="text-xs text-slate-600 mt-3 italic leading-relaxed">
                        "Membimbing mahasiswa Sistem Informasi 2A menjadi insan profesional di bidang rekayasa teknologi dan website."
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span>Status: {{ !empty($profile['dosen_wali']) ? 'Aktif Mengampu' : 'Belum Diatur' }}</span>
                    <i class="fa-solid fa-circle-check {{ !empty($profile['dosen_wali']) ? 'text-emerald-500' : 'text-slate-300' }}"></i>
                </div>
            </div>

            <!-- Status Pengurus Organisasi -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 flex items-center space-x-1.5">
                        <i class="fa-solid fa-sitemap text-brand-600"></i>
                        <span>Status Kepengurusan</span>
                    </h3>
                    <a href="{{ route('struktur.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700">
                        Atur &rarr;
                    </a>
                </div>

                <div class="space-y-2.5 text-xs">
                    @php
                        $ketua = collect($officers)->firstWhere('jabatan', 'Ketua Kelas');
                        $wakil = collect($officers)->firstWhere('jabatan', 'Wakil Ketua Kelas');
                        $sekretaris = collect($officers)->firstWhere('jabatan', 'Sekretaris');
                        $bendahara = collect($officers)->firstWhere('jabatan', 'Bendahara');
                    @endphp

                    <div class="p-2.5 rounded-xl border {{ $ketua ? 'border-slate-100 bg-slate-50/70 text-slate-900' : 'border-dashed border-amber-300 bg-amber-50/50 text-amber-800' }} flex items-center justify-between">
                        <span class="text-slate-500">Ketua Kelas</span>
                        <span class="font-bold {{ $ketua ? '' : 'italic' }}">
                            {{ $ketua['nama'] ?? 'Belum ditentukan' }}
                        </span>
                    </div>

                    <div class="p-2.5 rounded-xl border {{ $wakil ? 'border-slate-100 bg-slate-50/70 text-slate-900' : 'border-dashed border-amber-300 bg-amber-50/50 text-amber-800' }} flex items-center justify-between">
                        <span class="text-slate-500">Wakil Ketua Kelas</span>
                        <span class="font-bold {{ $wakil ? '' : 'italic' }}">
                            {{ $wakil['nama'] ?? 'Belum ditentukan' }}
                        </span>
                    </div>

                    <div class="p-2.5 rounded-xl border {{ $sekretaris ? 'border-slate-100 bg-slate-50/70 text-slate-900' : 'border-dashed border-amber-300 bg-amber-50/50 text-amber-800' }} flex items-center justify-between">
                        <span class="text-slate-500">Sekretaris</span>
                        <span class="font-bold {{ $sekretaris ? '' : 'italic' }}">
                            {{ $sekretaris['nama'] ?? 'Belum ditentukan' }}
                        </span>
                    </div>

                    <div class="p-2.5 rounded-xl border {{ $bendahara ? 'border-slate-100 bg-slate-50/70 text-slate-900' : 'border-dashed border-amber-300 bg-amber-50/50 text-amber-800' }} flex items-center justify-between">
                        <span class="text-slate-500">Bendahara</span>
                        <span class="font-bold {{ $bendahara ? '' : 'italic' }}">
                            {{ $bendahara['nama'] ?? 'Belum ditentukan' }}
                        </span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100">
                    <a href="{{ route('struktur.index') }}" class="w-full py-2 px-3 rounded-xl bg-brand-50 hover:bg-brand-100 text-brand-700 font-bold text-xs text-center block transition">
                        <i class="fa-solid fa-sliders mr-1"></i> Buka Bagan & Atur Jabatan
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
