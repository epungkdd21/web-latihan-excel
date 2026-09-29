# web-latihan-excel

## Menjalankan aplikasi

Gunakan PHP 8+ dengan ekstensi `pdo_sqlite` aktif, lalu jalankan server lokal dari direktori proyek:

```sh
php -S localhost:8000
```

Buka `http://localhost:8000`. Hasil kuis dan data JSON yang diimpor disimpan di `../web-latihan-excel-data/quiz.sqlite`, di luar document root. Direktori database dibuat otomatis. Pastikan PHP memiliki izin tulis ke direktori induk proyek, atau atur lokasi database dengan variabel lingkungan `EXCEL_QUIZ_DB` ke path yang dapat ditulis dan tidak berada di direktori publik.

Panel Admin menyediakan ringkasan skor, distribusi nilai dan tingkat, pencarian, filter, rincian jawaban, serta ekspor CSV. Daftar nilai dan impor JSON dilindungi sesi admin dengan cookie `HttpOnly`, `SameSite=Strict`, dan token CSRF. Password default disimpan sebagai hash di backend, bukan sebagai teks biasa.

Untuk mengganti kredensial saat deploy, atur `ADMIN_EMAIL` dan `ADMIN_PASSWORD_HASH` di environment server. Buat hash password dengan `php -r 'echo password_hash("password-baru", PASSWORD_DEFAULT), PHP_EOL;'`; jangan isi `ADMIN_PASSWORD_HASH` dengan password teks biasa. Gunakan HTTPS dan batasi akses jaringan untuk deployment publik.