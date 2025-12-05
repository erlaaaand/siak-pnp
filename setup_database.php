<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "Memulai Setup Database SIAK...\n";

try {
    // 1. Users Table
    if (!Capsule::schema()->hasTable('users')) {
        Capsule::schema()->create('users', function ($table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('password');
            $table->timestamps();
        });
        echo "✓ Tabel users dibuat\n";
    }

    // 2. Jurusan Table
    if (!Capsule::schema()->hasTable('jurusans')) {
        Capsule::schema()->create('jurusans', function ($table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama', 100);
            $table->timestamps();
        });
        echo "✓ Tabel jurusans dibuat\n";
    }

    // 3. Program Studi Table
    if (!Capsule::schema()->hasTable('program_studis')) {
        Capsule::schema()->create('program_studis', function ($table) {
            $table->id();
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->string('kode', 10)->unique();
            $table->string('nama', 100);
            $table->enum('jenjang', ['D3', 'D4', 'S1']);
            $table->timestamps();
        });
        echo "✓ Tabel program_studis dibuat\n";
    }

    // 4. Dosen Table
    if (!Capsule::schema()->hasTable('dosens')) {
        Capsule::schema()->create('dosens', function ($table) {
            $table->string('nidn', 20)->primary();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans');
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
        echo "✓ Tabel dosens dibuat\n";
    }

    // 5. Mahasiswa Table
    if (!Capsule::schema()->hasTable('mahasiswas')) {
        Capsule::schema()->create('mahasiswas', function ($table) {
            $table->string('nim', 20)->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama', 100);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('prodi_id')->constrained('program_studis');
            $table->year('angkatan');
            $table->string('kelas_profil', 10)->nullable();
            $table->tinyInteger('semester_aktif')->default(1);
            $table->string('foto', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        echo "✓ Tabel mahasiswas dibuat\n";
    }

    // 6. Tahun Akademik Table
    if (!Capsule::schema()->hasTable('tahun_akademiks')) {
        Capsule::schema()->create('tahun_akademiks', function ($table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama', 50);
            $table->string('tahun', 20);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('is_aktif')->default(0);
            $table->timestamps();
        });
        echo "✓ Tabel tahun_akademiks dibuat\n";
    }

    // 7. Matakuliah Table
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
        echo "✓ Tabel matakuliahs dibuat\n";
    }

    // 8. Ruangan Table
    if (!Capsule::schema()->hasTable('ruangans')) {
        Capsule::schema()->create('ruangans', function ($table) {
            $table->id();
            $table->string('kode_ruang', 20)->unique();
            $table->string('nama_ruang', 50);
            $table->integer('kapasitas')->nullable();
            $table->timestamps();
        });
        echo "✓ Tabel ruangans dibuat\n";
    }

    // 9. Jadwal Kelas Table
    if (!Capsule::schema()->hasTable('jadwal_kelas')) {
        Capsule::schema()->create('jadwal_kelas', function ($table) {
            $table->id();
            $table->foreignId('tahun_akademik_id')->constrained('tahun_akademiks');
            $table->foreignId('matakuliah_id')->constrained('matakuliahs');
            $table->string('dosen_id', 20);
            $table->foreign('dosen_id')->references('nidn')->on('dosens');
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans');
            $table->string('nama_kelas', 10)->nullable();
            $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('kuota')->default(40);
            $table->timestamps();
        });
        echo "✓ Tabel jadwal_kelas dibuat\n";
    }

    // 10. KRS Table
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
        });
        echo "✓ Tabel krs dibuat\n";
    }

    echo "\n✅ Database Setup Complete!\n";
    echo "Silakan jalankan: php seed_database.php\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}