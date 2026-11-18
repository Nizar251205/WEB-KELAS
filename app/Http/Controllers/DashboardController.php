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

        if (!$dataAvailable) {
            return view('dashboard', [
                'dataAvailable' => false,
                'totalMahasiswa' => 0,
                'totalPengurus' => 0,
                'totalKelas' => 0,
                'maleCount' => 0,
                'femaleCount' => 0,
                'malePercent' => 0,
                'femalePercent' => 0,
                'profile' => null,
                'officers' => [],
                'recentStudents' => []
            ]);
        }

        // Hitung jumlah mahasiswa
        $totalMahasiswa = count($students);

        // Hitung jumlah pengurus (selain 'Anggota')
        $officers = array_filter($students, function ($s) {
            return !in_array($s['jabatan'], ['Anggota', '', null]);
        });
        $totalPengurus = count($officers);

        // Jumlah kelas
        $totalKelas = 1;

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
            'dataAvailable' => true,
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
