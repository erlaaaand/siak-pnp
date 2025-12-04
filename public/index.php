<?php
// Aktifkan error reporting untuk development
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require '../vendor/autoload.php';
require '../config/database.php';

// Fungsi untuk redirect dengan pesan
function redirect($page, $type = 'error', $message = '') {
    if (!empty($message)) {
        $_SESSION[$type] = $message;
    }
    header("Location: index.php?page=$page");
    exit;
}

// Fungsi untuk cek autentikasi
function checkAuth() {
    if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
        redirect('login', 'error', 'Silakan login terlebih dahulu!');
    }
}

// Ambil parameter page dan action
$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

// Whitelist halaman publik (tidak perlu login)
$publicPages = ['login', 'register', 'auth_login', 'auth_register'];

// Cek autentikasi untuk halaman yang memerlukan login
if (!in_array($page, $publicPages)) {
    checkAuth();
}

try {
    // Routing dengan switch
    switch ($page) {
        // === AUTH PAGES ===
        case 'login':
            if (isset($_SESSION['is_login'])) {
                redirect('dashboard');
            }
            require '../views/auth/login.php';
            break;
        
        case 'register':
            if (isset($_SESSION['is_login'])) {
                redirect('dashboard');
            }
            require '../views/auth/register.php';
            break;

        case 'auth_login':
            if (isset($_SESSION['is_login'])) {
                redirect('dashboard');
            }
            require '../app/Controllers/AuthController.php';
            $controller = new App\Controllers\AuthController();
            $controller->login();
            break;

        case 'auth_register':
            if (isset($_SESSION['is_login'])) {
                redirect('dashboard');
            }
            require '../app/Controllers/AuthController.php';
            $controller = new App\Controllers\AuthController();
            $controller->register();
            break;

        case 'logout':
            session_destroy();
            redirect('login', 'success', 'Anda telah berhasil logout.');
            break;

        // === DASHBOARD ===
        case 'dashboard':
            require '../app/Controllers/DashboardController.php';
            $controller = new App\Controllers\DashboardController();
            $controller->index();
            break;

        // === KRS ===
        case 'krs':
            require '../app/Controllers/KrsController.php';
            $controller = new App\Controllers\KrsController();
            
            switch ($action) {
                case 'tambah':
                    $controller->tambah();
                    break;
                case 'store':
                    $controller->store();
                    break;
                case 'hapus':
                    $controller->hapus();
                    break;
                default:
                    $controller->index();
            }
            break;

        // === JADWAL ===
        case 'jadwal':
            require '../app/Controllers/JadwalController.php';
            $controller = new App\Controllers\JadwalController();
            $controller->index();
            break;

        // === NILAI ===
        case 'nilai':
            require '../app/Controllers/NilaiController.php';
            $controller = new App\Controllers\NilaiController();
            $controller->index();
            break;

        // === PROFIL ===
        case 'profil':
            require '../app/Controllers/ProfilController.php';
            $controller = new App\Controllers\ProfilController();
            
            switch ($action) {
                case 'update':
                    $controller->update();
                    break;
                case 'change_password':
                    $controller->changePassword();
                    break;
                default:
                    $controller->index();
            }
            break;

        // === 404 PAGE ===
        default:
            http_response_code(404);
            $errorTitle = "404 - Halaman Tidak Ditemukan";
            $errorMessage = "Maaf, halaman yang Anda cari tidak tersedia.";
            require '../views/errors/404.php';
            break;
    }

} catch (\Exception $e) {
    // Log error untuk debugging
    error_log("Application Error: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    
    // Tampilkan error page yang user-friendly
    http_response_code(500);
    $errorTitle = "500 - Terjadi Kesalahan";
    $errorMessage = "Terjadi kesalahan pada sistem. Silakan coba lagi nanti.";
    
    // Tampilkan detail error hanya di development mode
    if (getenv('APP_ENV') === 'development' || !getenv('APP_ENV')) {
        $errorMessage .= "<br><br><strong>Detail Error:</strong><br>" . $e->getMessage();
    }
    
    require '../views/errors/500.php';
}