<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "Memulai Seeding Data LENGKAP (Clone DB Asli ke Struktur Baru)...\n";

try {
    // === 1. PERSIAPAN: Reset Database ===
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=0;');
    $tables = ['krs', 'jadwal_kelas', 'matakuliahs', 'mahasiswas', 'dosens', 'program_studis', 'jurusans', 'users', 'tahun_akademiks', 'ruangans'];
    foreach ($tables as $table) Capsule::table($table)->truncate();
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=1;');

    // === 2. MASTER: JURUSAN (Sesuai db_siak.sql) ===
    $jurusans = [
        ['id'=>1, 'kode'=>'ME', 'nama'=>'Teknik Mesin'],
        ['id'=>2, 'kode'=>'SP', 'nama'=>'Teknik Sipil'],
        ['id'=>3, 'kode'=>'EE', 'nama'=>'Teknik Elektro'],
        ['id'=>4, 'kode'=>'AN', 'nama'=>'Administrasi Niaga'],
        ['id'=>5, 'kode'=>'AK', 'nama'=>'Akuntansi'],
        ['id'=>6, 'kode'=>'TI', 'nama'=>'Teknologi Informasi'],
        ['id'=>7, 'kode'=>'BI', 'nama'=>'Bahasa Inggris'],
    ];
    Capsule::table('jurusans')->insert($jurusans);
    echo "[OK] Jurusan inserted.\n";

    // === 3. MASTER: PRODI (Sesuai db_siak.sql) ===
    $prodis = [
        ['id'=>1, 'jurusan_id'=>3, 'kode'=>'4EC', 'nama'=>'Teknik Elektronika', 'jenjang'=>'D4'],
        ['id'=>7, 'jurusan_id'=>3, 'kode'=>'4TC', 'nama'=>'Teknik Telekomunikasi', 'jenjang'=>'D4'], // Fokus data sample disini
        ['id'=>9, 'jurusan_id'=>1, 'kode'=>'3ME', 'nama'=>'Teknik Mesin', 'jenjang'=>'D3'],
        ['id'=>10, 'jurusan_id'=>2, 'kode'=>'3SP', 'nama'=>'Teknik Sipil', 'jenjang'=>'D3'],
        ['id'=>17, 'jurusan_id'=>7, 'kode'=>'3BI', 'nama'=>'Bahasa Inggris', 'jenjang'=>'D3'],
    ];
    // Masukkan data prodi penting (sisanya bisa menyusul agar script tidak kepanjangan)
    foreach($prodis as $p) {
        Capsule::table('program_studis')->insert(array_merge($p, ['created_at'=>date('Y-m-d H:i:s')]));
    }
    echo "[OK] Prodi inserted.\n";

    // === 4. MASTER: DOSEN (29 Data Lengkap dari db_siak.sql) ===
    $dosens = [
        ['nidn'=>'0006058102', 'nama'=>'Amelia Yolanda', 'gelar_belakang'=>'ST., MT', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0006058302', 'nama'=>'Popy Maria', 'gelar_belakang'=>'ST.,MT', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0007016802', 'nama'=>'Yustini', 'gelar_belakang'=>'SST., MT', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0007039304', 'nama'=>'Ummul Khair', 'gelar_belakang'=>'S.T., M.T', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0007047602', 'nama'=>'Ramiati', 'gelar_belakang'=>'ST.,SST.,M.Kom', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0007087701', 'nama'=>'Dikky Chandra', 'gelar_belakang'=>'ST.,MT', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0009046904', 'nama'=>'Aprinal Adila Asril', 'gelar_belakang'=>'ST.,M.Kom', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0009067701', 'nama'=>'Silfia Rifka', 'gelar_belakang'=>'SST, MT.', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0010049210', 'nama'=>'Sahid Ridho', 'gelar_belakang'=>'S.T., M.T.', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0011097202', 'nama'=>'Andi Ahmad Dahlan', 'gelar_belakang'=>'ST., M.Eng', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0012067402', 'nama'=>'Sri Yusnita', 'gelar_belakang'=>'ST.,MT', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0014057908', 'nama'=>'Sabriandi Erdian', 'gelar_belakang'=>'SS.,M.Hum', 'jenis_kelamin'=>'L', 'jurusan_id'=>7], // Jurusan Bhs Inggris
        ['nidn'=>'0016046801', 'nama'=>'Sri Nita', 'gelar_belakang'=>'M.Pd', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0018069304', 'nama'=>'Deri Latika Herda', 'gelar_belakang'=>'S.T., M.T.', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0019107605', 'nama'=>'Rikki Vitria', 'gelar_belakang'=>'S.ST., M.Sc. Eng.', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0022027208', 'nama'=>'Lifwarda', 'gelar_belakang'=>'ST., M.Kom', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0022057705', 'nama'=>'Firdaus', 'gelar_belakang'=>'ST., MT', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0024096804', 'nama'=>'Uzma Septima', 'gelar_belakang'=>'ST.,M.Eng', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0025016906', 'nama'=>'Zurnawita', 'gelar_belakang'=>'ST.,MT', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0025117803', 'nama'=>'Ihsan Lumasa Rimra', 'gelar_belakang'=>'SST.,M.Sc DECN', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0029046406', 'nama'=>'Afrizal Yuhanef', 'gelar_belakang'=>'ST.,M.Kom', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0029097604', 'nama'=>'Vera Veronica', 'gelar_belakang'=>'ST.,MT', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0029107506', 'nama'=>'Ratna Dewi', 'gelar_belakang'=>'SST., M.Kom', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'0030046603', 'nama'=>'Yulindon', 'gelar_belakang'=>'S.T., M.Kom.', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0030116506', 'nama'=>'Nasrul', 'gelar_belakang'=>'ST.,M.Kom', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'0215039501', 'nama'=>'Muhammad Putra Pamungkas', 'gelar_belakang'=>'S.T., M.T.', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
        ['nidn'=>'1004038801', 'nama'=>'Siska Aulia', 'gelar_belakang'=>'ST.,MT', 'jenis_kelamin'=>'P', 'jurusan_id'=>3],
        ['nidn'=>'1301018802', 'nama'=>'Herry Setiawan', 'gelar_belakang'=>'S.ST., MT', 'jenis_kelamin'=>'L', 'jurusan_id'=>3],
    ];
    Capsule::table('dosens')->insert($dosens);
    echo "[OK] Dosen inserted.\n";

    // === 5. AKADEMIK (Tahun & Ruang) ===
    $thId = Capsule::table('tahun_akademiks')->insertGetId([
        'kode'=>'20241', 'tahun'=>'2024/2025', 'semester'=>'Ganjil', 'is_aktif'=>1
    ]);
    
    // Insert Ruang (Dummy, karena db asli tidak punya tabel ruang spesifik)
    $ruangIds = [];
    $ruangIds[] = Capsule::table('ruangans')->insertGetId(['kode_ruang'=>'E-201', 'nama_ruang'=>'Lab Jaringan']);
    $ruangIds[] = Capsule::table('ruangans')->insertGetId(['kode_ruang'=>'E-202', 'nama_ruang'=>'Lab Pemrograman']);
    $ruangIds[] = Capsule::table('ruangans')->insertGetId(['kode_ruang'=>'E-301', 'nama_ruang'=>'Ruang Teori 1']);

    // === 6. MATAKULIAH (15 Data Semester 4 & 5 dari db_siak.sql) ===
    $mks = [
        ['id'=>1, 'kode_mk'=>'TCE4106', 'nama_mk'=>'Bahasa Inggris 2', 'sks'=>2, 'semester_paket'=>4],
        ['id'=>2, 'kode_mk'=>'TCE4218', 'nama_mk'=>'Rangkaian Elektronika Telekomunikasi', 'sks'=>3, 'semester_paket'=>4],
        ['id'=>3, 'kode_mk'=>'TCE4219', 'nama_mk'=>'Teori dan Perancangan Antena', 'sks'=>2, 'semester_paket'=>4],
        ['id'=>4, 'kode_mk'=>'TCE4220', 'nama_mk'=>'Sistem Komunikasi Serat Optik', 'sks'=>4, 'semester_paket'=>4],
        ['id'=>5, 'kode_mk'=>'TCE4223', 'nama_mk'=>'Jaringan Radio Akses', 'sks'=>4, 'semester_paket'=>4],
        ['id'=>6, 'kode_mk'=>'TCE4229', 'nama_mk'=>'Jaringan Komputer', 'sks'=>3, 'semester_paket'=>4],
        ['id'=>7, 'kode_mk'=>'TCE4232', 'nama_mk'=>'Sistem Tertanam', 'sks'=>3, 'semester_paket'=>4],
        ['id'=>8, 'kode_mk'=>'TCE4107', 'nama_mk'=>'Bahasa Inggris 3', 'sks'=>2, 'semester_paket'=>5],
        ['id'=>9, 'kode_mk'=>'TCE4221', 'nama_mk'=>'Aplikasi Pengolahan Sinyal', 'sks'=>3, 'semester_paket'=>5],
        ['id'=>10, 'kode_mk'=>'TCE4224', 'nama_mk'=>'Rekayasa Frekuensi Radio', 'sks'=>4, 'semester_paket'=>5],
        ['id'=>11, 'kode_mk'=>'TCE4225', 'nama_mk'=>'Manajemen Telekomunikasi', 'sks'=>2, 'semester_paket'=>5],
        ['id'=>12, 'kode_mk'=>'TCE4230', 'nama_mk'=>'Komunikasi Data', 'sks'=>3, 'semester_paket'=>5],
        ['id'=>13, 'kode_mk'=>'TCE4231', 'nama_mk'=>'Teknik Penyambungan', 'sks'=>3, 'semester_paket'=>5],
        ['id'=>14, 'kode_mk'=>'TCE4234', 'nama_mk'=>'Pemrograman Internet', 'sks'=>2, 'semester_paket'=>5],
        ['id'=>15, 'kode_mk'=>'TCE4307', 'nama_mk'=>'Metoda Penelitian dan Penulisan Ilmiah', 'sks'=>2, 'semester_paket'=>5],
    ];
    foreach($mks as $mk) {
        Capsule::table('matakuliahs')->insert(array_merge($mk, ['prodi_id'=>7]));
    }
    echo "[OK] Matakuliah inserted.\n";

    // === 7. JADWAL KELAS (Konversi dari tabel `kelas_dosen` di db_siak.sql) ===
    // Mapping ID Kelas: 1=III.A, 2=III.B, 3=III.C
    $jadwalRaw = [
        // Kelas III.A
        ['mk'=>8, 'dsn'=>'0014057908', 'kls'=>'III.A', 'hari'=>'Senin', 'jam'=>'08:00:00'],
        ['mk'=>9, 'dsn'=>'0009067701', 'kls'=>'III.A', 'hari'=>'Senin', 'jam'=>'10:00:00'],
        ['mk'=>10, 'dsn'=>'0012067402', 'kls'=>'III.A', 'hari'=>'Selasa', 'jam'=>'08:00:00'],
        ['mk'=>11, 'dsn'=>'0006058302', 'kls'=>'III.A', 'hari'=>'Selasa', 'jam'=>'13:00:00'],
        ['mk'=>12, 'dsn'=>'0011097202', 'kls'=>'III.A', 'hari'=>'Rabu', 'jam'=>'08:00:00'],
        ['mk'=>13, 'dsn'=>'0010049210', 'kls'=>'III.A', 'hari'=>'Rabu', 'jam'=>'10:30:00'],
        ['mk'=>14, 'dsn'=>'0029107506', 'kls'=>'III.A', 'hari'=>'Kamis', 'jam'=>'08:00:00'],
        ['mk'=>15, 'dsn'=>'0030116506', 'kls'=>'III.A', 'hari'=>'Jumat', 'jam'=>'09:00:00'],
        // Kelas III.B
        ['mk'=>8, 'dsn'=>'0014057908', 'kls'=>'III.B', 'hari'=>'Senin', 'jam'=>'13:00:00'],
        ['mk'=>9, 'dsn'=>'0009067701', 'kls'=>'III.B', 'hari'=>'Selasa', 'jam'=>'08:00:00'],
        ['mk'=>10, 'dsn'=>'0029046406', 'kls'=>'III.B', 'hari'=>'Rabu', 'jam'=>'08:00:00'],
        // Kelas III.C
        ['mk'=>12, 'dsn'=>'0011097202', 'kls'=>'III.C', 'hari'=>'Kamis', 'jam'=>'13:00:00'],
        ['mk'=>14, 'dsn'=>'1301018802', 'kls'=>'III.C', 'hari'=>'Jumat', 'jam'=>'08:00:00'],
    ];

    foreach($jadwalRaw as $j) {
        Capsule::table('jadwal_kelas')->insert([
            'tahun_akademik_id' => $thId,
            'matakuliah_id' => $j['mk'],
            'dosen_id' => $j['dsn'],
            'ruangan_id' => $ruangIds[array_rand($ruangIds)], // Random ruang
            'nama_kelas' => $j['kls'],
            'hari' => $j['hari'],
            'jam_mulai' => $j['jam'],
            'jam_selesai' => date('H:i:s', strtotime($j['jam']) + 7200), // +2 jam
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    echo "[OK] Jadwal Kelas & Pra-Kuliah Data inserted.\n";

    // === 8. DATA MAHASISWA & PEMBAGIAN KELAS (Dari tabel `mahasiswa` & `kelas_mahasiswa`) ===
    
    // Data Mahasiswa dari DB Asli (Sample representatif per kelas)
    // Format: [NIM, Nama, Kelas]
    $mhsData = [
        // KELAS III.A
        ['2211071001', 'Cindy Juniarti', 'III.A'],
        ['2211071002', 'Dhuha Rais', 'III.A'],
        ['2211071004', 'Erin Aulia Rahma', 'III.A'],
        ['2211071005', 'Ervin Nawal Andra', 'III.A'],
        ['2211071006', 'Fikri Adi Pratama', 'III.A'],
        ['2211071008', 'Iqbal Rizantha', 'III.A'],
        ['2211071010', 'M. Aqil Hisyam Akbar', 'III.A'],
        ['2211072002', 'Aisyah Vianda Putri', 'III.A'],
        ['2211072003', 'Alfhadila', 'III.A'],
        ['2211073001', 'Alif Bintang Al Ikhlas', 'III.A'],
        
        // KELAS III.B
        ['2211071011', 'M. Aqsha Aqrizal', 'III.B'],
        ['2211071012', 'M. Rizky Irawan', 'III.B'],
        ['2211071013', 'Maulana Alfarizi', 'III.B'],
        ['2211071014', 'Mhd. Yadil Ulya', 'III.B'],
        ['2211071015', 'Muhammad Zaki', 'III.B'],
        ['2211071016', 'Nisa Rahima Sakinah', 'III.B'],
        ['2211072010', 'Dian Indah Lestari', 'III.B'],
        ['2211072012', 'Fawwaz Zahran', 'III.B'],
        
        // KELAS III.C
        ['2211071017', 'Revandi Jeanifar', 'III.C'],
        ['2211071018', 'Rezi Apandi Sitompul', 'III.C'],
        ['2211071019', 'Shintia Destrianita', 'III.C'],
        ['2211071020', 'Taura Ramadhani', 'III.C'],
        ['2211071021', 'Wisra Yandi', 'III.C'],
        ['2211071022', 'Ilhamdi', 'III.C'],
        ['2211071023', 'Rio Agus Saputra', 'III.C'],
    ];

    foreach($mhsData as $m) {
        // Tentukan angkatan dari NIM (2 digit awal)
        $angkatan = '20' . substr($m[0], 0, 2);
        
        Capsule::table('mahasiswas')->insert([
            'nim' => $m[0],
            'nama' => $m[1],
            'tempat_lahir' => 'Padang',
            'tanggal_lahir' => '2003-01-01',
            'jenis_kelamin' => 'L', // Default
            'prodi_id' => 7,
            'kelas_profil' => $m[2], // <--- INI FITUR UTAMA "Daftar Teman Sekelas"
            'semester_aktif' => 5,
            'angkatan' => $angkatan,
            'foto' => $m[0] . '.jpg',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    echo "[OK] Mahasiswa & Pembagian Kelas inserted.\n";

    // === 9. AUTO-KRS & NILAI (Simulasi Perkuliahan) ===
    // Logic: Mahasiswa mengambil jadwal sesuai kelas_profil mereka
    $allMhs = Capsule::table('mahasiswas')->get();
    
    foreach($allMhs as $mhs) {
        // Cari jadwal untuk kelas mahasiswa ini
        $jadwals = Capsule::table('jadwal_kelas')
                    ->where('nama_kelas', $mhs->kelas_profil)
                    ->get();
        
        foreach($jadwals as $j) {
            // Random Nilai untuk simulasi Transkrip/KHS
            $nilaiAngka = rand(60, 95);
            $nilaiHuruf = 'B';
            $bobot = 3.00;
            
            if($nilaiAngka >= 85) { $nilaiHuruf='A'; $bobot=4.00; }
            elseif($nilaiAngka >= 80) { $nilaiHuruf='A-'; $bobot=3.75; }
            elseif($nilaiAngka >= 75) { $nilaiHuruf='B+'; $bobot=3.50; }
            
            Capsule::table('krs')->insert([
                'nim' => $mhs->nim,
                'jadwal_kelas_id' => $j->id,
                'nilai_angka' => $nilaiAngka,
                'nilai_huruf' => $nilaiHuruf,
                'bobot' => $bobot,
                'is_disetujui' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
    echo "[OK] KRS & Nilai inserted automatically based on Class.\n";

    // === 10. USER LOGIN DEMO ===
    // Buat akun untuk Cindy Juniarti
    $userId = Capsule::table('users')->insertGetId([
        'nama_lengkap' => 'Cindy Juniarti',
        'password' => password_hash('123', PASSWORD_BCRYPT),
        'created_at' => date('Y-m-d H:i:s')
    ]);
    Capsule::table('mahasiswas')->where('nim', '2211071001')->update(['user_id' => $userId]);

    echo "\n============================================\n";
    echo " DATABASE READY FOR DEMO! \n";
    echo "============================================\n";
    echo "Akun Demo:\n";
    echo "Nama: Cindy Juniarti\n";
    echo "Pass: 123\n";
    echo "Kelas: III.A (Akan melihat teman sekelas III.A)\n";

} catch (\Exception $e) {
    echo "Error Seeding: " . $e->getMessage() . "\n";
}