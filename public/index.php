<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require '../vendor/autoload.php';
require '../config/database.php';

function redirect($page, $type = 'error', $message = '') {
    if (!empty($message)) {
        $_SESSION[$type] = $message;
    }
    header("Location: index.php?page=$page");
    exit;
}

function checkAuth() {
    if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
        redirect('login', 'error', 'Silakan login terlebih dahulu!');
    }
}

$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

$publicPages = ['login', 'register', 'auth_login', 'auth_register'];

if (!in_array($page, $publicPages)) {
    checkAuth();
}

try {
    switch ($page) {
        // === AUTH PAGES ===
        case 'login':
            if (isset($_SESSION['is_login'])) redirect('dashboard');
            require '../views/auth/login.php';
            break;
        
        case 'register':
            if (isset($_SESSION['is_login'])) redirect('dashboard');
            require '../views/auth/register.php';
            break;

        case 'auth_login':
            if (isset($_SESSION['is_login'])) redirect('dashboard');
            $controller = new App\Controllers\AuthController();
            $controller->login();
            break;

        case 'auth_register':
            if (isset($_SESSION['is_login'])) redirect('dashboard');
            $controller = new App\Controllers\AuthController();
            $controller->register();
            break;

        case 'logout':
            session_destroy();
            redirect('login', 'success', 'Anda telah berhasil logout.');
            break;

        // === DASHBOARD ===
        case 'dashboard':
            $controller = new App\Controllers\DashboardController();
            $controller->index();
            break;

        // === KRS ===
        case 'krs':
            $controller = new App\Controllers\KrsController();
            switch ($action) {
                case 'tambah': $controller->tambah(); break;
                case 'store': $controller->store(); break;
                case 'hapus': $controller->hapus(); break;
                default: $controller->index();
            }
            break;

        // === JADWAL ===
        case 'jadwal':
            $controller = new App\Controllers\JadwalController();
            $controller->index();
            break;

        // === NILAI ===
        case 'nilai':
            $controller = new App\Controllers\NilaiController();
            $controller->index();
            break;

        // === PROFIL ===
        case 'profil':
            $controller = new App\Controllers\ProfilController();
            switch ($action) {
                case 'update': $controller->update(); break;
                case 'change_password': $controller->changePassword(); break;
                default: $controller->index();
            }
            break;

        // === ADMIN ===
        case 'admin':
            $controller = new App\Controllers\AdminController();
            switch ($action) {
                case 'store_dosen': $controller->storeDosen(); break;
                case 'delete_dosen': $controller->deleteDosen(); break;
                case 'store_mhs': $controller->storeMahasiswa(); break;
                case 'delete_mhs': $controller->deleteMahasiswa(); break;
                case 'store_mk': $controller->storeMatakuliah(); break;
                case 'delete_mk': $controller->deleteMatakuliah(); break;
                case 'store_ruangan': $controller->storeRuangan(); break;
                case 'delete_ruangan': $controller->deleteRuangan(); break;
                default: $controller->index();
            }
            break;

        // === 404 ===
        default:
            http_response_code(404);
            $errorTitle = "404 - Halaman Tidak Ditemukan";
            $errorMessage = "Maaf, halaman yang Anda cari tidak tersedia.";
            require '../views/errors/404.php';
            break;
    }

} catch (\Exception $e) {
    error_log("Application Error: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    
    http_response_code(500);
    $errorTitle = "500 - Terjadi Kesalahan";
    $errorMessage = "Terjadi kesalahan pada sistem. Silakan coba lagi nanti.";
    
    if (getenv('APP_ENV') === 'development' || !getenv('APP_ENV')) {
        $errorMessage .= "<br><br><strong>Detail Error:</strong><br>" . $e->getMessage();
    }
    
    require '../views/errors/500.php';
}