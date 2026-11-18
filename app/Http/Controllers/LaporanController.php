<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassDataService;

class LaporanController extends Controller
{
    /**
     * Tampilkan Halaman Generate Laporan & Pratinjau (Activity Diagram Page 11 & 12)
     */
    public function index(Request $request)
    {
        $jenisLaporan = $request->query('jenis', 'mahasiswa'); // 'profil' atau 'mahasiswa'
        $filterJabatan = $request->query('jabatan', 'semua');

        $profile = ClassDataService::getProfile();
        $allStudents = ClassDataService::getStudents();

        $reportData = [];
        $dataFound = false;

        if ($jenisLaporan === 'profil') {
            if (!empty($profile)) {
                $reportData = [$profile];
                $dataFound = true;
            }
        } else {
            // Laporan Data Mahasiswa
            $reportData = $allStudents;

            if ($filterJabatan && $filterJabatan !== 'semua') {
                if ($filterJabatan === 'pengurus') {
                    $reportData = array_filter($reportData, function ($s) {
                        return !in_array($s['jabatan'], ['Anggota', '', null]);
                    });
                } else {
                    $reportData = array_filter($reportData, function ($s) use ($filterJabatan) {
                        return strtolower($s['jabatan']) === strtolower($filterJabatan);
                    });
                }
            }

            $reportData = array_values($reportData);
            $dataFound = !empty($reportData);
        }

        return view('laporan.index', [
            'jenisLaporan' => $jenisLaporan,
            'filterJabatan' => $filterJabatan,
            'profile' => $profile,
            'reportData' => $reportData,
            'dataFound' => $dataFound
        ]);
    }

    /**
     * Export Excel / CSV (Activity Diagram: Export Excel)
     */
    public function exportExcel(Request $request)
    {
        $jenisLaporan = $request->query('jenis', 'mahasiswa');
        $filterJabatan = $request->query('jabatan', 'semua');

        $filename = "laporan_{$jenisLaporan}_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($jenisLaporan, $filterJabatan) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM

            if ($jenisLaporan === 'profil') {
                $p = ClassDataService::getProfile();
                fputcsv($handle, ['PARAMETER', 'INFORMASI KELAS']);
                fputcsv($handle, ['Nama Kelas', $p['nama_kelas'] ?? '-']);
                fputcsv($handle, ['Program Studi', $p['prodi'] ?? '-']);
                fputcsv($handle, ['Jurusan', $p['jurusan'] ?? '-']);
                fputcsv($handle, ['Institusi / Kampus', $p['institusi'] ?? '-']);
                fputcsv($handle, ['Tahun Angkatan', $p['angkatan'] ?? '-']);
                fputcsv($handle, ['Mata Kuliah', $p['mata_kuliah'] ?? '-']);
                fputcsv($handle, ['Dosen Wali', $p['dosen_wali'] ?? '-']);
                fputcsv($handle, ['Deskripsi', $p['deskripsi'] ?? '-']);
            } else {
                $students = ClassDataService::getStudents();
                if ($filterJabatan && $filterJabatan !== 'semua') {
                    if ($filterJabatan === 'pengurus') {
                        $students = array_filter($students, function ($s) {
                            return !in_array($s['jabatan'], ['Anggota', '', null]);
                        });
                    } else {
                        $students = array_filter($students, function ($s) use ($filterJabatan) {
                            return strtolower($s['jabatan']) === strtolower($filterJabatan);
                        });
                    }
                }

                fputcsv($handle, ['NO', 'NIM', 'NAMA MAHASISWA', 'KELAS', 'JABATAN', 'JENIS KELAMIN', 'EMAIL', 'NO HP']);
                $no = 1;
                foreach ($students as $s) {
                    fputcsv($handle, [
                        $no++,
                        $s['nim'],
                        $s['nama'],
                        $s['kelas'],
                        $s['jabatan'],
                        $s['gender'] ?? 'Laki-laki',
                        $s['email'],
                        $s['no_hp']
                    ]);
                }
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
