@extends('layouts.app')

@section('title', 'Dashboard Kelas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-100 text-brand-800">
                    Sistem Informasi Kelas SI2A
                </span>
                <span class="text-xs text-slate-400">Politeknik Negeri Subang</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                Dashboard Ringkasan Kelas
            </h1>
        </div>

        <div class="flex items-center space-x-2">
            <a href="{{ route('profil.index') }}" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold shadow-sm transition">
                <i class="fa-solid fa-id-card mr-1 text-slate-400"></i> Profil Kelas
            </a>
            <a href="{{ route('mahasiswa.index') }}" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold shadow-sm transition">
                <i class="fa-solid fa-users mr-1 text-slate-400"></i> Mahasiswa
            </a>
            <a href="{{ route('struktur.index') }}" class="px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-sm transition">
                <i class="fa-solid fa-sitemap mr-1"></i> Struktur Kelas
            </a>
        </div>
    </div>

    @if(!$dataAvailable)
        <!-- Activity Diagram: Apakah data tersedia? Tidak -> Tampilkan nilai 0 dan pesan "Data belum tersedia" -->
        <div class="p-8 rounded-2xl bg-amber-50 border border-amber-200 text-center mb-8">
            <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h2 class="text-xl font-bold text-amber-900">Data belum tersedia</h2>
            <p class="text-sm text-amber-700 mt-1 max-w-md mx-auto">
                Data kelas atau mahasiswa belum dimasukkan ke dalam sistem. Silakan kelola profil dan tambahkan data mahasiswa terlebih dahulu.
            </p>
            <div class="mt-6 flex justify-center gap-3">
                <a href="{{ route('profil.index') }}" class="px-4 py-2 bg-amber-700 text-white rounded-xl text-xs font-bold shadow">
                    Kelola Profil Kelas
                </a>
            </div>
        </div>

        <!-- Kartu bernilai 0 -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 text-center">
                <span class="text-xs font-bold uppercase text-slate-400">Jumlah Mahasiswa</span>
                <span class="block text-4xl font-extrabold text-slate-800 mt-1">0</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 text-center">
                <span class="text-xs font-bold uppercase text-slate-400">Jumlah Pengurus</span>
                <span class="block text-4xl font-extrabold text-slate-800 mt-1">0</span>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 text-center">
                <span class="text-xs font-bold uppercase text-slate-400">Jumlah Kelas</span>
                <span class="block text-4xl font-extrabold text-slate-800 mt-1">0</span>
            </div>
        </div>
    @else
        <!-- Activity Diagram: Apakah data tersedia? Ya -> Hitung jumlah mahasiswa, pengurus, kelas dan komposisi -->
        
        <!-- Statistik Kartu Ringkas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Jumlah Mahasiswa</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalMahasiswa }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Terdaftar di SI2A</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Jumlah Pengurus</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalPengurus }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Memegang Jabatan Inti</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Jumlah Kelas</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalKelas }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $profile['nama_kelas'] ?? 'SI2A' }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-door-open"></i>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase text-slate-400 tracking-wider">Tahun Angkatan</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $profile['angkatan'] ?? '2026' }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">D-III Sistem Informasi</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Ringkasan Grafik Komposisi (Activity Diagram Page 3) -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 lg:col-span-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                        <h2 class="text-base font-bold text-slate-900 flex items-center space-x-2">
                            <i class="fa-solid fa-chart-pie text-brand-600"></i>
                            <span>Grafik Komposisi Mahasiswa</span>
                        </h2>
                    </div>

                    <!-- Visual Progress / Donut Representation -->
                    <div class="my-6">
                        <div class="flex items-center justify-between text-xs font-bold text-slate-600 mb-2">
                            <span class="flex items-center text-blue-600">
                                <i class="fa-solid fa-mars mr-1"></i> Laki-laki: {{ $maleCount }} ({{ $malePercent }}%)
                            </span>
                            <span class="flex items-center text-rose-500">
                                <i class="fa-solid fa-venus mr-1"></i> Perempuan: {{ $femaleCount }} ({{ $femalePercent }}%)
                            </span>
                        </div>
                        <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden flex shadow-inner">
                            <div class="bg-blue-500 h-full transition-all duration-500" style="width: {{ $malePercent }}%"></div>
                            <div class="bg-rose-400 h-full transition-all duration-500" style="width: {{ $femalePercent }}%"></div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2 text-xs">
                        <div class="p-3 rounded-xl bg-blue-50/70 border border-blue-100 flex items-center justify-between">
                            <span class="font-semibold text-blue-900">Mahasiswa Laki-laki</span>
                            <span class="font-bold text-blue-700">{{ $maleCount }} Orang</span>
                        </div>
                        <div class="p-3 rounded-xl bg-rose-50/70 border border-rose-100 flex items-center justify-between">
                            <span class="font-semibold text-rose-900">Mahasiswi Perempuan</span>
                            <span class="font-bold text-rose-700">{{ $femaleCount }} Orang</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <span class="font-semibold text-slate-700">Total Keseluruhan</span>
                            <span class="font-bold text-slate-900">{{ $totalMahasiswa }} Mahasiswa</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                    <span class="text-[11px] text-slate-400">Komposisi berdasarkan data mahasiswa aktif</span>
                </div>
            </div>

            <!-- Ringkasan Profil Kelas (Activity Diagram Page 3) -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 lg:col-span-2">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-5">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 flex items-center space-x-2">
                            <i class="fa-solid fa-school text-brand-600"></i>
                            <span>Ringkasan Profil Kelas SI2A</span>
                        </h2>
                        <p class="text-xs text-slate-500">Informasi identitas akademik dan dosen pembimbing</p>
                    </div>
                    <a href="{{ route('profil.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700">
                        Detail Profil &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm mb-6">
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-[11px] font-bold uppercase text-slate-400 block mb-0.5">Program Studi:</span>
                        <span class="font-bold text-slate-800">{{ $profile['prodi'] ?? '-' }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-[11px] font-bold uppercase text-slate-400 block mb-0.5">Jurusan:</span>
                        <span class="font-bold text-slate-800">{{ $profile['jurusan'] ?? '-' }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-[11px] font-bold uppercase text-slate-400 block mb-0.5">Institusi / Kampus:</span>
                        <span class="font-bold text-slate-800">{{ $profile['institusi'] ?? '-' }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-[11px] font-bold uppercase text-slate-400 block mb-0.5">Dosen Pengampu / Wali:</span>
                        <span class="font-bold text-brand-700">{{ $profile['dosen_wali'] ?? '-' }}</span>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-indigo-50/60 border border-indigo-100 text-xs text-slate-700 leading-relaxed mb-6">
                    <span class="font-bold text-indigo-900 block mb-1">Mata Kuliah & Kelompok:</span>
                    <span>{{ $profile['mata_kuliah'] ?? 'Pemrograman Website' }} • <strong>{{ $profile['kelompok'] ?? 'Kelompok 4' }}</strong></span>
                    <p class="mt-2 text-slate-600 italic">"{{ $profile['deskripsi'] ?? '-' }}"</p>
                </div>

                <!-- Daftar Pengurus Inti -->
                <div>
                    <h3 class="text-xs font-bold uppercase text-slate-400 tracking-wider mb-3">Pengurus Inti Saat Ini:</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                        @forelse($officers as $officer)
                        <div class="p-2.5 rounded-xl border border-slate-100 bg-white shadow-xs">
                            <span class="text-[10px] font-bold uppercase px-1.5 py-0.2 rounded bg-brand-50 text-brand-700 inline-block mb-1">
                                {{ $officer['jabatan'] }}
                            </span>
                            <span class="font-bold text-slate-900 block truncate">{{ $officer['nama'] }}</span>
                            <span class="text-[11px] text-slate-400 block font-mono">{{ $officer['nim'] }}</span>
                        </div>
                        @empty
                        <div class="col-span-4 text-xs text-slate-400 italic">Belum ada pengurus yang ditetapkan.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    @endif

</div>
@endsection
