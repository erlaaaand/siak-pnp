<?php
// login_process.php
use App\Models\User;

$namaInput = $_POST['nama_lengkap'];
$passInput = $_POST['password'];

// Cari user berdasarkan nama
$user = User::where('nama_lengkap', $namaInput)->first();

if ($user && password_verify($passInput, $user->password)) {
    // Validasi tambahan: Pastikan dia benar-benar terhubung ke data mahasiswa
    if (!$user->mahasiswa) {
        die("Akun user ada, tapi data mahasiswa tidak ditemukan (Error Data).");
    }

    // Set Session
    $_SESSION['is_login'] = true;
    $_SESSION['user_id']  = $user->id;
    $_SESSION['nim']      = $user->mahasiswa->nim; // Simpan NIM di session biar gampang query nilai
    $_SESSION['nama']     = $user->nama_lengkap;

    header("Location: dashboard.php");
} else {
    echo "Nama atau Password salah.";
}