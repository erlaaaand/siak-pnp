<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Capsule\Manager as DB;

class AuthController {
    
    public function login() {
        $namaInput = $_POST['nama_lengkap'] ?? '';
        $passInput = $_POST['password'] ?? '';

        if (empty($namaInput) || empty($passInput)) {
            $_SESSION['error'] = "Nama dan password harus diisi!";
            header("Location: index.php?page=login");
            return;
        }

        // Cari user berdasarkan nama
        $user = User::where('nama_lengkap', $namaInput)->first();

        if ($user && password_verify($passInput, $user->password)) {
            // Validasi tambahan: Pastikan dia benar-benar terhubung ke data mahasiswa
            if (!$user->mahasiswa) {
                $_SESSION['error'] = "Akun user ada, tapi data mahasiswa tidak ditemukan.";
                header("Location: index.php?page=login");
                return;
            }

            // Set Session
            $_SESSION['is_login'] = true;
            $_SESSION['user_id']  = $user->id;
            $_SESSION['nim']      = $user->mahasiswa->nim;
            $_SESSION['nama']     = $user->nama_lengkap;

            header("Location: index.php?page=dashboard");
        } else {
            $_SESSION['error'] = "Nama atau Password salah!";
            header("Location: index.php?page=login");
        }
    }

    public function register() {
        $namaInput = $_POST['nama_lengkap'] ?? '';
        $passInput = $_POST['password'] ?? '';
        $confirmPass = $_POST['confirm_password'] ?? '';

        // Validasi input
        if (empty($namaInput) || empty($passInput)) {
            $_SESSION['error'] = "Semua field harus diisi!";
            header("Location: index.php?page=register");
            return;
        }

        if ($passInput !== $confirmPass) {
            $_SESSION['error'] = "Password dan konfirmasi password tidak cocok!";
            header("Location: index.php?page=register");
            return;
        }

        if (strlen($passInput) < 6) {
            $_SESSION['error'] = "Password minimal 6 karakter!";
            header("Location: index.php?page=register");
            return;
        }

        // 1. Cek apakah Nama ini ada di database Mahasiswa?
        $mhs = Mahasiswa::where('nama', $namaInput)->first();

        if (!$mhs) {
            $_SESSION['error'] = "Nama Anda tidak terdaftar sebagai Mahasiswa di sistem akademik. Hubungi Admin.";
            header("Location: index.php?page=register");
            return;
        }

        // 2. Cek apakah Mahasiswa ini sudah punya akun?
        if ($mhs->user_id != null) {
            $_SESSION['error'] = "Anda sudah memiliki akun! Silakan login.";
            header("Location: index.php?page=register");
            return;
        }

        // 3. Jika Valid: Buat User Baru
        try {
            DB::connection()->beginTransaction();

            $user = User::create([
                'nama_lengkap' => $namaInput,
                'password'     => password_hash($passInput, PASSWORD_BCRYPT)
            ]);

            // 4. Update tabel Mahasiswa: Sambungkan ID User ke Mahasiswa
            $mhs->user_id = $user->id;
            $mhs->save();

            DB::connection()->commit();
            
            $_SESSION['success'] = "Registrasi Berhasil! Silakan login.";
            header("Location: index.php?page=login");

        } catch (\Exception $e) {
            DB::connection()->rollBack();
            $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
            header("Location: index.php?page=register");
        }
    }
}