# ✅ To-Do List Proyek SPK Pemilihan Paud (CI 4 + PROMETHEE)

## 🟢 Tahap Awal (Setup & Persiapan)
- [x] Install CodeIgniter 4 via Composer
- [x] Buat database `spk_paud`
- [x] Atur koneksi database di `.env`
- [x] Buat migration: `paud`
- [ ] Buat migration: `kriteria`
- [ ] Buat migration: `nilai_kriteria`
- [ ] (Opsional) Buat migration: `users` (admin & user login)

---

## 🟠 Tampilan Admin

### 🔐 Autentikasi Admin
- [ ] Login admin
- [ ] Session login & proteksi halaman `/admin/*`

### 🏫 Manajemen Data
- [ ] CRUD Paud
- [ ] CRUD Kriteria + Bobot
- [ ] Input Nilai Paud per Kriteria

### 📊 Perhitungan
- [ ] Halaman proses perhitungan PROMETHEE dari sisi admin
- [ ] Lihat hasil ranking paud

---

## 🔵 Tampilan User (Orang Tua)
- [ ] Halaman Home (penjelasan SPK & tujuan)
- [ ] Form Pemilihan Kriteria (user bisa atur bobot preferensi)
- [ ] Proses perhitungan PROMETHEE dari input user
- [ ] Halaman Hasil Rekomendasi Paud

---

## 🟣 Fungsi PROMETHEE
- [ ] Script menghitung:
  - Leaving Flow
  - Entering Flow
  - Net Flow
- [ ] Urutkan hasil berdasarkan Net Flow tertinggi
- [ ] Tampilkan hasil ranking di tampilan user dan admin

---

## 🟤 Tampilan dan UI/UX
- [ ] Layout umum menggunakan Bootstrap (Navbar, Footer, dll)
- [ ] Layout admin dan user dipisah
- [ ] Flash messages (sukses/gagal input)
- [ ] Validasi input form

---

## 🟢 Tahap Akhir
- [ ] Uji coba dan validasi hasil ranking PROMETHEE
- [ ] Backup database dummy
- [ ] Dokumentasi proyek
- [ ] Siapkan file presentasi atau laporan skripsi
