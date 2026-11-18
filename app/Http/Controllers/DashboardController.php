<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassDataService;

class DashboardController extends Controller
{
    /**
     * Tampilkan Halaman Dashboard
     */
    public function index()
    {
        $profile = ClassDataService::getProfile();
        $students = ClassDataService::getStudents();

        $dataAvailable = !empty($students) || !empty($profile);

        // Hitung jumlah mahasiswa
        $totalMahasiswa = count($students);

        // Hitung jumlah pengurus (selain 'Anggota')
        $officers = array_filter($students, function ($s) {
            return !in_array($s['jabatan'] ?? '', ['Anggota', '', null]);
        });
        $totalPengurus = count($officers);

        // Jumlah kelas aktif
        $totalKelas = !empty($profile['nama_kelas']) ? 1 : 0;

        // Komposisi Gender
        $maleCount = 0;
        $femaleCount = 0;
        foreach ($students as $s) {
            $gender = $s['gender'] ?? 'Laki-laki';
            if ($gender === 'Laki-laki') {
                $maleCount++;
            } else {
                $femaleCount++;
            }
        }

        $malePercent = $totalMahasiswa > 0 ? round(($maleCount / $totalMahasiswa) * 100, 1) : 0;
        $femalePercent = $totalMahasiswa > 0 ? round(($femaleCount / $totalMahasiswa) * 100, 1) : 0;

        return view('dashboard', [
            'dataAvailable' => $dataAvailable,
            'totalMahasiswa' => $totalMahasiswa,
            'totalPengurus' => $totalPengurus,
            'totalKelas' => $totalKelas,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
            'malePercent' => $malePercent,
            'femalePercent' => $femalePercent,
            'profile' => $profile,
            'officers' => array_values($officers),
            'recentStudents' => array_slice($students, 0, 5)
        ]);
    }
}
