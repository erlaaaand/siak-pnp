<?php
//app/Controllers/ProfilController.php
namespace App\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Database\Capsule\Manager as DB;

class ProfilController {
    
    public function index() {
        $nim = $_SESSION['nim'];
        $mahasiswa = Mahasiswa::with(['prodi.jurusan', 'user'])->find($nim);

        require '../views/profil/index.php';
    }

    public function update() {
        $nim = $_SESSION['nim'];
        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            $_SESSION['error'] = "Data mahasiswa tidak ditemukan!";
            header("Location: index.php?page=profil");
            return;
        }

        // Update data yang diizinkan
        $mahasiswa->tempat_lahir = $_POST['tempat_lahir'] ?? $mahasiswa->tempat_lahir;
        $mahasiswa->tanggal_lahir = $_POST['tanggal_lahir'] ?? $mahasiswa->tanggal_lahir;

        try {
            $mahasiswa->save();
            $_SESSION['success'] = "Profil berhasil diperbarui!";
        } catch (\Exception $e) {
            $_SESSION['error'] = "Gagal memperbarui profil: " . $e->getMessage();
        }

        header("Location: index.php?page=profil");
    }

    public function changePassword() {
        $nim = $_SESSION['nim'];
        $mahasiswa = Mahasiswa::with('user')->find($nim);

        $oldPassword = $_POST['old_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validasi
        if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
            $_SESSION['error'] = "Semua field harus diisi!";
            header("Location: index.php?page=profil");
            return;
        }

        if (!password_verify($oldPassword, $mahasiswa->user->password)) {
            $_SESSION['error'] = "Password lama salah!";
            header("Location: index.php?page=profil");
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = "Password baru dan konfirmasi tidak cocok!";
            header("Location: index.php?page=profil");
            return;
        }

        if (strlen($newPassword) < 6) {
            $_SESSION['error'] = "Password minimal 6 karakter!";
            header("Location: index.php?page=profil");
            return;
        }

        try {
            $mahasiswa->user->password = password_hash($newPassword, PASSWORD_BCRYPT);
            $mahasiswa->user->save();
            $_SESSION['success'] = "Password berhasil diubah!";
        } catch (\Exception $e) {
            $_SESSION['error'] = "Gagal mengubah password: " . $e->getMessage();
        }

        header("Location: index.php?page=profil");
    }
}