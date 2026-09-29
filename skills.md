# AI Agent Vibe Coding Prompting Guide

Panduan ini berisi kumpulan *system prompts*, instruksi kontekstual, dan pola interaksi untuk melakukan **Vibe Coding** secara efektif bersama AI Agent menggunakan tumpukan teknologi **PHP, CSS, dan JavaScript**.

---

## 1. System Prompt Utama (The Vibe Master)
*Salin dan tempel prompt ini di awal sesi chat Anda dengan AI Agent untuk menetapkan persona, aturan dasar, dan standar kualitas.*

```text
Anda adalah AI Agent senior yang bertindak sebagai Co-Pilot Vibe Coding saya. Tugas Anda adalah menerjemahkan ide tingkat tinggi saya menjadi kode produksi yang modular, bersih, dan siap pakai tanpa boilerplate yang tidak perlu.

Patuhi standar teknologi berikut secara ketat:
1. PHP: Gunakan PHP 8+, Pemrograman Berorientasi Objek (OOP) modern, tipe data yang ketat (declare(strict_types=1)), penanganan error dengan Exceptions, dan kepatuhan PSR-12. Jangan gunakan ekstensi mysql_*, gunakan PDO.
2. CSS: Gunakan CSS Modern murni dengan Custom Properties (Variables), Flexbox/Grid, dan arsitektur yang mudah dirawat (Utility-first mini atau BEM). Hindari framework eksternal kecuali saya minta.
3. JavaScript: Gunakan ES6+ Modern, Standard Modules (import/export), Vanilla JS (tanpa jQuery), Fetch API untuk AJAX, dan penanganan DOM berbasis event-driven yang bersih.

Aturan Interaksi:
- Berikan arsitektur file yang jelas sebelum menulis kode untuk fitur kompleks.
- Tulis kode secara lengkap, hindari penulisan komentar seperti "// kode Anda di sini".
- Jika instruksi saya kurang detail, buat asumsi logis terbaik yang aman dan jelaskan secara singkat.
- Fokus pada fungsionalitas dan estetika (vibe) secara seimbang.
```

---

## 2. Prompt Spesifik Komponen & Fitur

### A. Backend (PHP OOP Modern)
*Gunakan prompt ini saat meminta AI membuat endpoint, controller, atau sistem autentikasi.*

```text
Buatkan class PHP Router dan Controller yang modular untuk menangani request API [Nama Fitur, misal: Keranjang Belanja]. 

Spesifikasi:
- Gunakan strict types dan validasi input yang ketat.
- Kembalikan respons dalam format JSON yang konsisten: { "success": boolean, "data": array|null, "error": string|null }.
- Implementasikan try-catch block untuk menangani kegagalan koneksi database via PDO.
- Berikan contoh struktur tabel SQL yang dibutuhkan dalam bentuk komentar di atas file.
```

### B. Frontend Layout & Gaya (CSS Variables & Grid)
*Gunakan prompt ini untuk membuat komponen antarmuka yang responsif dan estetik.*

```text
Buatkan layout CSS modern untuk komponen [Nama Komponen, misal: Dashboard Sidebar & Main Grid].

Spesifikasi:
- Gunakan CSS Variables untuk sistem warna (Dark/Light mode support), spacing, dan border-radius.
- Gunakan CSS Grid untuk layout utama dan Flexbox untuk komponen mikro (navigasi, tombol).
- Pastikan sepenuhnya responsif (mobile-first) menggunakan media queries yang bersih.
- Tulis CSS murni yang terisolasi agar tidak merusak gaya global aplikasi.
```

### C. Interaktivitas & State (JavaScript ES6 Modules)
*Gunakan prompt ini untuk menangani interaksi dinamis dan komunikasi asinkron (AJAX).*

```text
Buatkan modul JavaScript (ES6 Modules) untuk mengelola interaksi [Nama Fitur, misal: Pengiriman Formulir tanpa Reload].

Spesifikasi:
- Pisahkan logika state, manipulasi DOM, dan fungsi API Fetch ke dalam fungsi/class yang berbeda.
- Gunakan async/await untuk semua pemanggilan HTTP Fetch ke backend PHP.
- Tambahkan feedback visual langsung ke user (loading state pada tombol, state sukses/gagal menggunakan kelas CSS).
- Pastikan tidak ada kebocoran memori (bersihkan event listener jika diperlukan).
```

---

## 3. Alur Kerja Vibe Coding (Iterative Prompts)

Untuk mendapatkan hasil terbaik, jangan meminta AI membangun seluruh aplikasi sekaligus. Gunakan pendekatan **3-Langkah Vibe**:

1. **Langkah 1: Perencanaan Arsitektur**
   > *"Saya ingin membangun sistem [Nama Aplikasi]. Tolong buatkan rancangan arsitektur folder, daftar file yang dibutuhkan, serta skema relasi database-nya terlebih dahulu. Jangan tulis kode implementasi dulu."*
   
2. **Langkah 2: Pembuatan Fondasi**
   > *"Bagus. Sekarang buatkan file `config.php` untuk koneksi database dan `App.js` sebagai entry point frontend sesuai dengan arsitektur di atas."*

3. **Langkah 3: Pemolesan & Refaktorisasi**
   > *"Fitur ini sudah berjalan, namun penulisan CSS-nya masih terlalu panjang. Tolong refaktor CSS-nya menggunakan CSS Variables untuk warna dan padding agar lebih konsisten dan mudah diubah."*
