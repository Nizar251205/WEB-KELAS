# 🎓 Sistem Informasi Struktur Kelas SI2A - Politeknik Negeri Subang

Aplikasi web sistem informasi struktur kelas modern yang dibangun menggunakan framework **Laravel** dan **Tailwind CSS**. Sistem ini direvisi dan disesuaikan **100% mengikuti rancangan dokumen Activity Diagram** Mata Kuliah Pemrograman Website [PSI3310].

Sistem ini dirancang secara khusus **berjalan tanpa dependensi database lokal (No-DB Architecture)** dengan penyimpanan berkas JSON (`storage/app/class_system_data.json`). Siapa pun yang meng-clone repository dari GitHub dapat langsung menjalankannya tanpa perlu menginstal atau mengkonfigurasi MySQL/database!

---

## 👥 Profil Pengembang & Dokumen

- **Mata Kuliah**: Pemrograman Website [PSI3310]
- **Program Studi**: D-III Sistem Informasi
- **Jurusan**: Jurusan Teknologi Informasi dan Komputer
- **Perguruan Tinggi**: Politeknik Negeri Subang (POLSUB) - 2026
- **Dosen Pengampu**:
  1. Rahmat Irsyada, M.Pd.
  2. Usep Abdul Rosid, M.Kom.
- **Kelompok 4 (Kelas SI2A)**:
  1. **Aakip Hasan Mutakin** – 10112001 (Ketua Kelas)
  2. **Aulia Putri Ramadhina** – 10112016 (Wakil Ketua Kelas)
  3. **Dealova Frazelia Setiawan** – 10112022 (Sekretaris)
  4. **Muhammad Nizar Zulhaqy** – 10112049 (Bendahara)

---

## 📋 Pemetaan Fitur Sesuai Activity Diagram

| No | Activity Diagram | Deskripsi & Implementasi Sistem | Rute / Halaman |
|---|---|---|---|
| **1** | **Diagram Login** *(Hal 2)* | Mahasiswa/Admin membuka web SI2A -> Form Login. Validasi: jika kolom kosong muncul *"Kolom wajib diisi"*, jika salah muncul *"Data login tidak valid"*, jika valid diarahkan ke Dashboard. | `/login` |
| **2** | **Diagram Dashboard** *(Hal 3)* | Mengambil data kelas & mahasiswa. Jika belum ada muncul *"Data belum tersedia"*. Jika ada, menghitung jumlah mahasiswa, pengurus, kelas, dan menampilkan **grafik komposisi gender** serta ringkasan profil. | `/` atau `/dashboard` |
| **3** | **Diagram Lihat Profil Kelas** *(Hal 4)* | Menampilkan nama kelas, prodi, jurusan, institusi, angkatan, dosen wali, dan deskripsi. Jika kosong muncul *"Profil kelas belum tersedia"*. | `/profil` |
| **4** | **Diagram Daftar Mahasiswa** *(Hal 5)* | Menampilkan tabel NIM, Nama, Kelas, Jabatan. Dilengkapi fitur **pencarian**. Jika kata kunci tidak cocok, muncul notifikasi *"Data mahasiswa tidak ditemukan"*. | `/mahasiswa` |
| **5** | **Diagram Lihat Detail Mahasiswa** *(Hal 6)* | Menampilkan NIM, Nama, Kelas, Jabatan, Email, dan No HP mahasiswa terpilih. Terdapat tombol "Kembali" ke daftar mahasiswa. | `/mahasiswa/detail/{id}` |
| **6** | **Diagram Struktur Kelas** *(Hal 7)* | Menampilkan bagan hierarki Dosen Wali, Ketua Kelas, Wakil, Sekretaris, Bendahara, dan Anggota. Posisi kosong berstatus *"Belum ditentukan"*. | `/struktur-kelas` |
| **7** | **Diagram Kelola Profil Kelas** *(Hal 8)* | Khusus Admin: Menambah, mengubah, dan menghapus profil kelas dengan dialog konfirmasi serta pesan notifikasi keberhasilan. | `/profil` |
| **8** | **Diagram Kelola Data Mahasiswa** *(Hal 9)* | Khusus Admin: Tambah, edit, dan hapus data mahasiswa dengan modal interaktif serta notifikasi *"Data berhasil disimpan"*. | `/mahasiswa` |
| **9** | **Diagram Atur Jabatan Pengurus** *(Hal 10)* | Khusus Admin: Tombol "Atur Jabatan". Sistem mengecek: jika jabatan tunggal (Ketua, Wakil, Sekretaris, Bendahara) sudah dipegang orang lain, sistem menolak dengan pesan *"Pilih Jabatan Lain!"*. Jika belum, jabatan diperbarui. | `/struktur-kelas` |
| **10** | **Diagram Generate Laporan** *(Hal 11-12)* | Khusus Admin: Pilihan jenis laporan (Data Mahasiswa / Profil Kelas) & filter jabatan. Pratinjau tabel, jika kosong muncul *"tidak ada data untuk dilaporkan"*. Dilengkapi 3 tombol: **Cetak**, **Export PDF**, dan **Export Excel (.csv)**. | `/laporan` |

---

## 🔑 Akun Demo untuk Pengujian Sistem

| Role | Username / Email / NIM | Password | Hak Akses |
|---|---|---|---|
| **Admin** | `admin` atau `admin@polsub.ac.id` | `admin123` | Akses penuh: Kelola Profil, Kelola Data Mahasiswa, Atur Jabatan, Generate Laporan |
| **Mahasiswa** | `10112001` atau `mahasiswa@polsub.ac.id` | `12345678` | Lihat Dashboard, Profil Kelas, Daftar Mahasiswa + Cari + Detail, Struktur Kelas |

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

*(Catatan: Anda **TIDAK PERLU** menjalankan MySQL, XAMPP, atau `php artisan migrate` karena sistem berjalan pada arsitektur No-DB JSON Store).*

---

## 📤 Cara Push Pembaruan ke GitHub

Semua pembaruan telah di-commit ke Git lokal. Untuk mengirimkannya ke repositori GitHub:

```bash
cd "C:\Users\khaik\.gemini\antigravity\scratch\web-kelas"

# Hubungkan ke repository GitHub Anda (jika belum):
git remote add origin https://github.com/USERNAME_ANDA/NAMA_REPO_ANDA.git

# Pastikan branch main:
git branch -M main

# Unggah perubahan:
git push -u origin main
```
