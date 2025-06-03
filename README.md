# 🚀 Nama Proyek Laravel

Ini adalah proyek web berbasis Laravel. Proyek ini dibuat untuk Manajemen Obat.

## 📦 Fitur Utama
- ✅ CRUD data
- ✅ Export data ke PDF
- ✅ Cetak Thermal


## ⚙️ Teknologi yang Digunakan
- PHP >= 8.2.4
- Laravel ^10.x
- Composer
- MySQL 
- Node.js & NPM (jika menggunakan frontend assets)

---

## 🧩 Cara Instalasi

Ikuti langkah-langkah berikut setelah meng-clone repositori ini:

```bash
git clone https://github.com/username/nama-proyek.git
cd nama-proyek

Install dependency PHP
composer install

Install dependency frontend (jika digunakan)
npm install
npm run dev

Salin file .env dan konfigurasi
cp .env.example .env

isi databasenya
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=(password bisa menggunakan)

Generate aplikasi key
php artisan key:generate

Jalankan migrasi dan seeder
php artisan migrate --seed
atau
php artisan db:seed --class=AdminSeeder

jalankan projek
php artisan serve

Setelah menjalankan AdminSeeder, kamu bisa login dengan akun default berikut:
Email: admin@example.com
Password: admin123
