<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "Memulai setup database SIAK (Student Login Only)...\n";

// 1. TABEL USERS (Hanya untuk Mahasiswa)
if (!Capsule::schema()->hasTable('users')) {
    Capsule::schema()->create('users', function ($table) {
        $table->id();
        $table->string('nama_lengkap', 100)->unique(); // Username untuk login
        $table->string('password');
        $table->timestamps();
    });
    echo "[OK] Tabel 'users' berhasil dibuat.\n";
}

// 2. TABEL JURUSAN & PRODI (Master Data)
if (!Capsule::schema()->hasTable('jurusans')) {
    Capsule::schema()->create('jurusans', function ($table) {
        $table->id();
        $table->string('kode', 10)->unique();
        $table->string('nama', 100);
        $table->timestamps();
    });
}

if (!Capsule::schema()->hasTable('program_studis')) {
    Capsule::schema()->create('program_studis', function ($table) {
        $table->id();
        $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
        $table->string('kode', 10)->unique();
        $table->string('nama', 100);
        $table->enum('jenjang', ['D3', 'D4', 'S1']);
        $table->timestamps();
    });
}

// 3. TABEL MAHASISWA (Inti Perubahan di sini)
if (!Capsule::schema()->hasTable('mahasiswas')) {
    Capsule::schema()->create('mahasiswas', function ($table) {
        $table->string('nim', 20)->primary();
        
        // Relasi One-to-One ke Users (Nullable, diisi saat Register)
        // Unique: Agar 1 akun user tidak bisa dipakai 2 mahasiswa berbeda
        $table->foreignId('user_id')->nullable()->unique()->constrained('users')->onDelete('set null');
        
        $table->string('nama', 100); // Nama sesuai data akademik
        $table->string('tempat_lahir', 50)->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->foreignId('prodi_id')->constrained('program_studis');
        $table->year('angkatan');
        $table->string('foto')->nullable();
        $table->timestamps();
        $table->softDeletes();
        
        // Index nama untuk mempercepat pencocokan saat Register
        $table->index('nama');
    });
    echo "[OK] Tabel 'mahasiswas' (Linked to Users) berhasil dibuat.\n";
}

// 4. TABEL DOSEN (Tanpa User ID)
if (!Capsule::schema()->hasTable('dosens')) {
    Capsule::schema()->create('dosens', function ($table) {
        $table->string('nidn', 20)->primary();
        // HAPUS kolom user_id disini
        $table->string('nama', 100);
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->foreignId('jurusan_id')->nullable()->constrained('jurusans');
        $table->string('foto')->nullable();
        $table->timestamps();
    });
    echo "[OK] Tabel 'dosens' berhasil dibuat.\n";
}

// 5. Tabel Tahun Akademik
if (!Capsule::schema()->hasTable('tahun_akademiks')) {
    Capsule::schema()->create('tahun_akademiks', function ($table) {
        $table->id();
        $table->string('kode', 10)->unique(); // 20241
        $table->string('tahun', 9); // 2024/2025
        $table->enum('semester', ['Ganjil', 'Genap']);
        $table->boolean('is_aktif')->default(0);
        $table->timestamps();
    });
    echo "[OK] Tabel 'tahun_akademiks' berhasil dibuat.\n";
}

// 6. Tabel Matakuliah
if (!Capsule::schema()->hasTable('matakuliahs')) {
    Capsule::schema()->create('matakuliahs', function ($table) {
        $table->id();
        $table->string('kode_mk', 20);
        $table->string('nama_mk', 100);
        $table->integer('sks');
        $table->integer('semester_paket')->nullable();
        $table->foreignId('prodi_id')->constrained('program_studis')->onDelete('cascade');
        $table->timestamps();
    });
    echo "[OK] Tabel 'matakuliahs' berhasil dibuat.\n";
}

// 7. Tabel Ruangan
if (!Capsule::schema()->hasTable('ruangans')) {
    Capsule::schema()->create('ruangans', function ($table) {
        $table->id();
        $table->string('kode_ruang', 20)->unique();
        $table->string('nama_ruang', 50);
        $table->integer('kapasitas')->nullable();
        $table->timestamps();
    });
    echo "[OK] Tabel 'ruangans' berhasil dibuat.\n";
}

// 8. Tabel Jadwal Kelas (Penghubung Dosen, MK, Ruang)
if (!Capsule::schema()->hasTable('jadwal_kelas')) {
    Capsule::schema()->create('jadwal_kelas', function ($table) {
        $table->id();
        $table->foreignId('tahun_akademik_id')->constrained('tahun_akademiks');
        $table->foreignId('matakuliah_id')->constrained('matakuliahs');
        
        $table->string('dosen_id', 20);
        $table->foreign('dosen_id')->references('nidn')->on('dosens');
        
        $table->foreignId('ruangan_id')->nullable()->constrained('ruangans');
        
        $table->string('nama_kelas', 10)->nullable(); // 3A, 3B
        $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'])->nullable();
        $table->time('jam_mulai')->nullable();
        $table->time('jam_selesai')->nullable();
        $table->integer('kuota')->default(30);
        $table->timestamps();
    });
    echo "[OK] Tabel 'jadwal_kelas' berhasil dibuat.\n";
}

// 9. Tabel KRS (Kartu Rencana Studi + Nilai)
if (!Capsule::schema()->hasTable('krs')) {
    Capsule::schema()->create('krs', function ($table) {
        $table->id();
        
        $table->string('nim', 20);
        $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
        
        $table->foreignId('jadwal_kelas_id')->constrained('jadwal_kelas')->onDelete('cascade');
        
        $table->decimal('nilai_angka', 5, 2)->default(0);
        $table->char('nilai_huruf', 2)->nullable();
        $table->decimal('bobot', 3, 2)->nullable();
        $table->boolean('is_disetujui')->default(0);
        
        $table->timestamps();
        
        // Unique constraint agar mhs tidak ambil kelas sama 2x
        $table->unique(['nim', 'jadwal_kelas_id']);
    });
    echo "[OK] Tabel 'krs' berhasil dibuat.\n";
}

echo "\nSemua tabel berhasil dikonfigurasi!\n";