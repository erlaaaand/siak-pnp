<?php
require_once '../vendor/autoload.php';
require_once '../config/database.php';

use App\Models\User;
use App\Models\Mahasiswa;

$namaInput = $_POST['nama_lengkap'];
$passInput = $_POST['password'];

// 1. Cek apakah Nama ini ada di database Mahasiswa?
$mhs = Mahasiswa::where('nama', $namaInput)->first();

if (!$mhs) {
    die("Maaf, Nama Anda tidak terdaftar sebagai Mahasiswa di sistem akademik. Hubungi Admin.");
}

// 2. Cek apakah Mahasiswa ini sudah punya akun?
if ($mhs->user_id != null) {
    die("Anda sudah memiliki akun! Silakan login.");
}

// 3. Jika Valid: Buat User Baru
try {
    // Mulai Database Transaction (Biar aman)
    Illuminate\Database\Capsule\Manager::connection()->beginTransaction();

    $user = User::create([
        'nama_lengkap' => $namaInput,
        'password'     => password_hash($passInput, PASSWORD_BCRYPT)
    ]);

    // 4. Update tabel Mahasiswa: Sambungkan ID User ke Mahasiswa
    $mhs->user_id = $user->id;
    $mhs->save();

    Illuminate\Database\Capsule\Manager::connection()->commit();
    
    echo "Registrasi Berhasil! Data akademik Anda telah terhubung otomatis.";
    header("refresh:2;url=login.php");

} catch (\Exception $e) {
    Illuminate\Database\Capsule\Manager::connection()->rollBack();
    echo "Terjadi kesalahan: " . $e->getMessage();
}