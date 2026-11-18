@extends('layouts.app')

@section('title', 'Struktur Organisasi Kelas SI2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-100 text-brand-800">
                    Struktur Organisasi
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi SI2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                Bagan Struktur Kelas SI2A
            </h1>
        </div>

        @if($isAdmin)
        <div>
            <!-- Tombol Atur Jabatan (Activity Diagram Page 10) -->
            <button type="button" onclick="openModal('modal-atur-jabatan')" class="px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition flex items-center space-x-2">
                <i class="fa-solid fa-sliders"></i>
                <span>Atur Jabatan Pengurus</span>
            </button>
        </div>
        @else
        <div class="text-xs text-slate-500 bg-white px-3 py-2 rounded-xl border border-slate-200">
            <i class="fa-solid fa-lock mr-1 text-slate-400"></i> Login sebagai Admin untuk mengatur susunan jabatan.
        </div>
        @endif
    </div>

    <!-- Status Kelengkapan Jabatan (Activity Diagram Page 7) -->
    @if(!$isComplete)
    <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-xs sm:text-sm flex items-center justify-between mb-8 shadow-sm">
        <div class="flex items-center space-x-2.5">
            <i class="fa-solid fa-circle-info text-amber-600 text-base"></i>
            <span>Ada jabatan yang berstatus <strong class="underline">Belum ditentukan</strong>. Pengurus kelas dapat diatur melalui tombol Atur Jabatan.</span>
        </div>
    </div>
    @endif

    <!-- BAGAN STRUKTUR VISUAL HIERARKIS -->
    <div class="flex flex-col items-center">

        <!-- LEVEL 1: DOSEN WALI -->
        <div class="flex flex-col items-center mb-6">
            <span class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-2">Pembimbing / Dosen Wali</span>
            <div class="bg-white rounded-2xl border-2 border-brand-500 p-5 shadow-lg max-w-sm w-full text-center relative group">
                <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center text-xl mx-auto mb-2 shadow-sm">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold uppercase bg-brand-100 text-brand-800">
                    Dosen Wali
                </span>
                <h3 class="text-base font-bold text-slate-900 mt-1">
                    {{ $structure['Dosen Wali'] ?? 'Rahmat Irsyada, M.Pd. & Usep Abdul Rosid, M.Kom.' }}
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Politeknik Negeri Subang</p>
            </div>
            <!-- Garis Penghubung Vertikal -->
            <div class="w-0.5 h-8 bg-slate-300"></div>
        </div>

        <!-- LEVEL 2: KETUA & WAKIL KETUA -->
        <div class="w-full max-w-3xl mb-6">
            <div class="text-center mb-2">
                <span class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Pimpinan Kelas</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Ketua Kelas -->
                <div class="bg-white rounded-2xl border {{ !empty($structure['Ketua Kelas']) ? 'border-amber-300 shadow-md' : 'border-dashed border-slate-300' }} p-5 text-center relative">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase {{ !empty($structure['Ketua Kelas']) ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-500' }}">
                        <i class="fa-solid fa-crown mr-1"></i> Ketua Kelas
                    </span>
                    @if(!empty($structure['Ketua Kelas']))
                        <h4 class="text-base font-black text-slate-900 mt-3">{{ $structure['Ketua Kelas']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono">NIM. {{ $structure['Ketua Kelas']['nim'] }}</p>
                        <p class="text-xs text-brand-600 mt-1 font-medium">{{ $structure['Ketua Kelas']['email'] }}</p>
                    @else
                        <!-- Activity Diagram Page 7: Tampilkan bagan dengan keterangan "Belum ditentukan" -->
                        <h4 class="text-sm font-bold text-rose-500 italic mt-3">Belum ditentukan</h4>
                        <p class="text-xs text-slate-400">Posisi kosong</p>
                    @endif
                </div>

                <!-- Wakil Ketua Kelas -->
                <div class="bg-white rounded-2xl border {{ !empty($structure['Wakil Ketua Kelas']) ? 'border-blue-300 shadow-md' : 'border-dashed border-slate-300' }} p-5 text-center relative">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase {{ !empty($structure['Wakil Ketua Kelas']) ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-500' }}">
                        <i class="fa-solid fa-star mr-1"></i> Wakil Ketua Kelas
                    </span>
                    @if(!empty($structure['Wakil Ketua Kelas']))
                        <h4 class="text-base font-black text-slate-900 mt-3">{{ $structure['Wakil Ketua Kelas']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono">NIM. {{ $structure['Wakil Ketua Kelas']['nim'] }}</p>
                        <p class="text-xs text-brand-600 mt-1 font-medium">{{ $structure['Wakil Ketua Kelas']['email'] }}</p>
                    @else
                        <!-- Activity Diagram Page 7: Tampilkan bagan dengan keterangan "Belum ditentukan" -->
                        <h4 class="text-sm font-bold text-rose-500 italic mt-3">Belum ditentukan</h4>
                        <p class="text-xs text-slate-400">Posisi kosong</p>
                    @endif
                </div>
            </div>

            <!-- Garis Penghubung Vertikal -->
            <div class="w-0.5 h-8 bg-slate-300 mx-auto mt-6"></div>
        </div>

        <!-- LEVEL 3: SEKRETARIS & BENDAHARA -->
        <div class="w-full max-w-3xl mb-8">
            <div class="text-center mb-2">
                <span class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Administrasi & Keuangan</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Sekretaris -->
                <div class="bg-white rounded-2xl border {{ !empty($structure['Sekretaris']) ? 'border-indigo-300 shadow-md' : 'border-dashed border-slate-300' }} p-5 text-center">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase {{ !empty($structure['Sekretaris']) ? 'bg-indigo-100 text-indigo-800' : 'bg-slate-100 text-slate-500' }}">
                        <i class="fa-solid fa-pen-fancy mr-1"></i> Sekretaris
                    </span>
                    @if(!empty($structure['Sekretaris']))
                        <h4 class="text-base font-black text-slate-900 mt-3">{{ $structure['Sekretaris']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono">NIM. {{ $structure['Sekretaris']['nim'] }}</p>
                        <p class="text-xs text-brand-600 mt-1 font-medium">{{ $structure['Sekretaris']['email'] }}</p>
                    @else
                        <!-- Activity Diagram Page 7: Tampilkan bagan dengan keterangan "Belum ditentukan" -->
                        <h4 class="text-sm font-bold text-rose-500 italic mt-3">Belum ditentukan</h4>
                        <p class="text-xs text-slate-400">Posisi kosong</p>
                    @endif
                </div>

                <!-- Bendahara -->
                <div class="bg-white rounded-2xl border {{ !empty($structure['Bendahara']) ? 'border-emerald-300 shadow-md' : 'border-dashed border-slate-300' }} p-5 text-center">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase {{ !empty($structure['Bendahara']) ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                        <i class="fa-solid fa-wallet mr-1"></i> Bendahara
                    </span>
                    @if(!empty($structure['Bendahara']))
                        <h4 class="text-base font-black text-slate-900 mt-3">{{ $structure['Bendahara']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono">NIM. {{ $structure['Bendahara']['nim'] }}</p>
                        <p class="text-xs text-brand-600 mt-1 font-medium">{{ $structure['Bendahara']['email'] }}</p>
                    @else
                        <!-- Activity Diagram Page 7: Tampilkan bagan dengan keterangan "Belum ditentukan" -->
                        <h4 class="text-sm font-bold text-rose-500 italic mt-3">Belum ditentukan</h4>
                        <p class="text-xs text-slate-400">Posisi kosong</p>
                    @endif
                </div>
            </div>

            <!-- Garis Penghubung Vertikal -->
            <div class="w-0.5 h-8 bg-slate-300 mx-auto mt-6"></div>
        </div>

        <!-- LEVEL 4: ANGGOTA KELAS -->
        <div class="w-full max-w-4xl">
            <div class="text-center mb-4">
                <span class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Seluruh Anggota Kelas</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 text-xs">
                    @forelse($structure['Anggota'] as $ang)
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-center space-x-2">
                        <div class="w-7 h-7 rounded-lg bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                            {{ substr($ang['nama'], 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-slate-800 block truncate">{{ $ang['nama'] }}</span>
                            <span class="text-[10px] text-slate-400 font-mono block">{{ $ang['nim'] }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-4 text-center text-xs text-slate-400 py-4 italic">
                        Semua mahasiswa telah memegang posisi kepengurusan inti.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

<!-- MODAL ATUR JABATAN PENGURUS (Admin - Activity Diagram Page 10) -->
<div id="modal-atur-jabatan" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Atur Jabatan Pengurus</h3>
                <p class="text-xs text-slate-500">Validasi kepemilikan jabatan organisasi kelas</p>
            </div>
            <button onclick="closeModal('modal-atur-jabatan')" class="text-slate-400 hover:text-slate-600">&times;</button>
        </div>

        <form action="{{ route('struktur.atur') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Mahasiswa</label>
                <select name="mahasiswa_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                    <option value="" disabled selected>-- Pilih Mahasiswa SI2A --</option>
                    @foreach($allStudents as $std)
                        <option value="{{ $std['id'] }}">
                            {{ $std['nim'] }} - {{ $std['nama'] }} (Saat ini: {{ $std['jabatan'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Jabatan Baru</label>
                <select name="jabatan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                    <option value="" disabled selected>-- Pilih Jabatan --</option>
                    <option value="Ketua Kelas">Ketua Kelas</option>
                    <option value="Wakil Ketua Kelas">Wakil Ketua Kelas</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota (Kembalikan ke Anggota)</option>
                </select>
                <p class="text-[11px] text-slate-400 mt-1">
                    *Catatan: Jabatan tunggal (Ketua, Wakil, Sekretaris, Bendahara) tidak dapat diduplikasi. Sistem akan menolak jika sudah diisi mahasiswa lain.
                </p>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('modal-atur-jabatan')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-brand-600 hover:bg-brand-700 text-white shadow">Simpan Jabatan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection
