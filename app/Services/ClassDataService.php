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
                'nama_kelas' => 'SI2A',
                'prodi' => 'D-III Sistem Informasi',
                'jurusan' => 'Jurusan Teknologi Informasi dan Komputer',
                'institusi' => 'Politeknik Negeri Subang',
                'angkatan' => '2026',
                'mata_kuliah' => 'Pemrograman Website [PSI3310]',
                'dosen_wali' => 'Rahmat Irsyada, M.Pd. & Usep Abdul Rosid, M.Kom.',
                'deskripsi' => 'Kelas SI2A Program Studi D-III Sistem Informasi, Jurusan Teknologi Informasi dan Komputer, Politeknik Negeri Subang. Wadah pembelajaran kolaboratif yang fokus pada pengembangan sistem website modern berstandar industri.',
                'kelompok' => 'Kelompok 4'
            ],
            'mahasiswa' => [
                [
                    'id' => 1,
                    'nim' => '10112001',
                    'nama' => 'Aakip Hasan Mutakin',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Ketua Kelas',
                    'email' => 'aakip.10112001@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7801',
                    'gender' => 'Laki-laki'
                ],
                [
                    'id' => 2,
                    'nim' => '10112016',
                    'nama' => 'Aulia Putri Ramadhina',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Wakil Ketua Kelas',
                    'email' => 'aulia.10112016@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7802',
                    'gender' => 'Perempuan'
                ],
                [
                    'id' => 3,
                    'nim' => '10112022',
                    'nama' => 'Dealova Frazelia Setiawan',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Sekretaris',
                    'email' => 'dealova.10112022@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7803',
                    'gender' => 'Perempuan'
                ],
                [
                    'id' => 4,
                    'nim' => '10112049',
                    'nama' => 'Muhammad Nizar Zulhaqy',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Bendahara',
                    'email' => 'nizar.10112049@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7804',
                    'gender' => 'Laki-laki'
                ],
                [
                    'id' => 5,
                    'nim' => '10112005',
                    'nama' => 'Budi Santoso',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Anggota',
                    'email' => 'budi.10112005@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7805',
                    'gender' => 'Laki-laki'
                ],
                [
                    'id' => 6,
                    'nim' => '10112008',
                    'nama' => 'Citra Lestari',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Anggota',
                    'email' => 'citra.10112008@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7806',
                    'gender' => 'Perempuan'
                ],
                [
                    'id' => 7,
                    'nim' => '10112012',
                    'nama' => 'Dimas Pratama',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Anggota',
                    'email' => 'dimas.10112012@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7807',
                    'gender' => 'Laki-laki'
                ],
                [
                    'id' => 8,
                    'nim' => '10112018',
                    'nama' => 'Farhan Kurniawan',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Anggota',
                    'email' => 'farhan.10112018@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7808',
                    'gender' => 'Laki-laki'
                ],
                [
                    'id' => 9,
                    'nim' => '10112025',
                    'nama' => 'Gita Gutawa',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Anggota',
                    'email' => 'gita.10112025@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7809',
                    'gender' => 'Perempuan'
                ],
                [
                    'id' => 10,
                    'nim' => '10112030',
                    'nama' => 'Indah Permatasari',
                    'kelas' => 'SI2A',
                    'jabatan' => 'Anggota',
                    'email' => 'indah.10112030@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7810',
                    'gender' => 'Perempuan'
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

    // --- MAHASISWA ---
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
            'kelas' => trim($fields['kelas'] ?? ($data['profile']['nama_kelas'] ?? 'SI2A')),
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

        // Cek apakah jabatan tunggal sudah dipegang orang lain
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

    // --- STRUKTUR JABATAN ---
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
