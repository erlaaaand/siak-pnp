<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "Memulai pengisian data awal (Seeding)...\n";

try {
    // === REVISI: Matikan Foreign Key Check Dulu ===
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=0;');
    
    // 1. Bersihkan Data Lama
    Capsule::table('krs')->truncate();
    Capsule::table('jadwal_kelas')->truncate();
    Capsule::table('matakuliahs')->truncate();
    Capsule::table('mahasiswas')->truncate();
    Capsule::table('dosens')->truncate();
    Capsule::table('program_studis')->truncate();
    Capsule::table('jurusans')->truncate();
    Capsule::table('users')->truncate();
    Capsule::table('tahun_akademiks')->truncate();
    Capsule::table('ruangans')->truncate();

    // === REVISI: Nyalakan Kembali Foreign Key Check ===
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=1;');

    // 2. Insert Jurusan
    $jurId = Capsule::table('jurusans')->insertGetId([
        'kode' => 'TI',
        'nama' => 'Teknologi Informasi',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 3. Insert Prodi
    $prodiId = Capsule::table('program_studis')->insertGetId([
        'jurusan_id' => $jurId,
        'kode' => 'TRPL',
        'nama' => 'Teknologi Rekayasa Perangkat Lunak',
        'jenjang' => 'D4',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 4. Insert Mahasiswa
    Capsule::table('mahasiswas')->insert([
        'nim' => '2311082001',
        'nama' => 'Budi Santoso', 
        'jenis_kelamin' => 'L',
        'prodi_id' => $prodiId,
        'angkatan' => 2023,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 5. Insert Dosen
    Capsule::table('dosens')->insert([
        'nidn' => '00112233',
        'nama' => 'Dr. Eka Putra',
        'jenis_kelamin' => 'L',
        'jurusan_id' => $jurId,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 6. Insert Tahun Akademik
    $thId = Capsule::table('tahun_akademiks')->insertGetId([
        'kode' => '20241',
        'tahun' => '2024/2025',
        'semester' => 'Ganjil',
        'is_aktif' => 1,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 7. Insert Matakuliah
    $mkWebId = Capsule::table('matakuliahs')->insertGetId([
        'kode_mk' => 'WEB001',
        'nama_mk' => 'Pemrograman Web Lanjut',
        'sks' => 3,
        'prodi_id' => $prodiId,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    $mkDbId = Capsule::table('matakuliahs')->insertGetId([
        'kode_mk' => 'DB002',
        'nama_mk' => 'Basis Data Relasional',
        'sks' => 4,
        'prodi_id' => $prodiId,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 8. Insert Ruangan
    $ruangId = Capsule::table('ruangans')->insertGetId([
        'kode_ruang' => 'LAB-KOM',
        'nama_ruang' => 'Lab Komputer 1',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // 9. Insert Jadwal Kelas
    Capsule::table('jadwal_kelas')->insert([
        [
            'tahun_akademik_id' => $thId,
            'matakuliah_id' => $mkWebId,
            'dosen_id' => '00112233',
            'ruangan_id' => $ruangId,
            'nama_kelas' => '2A',
            'hari' => 'Senin',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:30:00',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'tahun_akademik_id' => $thId,
            'matakuliah_id' => $mkDbId,
            'dosen_id' => '00112233',
            'ruangan_id' => $ruangId,
            'nama_kelas' => '2A',
            'hari' => 'Selasa',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '16:00:00',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ]);

    echo "SELESAI! Database telah diisi data dummy.\n";

} catch (\Exception $e) {
    echo "Gagal mengisi data: " . $e->getMessage() . "\n";
}