@extends('layouts.app')

@section('title', 'Profil Kelas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Profile Header Banner -->
    <div class="relative bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
        <!-- Banner Top Cover -->
        <div class="h-44 sm:h-52 bg-gradient-to-r from-slate-900 via-indigo-950 to-brand-900 relative">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            <div class="absolute top-4 right-4 flex items-center space-x-2">
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-md border border-white/20">
                    <i class="fa-solid fa-graduation-cap mr-1"></i> {{ $info['generation'] }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/80 text-white backdrop-blur-md">
                    {{ $info['academic_year'] }}
                </span>
            </div>
        </div>

        <!-- Banner Bottom Info -->
        <div class="px-6 sm:px-8 pb-8 pt-0 relative">
            <div class="flex flex-col sm:flex-row items-start sm:items-end -mt-16 sm:-mt-20 gap-5 mb-6">
                <!-- Class Logo / Avatar -->
                <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-3xl bg-gradient-to-tr from-brand-600 to-indigo-500 text-white flex items-center justify-center text-4xl sm:text-5xl font-extrabold shadow-xl border-4 border-white flex-shrink-0">
                    <i class="fa-solid fa-laptop-code"></i>
                </div>

                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-2">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $info['name'] }}</h1>
                        <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                            {{ $info['code'] }}
                        </span>
                    </div>
                    <p class="text-sm font-medium text-slate-500 mt-1">
                        <i class="fa-solid fa-school mr-1.5 text-slate-400"></i> {{ $info['school'] }} 
                        <span class="mx-2">•</span> 
                        <i class="fa-solid fa-door-open mr-1.5 text-slate-400"></i> {{ $info['room'] }}
                    </p>
                </div>

                <div class="flex items-center gap-2 sm:self-center">
                    <a href="{{ route('jabatan') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs sm:text-sm font-bold shadow-md shadow-brand-500/20 transition-all">
                        <i class="fa-solid fa-sitemap"></i>
                        <span>Lihat Struktur Jabatan</span>
                    </a>
                </div>
            </div>

            <!-- Motto & Slogan Strip -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 text-xs sm:text-sm">
                <div class="flex items-center space-x-2 text-slate-700">
                    <span class="font-bold text-brand-600 uppercase tracking-wider text-xs">Motto Kelas:</span>
                    <span class="italic font-medium">"{{ $info['motto'] }}"</span>
                </div>
                <div class="flex items-center space-x-2 text-slate-500">
                    <span class="font-semibold text-slate-400 uppercase tracking-wider text-xs">Slogan:</span>
                    <span class="font-bold text-slate-800">{{ $info['slogan'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 text-center shadow-sm">
            <span class="block text-2xl font-black text-brand-600">{{ $info['stats']['total_students'] }}</span>
            <span class="text-xs font-semibold text-slate-500 mt-0.5">Total Siswa</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 text-center shadow-sm">
            <span class="block text-2xl font-black text-blue-600">{{ $info['stats']['male_students'] }}</span>
            <span class="text-xs font-semibold text-slate-500 mt-0.5">Siswa Laki-laki</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 text-center shadow-sm">
            <span class="block text-2xl font-black text-rose-500">{{ $info['stats']['female_students'] }}</span>
            <span class="text-xs font-semibold text-slate-500 mt-0.5">Siswa Perempuan</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 text-center shadow-sm">
            <span class="block text-2xl font-black text-indigo-600">{{ $info['stats']['total_officers'] }}</span>
            <span class="text-xs font-semibold text-slate-500 mt-0.5">Pengurus Kelas</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 text-center shadow-sm">
            <span class="block text-2xl font-black text-amber-500">{{ $info['stats']['achievements_count'] }}</span>
            <span class="text-xs font-semibold text-slate-500 mt-0.5">Prestasi Diraih</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 text-center shadow-sm">
            <span class="block text-2xl font-black text-emerald-600">{{ $info['stats']['active_projects'] }}</span>
            <span class="text-xs font-semibold text-slate-500 mt-0.5">Proyek Aktif</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Tentang Kelas & Visi Misi (2 Columns) -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Deskripsi Kelas -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Tentang Kelas Kami</h2>
                        <p class="text-xs text-slate-500">Profil ringkas dan karakteristik komunitas kelas</p>
                    </div>
                </div>

                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                    {{ $info['description'] }}
                </p>

                <!-- Demografi Progress Visual -->
                <div class="mt-6 pt-6 border-t border-slate-100">
                    <div class="flex items-center justify-between text-xs font-bold text-slate-700 mb-2">
                        <span class="flex items-center text-blue-600">
                            <i class="fa-solid fa-mars mr-1.5"></i> Laki-laki: {{ $info['stats']['male_students'] }} (47%)
                        </span>
                        <span class="flex items-center text-rose-500">
                            <i class="fa-solid fa-venus mr-1.5"></i> Perempuan: {{ $info['stats']['female_students'] }} (53%)
                        </span>
                    </div>
                    <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden flex">
                        <div class="bg-blue-500 h-full" style="width: 47%"></div>
                        <div class="bg-rose-400 h-full" style="width: 53%"></div>
                    </div>
                </div>
            </div>

            <!-- Visi & Misi Kelas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Visi -->
                <div class="bg-gradient-to-br from-indigo-900 to-brand-900 text-white rounded-2xl p-6 sm:p-7 shadow-md flex flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 text-xs font-bold text-indigo-200 mb-4 border border-white/10">
                            <i class="fa-solid fa-eye"></i>
                            <span>Visi Kelas</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold leading-relaxed text-white">
                            "{{ $info['vision'] }}"
                        </h3>
                    </div>
                    <div class="mt-6 pt-4 border-t border-white/10 text-xs text-indigo-200 flex items-center justify-between">
                        <span>Fokus: Kualitas & Karakter</span>
                        <i class="fa-solid fa-compass text-lg opacity-40"></i>
                    </div>
                </div>

                <!-- Misi -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-sm">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-brand-50 text-xs font-bold text-brand-700 mb-4 border border-brand-200">
                        <i class="fa-solid fa-bullseye"></i>
                        <span>Misi Kelas</span>
                    </div>
                    <ul class="space-y-3">
                        @foreach($info['mission'] as $index => $mis)
                        <li class="flex items-start space-x-3 text-xs sm:text-sm text-slate-600">
                            <span class="w-5 h-5 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                {{ $index + 1 }}
                            </span>
                            <span>{{ $mis }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Fasilitas Ruang Belajar -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-chalkboard"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Fasilitas Ruang Kelas</h2>
                        <p class="text-xs text-slate-500">Sarana pendukung kenyamanan dan kelancaran belajar</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($info['facilities'] as $facility)
                    <div class="p-4 rounded-xl border border-slate-100 bg-slate-50/70 hover:bg-slate-50 transition-colors flex items-start space-x-3.5">
                        <div class="w-10 h-10 rounded-lg bg-white border border-slate-200 text-brand-600 flex items-center justify-center text-base shadow-sm flex-shrink-0">
                            <i class="fa-solid {{ $facility['icon'] }}"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">{{ $facility['name'] }}</h4>
                            <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">{{ $facility['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Sidebar / Prestasi & Wali Kelas (1 Column) -->
        <div class="space-y-8">

            <!-- Wali Kelas Full Card -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                <div class="text-center pb-5 border-b border-slate-100">
                    <img src="{{ $info['homeroom_teacher']['avatar'] }}" 
                         alt="{{ $info['homeroom_teacher']['name'] }}" 
                         class="w-28 h-28 rounded-2xl mx-auto object-cover shadow-lg border-4 border-slate-100">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 mt-4">
                        Wali Kelas
                    </span>
                    <h3 class="font-bold text-slate-900 text-lg mt-1">
                        {{ $info['homeroom_teacher']['name'] }}
                    </h3>
                    <p class="text-xs text-slate-500">NIP. {{ $info['homeroom_teacher']['nip'] }}</p>
                </div>

                <div class="pt-5 space-y-4">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Pesan Wali Kelas:</span>
                        <p class="text-xs text-slate-600 italic bg-slate-50 p-3.5 rounded-xl border border-slate-100 leading-relaxed">
                            "{{ $info['homeroom_teacher']['message'] }}"
                        </p>
                    </div>

                    <div class="flex items-center space-x-3 text-xs text-slate-600">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div class="truncate">
                            <span class="block text-[11px] text-slate-400">Kontak Email Resmi</span>
                            <span class="font-medium text-slate-800 truncate">{{ $info['homeroom_teacher']['contact'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prestasi & Penghargaan -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                            <i class="fa-solid fa-trophy text-sm"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Prestasi Kelas</h3>
                    </div>
                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">
                        {{ count($info['achievements']) }} Piagam
                    </span>
                </div>

                <div class="space-y-4">
                    @foreach($info['achievements'] as $item)
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50/70 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex items-start space-x-2.5">
                                <i class="fa-solid {{ $item['icon'] }} {{ $item['color'] }} text-base mt-0.5"></i>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-xs sm:text-sm leading-snug">{{ $item['title'] }}</h4>
                                    <span class="text-[11px] text-slate-400 block mt-1">
                                        {{ $item['category'] }} • Tahun {{ $item['year'] }}
                                    </span>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-800 flex-shrink-0">
                                {{ $item['badge'] }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
