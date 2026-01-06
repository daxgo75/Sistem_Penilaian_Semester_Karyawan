# 🚀 Panduan Setup Awal Sistem Penilaian Semester Karyawan

Dokumentasi lengkap untuk melakukan setup dan instalasi aplikasi **Sistem Penilaian Semester Karyawan** dari awal.

---

## 📋 Daftar Isi

-   [Prasyarat](#prasyarat)
-   [Clone Repository](#clone-repository)
-   [Instalasi Dependencies](#instalasi-dependencies)
-   [Konfigurasi Environment](#konfigurasi-environment)
-   [Setup Database](#setup-database)
-   [Generate Application Key](#generate-application-key)
-   [Menjalankan Aplikasi](#menjalankan-aplikasi)
-   [Testing Setup](#testing-setup)
-   [Troubleshooting](#troubleshooting)

---

## 💻 Prasyarat

Sebelum memulai, pastikan sudah menginstall tools berikut:

### 1. **PHP**

-   Versi minimum: **PHP 8.1** atau lebih tinggi
-   Download: [php.net](https://www.php.net/downloads)
-   Verifikasi:
    ```bash
    php --version
    ```

### 2. **Composer**

-   PHP package manager
-   Download: [getcomposer.org](https://getcomposer.org)
-   Verifikasi:
    ```bash
    composer --version
    ```

### 3. **Node.js & npm**

-   Versi minimum: Node.js 14.x atau lebih tinggi
-   Download: [nodejs.org](https://nodejs.org)
-   Verifikasi:
    ```bash
    node --version
    npm --version
    ```

### 4. **MySQL**

-   Versi minimum: MySQL 5.7 atau lebih tinggi
-   Download: [mysql.com](https://www.mysql.com/downloads)
-   Verifikasi:
    ```bash
    mysql --version
    ```

### 5. **Git**

-   Download: [git-scm.com](https://git-scm.com)
-   Verifikasi:
    ```bash
    git --version
    ```

### 6. **Code Editor** (Opsional)

-   Rekomendasi: Visual Studio Code, PHPStorm, atau Sublime Text
-   Download VS Code: [code.visualstudio.com](https://code.visualstudio.com)

---

## 📂 Clone Repository

### Langkah 1: Buka Terminal/Command Prompt

Navigasi ke folder dimana Anda ingin menyimpan project:

```bash
cd D:\laragon\www
# atau sesuaikan dengan path Anda
```

### Langkah 2: Clone Repository

```bash
git clone https://github.com/daxgo75/Sistem_Penilaian_Semester_Karyawan.git
```

### Langkah 3: Masuk ke Direktori Project

```bash
cd Sistem_Penilaian_Semester_Karyawan
```

### Langkah 4: Periksa Cabang (Branch)

```bash
git branch -a
# untuk melihat semua branch yang tersedia
```

---

## 📦 Instalasi Dependencies

### Langkah 1: Install PHP Dependencies dengan Composer

```bash
composer install
```

Proses ini akan:

-   Download semua package PHP yang diperlukan
-   Membuat folder `vendor/`
-   Generate autoload files

### Langkah 2: Install Frontend Dependencies dengan npm

```bash
npm install
```

Proses ini akan:

-   Download semua package Node.js yang diperlukan
-   Membuat folder `node_modules/`

### Langkah 3: Verifikasi Instalasi

Pastikan kedua perintah berhasil tanpa error.

---

## ⚙️ Konfigurasi Environment

### Langkah 1: Copy File Environment

Salin file `.env.example` menjadi `.env`:

```bash
# Windows (PowerShell)
Copy-Item .env.example .env

# atau Manual: copy file .env.example menjadi .env
```

### Langkah 2: Edit File .env

Buka file `.env` dengan text editor dan sesuaikan konfigurasi:

```env
APP_NAME=sistem-penilaian-semester-karyawan
APP_ENV=local
APP_KEY=base64:/fSNbJBhqgHRYlXaN+hIsJYJ03IcUg3aRug/sByGdLs=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# ⭐ KONFIGURASI DATABASE
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_penilaian_semester_karyawan
DB_USERNAME=root
DB_PASSWORD=

# Sesuaikan dengan MySQL Anda:
# DB_HOST: host MySQL (default: 127.0.0.1 atau localhost)
# DB_PORT: port MySQL (default: 3306)
# DB_USERNAME: username MySQL (default: root)
# DB_PASSWORD: password MySQL (kosongkan jika tidak ada password)

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=log
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Poin Penting:

-   **APP_KEY**: Akan di-generate otomatis pada langkah berikutnya
-   **DB_DATABASE**: Nama database yang akan dibuat di MySQL
-   **DB_USERNAME & DB_PASSWORD**: Sesuaikan dengan konfigurasi MySQL Anda

---

## 🗄️ Setup Database

### Langkah 1: Buat Database di MySQL

Pilih salah satu cara berikut:

#### Opsi A: Menggunakan Command Line

```bash
mysql -u root -p
# Masukkan password MySQL Anda (jika ada)
```

Kemudian jalankan command:

```sql
CREATE DATABASE sistem_penilaian_semester_karyawan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Opsi B: Menggunakan PhpMyAdmin

1. Buka `http://localhost/phpmyadmin`
2. Klik menu **"New"** atau **"Database"**
3. Masukkan nama: `sistem_penilaian_semester_karyawan`
4. Pilih charset: `utf8mb4`
5. Klik **"Create"**

### Langkah 2: Jalankan Migration

```bash
php artisan migrate
```

Perintah ini akan:

-   Membuat semua tabel yang diperlukan
-   Menjalankan database seeders (jika ada)

### Langkah 3: Jalankan Seeder (Opsional)

Untuk mengisi data dummy/default:

```bash
php artisan db:seed
```

---

## 🔑 Generate Application Key

Jalankan perintah berikut untuk generate APP_KEY:

```bash
php artisan key:generate
```

Perintah ini akan:

-   Generate encryption key otomatis
-   Update file `.env` dengan key yang baru

---

## 🏃 Menjalankan Aplikasi

### Langkah 1: Build Assets Frontend

Compile CSS dan JavaScript:

```bash
npm run build
```

Atau untuk development dengan watch mode:

```bash
npm run dev
```

### Langkah 2: Jalankan Development Server

Buka terminal baru dan jalankan:

```bash
php artisan serve
```

Aplikasi akan berjalan di:

-   **URL**: `http://localhost:8000`
-   **IP**: `http://127.0.0.1:8000`

### Langkah 3: Akses Aplikasi

Buka browser dan kunjungi:

```
http://localhost:8000
```

---

## 🧪 Testing Setup

### Jalankan Unit Tests

```bash
php artisan test
```

### Jalankan Specific Test

```bash
php artisan test tests/Feature/YourTestFile.php
```

---

## 📝 Struktur Project

```
Sistem_Penilaian_Semester_Karyawan/
├── app/                          # Kode aplikasi utama
│   ├── Console/                  # Artisan commands
│   ├── Exceptions/               # Exception handling
│   ├── Exports/                  # Excel export classes
│   ├── Http/
│   │   ├── Controllers/          # Route controllers
│   │   ├── Middleware/           # HTTP middleware
│   │   └── Requests/             # Form request validations
│   ├── Imports/                  # Excel import classes
│   ├── Models/                   # Eloquent models
│   ├── Providers/                # Service providers
│   └── View/                     # View components
├── bootstrap/                    # Framework bootstrap
├── config/                       # Konfigurasi aplikasi
├── database/
│   ├── factories/                # Model factories
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
├── public/                       # Publicly accessible files
│   └── images/                   # Image storage
├── resources/
│   ├── css/                      # Stylesheet
│   ├── js/                       # JavaScript files
│   └── views/                    # Blade templates
├── routes/                       # Route definitions
│   ├── web.php                   # Web routes
│   ├── api.php                   # API routes
│   └── ...
├── storage/                      # Generated files
│   ├── app/                      # Generated app files
│   ├── framework/                # Framework generated files
│   └── logs/                     # Application logs
├── tests/                        # Test files
│   ├── Feature/                  # Feature tests
│   └── Unit/                     # Unit tests
├── vendor/                       # Composer packages
├── .env                          # Environment variables
├── .env.example                  # Example env file
├── composer.json                 # Composer dependencies
├── package.json                  # NPM dependencies
└── artisan                       # Laravel CLI tool
```

---

## 🔧 Troubleshooting

### Error: "Class 'App\\...' not found"

**Solusi:**

```bash
composer dump-autoload
php artisan cache:clear
```

### Error: "No Application Key Found"

**Solusi:**

```bash
php artisan key:generate
```

### Error: "Class 'PDOException' not found" / Database Connection Error

**Solusi:**

1. Periksa konfigurasi database di `.env`
2. Pastikan MySQL server sedang berjalan
3. Verifikasi username dan password MySQL
4. Cek apakah database sudah dibuat

### Error: "npm: command not found"

**Solusi:**

1. Install Node.js dari [nodejs.org](https://nodejs.org)
2. Restart terminal setelah instalasi
3. Verifikasi dengan: `node --version` dan `npm --version`

### Error: "composer: command not found"

**Solusi:**

1. Install Composer dari [getcomposer.org](https://getcomposer.org)
2. Tambahkan ke PATH environment variable
3. Restart terminal setelah instalasi
4. Verifikasi dengan: `composer --version`

### Permission Denied di folder `storage/` atau `bootstrap/cache/`

**Solusi (Windows):**

```bash
# Jika menggunakan Laragon, set permissions
icacls "storage" /grant Everyone:F /T
icacls "bootstrap/cache" /grant Everyone:F /T
```

### Port 8000 sudah digunakan

**Solusi:**

```bash
php artisan serve --port=8001
# atau gunakan port lain yang tersedia
```

---

## 📚 Resource Tambahan

-   [Laravel Documentation](https://laravel.com/docs)
-   [Tailwind CSS Documentation](https://tailwindcss.com/docs)
-   [MySQL Documentation](https://dev.mysql.com/doc/)
-   [Composer Documentation](https://getcomposer.org/doc/)
-   [npm Documentation](https://docs.npmjs.com/)

---

## ✅ Checklist Setup Selesai

Pastikan semua langkah berikut sudah dikerjakan:

-   [ ] PHP 8.1+ sudah diinstall
-   [ ] Composer sudah diinstall
-   [ ] Node.js & npm sudah diinstall
-   [ ] MySQL sudah berjalan
-   [ ] Repository sudah di-clone
-   [ ] Dependency sudah di-install (`composer install` & `npm install`)
-   [ ] File `.env` sudah dikonfigurasi
-   [ ] Database sudah dibuat
-   [ ] Migration sudah dijalankan
-   [ ] Application key sudah di-generate
-   [ ] Server sudah berjalan di `http://localhost:8000`

---

## 🤝 Support & Kontribusi

Jika ada pertanyaan atau menemukan bug, silakan:

1. Buka issue di GitHub repository
2. Atau hubungi tim development

---

**Dokumentasi ini terakhir diperbarui:** December 2025
