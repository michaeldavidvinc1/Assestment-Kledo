# Assestment Kledo

## Instalasi

1. Clone repositori ini: git clone https://github.com/michaeldavidvinc1/Assestment-Kledo
2. Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database
3. Instal dependencies menggunakan Composer: Composer Install
4. Generate kunci aplikasi: php artisan generate:key
5. Jalankan migrasi database: php artisan migrate
6. Jalankan server: php artisan serve

## Struktur Direktori
- `app`: Berisi file-file aplikasi Laravel.
- `config`: Konfigurasi aplikasi.
- `database`: Migrasi dan *seeder* database.
- `public`: File publik, seperti gambar dan JavaScript.
- `resources`: File-file sumber daya, seperti *views* dan *assets*.
- `routes`: Definisi rute aplikasi.
- `storage`: File yang dihasilkan oleh aplikasi.
- `tests`: Test aplikasi.
- `vendor`: Dependencies dari Composer.
- `README.md`: Dokumentasi proyek.

  NOTE:
  1. Jika ingin menggunakan database yang sudah ada silahkan merubah nama value di .env->DB_DATABASE=assestment_kledo
  2. Lalu untuk menjalankan PHPUnit testing nya jalankan perintah berikut:
     - php artisan test tests/Feature/ApproverTest.php
     - php artisan test tests/Feature/ApproverStageTest.php
     - php artisan test tests/Feature/ExpenseTest.php
     - php artisan test tests/Feature/ApprovalTest.php
