<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;

echo "Memulai Seeding Data...\n\n";

try {
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=0;');
    
    $tables = ['krs', 'jadwal_kelas', 'matakuliahs', 'mahasiswas', 'dosens', 
               'ruangans', 'tahun_akademiks', 'program_studis', 'jurusans', 'users'];
    
    foreach ($tables as $table) {
        Capsule::table($table)->truncate();
        echo "✓ Tabel $table dikosongkan\n";
    }
    
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=1;');
    echo "\n";

    // 1. Master: Jurusan
    Capsule::table('jurusans')->insert([
        ['id'=>1, 'kode'=>'TI', 'nama'=>'Teknologi Informasi', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
        ['id'=>2, 'kode'=>'EE', 'nama'=>'Teknik Elektro', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
    ]);
    echo "✓ Data Jurusan berhasil ditambahkan\n";

    // 2. Master: Program Studi
    Capsule::table('program_studis')->insert([
        ['id'=>1, 'jurusan_id'=>1, 'kode'=>'TRPL', 'nama'=>'Teknologi Rekayasa Perangkat Lunak', 'jenjang'=>'D4', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
        ['id'=>2, 'jurusan_id'=>1, 'kode'=>'MI', 'nama'=>'Manajemen Informatika', 'jenjang'=>'D3', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
    ]);
    echo "✓ Data Program Studi berhasil ditambahkan\n";

    // 3. Master: Dosen
    $dosens = [
        ['nidn'=>'001', 'nama'=>'Dr. Budi Santoso, M.Kom', 'jenis_kelamin'=>'L', 'jurusan_id'=>1],
        ['nidn'=>'002', 'nama'=>'Siti Aminah, S.T., M.T.', 'jenis_kelamin'=>'P', 'jurusan_id'=>1],
        ['nidn'=>'003', 'nama'=>'Rahmat Hidayat, Ph.D', 'jenis_kelamin'=>'L', 'jurusan_id'=>1],
        ['nidn'=>'004', 'nama'=>'Dr. Fitri Handayani, S.Kom., M.T.', 'jenis_kelamin'=>'P', 'jurusan_id'=>1],
    ];
    
    foreach ($dosens as &$dosen) {
        $dosen['created_at'] = Carbon::now();
        $dosen['updated_at'] = Carbon::now();
    }
    Capsule::table('dosens')->insert($dosens);
    echo "✓ Data Dosen berhasil ditambahkan\n";

    // 4. Master: Tahun Akademik
    $tahunSekarang = date('Y');
    $bulanSekarang = (int)date('n');
    
    if ($bulanSekarang >= 8 || $bulanSekarang <= 1) {
        // Semester Ganjil
        $kode = $tahunSekarang . '1';
        $nama = $tahunSekarang . '/' . ($tahunSekarang + 1) . ' Ganjil';
        $semester = 'Ganjil';
        $tanggalMulai = $tahunSekarang . '-08-01';
        $tanggalSelesai = ($tahunSekarang + 1) . '-01-31';
    } else {
        // Semester Genap
        $kode = $tahunSekarang . '2';
        $nama = $tahunSekarang . '/' . ($tahunSekarang + 1) . ' Genap';
        $semester = 'Genap';
        $tanggalMulai = $tahunSekarang . '-02-01';
        $tanggalSelesai = $tahunSekarang . '-07-31';
    }

    Capsule::table('tahun_akademiks')->insert([
        'kode' => $kode,
        'nama' => $nama,
        'tahun' => $tahunSekarang . '/' . ($tahunSekarang + 1),
        'semester' => $semester,
        'tanggal_mulai' => $tanggalMulai,
        'tanggal_selesai' => $tanggalSelesai,
        'is_aktif' => 1,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
    
    $taAktif = Capsule::table('tahun_akademiks')->where('is_aktif', 1)->first();
    echo "✓ Tahun Akademik Aktif: {$taAktif->nama}\n";

    // 5. Master: Matakuliah
    $matakuliahs = [
        ['kode_mk'=>'TI001', 'nama_mk'=>'Pemrograman Web Lanjut', 'sks'=>4, 'semester_paket'=>5, 'prodi_id'=>1],
        ['kode_mk'=>'TI002', 'nama_mk'=>'Kecerdasan Buatan', 'sks'=>3, 'semester_paket'=>5, 'prodi_id'=>1],
        ['kode_mk'=>'TI003', 'nama_mk'=>'Manajemen Proyek', 'sks'=>2, 'semester_paket'=>5, 'prodi_id'=>1],
        ['kode_mk'=>'TI004', 'nama_mk'=>'Basis Data Lanjut', 'sks'=>3, 'semester_paket'=>5, 'prodi_id'=>1],
        ['kode_mk'=>'TI005', 'nama_mk'=>'Jaringan Komputer', 'sks'=>3, 'semester_paket'=>5, 'prodi_id'=>1],
    ];
    
    foreach ($matakuliahs as &$mk) {
        $mk['created_at'] = Carbon::now();
        $mk['updated_at'] = Carbon::now();
    }
    Capsule::table('matakuliahs')->insert($matakuliahs);
    echo "✓ Data Matakuliah berhasil ditambahkan\n";

    // 6. Master: Ruangan
    $ruangans = [
        ['kode_ruang'=>'LAB-A', 'nama_ruang'=>'Laboratorium RPL', 'kapasitas'=>30],
        ['kode_ruang'=>'R-201', 'nama_ruang'=>'Ruang Teori 2.1', 'kapasitas'=>40],
        ['kode_ruang'=>'R-202', 'nama_ruang'=>'Ruang Teori 2.2', 'kapasitas'=>40],
        ['kode_ruang'=>'LAB-B', 'nama_ruang'=>'Laboratorium Jaringan', 'kapasitas'=>30],
    ];
    
    foreach ($ruangans as &$ruang) {
        $ruang['created_at'] = Carbon::now();
        $ruang['updated_at'] = Carbon::now();
    }
    Capsule::table('ruangans')->insert($ruangans);
    echo "✓ Data Ruangan berhasil ditambahkan\n";

    // 7. Jadwal Kelas (untuk Kelas 3A)
    $jadwals = [
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>1, 'dosen_id'=>'001', 'ruangan_id'=>1, 'nama_kelas'=>'3A', 'hari'=>'Senin', 'jam_mulai'=>'08:00:00', 'jam_selesai'=>'12:00:00', 'kuota'=>30],
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>2, 'dosen_id'=>'002', 'ruangan_id'=>2, 'nama_kelas'=>'3A', 'hari'=>'Selasa', 'jam_mulai'=>'10:00:00', 'jam_selesai'=>'12:30:00', 'kuota'=>30],
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>3, 'dosen_id'=>'003', 'ruangan_id'=>2, 'nama_kelas'=>'3A', 'hari'=>'Rabu', 'jam_mulai'=>'08:00:00', 'jam_selesai'=>'09:40:00', 'kuota'=>30],
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>4, 'dosen_id'=>'004', 'ruangan_id'=>3, 'nama_kelas'=>'3A', 'hari'=>'Kamis', 'jam_mulai'=>'13:00:00', 'jam_selesai'=>'15:30:00', 'kuota'=>30],
        ['tahun_akademik_id'=>$taAktif->id, 'matakuliah_id'=>5, 'dosen_id'=>'001', 'ruangan_id'=>4, 'nama_kelas'=>'3A', 'hari'=>'Jumat', 'jam_mulai'=>'08:00:00', 'jam_selesai'=>'10:30:00', 'kuota'=>30],
    ];
    
    foreach ($jadwals as &$jadwal) {
        $jadwal['created_at'] = Carbon::now();
        $jadwal['updated_at'] = Carbon::now();
    }
    Capsule::table('jadwal_kelas')->insert($jadwals);
    echo "✓ Data Jadwal Kelas berhasil ditambahkan\n";

    // 8. Master: Mahasiswa
    $angkatan = $tahunSekarang - 2; // Mahasiswa Semester 5
    
    $mahasiswas = [
        ['nim'=>'1001', 'nama'=>'Cindy Juniarti', 'jenis_kelamin'=>'P', 'prodi_id'=>1, 'angkatan'=>$angkatan, 'kelas_profil'=>'3A', 'semester_aktif'=>5],
        ['nim'=>'1002', 'nama'=>'Budi Santoso', 'jenis_kelamin'=>'L', 'prodi_id'=>1, 'angkatan'=>$angkatan, 'kelas_profil'=>'3A', 'semester_aktif'=>5],
        ['nim'=>'1003', 'nama'=>'Dinda Kirana', 'jenis_kelamin'=>'P', 'prodi_id'=>1, 'angkatan'=>$angkatan, 'kelas_profil'=>'3A', 'semester_aktif'=>5],
        ['nim'=>'1004', 'nama'=>'Eko Prasetyo', 'jenis_kelamin'=>'L', 'prodi_id'=>1, 'angkatan'=>$angkatan, 'kelas_profil'=>'3A', 'semester_aktif'=>5],
    ];
    
    foreach ($mahasiswas as &$mhs) {
        $mhs['created_at'] = Carbon::now();
        $mhs['updated_at'] = Carbon::now();
    }
    Capsule::table('mahasiswas')->insert($mahasiswas);
    echo "✓ Data Mahasiswa berhasil ditambahkan\n";

    // 9. User & Link ke Mahasiswa
    $userId = Capsule::table('users')->insertGetId([
        'nama_lengkap' => 'Cindy Juniarti',
        'password' => password_hash('admin', PASSWORD_BCRYPT),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
    
    Capsule::table('mahasiswas')->where('nim', '1001')->update(['user_id' => $userId]);
    echo "✓ User Login dibuat (Username: Cindy Juniarti | Password: admin)\n";

    // 10. Auto KRS dengan Nilai Random
    $allMahasiswa = Capsule::table('mahasiswas')->get();
    $allJadwal = Capsule::table('jadwal_kelas')->get();
    
    foreach ($allMahasiswa as $mhs) {
        foreach ($allJadwal as $jadwal) {
            $nilaiAngka = rand(70, 95);
            $nilaiHuruf = ($nilaiAngka >= 85) ? 'A' : 
                          (($nilaiAngka >= 80) ? 'A-' : 
                          (($nilaiAngka >= 75) ? 'B+' : 
                          (($nilaiAngka >= 70) ? 'B' : 'C')));
            $bobot = ($nilaiAngka >= 85) ? 4.00 : 
                     (($nilaiAngka >= 80) ? 3.67 : 
                     (($nilaiAngka >= 75) ? 3.33 : 
                     (($nilaiAngka >= 70) ? 3.00 : 2.00)));

            Capsule::table('krs')->insert([
                'nim' => $mhs->nim,
                'jadwal_kelas_id' => $jadwal->id,
                'nilai_angka' => $nilaiAngka,
                'nilai_huruf' => $nilaiHuruf,
                'bobot' => $bobot,
                'is_disetujui' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
    echo "✓ Data KRS & Nilai berhasil ditambahkan\n";

    echo "\n";
    echo "═══════════════════════════════════════════\n";
    echo "✅ SEEDING SELESAI!\n";
    echo "═══════════════════════════════════════════\n";
    echo "Login Credentials:\n";
    echo "  Nama Lengkap: Cindy Juniarti\n";
    echo "  Password: admin\n";
    echo "═══════════════════════════════════════════\n";

} catch (\Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}