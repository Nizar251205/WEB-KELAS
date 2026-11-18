@extends('layouts.app')

@section('title', 'Dashboard Kelas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Welcome Hero Banner -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-brand-700 via-indigo-600 to-blue-600 text-white shadow-xl mb-8">
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -left-10 -top-10 w-60 h-60 bg-indigo-400/20 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative p-6 sm:p-8 lg:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-semibold mb-3 border border-white/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Portal Resmi Kelas • {{ $info['academic_year'] }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight">
                    Selamat Datang di <span class="text-indigo-200">{{ $info['name'] }}</span>
                </h1>
                <p class="mt-2 text-sm sm:text-base text-indigo-100 font-normal leading-relaxed">
                    "{{ $info['motto'] }}" — Menjadi ruang kolaborasi, pertumbuhan karakter, dan eksplorasi ilmu pengetahuan.
                </p>
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <a href="{{ route('profile') }}" class="inline-flex items-center space-x-2 px-4 py-2 rounded-xl bg-white text-brand-700 font-bold text-sm shadow hover:bg-indigo-50 transition-all duration-150">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>Lihat Profil Kelas</span>
                    </a>
                    <a href="{{ route('jabatan') }}" class="inline-flex items-center space-x-2 px-4 py-2 rounded-xl bg-white/15 hover:bg-white/25 border border-white/30 text-white font-semibold text-sm backdrop-blur-sm transition-all duration-150">
                        <i class="fa-solid fa-users-gear"></i>
                        <span>Struktur Pengurus</span>
                    </a>
                </div>
            </div>

            <!-- Quick Info Badge in Banner -->
            <div class="hidden md:flex flex-col items-end text-right bg-white/10 backdrop-blur-md border border-white/20 p-5 rounded-2xl min-w-[210px]">
                <span class="text-xs text-indigo-200 uppercase tracking-wider font-semibold">Ruang Belajar</span>
                <span class="text-xl font-bold text-white mt-0.5">{{ $info['room'] }}</span>
                <div class="mt-4 pt-3 border-t border-white/15 w-full flex items-center justify-between text-xs text-indigo-100">
                    <span>Angkatan</span>
                    <span class="font-bold text-white">{{ $info['generation'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        @foreach($dashboard['quick_stats'] as $stat)
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow duration-200 flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">{{ $stat['label'] }}</p>
                <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $stat['value'] }}</h3>
                <p class="text-xs text-slate-500 mt-1 flex items-center">
                    <i class="fa-solid fa-check-circle text-emerald-500 mr-1.5 text-[11px]"></i>
                    {{ $stat['detail'] }}
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg {{ $stat['bg'] }} border {{ $stat['border'] }}">
                <i class="fa-solid {{ $stat['icon'] }}"></i>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Main Content Layout (2 Columns) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Section (2 Columns width on LG) -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Pengumuman Kelas -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                            <i class="fa-solid fa-bullhorn text-sm"></i>
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">Pengumuman & Agenda Penting</h2>
                    </div>
                    <span class="text-xs text-slate-400 font-medium">Terbaru</span>
                </div>

                <div class="space-y-4">
                    @foreach($dashboard['announcements'] as $item)
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/60 hover:bg-slate-50 transition-colors">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $item['tag_color'] }}">
                                    {{ $item['tag'] }}
                                </span>
                                <h3 class="font-bold text-slate-800 text-sm sm:text-base">{{ $item['title'] }}</h3>
                            </div>
                            <span class="text-xs text-slate-400 flex items-center">
                                <i class="fa-regular fa-calendar-days mr-1.5"></i> {{ $item['date'] }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $item['content'] }}</p>
                        <div class="mt-2.5 flex items-center text-xs text-slate-400">
                            <i class="fa-solid fa-user-pen mr-1.5 text-slate-400"></i> Oleh: <span class="font-medium text-slate-600 ml-1">{{ $item['author'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Jadwal Pelajaran Hari Ini -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                            <i class="fa-solid fa-clock text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Jadwal Pelajaran Hari Ini</h2>
                            <p class="text-xs text-slate-500">Mata Pelajaran Jurusan Rekayasa Perangkat Lunak</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-brand-100 text-brand-800">
                        Hari Efektif
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-xs font-bold uppercase text-slate-400 border-b border-slate-100 pb-2">
                                <th class="pb-3 font-semibold">Waktu</th>
                                <th class="pb-3 font-semibold">Mata Pelajaran</th>
                                <th class="pb-3 font-semibold">Guru Pengampu</th>
                                <th class="pb-3 font-semibold">Ruangan</th>
                                <th class="pb-3 font-semibold text-right">Tipe</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($dashboard['today_schedule'] as $sched)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="py-3 font-medium text-slate-700 whitespace-nowrap">
                                    <i class="fa-regular fa-clock text-slate-400 mr-1.5"></i>
                                    {{ $sched['time'] }}
                                </td>
                                <td class="py-3 font-semibold text-slate-800">
                                    {{ $sched['subject'] }}
                                </td>
                                <td class="py-3 text-slate-600 whitespace-nowrap">
                                    {{ $sched['teacher'] }}
                                </td>
                                <td class="py-3 text-slate-500 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-slate-100 text-slate-700">
                                        {{ $sched['room'] }}
                                    </span>
                                </td>
                                <td class="py-3 text-right">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $sched['badge'] == 'Praktikum' ? 'bg-indigo-50 text-indigo-700' : 'bg-emerald-50 text-emerald-700' }}">
                                        {{ $sched['badge'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Jadwal Piket Harian -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-broom text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Jadwal Piket Kebersihan</h2>
                            <p class="text-xs text-slate-500">Dikoordinasikan oleh Seksi Kebersihan Kelas</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
                    @foreach($dashboard['piket_schedule'] as $day => $students)
                    <div class="p-3.5 rounded-xl border border-slate-200/70 bg-gradient-to-b from-white to-slate-50/50">
                        <div class="flex items-center justify-between mb-2 pb-1.5 border-b border-slate-100">
                            <span class="font-bold text-sm text-slate-800">{{ $day }}</span>
                            <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded">
                                {{ count($students) }} Siswa
                            </span>
                        </div>
                        <ul class="space-y-1 text-xs text-slate-600">
                            @foreach($students as $student)
                            <li class="flex items-center space-x-1.5 truncate">
                                <i class="fa-solid fa-check text-[10px] text-emerald-500 flex-shrink-0"></i>
                                <span class="truncate">{{ $student }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Right Sidebar (1 Column) -->
        <div class="space-y-6">

            <!-- Wali Kelas Spotlight -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 relative overflow-hidden">
                <div class="flex items-center space-x-2 text-xs font-bold uppercase tracking-wider text-brand-600 mb-4">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Wali Kelas Kami</span>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <img src="{{ $info['homeroom_teacher']['avatar'] }}" 
                             alt="{{ $info['homeroom_teacher']['name'] }}" 
                             class="w-24 h-24 rounded-full object-cover shadow-md border-4 border-brand-100">
                        <span class="absolute bottom-0 right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center text-white text-[10px]" title="Aktif Mengampu">
                            <i class="fa-solid fa-check"></i>
                        </span>
                    </div>

                    <h3 class="mt-4 font-bold text-slate-900 text-base leading-snug">
                        {{ $info['homeroom_teacher']['name'] }}
                    </h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">NIP: {{ $info['homeroom_teacher']['nip'] }}</p>

                    <div class="mt-4 p-3 bg-slate-50 rounded-xl border border-slate-100 text-xs text-slate-600 italic leading-relaxed text-left relative">
                        <i class="fa-solid fa-quote-left text-brand-200 text-lg absolute top-2 right-2 -z-0"></i>
                        <span class="relative z-10">"{{ $info['homeroom_teacher']['message'] }}"</span>
                    </div>

                    <a href="mailto:{{ $info['homeroom_teacher']['contact'] }}" class="mt-4 w-full inline-flex items-center justify-center space-x-2 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors">
                        <i class="fa-regular fa-envelope"></i>
                        <span>Hubungi Wali Kelas</span>
                    </a>
                </div>
            </div>

            <!-- Pimpinan Kelas Singkat -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-2">
                        <i class="fa-solid fa-crown text-amber-500"></i>
                        <span>Pimpinan Kelas</span>
                    </h3>
                    <a href="{{ route('jabatan') }}" class="text-xs font-semibold text-brand-600 hover:text-brand-700">
                        Semua Pengurus &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @foreach($officers['main'] as $lead)
                    <div class="flex items-center space-x-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <img src="{{ $lead['avatar'] }}" alt="{{ $lead['name'] }}" class="w-11 h-11 rounded-lg object-cover">
                        <div class="flex-grow min-w-0">
                            <span class="inline-block px-1.5 py-0.2 rounded text-[10px] font-bold uppercase tracking-wider {{ $lead['position'] == 'Ketua Kelas' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $lead['position'] }}
                            </span>
                            <h4 class="text-xs font-bold text-slate-800 truncate mt-0.5">{{ $lead['name'] }}</h4>
                            <p class="text-[11px] text-slate-400 truncate">{{ $lead['instagram'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quote of the Week -->
            <div class="rounded-2xl p-5 bg-gradient-to-br from-indigo-50 to-brand-50 border border-indigo-100 text-slate-700 shadow-sm">
                <div class="flex items-center space-x-2 text-brand-700 text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-lightbulb"></i>
                    <span>Quote Pekan Ini</span>
                </div>
                <p class="text-xs italic text-slate-600 leading-relaxed">
                    "{{ $dashboard['quote_of_the_week']['text'] }}"
                </p>
                <div class="mt-2 text-right text-[11px] font-semibold text-brand-600">
                    — {{ $dashboard['quote_of_the_week']['author'] }}
                </div>
            </div>

            <!-- Git & Migration Note Card -->
            <div class="rounded-2xl p-5 bg-slate-900 text-slate-200 shadow-sm">
                <div class="flex items-center space-x-2 text-emerald-400 text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="fa-brands fa-github text-sm"></i>
                    <span>Status Proyek: No Database</span>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Aplikasi ini dirancang bebas ketergantungan database lokal agar siap dipush ke GitHub dan langsung dapat dijalankan di mana saja dengan <code class="bg-slate-800 px-1 py-0.5 rounded text-emerald-300">php artisan serve</code>.
                </p>
            </div>

        </div>

    </div>

</div>
@endsection
