<?php

return [
    'info' => [
        'name' => 'XII Rekayasa Perangkat Lunak 1',
        'code' => 'XII RPL 1',
        'school' => 'SMK Negeri 1 Surabaya',
        'academic_year' => '2026 / 2027',
        'generation' => 'Angkatan 32',
        'room' => 'Gedung B, Lantai 2, Ruang 204',
        'motto' => 'Solid, Kreatif, Berkarakter, dan Siap Berkarya',
        'slogan' => 'Code the Future, Lead the Change',
        'description' => 'XII RPL 1 adalah keluarga belajar yang berdedikasi menguasai rekayasa perangkat lunak modern. Kami menjunjung tinggi semangat kolaborasi, inovasi digital, sportivitas, dan solidaritas persaudaraan yang erat.',
        'homeroom_teacher' => [
            'name' => 'Dra. Hj. Siti Nurhaliza, M.Pd.',
            'nip' => '19820514 200801 2 015',
            'role' => 'Wali Kelas',
            'message' => 'Jadilah insan yang tidak hanya mahir dalam logika algoritma dan teknologi, tetapi juga memiliki budi pekerti yang santun, empati yang tulus, serta integritas moral yang kokoh.',
            'contact' => 'siti.nurhaliza@smkn1sby.sch.id',
            'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=400'
        ],
        'stats' => [
            'total_students' => 34,
            'male_students' => 16,
            'female_students' => 18,
            'total_officers' => 12,
            'achievements_count' => 8,
            'active_projects' => 5,
        ],
        'vision' => 'Menjadi kelas teladan yang unggul dalam penguasaan teknologi informasi dan komunikasi, berprestasi secara akademik dan non-akademik, serta berlandaskan nilai-nilai kejujuran dan persaudaraan.',
        'mission' => [
            'Menciptakan iklim pembelajaran yang disiplin, interaktif, inklusif, dan menyenangkan.',
            'Mendorong inovasi koding dan solusi digital yang bermanfaat bagi masyarakat.',
            'Mengembangkan potensi bakat setiap siswa baik di bidang akademik, olahraga, maupun seni.',
            'Memperkuat rasa kekeluargaan, kepedulian sosial, dan gotong royong antaranggota kelas.'
        ],
        'facilities' => [
            [
                'name' => 'Interactive Smart Screen',
                'desc' => 'Display sentuh 75 inci untuk pembelajaran koding interaktif dan review presentasi tugas.',
                'icon' => 'fa-tv'
            ],
            [
                'name' => 'High-Speed Dedicated Wi-Fi',
                'desc' => 'Jaringan fiber optik berkecepatan tinggi khusus untuk riset pengembangan software.',
                'icon' => 'fa-wifi'
            ],
            [
                'name' => 'Dual Inverter Air Conditioning',
                'desc' => 'Suhu ruangan tetap sejuk dan optimal sepanjang kegiatan belajar mengajar.',
                'icon' => 'fa-snowflake'
            ],
            [
                'name' => 'Tech Library & Book Nook',
                'desc' => 'Sudut baca referensi algoritma, dokumentasi bahasa pemrograman, dan buku motivasi.',
                'icon' => 'fa-book-open'
            ],
            [
                'name' => 'Charging Hub & Board Game Bar',
                'desc' => 'Stasiun pengisian daya laptop/gadget dan hiburan ice-breaking saat jam istirahat.',
                'icon' => 'fa-plug'
            ]
        ],
        'achievements' => [
            [
                'title' => 'Juara 1 Lomba Web Design Tingkat Provinsi',
                'year' => '2026',
                'category' => 'Teknologi & Koding',
                'badge' => 'Juara 1',
                'icon' => 'fa-trophy',
                'color' => 'text-amber-500'
            ],
            [
                'title' => 'Juara 1 Kebersihan & Kerapian Ruang Kelas',
                'year' => '2026',
                'category' => 'Kedisiplinan & Lingkungan',
                'badge' => 'Terbaik',
                'icon' => 'fa-medal',
                'color' => 'text-emerald-500'
            ],
            [
                'title' => 'Juara 2 Turnamen Futsal Dies Natalis Sekolah',
                'year' => '2026',
                'category' => 'Olahraga',
                'badge' => 'Juara 2',
                'icon' => 'fa-award',
                'color' => 'text-blue-500'
            ],
            [
                'title' => 'Juara Harapan 1 Cerdas Cermat Sains & IT',
                'year' => '2025',
                'category' => 'Akademik',
                'badge' => 'Harapan 1',
                'icon' => 'fa-star',
                'color' => 'text-purple-500'
            ]
        ]
    ],

    'dashboard' => [
        'quick_stats' => [
            [
                'label' => 'Total Siswa',
                'value' => '34 Siswa',
                'detail' => '16 Laki-laki • 18 Perempuan',
                'icon' => 'fa-users',
                'bg' => 'bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                'border' => 'border-blue-200 dark:border-blue-800'
            ],
            [
                'label' => 'Kas Kelas Terkumpul',
                'value' => 'Rp 1.450.000',
                'detail' => 'Update per November 2026',
                'icon' => 'fa-wallet',
                'bg' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400',
                'border' => 'border-emerald-200 dark:border-emerald-800'
            ],
            [
                'label' => 'Persentase Kehadiran',
                'value' => '98.5%',
                'detail' => 'Tertinggi di Tingkat XII',
                'icon' => 'fa-user-check',
                'bg' => 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400',
                'border' => 'border-indigo-200 dark:border-indigo-800'
            ],
            [
                'label' => 'Prestasi & Penghargaan',
                'value' => '8 Piagam',
                'detail' => 'Tingkat Sekolah & Wilayah',
                'icon' => 'fa-trophy',
                'bg' => 'bg-amber-50 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400',
                'border' => 'border-amber-200 dark:border-amber-800'
            ]
        ],
        'announcements' => [
            [
                'title' => 'Pelaksanaan Ujian Akhir Semester (UAS) Ganjil',
                'date' => '25 Nov 2026',
                'author' => 'Wali Kelas',
                'tag' => 'Penting',
                'tag_color' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300',
                'content' => 'Jadwal UAS telah dipublikasikan di mading sekolah. Pastikan seluruh berkas tugas praktikum web dan database diserahkan sebelum tanggal 22 November.'
            ],
            [
                'title' => 'Gotong Royong & Pembaruan Dekorasi Kelas',
                'date' => '21 Nov 2026',
                'author' => 'Seksi Kebersihan',
                'tag' => 'Kegiatan',
                'tag_color' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
                'content' => 'Akan diadakan kerja bakti bersama pada hari Jumat setelah jam sekolah untuk pengecatan ulang pojok literasi dan pembersihan filter pendingin ruangan.'
            ],
            [
                'title' => 'Iuran Kas Bulanan dan Tabungan Wisuda',
                'date' => '18 Nov 2026',
                'author' => 'Bendahara Kelas',
                'tag' => 'Keuangan',
                'tag_color' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300',
                'content' => 'Iuran wajib mingguan sebesar Rp 5.000 sudah dapat disetorkan kepada bendahara piket. Laporan transparansi kas dapat dilihat di papan pengumuman.'
            ]
        ],
        'today_schedule' => [
            [
                'time' => '07.00 - 08.30',
                'subject' => 'Pemrograman Web & Mobile',
                'teacher' => 'Hendra Setiawan, S.Kom',
                'room' => 'Lab Komputer 3',
                'badge' => 'Praktikum'
            ],
            [
                'time' => '08.30 - 10.00',
                'subject' => 'Arsitektur Basis Data Modern',
                'teacher' => 'Ratna Permata, M.Kom',
                'room' => 'Lab Komputer 3',
                'badge' => 'Praktikum'
            ],
            [
                'time' => '10.15 - 11.45',
                'subject' => 'Matematika Terapan & Diskrit',
                'teacher' => 'Drs. Joko Suwandi, M.Pd',
                'room' => 'Ruang 204',
                'badge' => 'Teori'
            ],
            [
                'time' => '12.30 - 14.00',
                'subject' => 'Bahasa Inggris Teknis IT',
                'teacher' => 'Amanda Wijayanti, S.Pd',
                'room' => 'Ruang 204',
                'badge' => 'Bahasa'
            ]
        ],
        'piket_schedule' => [
            'Senin' => ['Farhan Pratama', 'Alya Zahra', 'Dimas Anggara', 'Siti Rahma'],
            'Selasa' => ['Budi Santoso', 'Dewi Lestari', 'Rizky Fadilah', 'Nabila Putri'],
            'Rabu' => ['Ahmad Fauzi', 'Tiara Andini', 'Gita Gutawa', 'Hendra Wijaya'],
            'Kamis' => ['Ilham Maulana', 'Zahra Amelia', 'Fajar Ramadhan', 'Maya Safitri'],
            'Jumat' => ['Bayu Nugroho', 'Citra Kirana', 'Eko Prasetyo', 'Larasati']
        ],
        'quote_of_the_week' => [
            'text' => 'Bukan kecerdasan semata yang menentukan masa depan, melainkan konsistensi untuk belajar dan keikhlasan untuk saling tolong-menolong.',
            'author' => 'Tim Pengurus XII RPL 1'
        ]
    ],

    'officers' => [
        'main' => [
            [
                'position' => 'Ketua Kelas',
                'name' => 'Muhammad Rayhan Pratama',
                'nis' => '240101',
                'nickname' => 'Rayhan',
                'bio' => 'Bertanggung jawab mengoordinasikan seluruh dinamika kelas, menjadi perwakilan siswa saat berinteraksi dengan guru/sekolah, serta menjaga keharmonisan antarteman.',
                'motto' => 'Memimpin dengan teladan, melangkah dengan kebersamaan.',
                'avatar' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=400',
                'tag' => 'Pimpinan Utama',
                'instagram' => '@rayhan_pratama',
                'email' => 'rayhan.rpl@example.com'
            ],
            [
                'position' => 'Wakil Ketua Kelas',
                'name' => 'Nabila Az-Zahra',
                'nis' => '240102',
                'nickname' => 'Nabila',
                'bio' => 'Mendampingi ketua kelas dalam penyusunan agenda kegiatan, mengawasi kinerja seksi-seksi bidang, dan menggantikan peran ketua apabila berhalangan hadir.',
                'motto' => 'Konsisten dan tanggap dalam setiap tantangan.',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=400',
                'tag' => 'Pimpinan Pendamping',
                'instagram' => '@nabila_azzahra',
                'email' => 'nabila.rpl@example.com'
            ]
        ],
        'administration' => [
            [
                'position' => 'Sekretaris 1',
                'name' => 'Safira Maharani Putri',
                'nis' => '240103',
                'nickname' => 'Fira',
                'tasks' => 'Mencatat notulen rapat kelas, mengelola absensi harian, dan menyusun arsip dokumen kelas.',
                'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=300',
                'instagram' => '@safiramaharani'
            ],
            [
                'position' => 'Sekretaris 2',
                'name' => 'Aditya Wardhana',
                'nis' => '240104',
                'nickname' => 'Adit',
                'tasks' => 'Membantu pembuatan surat izin, mengelola mading informasi kelas, dan rekapitulasi data inventaris.',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=300',
                'instagram' => '@aditya_wardhana'
            ],
            [
                'position' => 'Bendahara 1',
                'name' => 'Aisyah Nurul Hikmah',
                'nis' => '240105',
                'nickname' => 'Aisyah',
                'tasks' => 'Menghimpun iuran kas mingguan, mencatat arus kas masuk-keluar, dan menyusun laporan transparansi.',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=300',
                'instagram' => '@aisyah_nurul'
            ],
            [
                'position' => 'Bendahara 2',
                'name' => 'Budi Setiawan',
                'nis' => '240106',
                'nickname' => 'Budi',
                'tasks' => 'Mengelola alokasi anggaran logistik, pembelian perlengkapan kelas, dan bukti nota pembelanjaan.',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=300',
                'instagram' => '@budisetiawan'
            ]
        ],
        'sections' => [
            [
                'section_name' => 'Seksi Kebersihan & Lingkungan Hidup',
                'icon' => 'fa-broom',
                'color' => 'emerald',
                'lead' => 'Dimas Prasetya Utomo',
                'members' => ['Larasati Dewi', 'Kevin Alamsyah'],
                'duties' => [
                    'Mengontrol pelaksanaan jadwal piket kebersihan setiap pagi dan pulang sekolah.',
                    'Memastikan ketersediaan alat kebersihan, tempat sampah terpilah, dan sabun cuci tangan.',
                    'Menjaga estetika tanaman hias dan penghijauan di lingkungan teras kelas.'
                ]
            ],
            [
                'section_name' => 'Seksi Keamanan & Kedisiplinan',
                'icon' => 'fa-shield-halved',
                'color' => 'blue',
                'lead' => 'Fajar Ramadhan',
                'members' => ['Rizky Firmansyah', 'Doni Wicaksono'],
                'duties' => [
                    'Menjaga ketenangan dan kondusifitas suasana kelas saat pergantian jam pelajaran.',
                    'Mengingatkan kedisiplinan pemakaian seragam dan kelengkapan atribut sekolah.',
                    'Memastikan pintu dan jendela terkunci dengan aman saat ruangan ditinggalkan.'
                ]
            ],
            [
                'section_name' => 'Seksi Kerohanian & Budi Pekerti',
                'icon' => 'fa-hands-praying',
                'color' => 'purple',
                'lead' => 'Ahmad Fauzi Ridwan',
                'members' => ['Siti Aminah', 'Christian Daniel'],
                'duties' => [
                    'Memimpin doa bersama di awal dan akhir jam pelajaran.',
                    'Mengoordinasikan kegiatan ibadah bersama dan peringatan hari besar keagamaan.',
                    'Menyelenggarakan aksi solidaritas dan penggalangan dana kemanusiaan bila ada siswa berduka/sakit.'
                ]
            ],
            [
                'section_name' => 'Seksi Humas, Publikasi & Dokumentasi',
                'icon' => 'fa-camera-retro',
                'color' => 'rose',
                'lead' => 'Farah Diba Azzahra',
                'members' => ['Gilang Pratama', 'Jessica Melinda'],
                'duties' => [
                    'Mendokumentasikan foto/video setiap momen berharga, perayaan, dan prestasi kelas.',
                    'Mengelola akun media sosial resmi kelas serta menyebarkan info lomba dan edaran sekolah.',
                    'Menjadi narahubung komunikasi antara kelas dengan pengurus OSIS/MPK.'
                ]
            ],
            [
                'section_name' => 'Seksi Olahraga, Seni & Bakat',
                'icon' => 'fa-volleyball',
                'color' => 'amber',
                'lead' => 'Bayu Nugroho Wicaksono',
                'members' => ['Citra Kirana', 'Alif Kurniawan'],
                'duties' => [
                    'Mengatur tim perwakilan kelas dalam ajang lomba Classmeeting olahraga dan seni.',
                    'Menyelenggarakan kegiatan olahraga sore bersama untuk menjaga kebugaran siswa.',
                    'Memfasilitasi pengembangan bakat minat siswa di bidang musik, desain grafis, dan tari.'
                ]
            ]
        ]
    ]
];
