<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "Memulai setup database SIAK Final (Support Pra/Pasca Kuliah)...\n";

// 1. TABEL USERS
if (!Capsule::schema()->hasTable('users')) {
    Capsule::schema()->create('users', function ($table) {
        $table->id();
        $table->string('nama_lengkap', 100)->unique();
        $table->string('password');
        $table->timestamps();
    });
    echo "[OK] Tabel 'users' dibuat.\n";
}

// 2. TABEL MASTER (Jurusan & Prodi)
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

// 3. TABEL MAHASISWA (Update: Tambah Kelas Profil)
if (!Capsule::schema()->hasTable('mahasiswas')) {
    Capsule::schema()->create('mahasiswas', function ($table) {
        $table->string('nim', 20)->primary();
        $table->foreignId('user_id')->nullable()->unique()->constrained('users')->onDelete('set null');
        
        $table->string('nama', 100);
        $table->string('tempat_lahir', 50)->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->enum('jenis_kelamin', ['L', 'P']);
        
        $table->foreignId('prodi_id')->constrained('program_studis');
        
        // FITUR BARU: Untuk menu 'Daftar Mahasiswa Kelas' (Pra-kuliah)
        $table->string('kelas_profil', 10)->nullable(); // Contoh: 'III.A', 'III.B'
        $table->integer('semester_aktif')->default(1);  // Contoh: 5
        
        $table->year('angkatan');
        $table->string('foto')->nullable();
        $table->timestamps();
        $table->softDeletes();
        
        $table->index('nama');
        $table->index('kelas_profil'); // Index biar pencarian teman sekelas cepat
    });
    echo "[OK] Tabel 'mahasiswas' (Support Kelas) dibuat.\n";
}

// 4. TABEL DOSEN
if (!Capsule::schema()->hasTable('dosens')) {
    Capsule::schema()->create('dosens', function ($table) {
        $table->string('nidn', 20)->primary();
        $table->string('nama', 100);
        $table->string('gelar_depan', 50)->nullable();
        $table->string('gelar_belakang', 50)->nullable();
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->foreignId('jurusan_id')->nullable()->constrained('jurusans');
        $table->string('foto')->nullable();
        $table->timestamps();
    });
}

// 5. TABEL AKADEMIK (Tahun, MK, Ruangan)
if (!Capsule::schema()->hasTable('tahun_akademiks')) {
    Capsule::schema()->create('tahun_akademiks', function ($table) {
        $table->id();
        $table->string('kode', 10)->unique();
        $table->string('tahun', 9);
        $table->enum('semester', ['Ganjil', 'Genap']);
        $table->boolean('is_aktif')->default(0);
        $table->timestamps();
    });
}
if (!Capsule::schema()->hasTable('matakuliahs')) {
    Capsule::schema()->create('matakuliahs', function ($table) {
        $table->id();
        $table->string('kode_mk', 20);
        $table->string('nama_mk', 100);
        $table->integer('sks');
        $table->integer('semester_paket')->nullable();
        $table->foreignId('prodi_id')->constrained('program_studis');
        $table->timestamps();
    });
}
if (!Capsule::schema()->hasTable('ruangans')) {
    Capsule::schema()->create('ruangans', function ($table) {
        $table->id();
        $table->string('kode_ruang', 20)->unique();
        $table->string('nama_ruang', 50);
        $table->integer('kapasitas')->nullable();
        $table->timestamps();
    });
}

// 6. JADWAL KELAS (Support Pra-kuliah: Daftar MK Kelas, Daftar Dosen Kelas)
if (!Capsule::schema()->hasTable('jadwal_kelas')) {
    Capsule::schema()->create('jadwal_kelas', function ($table) {
        $table->id();
        $table->foreignId('tahun_akademik_id')->constrained('tahun_akademiks');
        $table->foreignId('matakuliah_id')->constrained('matakuliahs');
        
        $table->string('dosen_id', 20);
        $table->foreign('dosen_id')->references('nidn')->on('dosens');
        
        $table->foreignId('ruangan_id')->nullable()->constrained('ruangans');
        
        // Penting untuk grouping "Daftar Mata Kuliah Kelas 3A"
        $table->string('nama_kelas', 10)->nullable(); 
        
        $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'])->nullable();
        $table->time('jam_mulai')->nullable();
        $table->time('jam_selesai')->nullable();
        $table->integer('kuota')->default(30);
        $table->timestamps();
    });
}

// 7. KRS & KHS (Support Perkuliahan & Pasca-kuliah)
if (!Capsule::schema()->hasTable('krs')) {
    Capsule::schema()->create('krs', function ($table) {
        $table->id();
        $table->string('nim', 20);
        $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
        $table->foreignId('jadwal_kelas_id')->constrained('jadwal_kelas')->onDelete('cascade');
        
        $table->decimal('nilai_angka', 5, 2)->default(0);
        $table->char('nilai_huruf', 2)->nullable();
        $table->decimal('bobot', 3, 2)->nullable();
        $table->boolean('is_disetujui')->default(1);
        
        $table->timestamps();
        $table->unique(['nim', 'jadwal_kelas_id']);
    });
    echo "[OK] Tabel 'krs' (Nilai & Transkrip) dibuat.\n";
}

echo "\nDatabase Setup Final Selesai!\n";