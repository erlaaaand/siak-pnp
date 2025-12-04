# INSTALL.md
# Panduan Instalasi SIAK PNP

## Langkah-langkah Instalasi

### 1. Persiapan Environment

**Windows (XAMPP/Laragon):**
- Download dan install XAMPP atau Laragon
- Pastikan PHP >= 8.2 dan MySQL >= 8.0
- Download Composer dari https://getcomposer.org

**Linux (Ubuntu/Debian):**
```bash
sudo apt update
sudo apt install php8.2 php8.2-mysql php8.2-mbstring php8.2-xml composer
sudo apt install mysql-server
```

**macOS:**
```bash
brew install php@8.2 mysql composer
```

### 2. Clone atau Download Project

```bash
git clone https://github.com/yourusername/siak-pnp.git
cd siak-pnp
```

Atau download ZIP dan extract.

### 3. Install Dependencies

```bash
composer install
```

Jika ada error "composer not found", install composer terlebih dahulu.

### 4. Setup Database

**A. Buat Database dan User:**

Login ke MySQL:
```bash
mysql -u root -p
```

Jalankan query berikut:
```sql
CREATE DATABASE db_siak CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE USER 'siak_user'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON db_siak.* TO 'siak_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

**B. Konfigurasi Connection:**

Edit file `config/database.php`:
```php
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'db_siak',
    'username'  => 'siak_user',
    'password'  => 'password123',
    // ... sisanya biarkan default
]);
```

**C. Buat Tabel:**

```bash
php setup_database.php
```

Output yang benar:
```
Memulai setup database SIAK (Student Login Only)...
[OK] Tabel 'users' berhasil dibuat.
[OK] Tabel 'mahasiswas' (Linked to Users) berhasil dibuat.
[OK] Tabel 'dosens' berhasil dibuat.
... dst
Semua tabel berhasil dikonfigurasi!
```

**D. Isi Data Dummy (Opsional):**

```bash
php seed_database.php
```

### 5. Konfigurasi Web Server

**XAMPP/Laragon:**
- Copy folder project ke htdocs/www
- Akses: `http://localhost/siak-pnp/public/`

**Apache Virtual Host:**
```apache
<VirtualHost *:80>
    ServerName siak.local
    DocumentRoot "/path/to/siak-pnp/public"
    
    <Directory "/path/to/siak-pnp/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Tambahkan ke `/etc/hosts`:
```
127.0.0.1 siak.local
```

**Nginx:**
```nginx
server {
    listen 80;
    server_name siak.local;
    root /path/to/siak-pnp/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

**PHP Built-in Server (Development Only):**
```bash
cd public
php -S localhost:8000
```

### 6. Test Akses

Buka browser dan akses:
```
http://localhost/siak-pnp/public/
# atau
http://siak.local/
# atau
http://localhost:8000/
```

### 7. Registrasi Akun

1. Klik "Daftar Sekarang"
2. Gunakan nama: **Budi Santoso** (sesuai data dummy)
3. Buat password (min 6 karakter)
4. Login dengan kredensial tersebut

## Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Access denied for user"
Periksa username/password di `config/database.php`

### Error: "Call to undefined function mb_*"
Install PHP mbstring:
```bash
sudo apt install php8.2-mbstring
# atau untuk XAMPP, aktifkan extension=mbstring di php.ini
```

### Halaman blank/error 500
Check error log:
- XAMPP: `xampp/apache/logs/error.log`
- Linux: `/var/log/apache2/error.log`

Enable error display di `public/index.php`:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### Permission denied (Linux)
```bash
sudo chown -R www-data:www-data /path/to/siak-pnp
sudo chmod -R 755 /path/to/siak-pnp
```

## Selesai!

Aplikasi siap digunakan. Untuk menambah data mahasiswa baru:
1. Insert manual ke tabel `mahasiswas`
2. Mahasiswa registrasi dengan nama lengkap yang sama
3. Sistem akan otomatis menghubungkan akun

---

Untuk pertanyaan lebih lanjut, buat issue di repository.