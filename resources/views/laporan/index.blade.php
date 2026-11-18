@extends('layouts.app')

@section('title', 'Generate Laporan Kelas SI2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section (no-print) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 no-print">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-100 text-brand-800">
                    Fitur Admin
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi SI2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                Generate Laporan Kelas
            </h1>
        </div>

        <!-- Tombol Aksi Ekspor (Activity Diagram: Cetak, Export PDF, Export Excel) -->
        @if($dataFound)
        <div class="flex items-center space-x-2">
            <!-- 1. Cetak Langsung via Browser -->
            <button type="button" onclick="window.print()" class="px-3.5 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-sm transition flex items-center space-x-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak</span>
            </button>

            <!-- 2. Export / Print to PDF -->
            <button type="button" onclick="window.print()" class="px-3.5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-sm transition flex items-center space-x-1.5">
                <i class="fa-solid fa-file-pdf"></i>
                <span>Export PDF</span>
            </button>

            <!-- 3. Export Excel / CSV -->
            <a href="{{ route('laporan.export.excel', ['jenis' => $jenisLaporan, 'jabatan' => $filterJabatan]) }}" class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-sm transition flex items-center space-x-1.5">
                <i class="fa-solid fa-file-excel"></i>
                <span>Export Excel</span>
            </a>
        </div>
        @endif
    </div>

    <!-- Filter Form (Activity Diagram Page 11: "Pilihan jenis laporan dan filter jabatan") (no-print) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 mb-8 no-print">
        <form action="{{ route('laporan.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
            
            <!-- Jenis Laporan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Pilih Jenis Laporan
                </label>
                <select name="jenis" onchange="this.form.submit()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-medium">
                    <option value="mahasiswa" {{ $jenisLaporan === 'mahasiswa' ? 'selected' : '' }}>Data Mahasiswa</option>
                    <option value="profil" {{ $jenisLaporan === 'profil' ? 'selected' : '' }}>Profil Kelas</option>
                </select>
            </div>

            <!-- Filter Jabatan (hanya aktif bila jenis == mahasiswa) -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Filter Jabatan
                </label>
                <select name="jabatan" {{ $jenisLaporan === 'profil' ? 'disabled' : '' }} onchange="this.form.submit()" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-medium disabled:bg-slate-100 disabled:text-slate-400">
                    <option value="semua" {{ $filterJabatan === 'semua' ? 'selected' : '' }}>Semua Jabatan</option>
                    <option value="pengurus" {{ $filterJabatan === 'pengurus' ? 'selected' : '' }}>Hanya Pengurus Inti</option>
                    <option value="Ketua Kelas" {{ $filterJabatan === 'Ketua Kelas' ? 'selected' : '' }}>Ketua Kelas</option>
                    <option value="Wakil Ketua Kelas" {{ $filterJabatan === 'Wakil Ketua Kelas' ? 'selected' : '' }}>Wakil Ketua Kelas</option>
                    <option value="Sekretaris" {{ $filterJabatan === 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                    <option value="Bendahara" {{ $filterJabatan === 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                    <option value="Anggota" {{ $filterJabatan === 'Anggota' ? 'selected' : '' }}>Anggota Saja</option>
                </select>
            </div>

            <div>
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow transition">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- KOP SURAT / HEADER CETAK KHUSUS PRINT LAPORAN -->
    <div class="hidden print:block mb-6 border-b-2 border-slate-900 pb-4 text-center">
        <h2 class="text-xl font-black uppercase tracking-wider">POLITEKNIK NEGERI SUBANG</h2>
        <h3 class="text-base font-bold uppercase">JURUSAN TEKNOLOGI INFORMASI DAN KOMPUTER</h3>
        <p class="text-xs">Program Studi D-III Sistem Informasi • Kelas SI2A • Mata Kuliah Pemrograman Website [PSI3310]</p>
        <p class="text-xs italic mt-1 font-semibold">Laporan Resmi {{ $jenisLaporan === 'profil' ? 'Profil Kelas' : 'Daftar & Struktur Mahasiswa' }} (Tahun 2026)</p>
    </div>

    <!-- PRATINJAU LAPORAN (Activity Diagram Page 11 & 12) -->
    @if(!$dataFound)
        <!-- Activity Diagram: Data ditemukan? Tidak -> Menampilkan pratinjau kosong dan pesan "tidak ada data untuk dilaporkan" -->
        <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center shadow-sm">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-3">
                <i class="fa-solid fa-file-circle-xmark"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Tidak ada data untuk dilaporkan</h3>
            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                Kriteria filter yang dipilih tidak menemukan data yang sesuai dalam basis data kelas.
            </p>
        </div>
    @else
        <!-- Activity Diagram: Data ditemukan? Ya -> Menampilkan pratinjau laporan dalam bentuk tabel -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden p-6 sm:p-8">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Pratinjau Laporan Tabel:</span>
                    <h2 class="text-lg font-bold text-slate-900">
                        {{ $jenisLaporan === 'profil' ? 'Laporan Profil Kelas SI2A' : 'Laporan Data & Struktur Mahasiswa' }}
                    </h2>
                </div>
                <span class="text-xs font-mono text-slate-400">Dicetak: {{ date('d F Y') }}</span>
            </div>

            @if($jenisLaporan === 'profil')
                <!-- Tabel Pratinjau Profil -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <tbody class="divide-y divide-slate-200">
                            <tr>
                                <th class="py-3 px-4 bg-slate-50 font-bold text-slate-600 w-1/3">Nama Kelas</th>
                                <td class="py-3 px-4 font-bold text-slate-900">{{ $profile['nama_kelas'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 px-4 bg-slate-50 font-bold text-slate-600">Program Studi</th>
                                <td class="py-3 px-4 text-slate-800">{{ $profile['prodi'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 px-4 bg-slate-50 font-bold text-slate-600">Jurusan</th>
                                <td class="py-3 px-4 text-slate-800">{{ $profile['jurusan'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 px-4 bg-slate-50 font-bold text-slate-600">Institusi / Perguruan Tinggi</th>
                                <td class="py-3 px-4 text-slate-800">{{ $profile['institusi'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 px-4 bg-slate-50 font-bold text-slate-600">Tahun Angkatan</th>
                                <td class="py-3 px-4 text-slate-800">{{ $profile['angkatan'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 px-4 bg-slate-50 font-bold text-slate-600">Dosen Pengampu / Wali</th>
                                <td class="py-3 px-4 font-bold text-brand-700">{{ $profile['dosen_wali'] ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="py-3 px-4 bg-slate-50 font-bold text-slate-600">Deskripsi</th>
                                <td class="py-3 px-4 text-slate-700 leading-relaxed">{{ $profile['deskripsi'] ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Tabel Pratinjau Mahasiswa -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100/80 text-slate-600 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200">
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
                            <tr class="hover:bg-slate-50">
                                <td class="py-2.5 px-4 text-center text-slate-400 font-mono">{{ $index + 1 }}</td>
                                <td class="py-2.5 px-4 font-mono font-bold text-slate-800">{{ $row['nim'] }}</td>
                                <td class="py-2.5 px-4 font-semibold text-slate-900">{{ $row['nama'] }}</td>
                                <td class="py-2.5 px-4 text-slate-600">{{ $row['kelas'] }}</td>
                                <td class="py-2.5 px-4 font-bold text-slate-700">{{ $row['jabatan'] }}</td>
                                <td class="py-2.5 px-4 text-slate-500">{{ $row['gender'] ?? 'Laki-laki' }}</td>
                                <td class="py-2.5 px-4 text-slate-600">{{ $row['email'] }}</td>
                                <td class="py-2.5 px-4 text-slate-600 font-mono">{{ $row['no_hp'] }}</td>
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
