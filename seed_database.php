<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "Memulai Seeding Data LENGKAP (Real-time Support)...\n";

try {
    // 1. Reset Database
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=0;');
    $tables = ['krs', 'jadwal_kelas', 'matakuliahs', 'mahasiswas', 'dosens', 'program_studis', 'jurusans', 'users', 'tahun_akademiks', 'ruangans'];
    foreach ($tables as $table) Capsule::table($table)->truncate();
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=1;');

    // 2. Data Master: Jurusan & Prodi
    Capsule::table('jurusans')->insert([
        ['id'=>1, 'kode'=>'TI', 'nama'=>'Teknologi Informasi'],
        ['id'=>2, 'kode'=>'EE', 'nama'=>'Teknik Elektro'],
    ]);

    Capsule::table('program_studis')->insert([
        ['id'=>1, 'jurusan_id'=>1, 'kode'=>'TRPL', 'nama'=>'Teknologi Rekayasa Perangkat Lunak', 'jenjang'=>'D4'],
        ['id'=>2, 'jurusan_id'=>1, 'kode'=>'MI', 'nama'=>'Manajemen Informatika', 'jenjang'=>'D3'],
    ]);

    // 3. Data Master: Dosen
    Capsule::table('dosens')->insert([
        ['nidn'=>'001', 'nama'=>'Dr. Budi Santoso, M.Kom', 'jenis_kelamin'=>'L', 'jurusan_id'=>1],
        ['nidn'=>'002', 'nama'=>'Siti Aminah, S.T., M.T.', 'jenis_kelamin'=>'P', 'jurusan_id'=>1],
        ['nidn'=>'003', 'nama'=>'Rahmat Hidayat, Ph.D', 'jenis_kelamin'=>'L', 'jurusan_id'=>1],
    ]);

    // 4. Data Master: Tahun Akademik (REAL TIME SETUP)
    // Kita set agar T.A. saat ini aktif berdasarkan tanggal hari ini
    $tahunIni = date('Y');
    
    // Semester Ganjil (Agu - Jan)
    Capsule::table('tahun_akademiks')->insert([
        'kode' => $tahunIni . '1',
        'nama' => $tahunIni . '/' . ($tahunIni+1) . ' Ganjil',
        'semester' => 'Ganjil',
        'tanggal_mulai' => "$tahunIni-08-01",
        'tanggal_selesai' => ($tahunIni+1) . "-01-31",
        'is_aktif' => 1
    ]);

    // Semester Genap (Feb - Jul)
    Capsule::table('tahun_akademiks')->insert([
        'kode' => ($tahunIni-1) . '2',
        'nama' => ($tahunIni-1) . '/' . $tahunIni . ' Genap',
        'semester' => 'Genap',
        'tanggal_mulai' => "$tahunIni-02-01",
        'tanggal_selesai' => "$tahunIni-07-31",
        'is_aktif' => 0
    ]);
    
    $taAktif = Capsule::table('tahun_akademiks')->where('is_aktif', 1)->first();

    // 5. Data Master: Matakuliah
    Capsule::table('matakuliahs')->insert([
        ['id'=>1, 'kode_mk'=>'TI001', 'nama_mk'=>'Pemrograman Web Lanjut', 'sks'=>4, 'semester_paket'=>5, 'prodi_id'=>1],
        ['id'=>2, 'kode_mk'=>'TI002', 'nama_mk'=>'Kecerdasan Buatan', 'sks'=>3, 'semester_paket'=>5, 'prodi_id'=>1],
        ['id'=>3, 'kode_mk'=>'TI003', 'nama_mk'=>'Manajemen Proyek', 'sks'=>2, 'semester_paket'=>5, 'prodi_id'=>1],
    ]);

    // 6. Data Master: Ruangan
    Capsule::table('ruangans')->insert([
        ['id'=>1, 'kode_ruang'=>'LAB-A', 'nama_ruang'=>'Laboratorium RPL', 'kapasitas'=>30],
        ['id'=>2, 'kode_ruang'=>'R-201', 'nama_ruang'=>'Ruang Teori 2.1', 'kapasitas'=>40],
    ]);

    // 7. Jadwal Kelas (Kelas Profil: 3A)
    Capsule::table('jadwal_kelas')->insert([
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>1, 'dosen_id'=>'001', 'ruangan_id'=>1, 'nama_kelas'=>'3A', 'hari'=>'Senin', 'jam_mulai'=>'08:00:00', 'jam_selesai'=>'12:00:00'],
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>2, 'dosen_id'=>'002', 'ruangan_id'=>2, 'nama_kelas'=>'3A', 'hari'=>'Selasa', 'jam_mulai'=>'10:00:00', 'jam_selesai'=>'12:30:00'],
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>3, 'dosen_id'=>'003', 'ruangan_id'=>2, 'nama_kelas'=>'3A', 'hari'=>'Rabu', 'jam_mulai'=>'08:00:00', 'jam_selesai'=>'09:40:00'],
    ]);

    // 8. Data Master: Mahasiswa
    // Angkatan diset 2 tahun lalu agar sekarang jadi Semester 5 (Sesuai real-time logic)
    $angkatan5 = $tahunIni - 2; 
    
    $mhsData = [
        ['nim'=>'1001', 'nama'=>'Cindy Juniarti', 'kls'=>'3A'],
        ['nim'=>'1002', 'nama'=>'Budi Santoso', 'kls'=>'3A'],
        ['nim'=>'1003', 'nama'=>'Dinda Kirana', 'kls'=>'3A'],
        ['nim'=>'1004', 'nama'=>'Eko Prasetyo', 'kls'=>'3A'],
    ];

    foreach($mhsData as $m) {
        Capsule::table('mahasiswas')->insert([
            'nim' => $m['nim'],
            'nama' => $m['nama'],
            'prodi_id' => 1,
            'angkatan' => $angkatan5,
            'kelas_profil' => $m['kls'],
            'semester_aktif' => 5, // Data awal
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // 9. User Login (Super Admin / Mahasiswa Tunggal)
    $userId = Capsule::table('users')->insertGetId([
        'nama_lengkap' => 'Cindy Juniarti',
        'username' => 'admin', // Login pakai ini
        'password' => password_hash('admin', PASSWORD_BCRYPT),
        'role' => 'admin'
    ]);
    // Link ke Mahasiswa Utama (Cindy)
    Capsule::table('mahasiswas')->where('nim', '1001')->update(['user_id' => $userId]);

    // 10. Auto KRS & Nilai (Simulasi Data Perkuliahan)
    $allMhs = Capsule::table('mahasiswas')->get();
    $jadwals = Capsule::table('jadwal_kelas')->get();

    foreach($allMhs as $mhs) {
        foreach($jadwals as $j) {
            // Random Nilai
            $nilai = rand(70, 95);
            $huruf = ($nilai >= 85) ? 'A' : (($nilai >= 75) ? 'B+' : 'B');
            $bobot = ($huruf == 'A') ? 4.0 : (($huruf == 'B+') ? 3.5 : 3.0);

            Capsule::table('krs')->insert([
                'nim' => $mhs->nim,
                'jadwal_kelas_id' => $j->id,
                'nilai_angka' => $nilai,
                'nilai_huruf' => $huruf,
                'bobot' => $bobot,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    echo "SELESAI! Database Terisi.\n";
    echo "Login: admin / admin\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}