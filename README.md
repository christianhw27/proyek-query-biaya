# QUERY BIAYA

### Analisis Data Biaya (PHP PDO & Bootstrap)

Proyek web sederhana ini dibuat untuk menganalisis data transaksi (KartuPesanan & RincianBiaya) melalui 8 *query* SQL yang kompleks. Dibangun menggunakan PHP PDO untuk koneksi aman dan Bootstrap 5 untuk tampilan.

---

## 🚀 FITUR INTI

-   **8 Query Analisis:** Menampilkan hasil agregasi biaya, kalkulasi per unit, dan filter data (Q1-Q8).
-   **Tampilan Data Awal:** Menunjukkan isi dari tabel utama (`KartuPesanan`, `RincianBiaya`) sebagai konteks.
-   **Aksi Dinamis:** Tombol **Detail** (universal) dan **Edit/Delete** (hanya aktif pada data transaksional).

---

## 📸 SCREENSHOT
![Alt Text](pic/Struktur.png)
![Alt Text](pic/1.png)
![Alt Text](pic/2.png)
![Alt Text](pic/3.png)
![Alt Text](pic/4.png)
![Alt Text](pic/5.png)

---
## ❓ Mengapa Q2, Q3, dan Q5 TIDAK BOLEH Memiliki Tombol Edit/Delete?
### Q2 - Total Biaya per Bulan
Jika Anda mengklik **Edit**, data apa yang akan diubah?  
Anda tidak bisa mengedit **total biaya** untuk bulan tertentu secara langsung.  
Untuk mengubahnya, Anda harus mengedit **transaksi asli** yang membentuk total biaya tersebut.

---
### Q3 - Total Biaya per Jenis Produk
Sama seperti Q2, Anda tidak bisa mengedit total biaya untuk **Jenis Produk** secara keseluruhan.  
Perubahan hanya bisa dilakukan pada **data transaksi** yang menjadi dasar perhitungan.

---

### Q5 - Statistik Biaya
Q5 menampilkan perhitungan berupa:  
- **Rata-rata**  
- **Minimum**  
- **Maksimum**  

Karena ini murni hasil **perhitungan otomatis**, maka data ini **tidak dapat diedit** secara manual.

---
### JADI 
Tombol Edit dan Delete hanya muncul pada query transaksional `(Q1, Q4, Q6, Q7, Q8)` karena query tersebut menyajikan data yang dapat dihubungkan kembali ke satu baris di tabel `KartuPesanan` menggunakan kunci unik `NomorPesanan`.

## ⚙️ Langkah-Langkah Menjalankan Proyek di XAMPP
Ikuti langkah-langkah ini secara berurutan untuk memastikan aplikasi berjalan dengan baik:

### Langkah 1: Persiapan Lingkungan
1.  **Nyalakan XAMPP:** Buka XAMPP Control Panel dan klik tombol **Start** untuk modul **Apache** dan **MySQL/MariaDB**. Pastikan keduanya berwarna hijau.
2.  **Buat Folder Proyek:**
      * Buka direktori instalasi XAMPP Anda (biasanya `C:\xampp`).
      * Masuk ke folder **`htdocs`**.
      * Di dalam `htdocs`, buat folder baru, misalnya **`aplikasi-biaya`**.
3.  **Tempatkan File:**
      * Salin semua file PHP yang sudah direvisi (`koneksi.php`, `tampilan.php`, `edit.php`, `detail.php`) ke dalam folder **`aplikasi-biaya`** ini.
      * Letakkan juga folder aset (jika ada *screenshot* atau CSS/JS terpisah) di sini.
        
### Langkah 2: Setup Database
1.  **Akses phpMyAdmin:** Buka *browser* Anda dan ketik alamat: `http://localhost/phpmyadmin`
2.  **Buat Database:** Klik **New** di sisi kiri dan buat database baru dengan nama yang Anda gunakan di `koneksi.php` (misalnya: **`db_proyek_biaya`**).
3.  **Buat Tabel:** Anda perlu membuat dua tabel utama yang digunakan aplikasi, yaitu **`KartuPesanan`** dan **`RincianBiaya`**, serta mengisi data sampel agar 8 *query* Anda bisa menampilkan hasil.

### Langkah 3: Konfigurasi Koneksi
1.  **Buka `koneksi.php`:** Buka file ini menggunakan *code editor* Anda.
2.  **Verifikasi Kredensial:** Pastikan nilai variabel koneksi Anda benar, terutama:
      * `$db = 'db_proyek_biaya';` (Harus sama dengan nama database yang Anda buat).
      * `$user = 'root';`
      * `$pass = '';` (Biarkan kosong jika Anda tidak pernah mengatur *password* root MySQL di XAMPP).

### Langkah 4: Menjalankan Aplikasi
1.  Buka *browser* Anda.
2.  Ketik alamat URL berikut:
    ```
    http://localhost/aplikasi-biaya/tampilan.php
    ```
Anda akan melihat halaman utama dengan tabel data mentah dan hasil dari ke-8 *query* analisis Anda, lengkap dengan kolom **ACTION**.

-----

## 📂 Fungsi Setiap File PHP

Proyek ini sangat terstruktur, di mana setiap file memiliki tanggung jawab tunggal:

| Nama File | Fungsi Utama | Keterangan |
| :--- | :--- | :--- |
| **`koneksi.php`** | **Koneksi Database** | Tugasnya hanya satu: membuat objek koneksi **PDO** (`$pdo`). Semua file lain menyertakan (`require_once`) file ini untuk bisa "berbicara" dengan database secara aman. |
| **`tampilan.php`** | **Dasbor & Analisis (Read)** | File utama yang: 1. Menampilkan tabel data mentah. 2. Mendefinisikan dan menjalankan ke-8 *query* analisis. 3. Mengambil hasil query dan menampilkannya dalam tabel Bootstrap. |
| **`detail.php`** | **Penampil Data Baris (Read Detail)** | Tugasnya hanya menampilkan data dari satu baris yang diklik (**universal**). File ini membaca data yang dikirim melalui URL (`$_GET`) dan menampilkannya dalam format kartu info yang ringkas. |
| **`edit.php`** | **Pengubah Data (Update)** | File yang menangani fungsionalitas **Edit**. Ia: 1. Mengambil data lama untuk mengisi *form*. 2. Menjalankan *query* **`UPDATE`** yang aman (menggunakan Prepared Statements) ketika *form* disubmit. |

---


