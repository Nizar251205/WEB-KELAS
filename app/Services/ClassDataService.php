<?php

namespace App\Services;

class ClassDataService
{
    protected static $filePath;

    public static function getFilePath()
    {
        if (!self::$filePath) {
            self::$filePath = storage_path('app/class_system_data.json');
        }
        return self::$filePath;
    }

    public static function getDefaultData()
    {
        return [
            'profile' => [
                'nama_kelas' => 'Sistem Informasi 2A',
                'prodi' => 'D-III Sistem Informasi',
                'jurusan' => 'Jurusan Teknologi Informasi dan Komputer',
                'institusi' => 'Politeknik Negeri Subang',
                'angkatan' => '2026',
                'mata_kuliah' => 'Pemrograman Website [PSI3310]',
                'dosen_wali' => 'Rahmat Irsyada, M.Pd. & Usep Abdul Rosid, M.Kom.',
                'deskripsi' => 'Kelas Sistem Informasi 2A (SI2A) merupakan wadah pembelajaran kolaboratif Program Studi D-III Sistem Informasi, Jurusan Teknologi Informasi dan Komputer di Politeknik Negeri Subang. Berfokus pada pengembangan rekayasa web, teknologi basis data, dan kepemimpinan organisasi digital.',
                'kelompok' => 'Kelompok 4'
            ],
            // Data awal dibuat minimal (hanya anggota inisiator) dan beberapa posisi jabatan sengaja dibiarkan "Belum ditentukan"
            // agar pengguna/dosen dapat langsung menguji fitur Atur Jabatan & Tambah Mahasiswa
            'mahasiswa' => [
                [
                    'id' => 1,
                    'nim' => '10112001',
                    'nama' => 'Aakip Hasan Mutakin',
                    'kelas' => 'Sistem Informasi 2A',
                    'jabatan' => 'Ketua Kelas',
                    'email' => 'aakip.10112001@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7801',
                    'gender' => 'Laki-laki'
                ],
                [
                    'id' => 2,
                    'nim' => '10112016',
                    'nama' => 'Aulia Putri Ramadhina',
                    'kelas' => 'Sistem Informasi 2A',
                    'jabatan' => 'Anggota',
                    'email' => 'aulia.10112016@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7802',
                    'gender' => 'Perempuan'
                ],
                [
                    'id' => 3,
                    'nim' => '10112022',
                    'nama' => 'Dealova Frazelia Setiawan',
                    'kelas' => 'Sistem Informasi 2A',
                    'jabatan' => 'Anggota',
                    'email' => 'dealova.10112022@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7803',
                    'gender' => 'Perempuan'
                ],
                [
                    'id' => 4,
                    'nim' => '10112049',
                    'nama' => 'Muhammad Nizar Zulhaqy',
                    'kelas' => 'Sistem Informasi 2A',
                    'jabatan' => 'Anggota',
                    'email' => 'nizar.10112049@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7804',
                    'gender' => 'Laki-laki'
                ]
            ]
        ];
    }

    public static function loadData()
    {
        $path = self::getFilePath();
        if (!file_exists($path)) {
            $default = self::getDefaultData();
            self::saveData($default);
            return $default;
        }

        $content = file_get_contents($path);
        $data = json_decode($content, true);
        if (!$data || !is_array($data)) {
            $default = self::getDefaultData();
            self::saveData($default);
            return $default;
        }

        return $data;
    }

    public static function saveData(array $data)
    {
        $path = self::getFilePath();
        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    // --- PROFIL KELAS ---
    public static function getProfile()
    {
        $data = self::loadData();
        return $data['profile'] ?? null;
    }

    public static function updateProfile(array $newProfile)
    {
        $data = self::loadData();
        $data['profile'] = array_merge($data['profile'] ?? [], $newProfile);
        self::saveData($data);
        return $data['profile'];
    }

    public static function deleteProfile()
    {
        $data = self::loadData();
        $data['profile'] = null;
        self::saveData($data);
    }

    public static function resetProfile()
    {
        $data = self::loadData();
        $default = self::getDefaultData();
        $data['profile'] = $default['profile'];
        self::saveData($data);
        return $data['profile'];
    }

    // --- DATA MAHASISWA ---
    public static function getStudents($search = null)
    {
        $data = self::loadData();
        $students = $data['mahasiswa'] ?? [];

        if ($search) {
            $search = strtolower(trim($search));
            $students = array_values(array_filter($students, function ($s) use ($search) {
                return str_contains(strtolower($s['nama']), $search) ||
                       str_contains(strtolower($s['nim']), $search) ||
                       str_contains(strtolower($s['jabatan']), $search);
            }));
        }

        return $students;
    }

    public static function getStudentById($id)
    {
        $data = self::loadData();
        foreach ($data['mahasiswa'] as $s) {
            if ($s['id'] == $id) {
                return $s;
            }
        }
        return null;
    }

    public static function addStudent(array $fields)
    {
        $data = self::loadData();
        $newId = 1;
        if (!empty($data['mahasiswa'])) {
            $ids = array_column($data['mahasiswa'], 'id');
            $newId = max($ids) + 1;
        }

        $newStudent = [
            'id' => $newId,
            'nim' => trim($fields['nim'] ?? ''),
            'nama' => trim($fields['nama'] ?? ''),
            'kelas' => trim($fields['kelas'] ?? ($data['profile']['nama_kelas'] ?? 'Sistem Informasi 2A')),
            'jabatan' => trim($fields['jabatan'] ?? 'Anggota'),
            'email' => trim($fields['email'] ?? ''),
            'no_hp' => trim($fields['no_hp'] ?? ''),
            'gender' => trim($fields['gender'] ?? 'Laki-laki')
        ];

        $data['mahasiswa'][] = $newStudent;
        self::saveData($data);
        return $newStudent;
    }

    public static function updateStudent($id, array $fields)
    {
        $data = self::loadData();
        $found = false;
        foreach ($data['mahasiswa'] as &$s) {
            if ($s['id'] == $id) {
                $s['nim'] = trim($fields['nim'] ?? $s['nim']);
                $s['nama'] = trim($fields['nama'] ?? $s['nama']);
                $s['kelas'] = trim($fields['kelas'] ?? $s['kelas']);
                $s['jabatan'] = trim($fields['jabatan'] ?? $s['jabatan']);
                $s['email'] = trim($fields['email'] ?? $s['email']);
                $s['no_hp'] = trim($fields['no_hp'] ?? $s['no_hp']);
                if (isset($fields['gender'])) {
                    $s['gender'] = trim($fields['gender']);
                }
                $found = true;
                break;
            }
        }
        if ($found) {
            self::saveData($data);
            return true;
        }
        return false;
    }

    public static function deleteStudent($id)
    {
        $data = self::loadData();
        $initialCount = count($data['mahasiswa']);
        $data['mahasiswa'] = array_values(array_filter($data['mahasiswa'], function ($s) use ($id) {
            return $s['id'] != $id;
        }));

        if (count($data['mahasiswa']) !== $initialCount) {
            self::saveData($data);
            return true;
        }
        return false;
    }

    // --- ATUR JABATAN PENGURUS ---
    public static function assignRole($studentId, $newRole)
    {
        $data = self::loadData();
        $singleRoles = ['Ketua Kelas', 'Wakil Ketua Kelas', 'Sekretaris', 'Bendahara'];

        // Cek jika jabatan tunggal sudah dipegang orang lain
        if (in_array($newRole, $singleRoles)) {
            foreach ($data['mahasiswa'] as $s) {
                if ($s['jabatan'] === $newRole && $s['id'] != $studentId) {
                    return [
                        'success' => false,
                        'message' => "Pilih Jabatan Lain! Jabatan '{$newRole}' sudah dipegang oleh {$s['nama']}."
                    ];
                }
            }
        }

        // Update jabatan mahasiswa yang dipilih
        $updated = false;
        $studentName = '';
        foreach ($data['mahasiswa'] as &$s) {
            if ($s['id'] == $studentId) {
                $s['jabatan'] = $newRole;
                $studentName = $s['nama'];
                $updated = true;
                break;
            }
        }

        if ($updated) {
            self::saveData($data);
            return [
                'success' => true,
                'message' => "Jabatan {$newRole} berhasil diberikan kepada {$studentName}."
            ];
        }

        return [
            'success' => false,
            'message' => "Data mahasiswa tidak ditemukan."
        ];
    }

    // --- STRUKTUR JABATAN ORGANISASI ---
    public static function getStructure()
    {
        $data = self::loadData();
        $students = $data['mahasiswa'] ?? [];
        $profile = $data['profile'] ?? null;

        $roles = [
            'Dosen Wali' => $profile['dosen_wali'] ?? 'Belum ditentukan',
            'Ketua Kelas' => null,
            'Wakil Ketua Kelas' => null,
            'Sekretaris' => null,
            'Bendahara' => null,
            'Anggota' => []
        ];

        foreach ($students as $s) {
            if ($s['jabatan'] === 'Ketua Kelas' && !$roles['Ketua Kelas']) {
                $roles['Ketua Kelas'] = $s;
            } elseif ($s['jabatan'] === 'Wakil Ketua Kelas' && !$roles['Wakil Ketua Kelas']) {
                $roles['Wakil Ketua Kelas'] = $s;
            } elseif ($s['jabatan'] === 'Sekretaris' && !$roles['Sekretaris']) {
                $roles['Sekretaris'] = $s;
            } elseif ($s['jabatan'] === 'Bendahara' && !$roles['Bendahara']) {
                $roles['Bendahara'] = $s;
            } else {
                $roles['Anggota'][] = $s;
            }
        }

        return $roles;
    }
}
