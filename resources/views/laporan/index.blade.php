@extends('layouts.app')

@section('title', 'Generate Laporan - Sistem Informasi 2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section (no-print) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 no-print">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                    Administrasi Laporan
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi 2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 tracking-tight">
                Generate & Ekspor Laporan
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                Cetak pratinjau dokumen resmi dan unduh arsip data kelas dalam format PDF atau Excel
            </p>
        </div>

        <!-- Tombol Aksi Ekspor -->
        @if($dataFound)
        <div class="flex items-center space-x-2">
            <!-- Cetak Browser -->
            <button type="button" onclick="window.print()" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-extrabold shadow-sm transition flex items-center space-x-2">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Dokumen</span>
            </button>

            <!-- Export PDF -->
            <button type="button" onclick="window.print()" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-500 hover:to-pink-500 text-white text-xs font-extrabold shadow-md shadow-rose-500/20 transition flex items-center space-x-2">
                <i class="fa-solid fa-file-pdf"></i>
                <span>Export PDF</span>
            </button>

            <!-- Export Excel (.csv) -->
            <a href="{{ route('laporan.export.excel', ['jenis' => $jenisLaporan, 'jabatan' => $filterJabatan]) }}" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-xs font-extrabold shadow-md shadow-emerald-500/20 transition flex items-center space-x-2">
                <i class="fa-solid fa-file-excel"></i>
                <span>Export Excel</span>
            </a>
        </div>
        @endif
    </div>

    <!-- Filter Form Card (no-print) -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 mb-8 no-print">
        <form action="{{ route('laporan.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-5 items-end">
            
            <!-- Jenis Laporan -->
            <div>
                <label class="block text-xs font-black uppercase text-slate-700 tracking-wider mb-2">
                    Jenis Laporan
                </label>
                <select name="jenis" onchange="this.form.submit()" class="w-full px-4 py-3 rounded-2xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-bold bg-slate-50/50">
                    <option value="mahasiswa" {{ $jenisLaporan === 'mahasiswa' ? 'selected' : '' }}>Data Mahasiswa & Pengurus</option>
                    <option value="profil" {{ $jenisLaporan === 'profil' ? 'selected' : '' }}>Profil Resmi Kelas</option>
                </select>
            </div>

            <!-- Filter Jabatan -->
            <div>
                <label class="block text-xs font-black uppercase text-slate-700 tracking-wider mb-2">
                    Filter Jabatan
                </label>
                <select name="jabatan" {{ $jenisLaporan === 'profil' ? 'disabled' : '' }} onchange="this.form.submit()" class="w-full px-4 py-3 rounded-2xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-semibold bg-slate-50/50 disabled:bg-slate-100 disabled:text-slate-400">
                    <option value="semua" {{ $filterJabatan === 'semua' ? 'selected' : '' }}>Semua Mahasiswa (Seluruh Jabatan)</option>
                    <option value="pengurus" {{ $filterJabatan === 'pengurus' ? 'selected' : '' }}>Hanya Pengurus Inti</option>
                    <option value="Ketua Kelas" {{ $filterJabatan === 'Ketua Kelas' ? 'selected' : '' }}>Ketua Kelas</option>
                    <option value="Wakil Ketua Kelas" {{ $filterJabatan === 'Wakil Ketua Kelas' ? 'selected' : '' }}>Wakil Ketua Kelas</option>
                    <option value="Sekretaris" {{ $filterJabatan === 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                    <option value="Bendahara" {{ $filterJabatan === 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                    <option value="Anggota" {{ $filterJabatan === 'Anggota' ? 'selected' : '' }}>Anggota Saja</option>
                </select>
            </div>

            <div>
                <button type="submit" class="w-full py-3 px-5 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs shadow-sm transition">
                    Terapkan Filter Laporan
                </button>
            </div>
        </form>
    </div>

    <!-- KOP SURAT RESMI CETAK (Hanya Muncul Saat Print / PDF) -->
    <div class="hidden print:block mb-8 border-b-2 border-slate-900 pb-4 text-center">
        <h2 class="text-xl font-black uppercase tracking-wider text-slate-900">POLITEKNIK NEGERI SUBANG</h2>
        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-800">JURUSAN TEKNOLOGI INFORMASI DAN KOMPUTER</h3>
        <p class="text-xs text-slate-600 mt-0.5">Program Studi D-III Sistem Informasi • Kelas Sistem Informasi 2A</p>
        <p class="text-xs text-slate-600">Mata Kuliah Pemrograman Website [PSI3310] • Kelompok 4</p>
        <p class="text-xs font-bold italic mt-2 uppercase border-t border-slate-300 pt-1">
            {{ $jenisLaporan === 'profil' ? 'Dokumen Profil Kelas' : 'Laporan Daftar Mahasiswa & Struktur Kepengurusan' }}
        </p>
    </div>

    <!-- PRATINJAU LAPORAN -->
    @if(!$dataFound)
        <!-- EMPTY STATE LAPORAN: Tidak ada data untuk dilaporkan -->
        <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center shadow-xs">
            <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mx-auto mb-3">
                <i class="fa-solid fa-file-circle-xmark"></i>
            </div>
            <h3 class="text-lg font-black text-slate-800">Tidak ada data untuk dilaporkan</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                Kriteria filter jabatan yang dipilih tidak menemukan data mahasiswa yang sesuai dalam basis data kelas.
            </p>
        </div>
    @else
        <!-- TABEL PRATINJAU LAPORAN -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden p-6 sm:p-8">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Pratinjau Dokumen Cetak:</span>
                    <h2 class="text-lg font-black text-slate-900 mt-0.5">
                        {{ $jenisLaporan === 'profil' ? 'Laporan Profil Kelas Sistem Informasi 2A' : 'Laporan Daftar & Struktur Mahasiswa' }}
                    </h2>
                </div>
                <span class="text-xs font-mono text-slate-400">Tanggal: {{ date('d F Y') }}</span>
            </div>

            @if($jenisLaporan === 'profil')
                <!-- Tabel Pratinjau Profil -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <tbody class="divide-y divide-slate-200">
                            <tr>
                                <th class="py-3.5 px-4 bg-slate-50 font-bold text-slate-600 w-1/3">Nama Kelas</th>
                                <td class="py-3.5 px-4 font-black text-slate-900">{{ $profile['nama_kelas'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3.5 px-4 bg-slate-50 font-bold text-slate-600">Program Studi</th>
                                <td class="py-3.5 px-4 text-slate-800 font-semibold">{{ $profile['prodi'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3.5 px-4 bg-slate-50 font-bold text-slate-600">Jurusan</th>
                                <td class="py-3.5 px-4 text-slate-800">{{ $profile['jurusan'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3.5 px-4 bg-slate-50 font-bold text-slate-600">Institusi / Perguruan Tinggi</th>
                                <td class="py-3.5 px-4 text-slate-800">{{ $profile['institusi'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3.5 px-4 bg-slate-50 font-bold text-slate-600">Tahun Angkatan</th>
                                <td class="py-3.5 px-4 text-slate-800 font-mono font-bold">{{ $profile['angkatan'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3.5 px-4 bg-slate-50 font-bold text-slate-600">Dosen Pengampu / Wali</th>
                                <td class="py-3.5 px-4 font-bold text-brand-700">{{ $profile['dosen_wali'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3.5 px-4 bg-slate-50 font-bold text-slate-600">Deskripsi</th>
                                <td class="py-3.5 px-4 text-slate-700 leading-relaxed">{{ $profile['deskripsi'] ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Tabel Pratinjau Mahasiswa -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-600 font-black uppercase tracking-wider text-[11px] border-b border-slate-200">
                                <th class="py-3 px-4 text-center w-12">No</th>
                                <th class="py-3 px-4">NIM</th>
                                <th class="py-3 px-4">Nama Mahasiswa</th>
                                <th class="py-3 px-4">Kelas</th>
                                <th class="py-3 px-4">Jabatan</th>
                                <th class="py-3 px-4">Gender</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">No HP</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($reportData as $index => $row)
                            <tr class="hover:bg-slate-50/80">
                                <td class="py-3 px-4 text-center text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 font-mono font-bold text-slate-800">{{ $row['nim'] }}</td>
                                <td class="py-3 px-4 font-bold text-slate-900">{{ $row['nama'] }}</td>
                                <td class="py-3 px-4 text-slate-600">{{ $row['kelas'] }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-black
                                        {{ $row['jabatan'] === 'Ketua Kelas' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $row['jabatan'] === 'Wakil Ketua Kelas' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ in_array($row['jabatan'], ['Sekretaris', 'Bendahara']) ? 'bg-indigo-100 text-indigo-800' : '' }}
                                        {{ $row['jabatan'] === 'Anggota' ? 'bg-slate-100 text-slate-600' : '' }}
                                    ">
                                        {{ $row['jabatan'] }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-slate-500">{{ $row['gender'] ?? 'Laki-laki' }}</td>
                                <td class="py-3 px-4 text-slate-600">{{ $row['email'] }}</td>
                                <td class="py-3 px-4 text-slate-600 font-mono">{{ $row['no_hp'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Tanda Tangan Cetak Khusus Print -->
            <div class="hidden print:grid grid-cols-2 mt-16 pt-8 text-center text-xs">
                <div>
                    <p>Mengetahui,</p>
                    <p class="font-bold">Ketua Kelas SI2A</p>
                    <div class="h-20"></div>
                    <p class="font-bold underline">Aakip Hasan Mutakin</p>
                    <p>NIM. 10112001</p>
                </div>
                <div>
                    <p>Subang, {{ date('d F Y') }}</p>
                    <p class="font-bold">Dosen Pembimbing / Wali</p>
                    <div class="h-20"></div>
                    <p class="font-bold underline">Rahmat Irsyada, M.Pd. / Usep Abdul Rosid, M.Kom.</p>
                    <p>D-III Sistem Informasi POLSUB</p>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
