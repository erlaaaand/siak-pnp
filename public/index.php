<?php
session_start();
require '../vendor/autoload.php';
require '../config/database.php';

// --- ROUTING SEDERHANA ---

// Ambil parameter page, default ke 'login'
$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

// Cek sesi login (Kecuali halaman login/register)
if (!isset($_SESSION['is_login']) && !in_array($page, ['login', 'register', 'auth_login', 'auth_register'])) {
    header("Location: index.php?page=login");
    exit;
}

// Switch Controller
switch ($page) {
    case 'login':
        require '../views/auth/login.php';
        break;
    
    case 'register':
        require '../views/auth/register.php';
        break;

    case 'auth_login': // Proses Login
        require '../app/Controllers/AuthController.php';
        $auth = new App\Controllers\AuthController();
        $auth->login();
        break;

    case 'auth_register': // Proses Register
        require '../app/Controllers/AuthController.php';
        $auth = new App\Controllers\AuthController();
        $auth->register();
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        break;

    case 'dashboard':
        require '../app/Controllers/DashboardController.php';
        $controller = new App\Controllers\DashboardController();
        $controller->index();
        break;

    case 'krs':
        require '../app/Controllers/KrsController.php';
        $controller = new App\Controllers\KrsController();
        if ($action == 'tambah') $controller->tambah();
        elseif ($action == 'store') $controller->store();
        elseif ($action == 'hapus') $controller->hapus();
        else $controller->index();
        break;

    default:
        echo "<h1>404 Halaman Tidak Ditemukan</h1>";
        break;
}