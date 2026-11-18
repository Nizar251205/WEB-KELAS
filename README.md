# 🎓 Web Portal & Profil Kelas (Laravel)

Sistem Web Kelas modern, informatif, dan responsif yang dibangun menggunakan framework **Laravel** dan **Tailwind CSS**. 

Website ini dirancang secara khusus **tanpa memerlukan database** (semua data kelas tersimpan terstruktur di konfigurasi aplikasi `config/classdata.php`), sehingga sangat ringan, aman, dan siap untuk langsung di-push dan di-migrasi melalui **GitHub**. Siapa pun yang meng-clone repository ini dapat langsung menjalankannya tanpa perlu menginstal atau mengatur database MySQL/PostgreSQL terlebih dahulu.

---

## 🌟 Fitur Utama

1. **Dashboard Kelas (`/` atau `/dashboard`)**
   - **Kartu Statistik Ringkas**: Total siswa, kas kelas terkumpul, persentase kehadiran, dan jumlah piagam prestasi.
   - **Pengumuman & Agenda Kelas**: Informasi penting seperti jadwal ujian, kerja bakti/gotong royong, dan info iuran kas.
   - **Jadwal Pelajaran Harian**: Jadwal mata pelajaran lengkap dengan waktu, guru pengampu, ruangan, dan badge kategori (Praktikum/Teori).
   - **Jadwal Piket Kebersihan Harian**: Pembagian jadwal piket siswa dari Senin hingga Jumat.
   - **Spotlight Wali Kelas & Pimpinan Kelas**: Informasi sekilas mengenai wali kelas, ketua kelas, dan wakil ketua kelas.
   - **Quote Pekan Ini**: Kalimat motivasi mingguan untuk para siswa.

2. **Profil Kelas (`/profile`)**
   - **Identitas & Slogan Kelas**: Nama kelas, sekolah, angkatan, tahun ajaran, ruang kelas, motto, dan slogan.
   - **Tentang Kelas**: Deskripsi dan filosofi kelas.
   - **Visi & Misi Kelas**: Komitmen dan arah tujuan kelas secara terstruktur.
   - **Demografi Siswa**: Statistik perbandingan rasio siswa laki-laki dan perempuan.
   - **Fasilitas Ruang Kelas**: Sarana belajar pendukung (Smart Screen, Dedicated Wi-Fi, AC, Pojok Literasi, Charging Hub).
   - **Prestasi & Penghargaan**: Daftar piala dan kejuaraan yang pernah diraih.
   - **Profil Lengkap Wali Kelas**: Informasi NIP, pesan pembimbing, dan kontak email resmi.

3. **Struktur Organisasi & Jabatan (`/jabatan`)**
   - **Hierarki Kepengurusan Visual**:
     - **Level 1**: Pembimbing / Wali Kelas.
     - **Level 2**: Pimpinan Inti (Ketua Kelas & Wakil Ketua Kelas) lengkap dengan bio, motto, dan kontak.
     - **Level 3**: Badan Pengurus Harian (BPH) — Sekretaris 1, Sekretaris 2, Bendahara 1, Bendahara 2.
     - **Level 4**: Seksi-seksi Bidang (Kebersihan & Lingkungan, Keamanan & Kedisiplinan, Kerohanian, Humas & Publikasi, serta Olahraga & Seni) lengkap dengan koordinator, anggota tim, dan rincian tugas (tupoksi).

---

## ⚙️ Kustomisasi Data Tanpa Database

Seluruh konten data kelas (nama murid, pengurus, wali kelas, pengumuman, jadwal pelajaran, dsb.) tersimpan rapi pada file:
```
config/classdata.php
```
Anda dapat dengan mudah mengubah nama kelas, data siswa, foto, nomor kontak, jadwal, atau visi & misi hanya dengan mengedit array di dalam file tersebut tanpa perlu menyentuh file HTML/Blade maupun query SQL.

---

## 🚀 Cara Menjalankan Proyek Secara Lokal

### Prasyarat:
- PHP >= 8.0
- Composer

### Langkah-langkah:
1. **Clone repository ini** (jika dari GitHub):
   ```bash
   git clone <URL_REPOSITORY_ANDA>
   cd web-kelas
   ```

2. **Install dependensi Composer**:
   ```bash
   composer install
   ```

3. **Salin file environment**:
   ```bash
   # Di Windows (Command Prompt / PowerShell):
   copy .env.example .env
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Jalankan server pengembangan**:
   ```bash
   php artisan serve
   ```

6. **Buka di browser**:
   Akses `http://127.0.0.1:8000` di browser favorit Anda.

*(Catatan: Anda **TIDAK** perlu menjalankan `php artisan migrate` karena sistem ini berjalan sepenuhnya tanpa dependensi database).*

---

## 📤 Cara Push Proyek Ini ke GitHub

Jika Anda ingin mengunggah proyek ini ke repository GitHub Anda:

```bash
# 1. Buka folder proyek di terminal
cd "C:\Users\khaik\.gemini\antigravity\scratch\web-kelas"

# 2. Inisialisasi Git (jika belum)
git init

# 3. Tambahkan semua file ke staging
git add .

# 4. Buat commit pertama
git commit -m "feat: inisialisasi web kelas profil, dashboard, dan struktur jabatan tanpa database"

# 5. Ubah branch default ke main
git branch -M main

# 6. Hubungkan ke repository GitHub Anda (ganti URL di bawah dengan URL repo Anda di GitHub)
git remote add origin https://github.com/USERNAME_ANDA/NAMA_REPO_ANDA.git

# 7. Push kode ke GitHub
git push -u origin main
```

---

## 📁 Struktur File Penting

- `config/classdata.php` : Pusat data statis profil, dashboard, jadwal, dan pengurus kelas.
- `app/Http/Controllers/ClassController.php` : Controller pengendali halaman Dashboard, Profil, dan Jabatan.
- `routes/web.php` : Rute navigasi halaman.
- `resources/views/layouts/app.blade.php` : Master layout utama (Navbar responsif & Footer).
- `resources/views/dashboard.blade.php` : Tampilan Dashboard Kelas.
- `resources/views/profile.blade.php` : Tampilan Profil Lengkap Kelas.
- `resources/views/jabatan.blade.php` : Tampilan Struktur Organisasi & Jabatan.
