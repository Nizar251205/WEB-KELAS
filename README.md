# 🎓 Sistem Informasi Struktur Kelas SI2A - Politeknik Negeri Subang

Aplikasi web sistem informasi struktur kelas modern yang dibangun menggunakan framework **Laravel** dan **Tailwind CSS**. 

Sistem ini dirancang secara khusus **berjalan tanpa dependensi database lokal (No-DB Architecture)** menggunakan file data JSON terstruktur (`storage/app/class_system_data.json`). Siapa pun yang meng-clone repository ini dari GitHub dapat langsung menjalankannya tanpa perlu menginstal atau mengkonfigurasi MySQL/database!

---

## 👥 Profil Pengembang & Informasi Proyek

- **Kelas**: Pemrograman Website [PSI3310]
- **Program Studi**: D-III Sistem Informasi
- **Jurusan**: Jurusan Teknologi Informasi dan Komputer
- **Perguruan Tinggi**: Politeknik Negeri Subang (POLSUB) - Angkatan 2025
- **Dosen Pengampu**:
  1. Rahmat Irsyada, M.Pd.
  2. Usep Abdul Rosid, M.Kom.
- **Kelompok 4 (Kelas SI2A)**:
  1. **Aakip Hasan Mutakin** – 10112001 (Ketua Kelas)
  2. **Aulia Putri Ramadhina** – 10112016 (Wakil Ketua Kelas)
  3. **Dealova Frazelia Setiawan** – 10112022 (Sekretaris)
  4. **Muhammad Nizar Zulhaqy** – 10112049 (Bendahara)

---

## 📋 Fitur dan Modul Aplikasi

| No | Modul Sistem | Deskripsi & Implementasi Sistem | Rute / Halaman |
|---|---|---|---|
| **1** | **Autentikasi (Login)** | Form login untuk Mahasiswa & Admin. Dilengkapi validasi: jika input kosong muncul *"Kolom wajib diisi"*, jika kredensial salah muncul *"Data login tidak valid"*, dan jika berhasil diarahkan ke Dashboard. | `/login` |
| **2** | **Dashboard Kelas** | Menampilkan ringkasan statistik kelas: jumlah mahasiswa, total pengurus kelas, jumlah kelas, serta **grafik persentase komposisi mahasiswa (Laki-laki & Perempuan)** dan ringkasan identitas kelas. | `/` atau `/dashboard` |
| **3** | **Profil Kelas** | Menampilkan informasi Nama Kelas, Program Studi, Jurusan, Institusi, Angkatan, Dosen Wali, dan Deskripsi. Khusus Admin dapat mengelola (Tambah, Ubah, Hapus) data profil kelas. | `/profil` |
| **4** | **Data Mahasiswa & Pencarian** | Menampilkan tabel lengkap NIM, Nama, Kelas, dan Jabatan. Dilengkapi fitur pencarian real-time (dengan notifikasi *"Data mahasiswa tidak ditemukan"* jika hasil pencarian nihil). | `/mahasiswa` |
| **5** | **Detail Mahasiswa** | Menampilkan rincian data mahasiswa terpilih: NIM, Nama Lengkap, Kelas, Jabatan, Email, dan No HP, serta tombol kembali ke daftar. | `/mahasiswa/detail/{id}` |
| **6** | **Struktur Organisasi Kelas** | Menampilkan bagan hierarkis visual: Dosen Wali, Ketua Kelas, Wakil Ketua, Sekretaris, Bendahara, dan Anggota Kelas. Posisi kosong berstatus *"Belum ditentukan"*. | `/struktur-kelas` |
| **7** | **Manajemen Data Mahasiswa (Admin)** | Khusus Admin: Tambah, edit, dan hapus data mahasiswa melalui modal interaktif dengan pesan notifikasi *"Data berhasil disimpan"*. | `/mahasiswa` |
| **8** | **Atur Jabatan Pengurus (Admin)** | Khusus Admin: Menetapkan jabatan pengurus. Sistem memiliki validasi pencegah konflik: jika jabatan tunggal (Ketua, Wakil, Sekretaris, Bendahara) sudah diisi, sistem menampilkan notifikasi *"Pilih Jabatan Lain!"*. | `/struktur-kelas` |
| **9** | **Generate & Ekspor Laporan** | Khusus Admin: Pembuatan laporan dengan pilihan jenis laporan (Data Mahasiswa / Profil Kelas) & filter jabatan. Dilengkapi 3 tombol ekspor: **Cetak Dokumen**, **Export PDF**, dan **Export Excel (.csv)**. | `/laporan` |

---

## 🔑 Akun Admin

Username admin adalah `nizar`. Atur password melalui variabel lingkungan `NIZAR_PASSWORD` di file `.env` lokal atau sebagai secret pada platform deployment. Jangan masukkan password ke Git.

| Role | Username / Email / NIM | Password | Hak Akses |
|---|---|---|---|
| **Admin** | `nizar` | Diatur melalui `NIZAR_PASSWORD` | Akses penuh: Kelola Profil, Kelola Data Mahasiswa, Atur Jabatan, Generate Laporan |
| **Mahasiswa** | `10112001` atau `mahasiswa@polsub.ac.id` | `12345678` | Lihat Dashboard, Profil Kelas, Pencarian Mahasiswa, Detail Mahasiswa, Struktur Kelas |

---

## 🚀 Cara Menjalankan Proyek Secara Lokal

### Prasyarat:
- PHP >= 8.0
- Composer

### Langkah-langkah:
1. **Buka folder proyek**:
   ```bash
   cd "C:\Users\khaik\.gemini\antigravity\scratch\web-kelas"
   ```

2. **Jalankan server aplikasi**:
   ```bash
   php artisan serve
   ```

3. **Buka di browser**:
   Kunjungi `http://127.0.0.1:8000`.

*(Catatan: Anda **TIDAK PERLU** mengaktifkan MySQL, XAMPP, atau `php artisan migrate` karena sistem berjalan pada arsitektur No-DB).*

---

## 📤 Cara Push ke GitHub

Jika repositori GitHub Anda baru dibuat dan perlu disinkronkan:

```bash
cd "C:\Users\khaik\.gemini\antigravity\scratch\web-kelas"

# Push dengan opsi --force untuk menyinkronkan kode proyek ke GitHub:
git push -u origin main --force
```
