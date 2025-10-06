# [QUERY BIAYA]

### Analisis Data Biaya (PHP PDO & Bootstrap)

Proyek web sederhana ini dibuat untuk menganalisis data transaksi (KartuPesanan & RincianBiaya) melalui 8 *query* SQL yang kompleks. Dibangun menggunakan PHP PDO untuk koneksi aman dan Bootstrap 5 untuk tampilan.

---

## 🚀 FITUR INTI

-   **8 Query Analisis:** Menampilkan hasil agregasi biaya, kalkulasi per unit, dan filter data (Q1-Q8).
-   **Tampilan Data Awal:** Menunjukkan 5 baris pertama dari tabel utama (`KartuPesanan`, `RincianBiaya`) sebagai konteks.
-   **Aksi Dinamis:** Tombol **Detail** (universal) dan **Edit/Delete** (hanya aktif pada data transaksional).

---

## 📸 SCREENSHOT
proyek-query-biaya/pic/Screenshot 2025-10-06 151657.png

---

## ⚙️ CARA JALANIN (XAMPP)

1.  **Clone Repo:** Tarik proyek ini ke folder `htdocs` Anda.
2.  **Setup DB:** Buat database, lalu buat tabel `KartuPesanan` dan `RincianBiaya` di phpMyAdmin (pastikan sudah ada datanya).
3.  **Cek Koneksi:** Pastikan `koneksi.php` sudah disesuaikan dengan nama database dan kredensial XAMPP Anda.
4.  **Akses:** Buka `http://localhost/[FOLDER_ANDA]/tampilan.php`

---

## 🛠️ STACK

| | Teknologi |
| :--- | :--- |
| **Backend** | PHP (PDO) |
| **Database** | MySQL/MariaDB |
| **Frontend** | Bootstrap 5 |
