@extends('layouts.app')

@section('title', 'Struktur Jabatan & Pengurus')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="text-center max-w-3xl mx-auto mb-12">
        <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-bold border border-brand-200 mb-3">
            <i class="fa-solid fa-sitemap"></i>
            <span>Bagan Struktur Kepengurusan</span>
        </span>
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
            Struktur Organisasi & Jabatan Kelas
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-500 leading-relaxed">
            Mengenal tim pengurus kelas <strong class="text-slate-700">{{ $info['name'] }}</strong> yang bertugas menjaga ketertiban, keharmonisan, serta kelancaran seluruh kegiatan belajar.
        </p>
    </div>

    <!-- LEVEL 1: PEMBINA / WALI KELAS -->
    <div class="flex flex-col items-center mb-12">
        <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 flex items-center space-x-1.5">
            <i class="fa-solid fa-user-tie text-brand-600"></i>
            <span>Pembimbing / Wali Kelas</span>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-md p-5 sm:p-6 max-w-md w-full flex items-center space-x-4 relative group hover:border-brand-300 transition-all">
            <div class="relative">
                <img src="{{ $info['homeroom_teacher']['avatar'] }}" alt="{{ $info['homeroom_teacher']['name'] }}" class="w-16 h-16 rounded-2xl object-cover border-2 border-brand-500 shadow-sm">
                <span class="absolute -top-2 -left-2 bg-brand-600 text-white rounded-full p-1 text-[10px]">
                    <i class="fa-solid fa-award"></i>
                </span>
            </div>
            <div class="flex-grow min-w-0">
                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-brand-50 text-brand-700">Wali Kelas</span>
                <h3 class="text-base font-bold text-slate-900 truncate mt-1">{{ $info['homeroom_teacher']['name'] }}</h3>
                <p class="text-xs text-slate-500">NIP. {{ $info['homeroom_teacher']['nip'] }}</p>
            </div>
        </div>

        <!-- Vertical Connecting Line -->
        <div class="w-0.5 h-10 bg-slate-300 my-1"></div>
    </div>

    <!-- LEVEL 2: PIMPINAN UTAMA (KETUA & WAKIL) -->
    <div class="mb-14">
        <div class="text-center mb-6">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 inline-flex items-center space-x-1.5">
                <i class="fa-solid fa-crown text-amber-500"></i>
                <span>Pimpinan Inti Kelas</span>
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            @foreach($officers['main'] as $lead)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all p-6 relative overflow-hidden flex flex-col justify-between">
                <!-- Top Corner Accent -->
                <div class="absolute top-0 right-0 w-28 h-28 {{ $lead['position'] == 'Ketua Kelas' ? 'bg-amber-500/10' : 'bg-blue-500/10' }} rounded-bl-full pointer-events-none"></div>

                <div>
                    <div class="flex items-start space-x-4 mb-4">
                        <img src="{{ $lead['avatar'] }}" alt="{{ $lead['name'] }}" class="w-20 h-20 rounded-2xl object-cover shadow border-2 {{ $lead['position'] == 'Ketua Kelas' ? 'border-amber-400' : 'border-blue-400' }}">
                        <div class="flex-grow min-w-0">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold {{ $lead['position'] == 'Ketua Kelas' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                <i class="fa-solid {{ $lead['position'] == 'Ketua Kelas' ? 'fa-crown' : 'fa-star' }} mr-1 text-[11px]"></i>
                                {{ $lead['position'] }}
                            </span>
                            <h3 class="text-lg font-bold text-slate-900 mt-1.5 leading-snug">{{ $lead['name'] }}</h3>
                            <p class="text-xs text-slate-400 font-medium">Panggilan: "{{ $lead['nickname'] }}" • NIS. {{ $lead['nis'] }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <span class="text-xs font-semibold text-slate-500 block mb-0.5">Tugas & Tanggung Jawab:</span>
                            <p class="text-xs text-slate-600 leading-relaxed">{{ $lead['bio'] }}</p>
                        </div>

                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-xs italic text-slate-600">
                            "{{ $lead['motto'] }}"
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span class="flex items-center space-x-1.5">
                        <i class="fa-brands fa-instagram text-rose-500"></i>
                        <span>{{ $lead['instagram'] }}</span>
                    </span>
                    <span class="text-slate-400 truncate text-[11px]">{{ $lead['email'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- LEVEL 3: BADAN PENGURUS HARIAN (SEKRETARIS & BENDAHARA) -->
    <div class="mb-14">
        <div class="text-center mb-6">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 inline-flex items-center space-x-1.5">
                <i class="fa-solid fa-file-invoice text-indigo-500"></i>
                <span>Badan Pengurus Harian (BPH)</span>
            </span>
            <h2 class="text-xl font-bold text-slate-800 mt-1">Sekretaris & Bendahara</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($officers['administration'] as $admin)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 hover:border-brand-300 transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-3">
                        <img src="{{ $admin['avatar'] }}" alt="{{ $admin['name'] }}" class="w-14 h-14 rounded-xl object-cover border border-slate-200 shadow-sm">
                        <div class="min-w-0 flex-grow">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-700">
                                {{ $admin['position'] }}
                            </span>
                            <h4 class="font-bold text-slate-900 text-sm truncate mt-1">{{ $admin['name'] }}</h4>
                            <span class="text-xs text-slate-400">{{ $admin['instagram'] }}</span>
                        </div>
                    </div>

                    <div class="mt-2">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tupoksi:</span>
                        <p class="text-xs text-slate-600 leading-relaxed">{{ $admin['tasks'] }}</p>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-400 flex items-center justify-between">
                    <span>NIS: {{ $admin['nis'] }}</span>
                    <span class="font-semibold text-brand-600">{{ $admin['nickname'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- LEVEL 4: SEKSI-SEKSI BIDANG -->
    <div class="mb-8">
        <div class="text-center mb-8">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 inline-flex items-center space-x-1.5">
                <i class="fa-solid fa-cubes text-emerald-500"></i>
                <span>Koordinator & Seksi Bidang</span>
            </span>
            <h2 class="text-xl font-bold text-slate-800 mt-1">Divisi Pendukung Kelas</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-xl mx-auto">
                Setiap divisi bertanggung jawab langsung terhadap kelancaran operasional spesifik, ketertiban, dan kenyamanan lingkungan kelas.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($officers['sections'] as $sec)
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    <!-- Header Seksi -->
                    <div class="flex items-start space-x-3.5 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-700 text-lg flex-shrink-0">
                            <i class="fa-solid {{ $sec['icon'] }}"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-bold text-slate-900 text-sm sm:text-base leading-snug">{{ $sec['section_name'] }}</h3>
                            <span class="text-xs text-slate-400 font-medium">Koordinator: <strong class="text-slate-700">{{ $sec['lead'] }}</strong></span>
                        </div>
                    </div>

                    <!-- Anggota Seksi -->
                    <div class="mb-4 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Anggota Tim:</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($sec['members'] as $member)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-white text-slate-700 border border-slate-200">
                                <i class="fa-regular fa-user mr-1 text-[10px] text-slate-400"></i>
                                {{ $member }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Rincian Tugas (Duties) -->
                    <div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Tugas Utama:</span>
                        <ul class="space-y-1.5 text-xs text-slate-600">
                            @foreach($sec['duties'] as $duty)
                            <li class="flex items-start space-x-2">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-[11px] flex-shrink-0 mt-0.5"></i>
                                <span>{{ $duty }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                    <span>Status: Aktif</span>
                    <span class="text-brand-600 font-semibold">{{ count($sec['members']) + 1 }} Personel</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Navigation Bottom Banner -->
    <div class="mt-12 p-6 rounded-2xl bg-gradient-to-r from-slate-900 to-indigo-950 text-white flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h3 class="font-bold text-base sm:text-lg">Ingin Mengetahui Lebih Lengkap Tentang Kelas?</h3>
            <p class="text-xs sm:text-sm text-slate-300">Kunjungi profil lengkap, visi & misi, fasilitas serta pencapaian kelas.</p>
        </div>
        <div class="flex items-center space-x-3 flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold border border-white/20 transition-colors">
                <i class="fa-solid fa-table-columns mr-1"></i> Dashboard
            </a>
            <a href="{{ route('profile') }}" class="px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-500 text-white text-xs font-semibold shadow-md transition-colors">
                <i class="fa-solid fa-id-card mr-1"></i> Profil Kelas
            </a>
        </div>
    </div>

</div>
@endsection
