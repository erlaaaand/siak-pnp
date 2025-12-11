<?php
require 'vendor/autoload.php';
require 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

echo "==========================================================\n";
echo "   MIGRASI DATABASE SIAK (FULL RESTORE FROM SQL DUMP)     \n";
echo "==========================================================\n";

try {
    // === 1. PERSIAPAN: Reset Database & Matikan Foreign Key Check ===
    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=0;');

    $tables = [
        'krs',
        'jadwal_kelas',
        'matakuliahs',
        'mahasiswas',
        'dosens',
        'program_studis',
        'jurusans',
        'users',
        'tahun_akademiks',
        'ruangans'
    ];

    foreach ($tables as $table) {
        if (Capsule::schema()->hasTable($table)) {
            Capsule::table($table)->truncate();
        }
    }

    Capsule::connection()->statement('SET FOREIGN_KEY_CHECKS=1;');
    echo "[RESET] Database bersih.\n";

    // === 2. DATA JURUSAN (7 Data - Sesuai SQL Dump) ===
    $jurusans = [
        ['id' => 1, 'kode' => 'ME', 'nama' => 'Teknik Mesin', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 2, 'kode' => 'SP', 'nama' => 'Teknik Sipil', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 3, 'kode' => 'EE', 'nama' => 'Teknik Elektro', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 4, 'kode' => 'AN', 'nama' => 'Administrasi Niaga', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 5, 'kode' => 'AK', 'nama' => 'Akuntansi', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 6, 'kode' => 'TI', 'nama' => 'Teknologi Informasi', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 7, 'kode' => 'BI', 'nama' => 'Bahasa Inggris', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    ];
    Capsule::table('jurusans')->insert($jurusans);
    echo "[OK] Jurusan inserted (7 data).\n";

    // === 3. DATA PRODI (17 Data - Sesuai SQL Dump) ===
    $prodis = [
        ['id' => 1, 'jurusan_id' => 3, 'kode' => '4EC', 'nama' => 'Teknik Elektronika', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 2, 'jurusan_id' => 2, 'kode' => '4TPIR', 'nama' => 'Teknik Perencanaan Irigasi dan Rawa', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 3, 'jurusan_id' => 1, 'kode' => '4TMAN', 'nama' => 'Teknik Manufaktur', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 4, 'jurusan_id' => 2, 'kode' => '4PJJ', 'nama' => 'Perancangan Jalan dan Jembatan', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 5, 'jurusan_id' => 2, 'kode' => '4MRK', 'nama' => 'Manajemen Rekayasa Konstruksi', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 6, 'jurusan_id' => 3, 'kode' => '4TRIL', 'nama' => 'Teknologi Rekayasa Instalasi Listrik', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 7, 'jurusan_id' => 3, 'kode' => '4TC', 'nama' => 'Teknik Telekomunikasi', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 8, 'jurusan_id' => 1, 'kode' => '4RPM', 'nama' => 'Rekayasa Perancangan Mekanik', 'jenjang' => 'D4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 9, 'jurusan_id' => 1, 'kode' => '3ME', 'nama' => 'Teknik Mesin', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 10, 'jurusan_id' => 2, 'kode' => '3SP', 'nama' => 'Teknik Sipil', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 11, 'jurusan_id' => 3, 'kode' => '3EL', 'nama' => 'Teknik Listrik', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 12, 'jurusan_id' => 3, 'kode' => '3EC', 'nama' => 'Teknik Elektronika', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 13, 'jurusan_id' => 3, 'kode' => '3TC', 'nama' => 'Teknik Telekomunikasi', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 14, 'jurusan_id' => 1, 'kode' => '3TAB', 'nama' => 'Teknik Alat Berat', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 15, 'jurusan_id' => 2, 'kode' => '3TS-TD', 'nama' => 'Teknologi Sipil', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 16, 'jurusan_id' => 3, 'kode' => '3TL-P', 'nama' => 'Teknik Listrik', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ['id' => 17, 'jurusan_id' => 7, 'kode' => '3BI', 'nama' => 'Bahasa Inggris', 'jenjang' => 'D3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    ];
    Capsule::table('program_studis')->insert($prodis);
    echo "[OK] Prodi inserted (17 data).\n";

    // === 4. DATA DOSEN (29 Data - Lengkap dengan Gelar) ===
    $dosens = [
        ['nidn' => '0006058102', 'jurusan_id' => 3, 'nama' => 'Amelia Yolanda, ST., MT', 'jenis_kelamin' => 'P', 'foto' => '0006058102.jpg'],
        ['nidn' => '0006058302', 'jurusan_id' => 3, 'nama' => 'Popy Maria, ST.,MT', 'jenis_kelamin' => 'P', 'foto' => '0006058302.jpg'],
        ['nidn' => '0007016802', 'jurusan_id' => 3, 'nama' => 'Yustini, SST., MT', 'jenis_kelamin' => 'P', 'foto' => '0007016802.jpg'],
        ['nidn' => '0007039304', 'jurusan_id' => 3, 'nama' => 'Ummul Khair, S.T., M.T', 'jenis_kelamin' => 'P', 'foto' => '0007039304.jpg'],
        ['nidn' => '0007047602', 'jurusan_id' => 3, 'nama' => 'Ramiati, ST.,SST.,M.Kom', 'jenis_kelamin' => 'P', 'foto' => '0007047602.jpg'],
        ['nidn' => '0007087701', 'jurusan_id' => 3, 'nama' => 'Dikky Chandra, ST.,MT', 'jenis_kelamin' => 'L', 'foto' => '0007087701.jpg'],
        ['nidn' => '0009046904', 'jurusan_id' => 3, 'nama' => 'Aprinal Adila Asril, ST.,M.Kom', 'jenis_kelamin' => 'L', 'foto' => '0009046904.jpg'],
        ['nidn' => '0009067701', 'jurusan_id' => 3, 'nama' => 'Silfia Rifka, SST, MT.', 'jenis_kelamin' => 'P', 'foto' => '0009067701.jpg'],
        ['nidn' => '0010049210', 'jurusan_id' => 3, 'nama' => 'Sahid Ridho, S.T., M.T.', 'jenis_kelamin' => 'L', 'foto' => '0010049210.jpg'],
        ['nidn' => '0011097202', 'jurusan_id' => 3, 'nama' => 'Andi Ahmad Dahlan, ST., M.Eng', 'jenis_kelamin' => 'L', 'foto' => '0011097202.jpg'],
        ['nidn' => '0012067402', 'jurusan_id' => 3, 'nama' => 'Sri Yusnita, ST.,MT', 'jenis_kelamin' => 'P', 'foto' => '0012067402.jpg'],
        ['nidn' => '0014057908', 'jurusan_id' => 7, 'nama' => 'Sabriandi Erdian, SS.,M.Hum', 'jenis_kelamin' => 'L', 'foto' => '0014057908.jpg'],
        ['nidn' => '0016046801', 'jurusan_id' => 3, 'nama' => 'Dra. Sri Nita, M.Pd', 'jenis_kelamin' => 'P', 'foto' => '0016046801.jpg'],
        ['nidn' => '0018069304', 'jurusan_id' => 3, 'nama' => 'Deri Latika Herda, S.T., M.T.', 'jenis_kelamin' => 'P', 'foto' => '0018069304.jpg'],
        ['nidn' => '0019107605', 'jurusan_id' => 3, 'nama' => 'Ir. Rikki Vitria, S.ST., M.Sc. Eng.', 'jenis_kelamin' => 'L', 'foto' => '0019107605.jpg'],
        ['nidn' => '0022027208', 'jurusan_id' => 3, 'nama' => 'Lifwarda, ST., M.Kom', 'jenis_kelamin' => 'P', 'foto' => '0022027208.jpg'],
        ['nidn' => '0022057705', 'jurusan_id' => 3, 'nama' => 'Firdaus, ST., MT', 'jenis_kelamin' => 'L', 'foto' => '0022057705.jpg'],
        ['nidn' => '0024096804', 'jurusan_id' => 3, 'nama' => 'Uzma Septima, ST.,M.Eng', 'jenis_kelamin' => 'L', 'foto' => '0024096804.jpg'],
        ['nidn' => '0024127804', 'jurusan_id' => 3, 'nama' => 'Firdaus, ST., MT', 'jenis_kelamin' => 'L', 'foto' => '0024127804.jpg'],
        ['nidn' => '0025016906', 'jurusan_id' => 3, 'nama' => 'Zurnawita, ST.,MT', 'jenis_kelamin' => 'P', 'foto' => '0025016906.jpg'],
        ['nidn' => '0025117803', 'jurusan_id' => 3, 'nama' => 'Ihsan Lumasa Rimra, SST.,M.Sc DECN', 'jenis_kelamin' => 'L', 'foto' => '0025117803.jpg'],
        ['nidn' => '0029046406', 'jurusan_id' => 3, 'nama' => 'Dr. Afrizal Yuhanef, ST.,M.Kom', 'jenis_kelamin' => 'L', 'foto' => '0029046406.jpg'],
        ['nidn' => '0029097604', 'jurusan_id' => 3, 'nama' => 'Vera Veronica, ST.,MT', 'jenis_kelamin' => 'P', 'foto' => '0029097604.jpg'],
        ['nidn' => '0029107506', 'jurusan_id' => 3, 'nama' => 'Ratna Dewi, SST., M.Kom', 'jenis_kelamin' => 'P', 'foto' => '0029107506.jpg'],
        ['nidn' => '0030046603', 'jurusan_id' => 3, 'nama' => 'Yulindon, S.T., M.Kom.', 'jenis_kelamin' => 'L', 'foto' => '0030046603.jpg'],
        ['nidn' => '0030116506', 'jurusan_id' => 3, 'nama' => 'Dr. Nasrul, ST.,M.Kom', 'jenis_kelamin' => 'L', 'foto' => '0030116506.jpg'],
        ['nidn' => '0215039501', 'jurusan_id' => 3, 'nama' => 'Muhammad Putra Pamungkas, S.T., M.T.', 'jenis_kelamin' => 'L', 'foto' => '0215039501.jpg'],
        ['nidn' => '1004038801', 'jurusan_id' => 3, 'nama' => 'Siska Aulia, ST.,MT', 'jenis_kelamin' => 'P', 'foto' => '1004038801.jpg'],
        ['nidn' => '1301018802', 'jurusan_id' => 3, 'nama' => 'Herry Setiawan, S.ST., MT', 'jenis_kelamin' => 'L', 'foto' => '1301018802.jpg'],
    ];

    foreach ($dosens as $dosen) {
        // 1. Create User for Dosen (Username: nama_lengkap, Pass: 123)
        $userId = Capsule::table('users')->insertGetId([
            'nama_lengkap' => $dosen['nama'],
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 2. Insert Dosen Data
        Capsule::table('dosens')->insert([
            'nidn' => $dosen['nidn'],
            'jurusan_id' => $dosen['jurusan_id'],
            'nama' => $dosen['nama'],
            'jenis_kelamin' => $dosen['jenis_kelamin'],
            'foto' => $dosen['foto'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    echo "[OK] Dosen & User Akun inserted (" . count($dosens) . " data).\n";

    // === 5. DATA MAHASISWA (78 Data - Sesuai SQL Dump) ===
    $mhsRaw = [
        ['2111071006', 'Ferdiansyah', 'Padang', '2003-07-29', 'L', 2022, 7, '2111071006.jpg'],
        ['2211071001', 'Cindy Juniarti', 'Padang', '2004-06-16', 'P', 2022, 7, '2211071001.jpg'],
        ['2211071002', 'Dhuha Rais', 'Padang', '2003-08-30', 'L', 2022, 7, '2211071002.jpg'],
        ['2211071003', 'Dinda Kurnia Illahi', 'Padang', '2003-01-01', 'P', 2022, 7, '2211071003.jpg'],
        ['2211071004', 'Erin Aulia Rahma', 'Padang', '2002-11-13', 'P', 2022, 7, '2211071004.jpg'],
        ['2211071005', 'Ervin Nawal Andra', 'Padang', '2004-11-21', 'L', 2022, 7, '2211071005.jpg'],
        ['2211071006', 'Fikri Adi Pratama', 'Padang', '2004-01-24', 'L', 2022, 7, '2211071006.jpg'],
        ['2211071008', 'Iqbal Rizantha', 'Padang', '2004-03-11', 'L', 2022, 7, '2211071008.jpg'],
        ['2211071010', 'M. Aqil Hisyam Akbar', 'Padang', '2004-05-03', 'L', 2022, 7, '2211071010.jpg'],
        ['2211071011', 'M. Aqsha Aqrizal', 'Padang', '2003-01-22', 'L', 2022, 7, '2211071011.jpg'],
        ['2211071012', 'M. Rizky Irawan', 'Padang', '2003-01-06', 'L', 2022, 7, '2211071012.jpg'],
        ['2211071013', 'Maulana Alfarizi', 'Padang', '2005-01-15', 'L', 2022, 7, '2211071013.jpg'],
        ['2211071014', 'Mhd. Yadil Ulya', 'Padang', '2004-02-26', 'L', 2022, 7, '2211071014.jpg'],
        ['2211071015', 'Muhammad Zaki', 'Padang', '2004-06-08', 'L', 2022, 7, '2211071015.jpg'],
        ['2211071016', 'Nisa Rahima Sakinah', 'Padang', '2004-04-27', 'P', 2022, 7, '2211071016.jpg'],
        ['2211071017', 'Revandi Jeanifar', 'Padang', '2004-01-25', 'L', 2022, 7, '2211071017.jpg'],
        ['2211071018', 'Rezi Apandi Sitompul', 'Padang', '2004-01-05', 'L', 2022, 7, '2211071018.jpg'],
        ['2211071019', 'Shintia Destrianita', 'Padang', '2003-12-03', 'P', 2022, 7, '2211071019.jpg'],
        ['2211071020', 'Taura Ramadhani', 'Padang', '2003-11-10', 'P', 2022, 7, '2211071020.jpg'],
        ['2211071021', 'Wisra Yandi', 'Padang', '2004-04-12', 'L', 2022, 7, '2211071021.jpg'],
        ['2211071022', 'Ilhamdi', 'Padang', '2003-09-10', 'L', 2022, 7, '2211071022.jpg'],
        ['2211071023', 'Rio Agus Saputra', 'Padang', '2002-08-30', 'L', 2022, 7, '2211071023.jpg'],
        ['2211072001', 'Adinda Aliya Maharani', 'Padang', '2005-03-15', 'P', 2022, 7, '2211072001.jpg'],
        ['2211072002', 'Aisyah Vianda Putri', 'Padang', '2003-04-14', 'P', 2022, 7, '2211072002.jpg'],
        ['2211072003', 'Alfhadila', 'Padang', '2004-01-12', 'L', 2022, 7, '2211072003.jpg'],
        ['2211072004', 'Aliyah Arniz Nagia', 'Padang', '2004-05-15', 'P', 2022, 7, '2211072004.jpg'],
        ['2211072006', 'Ashilah Khairunnisa Putri', 'Padang', '2004-05-16', 'P', 2022, 7, '2211072006.jpg'],
        ['2211072007', 'Budi Mulia', 'Padang', '2003-10-29', 'L', 2022, 7, '2211072007.jpg'],
        ['2211072009', 'Danda Maritsyah Putra', 'Padang', '2004-03-20', 'L', 2022, 7, '2211072009.jpg'],
        ['2211072010', 'Dian Indah Lestari', 'Padang', '2003-10-29', 'P', 2022, 7, '2211072010.jpg'],
        ['2211072011', 'Dipal Irpandi', 'Padang', '2003-09-19', 'L', 2022, 7, '2211072011.jpg'],
        ['2211072012', 'Fawwaz Zahran', 'Padang', '2004-04-07', 'L', 2022, 7, '2211072012.jpg'],
        ['2211072014', 'Lin Fitri Alif Aisyah', 'Padang', '2001-12-16', 'P', 2022, 7, '2211072014.jpg'],
        ['2211072015', 'Aidil Safitra', 'Padang', '2002-02-16', 'L', 2022, 7, '2211072015.jpg'],
        ['2211072016', 'Muhammad Aulia Zaki', 'Padang', '2004-05-06', 'L', 2022, 7, '2211072016.jpg'],
        ['2211072017', 'Muhammad Nur Fadly', 'Padang', '2003-07-12', 'L', 2022, 7, '2211072017.jpg'],
        ['2211072018', 'Najip Nesta', 'Padang', '2004-06-10', 'L', 2022, 7, '2211072018.jpg'],
        ['2211072019', 'Najla Raiqah Luthfiah', 'Padang', '2004-03-03', 'P', 2022, 7, '2211072019.jpg'],
        ['2211072021', 'Nurwahid Fil Qodri', 'Padang', '2004-01-06', 'L', 2022, 7, '2211072021.jpg'],
        ['2211072022', 'Rindu Zulhimi Qolbu', 'Padang', '2004-02-10', 'P', 2022, 7, '2211072022.jpg'],
        ['2211072023', 'Shalma Zopi Habibah', 'Padang', '2004-12-01', 'P', 2022, 7, '2211072023.jpg'],
        ['2211072024', 'Siti Aisyah Aliyah', 'Padang', '2005-01-18', 'P', 2022, 7, '2211072024.jpg'],
        ['2211072025', 'Dani Adzmi', 'Padang', '2003-12-06', 'L', 2022, 7, '2211072025.jpg'],
        ['2211072027', 'Mutiara Muthmainnah Nasution', 'Padang', '2002-05-17', 'P', 2022, 7, '2211072027.jpg'],
        ['2211072028', 'Nabil Fajri', 'Padang', '2004-09-10', 'L', 2022, 7, '2211072028.jpg'],
        ['2211072030', 'Salsa Bila', 'Padang', '2004-03-13', 'P', 2022, 7, '2211072030.jpg'],
        ['2211073001', 'Alif Bintang Al Ikhlas', 'Padang', '2003-05-22', 'L', 2022, 7, '2211073001.jpg'],
        ['2211073002', 'Evan Adicandra', 'Padang', '2004-08-28', 'L', 2022, 7, '2211073002.jpg'],
        ['2211073003', 'Miftahul Hamdi', 'Padang', '2004-08-02', 'L', 2022, 7, '2211073003.jpg'],
        ['2211073004', 'Muhammad Erlangga', 'Padang', '2004-05-05', 'L', 2022, 7, '2211073004.jpg'],
        ['2211073005', 'Muhammad Yudis Afriansyah Saputra', 'Padang', '2003-07-14', 'L', 2022, 7, '2211073005.jpg'],
        ['2211073006', 'Ramanda Grace Aulia', 'Padang', '2003-12-23', 'P', 2022, 7, '2211073006.jpg'],
        ['2211073007', 'Wendra Satria Utama', 'Padang', '2004-04-16', 'L', 2022, 7, '2211073007.jpg'],
        ['2211073009', 'Viony Monica', 'Padang', '2004-06-04', 'P', 2022, 7, '2211073009.jpg'],
        ['2211073010', 'Yola Febrilla', 'Padang', '2004-02-09', 'P', 2022, 7, '2211073010.jpg'],
        ['2211073011', 'Afif Ainur Rafiq', 'Padang', '2004-07-05', 'L', 2022, 7, '2211073011.jpg'],
        ['2211073012', 'Ariq Muzakki', 'Padang', '2004-05-14', 'L', 2022, 7, '2211073012.jpg'],
        ['2211073013', 'Khoirul Yazid', 'Padang', '2003-09-12', 'L', 2022, 7, '2211073013.jpg'],
        ['2211073014', 'M. Affandi', 'Padang', '2003-08-12', 'L', 2022, 7, '2211073014.jpg'],
        ['2211073015', 'M. Ravi Setiawan P.C', 'Padang', '2003-04-23', 'L', 2022, 7, '2211073015.jpg'],
        ['2211073017', 'Muhammad Rafif', 'Padang', '2003-08-01', 'L', 2022, 7, '2211073017.jpg'],
        ['2211073018', 'Raihan Riyon Pratama', 'Padang', '2002-10-05', 'L', 2022, 7, '2211073018.jpg'],
        ['2211073019', 'Rama Ihya Ulumuddin', 'Padang', '2002-12-03', 'L', 2022, 7, '2211073019.jpg'],
        ['2211073020', 'Sultha Redysa', 'Padang', '2004-09-20', 'L', 2022, 7, '2211073020.jpg'],
        ['2211073021', 'Tsabitah Hanum', 'Padang', '2005-01-29', 'P', 2022, 7, '2211073021.jpg'],
        ['2211073022', 'Zahra Haiva Meydina', 'Padang', '2003-05-12', 'P', 2022, 7, '2211073022.jpg'],
        ['2211073023', 'Andhika Fachrurriadi', 'Padang', '2003-07-15', 'L', 2022, 7, '2211073023.jpg'],
        ['2211073024', 'Andika Putra', 'Padang', '2003-10-20', 'L', 2022, 7, '2211073024.jpg'],
        ['2211073025', 'Maya Dwi Anita', 'Padang', '2004-05-02', 'P', 2022, 7, '2211073025.jpg'],
        ['2211073026', 'Meidina Agnesia', 'Padang', '2004-05-25', 'P', 2022, 7, '2211073026.jpg'],
        ['2211073027', 'Muhamad Ilham', 'Padang', '2001-10-21', 'L', 2022, 7, '2211073027.jpg'],
        ['2211073028', 'Naia Az - Zahra', 'Padang', '2004-06-19', 'P', 2022, 7, '2211073028.jpg'],
        ['2211073030', 'Putri Aulia Rahmi', 'Padang', '2003-03-29', 'P', 2022, 7, '2211073030.jpg'],
        ['2211073031', 'Ranik Jintan', 'Padang', '2004-10-03', 'P', 2022, 7, '2211073031.jpg'],
        ['2211073032', 'Riska Andini', 'Padang', '2003-08-13', 'P', 2022, 7, '2211073032.jpg'],
        ['2211073033', 'Sri Mailani', 'Padang', '2004-05-14', 'P', 2022, 7, '2211073033.jpg'],
        ['2211073034', 'Tri Sukma Afani', 'Padang', '2004-03-28', 'P', 2022, 7, '2211073034.jpg'],
        ['2211073035', 'Wildan Zahky', 'Padang', '2003-09-26', 'L', 2022, 7, '2211073035.jpg'],
    ];

    $count = 0;
    foreach ($mhsRaw as $m) {
        [$nim, $nama, $tmpLahir, $tglLahir, $jk, $angkatan, $smt, $foto] = $mhs;

        // ----------------------------------------------------
        // LOGIKA PENENTUAN KELAS BERDASARKAN NIM
        // ----------------------------------------------------
        // Ambil digit ke-7 (index 6). Contoh: 221107[1]001
        $kodeKelas = substr($nim, 6, 1); 
        
        $kelas = '3A'; // Default
        if ($kodeKelas == '1') $kelas = '3A';
        elseif ($kodeKelas == '2') $kelas = '3B';
        elseif ($kodeKelas == '3') $kelas = '3C';

        // 1. Create User for Mahasiswa (Username: nama_lengkap, Pass: 123)
        $userId = Capsule::table('users')->insertGetId([
            'nama_lengkap' => $m[1],
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 2. Insert Mahasiswa Data
        Capsule::table('mahasiswas')->insert([
            'nim' => $m[0],
            'user_id' => $userId,
            'nama' => $m[1],
            'tempat_lahir' => $m[2],
            'tanggal_lahir' => $m[3],
            'jenis_kelamin' => $m[4],
            'prodi_id' => $m[6],
            'angkatan' => $m[5],
            'kelas_profil' => $kelas,
            'semester_aktif' => 5, // Semester 5 untuk angkatan 2022
            'foto' => $m[7],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    echo "[OK] Mahasiswa & User Akun inserted (" . count($mhsRaw) . " data).\n";

    // === 6. TAHUN AKADEMIK (2 Data) ===
    $thId = Capsule::table('tahun_akademiks')->insertGetId([
        'kode' => '20241',
        'nama' => 'Semester Ganjil 2024/2025',
        'tahun' => '2024/2025',
        'semester' => 'Ganjil',
        'tanggal_mulai' => '2024-08-19',
        'tanggal_selesai' => '2025-01-06',
        'is_aktif' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    // Insert TA Lama (Arsip)
    Capsule::table('tahun_akademiks')->insert([
        'kode' => '20232',
        'nama' => 'Semester Genap 2023/2024',
        'tahun' => '2023/2024',
        'semester' => 'Genap',
        'tanggal_mulai' => '2024-02-19',
        'tanggal_selesai' => '2024-07-20',
        'is_aktif' => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    echo "[OK] Tahun Akademik inserted (2 data).\n";

    // === 7. MATAKULIAH (15 Data - Sesuai SQL Dump) ===
    $mks = [
        ['id' => 1, 'kode_mk' => 'TCE4106', 'nama_mk' => 'Bahasa Inggris 2', 'sks' => 2, 'semester_paket' => 4, 'prodi_id' => 7],
        ['id' => 2, 'kode_mk' => 'TCE4218', 'nama_mk' => 'Rangkaian Elektronika Telekomunikasi', 'sks' => 3, 'semester_paket' => 4, 'prodi_id' => 7],
        ['id' => 3, 'kode_mk' => 'TCE4219', 'nama_mk' => 'Teori dan Perancangan Antena', 'sks' => 2, 'semester_paket' => 4, 'prodi_id' => 7],
        ['id' => 4, 'kode_mk' => 'TCE4220', 'nama_mk' => 'Sistem Komunikasi Serat Optik', 'sks' => 4, 'semester_paket' => 4, 'prodi_id' => 7],
        ['id' => 5, 'kode_mk' => 'TCE4223', 'nama_mk' => 'Jaringan Radio Akses', 'sks' => 4, 'semester_paket' => 4, 'prodi_id' => 7],
        ['id' => 6, 'kode_mk' => 'TCE4229', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester_paket' => 4, 'prodi_id' => 7],
        ['id' => 7, 'kode_mk' => 'TCE4232', 'nama_mk' => 'Sistem Tertanam', 'sks' => 3, 'semester_paket' => 4, 'prodi_id' => 7],
        ['id' => 8, 'kode_mk' => 'TCE4107', 'nama_mk' => 'Bahasa Inggris 3', 'sks' => 2, 'semester_paket' => 5, 'prodi_id' => 7],
        ['id' => 9, 'kode_mk' => 'TCE4221', 'nama_mk' => 'Aplikasi Pengolahan Sinyal', 'sks' => 3, 'semester_paket' => 5, 'prodi_id' => 7],
        ['id' => 10, 'kode_mk' => 'TCE4224', 'nama_mk' => 'Rekayasa Frekuensi Radio', 'sks' => 4, 'semester_paket' => 5, 'prodi_id' => 7],
        ['id' => 11, 'kode_mk' => 'TCE4225', 'nama_mk' => 'Manajemen Telekomunikasi', 'sks' => 2, 'semester_paket' => 5, 'prodi_id' => 7],
        ['id' => 12, 'kode_mk' => 'TCE4230', 'nama_mk' => 'Komunikasi Data', 'sks' => 3, 'semester_paket' => 5, 'prodi_id' => 7],
        ['id' => 13, 'kode_mk' => 'TCE4231', 'nama_mk' => 'Teknik Penyambungan', 'sks' => 3, 'semester_paket' => 5, 'prodi_id' => 7],
        ['id' => 14, 'kode_mk' => 'TCE4234', 'nama_mk' => 'Pemrograman Internet', 'sks' => 2, 'semester_paket' => 5, 'prodi_id' => 7],
        ['id' => 15, 'kode_mk' => 'TCE4307', 'nama_mk' => 'Metoda Penelitian dan Penulisan Ilmiah', 'sks' => 2, 'semester_paket' => 5, 'prodi_id' => 7],
    ];

    foreach ($mks as $mk) {
        Capsule::table('matakuliahs')->insert([
            'id' => $mk['id'],
            'kode_mk' => $mk['kode_mk'],
            'nama_mk' => $mk['nama_mk'],
            'sks' => $mk['sks'],
            'semester_paket' => $mk['semester_paket'],
            'prodi_id' => $mk['prodi_id'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    echo "[OK] Matakuliah inserted (15 data).\n";

    // === 8. RUANGAN (1 Data Dummy) ===
    $ruangId = Capsule::table('ruangans')->insertGetId([
        'kode_ruang' => 'CR-01',
        'nama_ruang' => 'Classroom 01',
        'kapasitas' => 40,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    echo "[OK] Ruangan inserted (1 data).\n";

    // === 9. JADWAL KELAS (36 Data - Mapping dari kelas_dosen) ===
    $jadwals = [
        // Kelas III.A (11 jadwal)
        ['id' => 1, 'mk' => 8, 'dsn' => '0014057908', 'kls' => 'III.A', 'hari' => 'Senin', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 2, 'mk' => 9, 'dsn' => '0009067701', 'kls' => 'III.A', 'hari' => 'Senin', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 3, 'mk' => 9, 'dsn' => '0007039304', 'kls' => 'III.A', 'hari' => 'Selasa', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 4, 'mk' => 10, 'dsn' => '0012067402', 'kls' => 'III.A', 'hari' => 'Selasa', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 5, 'mk' => 10, 'dsn' => '1004038801', 'kls' => 'III.A', 'hari' => 'Rabu', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 6, 'mk' => 11, 'dsn' => '0006058302', 'kls' => 'III.A', 'hari' => 'Rabu', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 7, 'mk' => 12, 'dsn' => '0011097202', 'kls' => 'III.A', 'hari' => 'Kamis', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 8, 'mk' => 13, 'dsn' => '0010049210', 'kls' => 'III.A', 'hari' => 'Kamis', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 9, 'mk' => 14, 'dsn' => '0029107506', 'kls' => 'III.A', 'hari' => 'Jumat', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 10, 'mk' => 14, 'dsn' => '0007047602', 'kls' => 'III.A', 'hari' => 'Jumat', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 11, 'mk' => 15, 'dsn' => '0030116506', 'kls' => 'III.A', 'hari' => 'Sabtu', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],

        // Kelas III.B (12 jadwal)
        ['id' => 12, 'mk' => 8, 'dsn' => '0014057908', 'kls' => 'III.B', 'hari' => 'Senin', 'mulai' => '13:00:00', 'selesai' => '15:00:00'],
        ['id' => 13, 'mk' => 9, 'dsn' => '0009067701', 'kls' => 'III.B', 'hari' => 'Senin', 'mulai' => '15:00:00', 'selesai' => '17:00:00'],
        ['id' => 14, 'mk' => 9, 'dsn' => '0018069304', 'kls' => 'III.B', 'hari' => 'Selasa', 'mulai' => '13:00:00', 'selesai' => '15:00:00'],
        ['id' => 15, 'mk' => 10, 'dsn' => '0029046406', 'kls' => 'III.B', 'hari' => 'Selasa', 'mulai' => '15:00:00', 'selesai' => '17:00:00'],
        ['id' => 16, 'mk' => 10, 'dsn' => '0215039501', 'kls' => 'III.B', 'hari' => 'Rabu', 'mulai' => '13:00:00', 'selesai' => '15:00:00'],
        ['id' => 17, 'mk' => 11, 'dsn' => '0006058302', 'kls' => 'III.B', 'hari' => 'Rabu', 'mulai' => '15:00:00', 'selesai' => '17:00:00'],
        ['id' => 18, 'mk' => 12, 'dsn' => '0025117803', 'kls' => 'III.B', 'hari' => 'Kamis', 'mulai' => '13:00:00', 'selesai' => '15:00:00'],
        ['id' => 19, 'mk' => 12, 'dsn' => '1301018802', 'kls' => 'III.B', 'hari' => 'Kamis', 'mulai' => '15:00:00', 'selesai' => '17:00:00'],
        ['id' => 20, 'mk' => 13, 'dsn' => '0025016906', 'kls' => 'III.B', 'hari' => 'Jumat', 'mulai' => '13:00:00', 'selesai' => '15:00:00'],
        ['id' => 21, 'mk' => 14, 'dsn' => '0011097202', 'kls' => 'III.B', 'hari' => 'Jumat', 'mulai' => '15:00:00', 'selesai' => '17:00:00'],
        ['id' => 22, 'mk' => 14, 'dsn' => '1301018802', 'kls' => 'III.B', 'hari' => 'Sabtu', 'mulai' => '13:00:00', 'selesai' => '15:00:00'],
        ['id' => 23, 'mk' => 15, 'dsn' => '0030116506', 'kls' => 'III.B', 'hari' => 'Sabtu', 'mulai' => '15:00:00', 'selesai' => '17:00:00'],

        // Kelas III.A Tambahan (1 jadwal)
        ['id' => 24, 'mk' => 12, 'dsn' => '1301018802', 'kls' => 'III.A', 'hari' => 'Sabtu', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],

        // Kelas III.C (12 jadwal)
        ['id' => 25, 'mk' => 8, 'dsn' => '0014057908', 'kls' => 'III.C', 'hari' => 'Senin', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 26, 'mk' => 9, 'dsn' => '0025016906', 'kls' => 'III.C', 'hari' => 'Senin', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 27, 'mk' => 9, 'dsn' => '0006058302', 'kls' => 'III.C', 'hari' => 'Selasa', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 28, 'mk' => 10, 'dsn' => '0007087701', 'kls' => 'III.C', 'hari' => 'Selasa', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 29, 'mk' => 10, 'dsn' => '0025016906', 'kls' => 'III.C', 'hari' => 'Rabu', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 30, 'mk' => 11, 'dsn' => '0007087701', 'kls' => 'III.C', 'hari' => 'Rabu', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 31, 'mk' => 12, 'dsn' => '0011097202', 'kls' => 'III.C', 'hari' => 'Kamis', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 32, 'mk' => 12, 'dsn' => '0007039304', 'kls' => 'III.C', 'hari' => 'Kamis', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 33, 'mk' => 13, 'dsn' => '0010049210', 'kls' => 'III.C', 'hari' => 'Jumat', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 34, 'mk' => 14, 'dsn' => '0009067701', 'kls' => 'III.C', 'hari' => 'Jumat', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
        ['id' => 35, 'mk' => 14, 'dsn' => '1301018802', 'kls' => 'III.C', 'hari' => 'Sabtu', 'mulai' => '08:00:00', 'selesai' => '10:00:00'],
        ['id' => 36, 'mk' => 15, 'dsn' => '0030046603', 'kls' => 'III.C', 'hari' => 'Sabtu', 'mulai' => '10:00:00', 'selesai' => '12:00:00'],
    ];

    foreach ($jadwals as $jadwal) {
        Capsule::table('jadwal_kelas')->insert([
            'id' => $jadwal['id'],
            'tahun_akademik_id' => $thId,
            'matakuliah_id' => $jadwal['mk'],
            'dosen_id' => $jadwal['dsn'],
            'ruangan_id' => $ruangId,
            'nama_kelas' => $jadwal['kls'],
            'hari' => $jadwal['hari'],
            'jam_mulai' => $jadwal['mulai'],
            'jam_selesai' => $jadwal['selesai'],
            'kuota' => 40,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    echo "[OK] Jadwal Kelas inserted (36 data).\n";

    // === 10. KRS (Mapping dari kelas_mahasiswa - 78 mahasiswa x jadwal kelasnya) ===
    $kelasMhs = [
        ['kls' => 'III.A', 'nims' => ['2211071001', '2211071002', '2211071004', '2211071005', '2211071006', '2211071008', '2211071010', '2211072002', '2211072003', '2211072004', '2211072006', '2211072007', '2211072009', '2211072011', '2211073001', '2211073002', '2211073003', '2211073004', '2211073005', '2211073006', '2211073007', '2211073009', '2211073010', '2211073021', '2211072001', '2211071003']],
        ['kls' => 'III.B', 'nims' => ['2211071011', '2211071012', '2211071013', '2211071014', '2211071015', '2211071016', '2211072010', '2211072012', '2211072014', '2211072015', '2211072016', '2211072017', '2211072019', '2211072022', '2211073012', '2211073013', '2211073014', '2211073015', '2211073017', '2211073018', '2211073019', '2211073025', '2211073026', '2211073028', '2211073030']],
        ['kls' => 'III.C', 'nims' => ['2111071006', '2211071017', '2211071019', '2211071020', '2211071022', '2211071023', '2211072018', '2211072021', '2211072023', '2211072024', '2211072025', '2211072027', '2211072028', '2211072030', '2211073020', '2211073022', '2211073023', '2211073024', '2211073027', '2211073031', '2211073033', '2211073034', '2211073035', '2211071018', '2211073011', '2211071021', '2211073032']]
    ];

    $countKrs = 0;
    foreach ($kelasMhs as $group) {
        // Ambil ID jadwal untuk kelas ini
        $jadwalIds = Capsule::table('jadwal_kelas')
            ->where('nama_kelas', $group['kls'])
            ->pluck('id')
            ->toArray();

        foreach ($group['nims'] as $nim) {
            foreach ($jadwalIds as $jid) {
                // Cek duplikasi
                $exists = Capsule::table('krs')
                    ->where('nim', $nim)
                    ->where('jadwal_kelas_id', $jid)
                    ->exists();

                if (!$exists) {
                    Capsule::table('krs')->insert([
                        'nim' => $nim,
                        'jadwal_kelas_id' => $jid,
                        'nilai_angka' => 0,
                        'nilai_huruf' => null,
                        'bobot' => null,
                        'is_disetujui' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    $countKrs++;
                }
            }
        }
    }
    echo "[OK] KRS inserted ($countKrs data).\n";

    echo "\n==========================================================\n";
    echo "   ✅ RESTORE SELESAI!                                    \n";
    echo "==========================================================\n";
    echo "\nRINGKASAN DATA:\n";
    echo "- Jurusan: 7 data\n";
    echo "- Program Studi: 17 data\n";
    echo "- Dosen: 29 data (+ 29 user akun)\n";
    echo "- Mahasiswa: 78 data (+ 78 user akun)\n";
    echo "- Tahun Akademik: 2 data\n";
    echo "- Matakuliah: 15 data\n";
    echo "- Ruangan: 1 data\n";
    echo "- Jadwal Kelas: 36 data\n";
    echo "- KRS: $countKrs data\n";
    echo "\n==========================================================\n";
    echo "PANDUAN LOGIN:\n";
    echo "==========================================================\n";
    echo "MAHASISWA:\n";
    echo "  Username: [Nama Lengkap Mahasiswa]\n";
    echo "  Password: 123\n";
    echo "  Contoh: Cindy Juniarti / 123\n";
    echo "\nDOSEN:\n";
    echo "  Username: [Nama Lengkap Dosen]\n";
    echo "  Password: 123\n";
    echo "  Contoh: Sabriandi Erdian, SS.,M.Hum / 123\n";
    echo "==========================================================\n";
} catch (\Exception $e) {
    echo "\n❌ GAGAL: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
