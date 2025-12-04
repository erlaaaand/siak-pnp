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
        if ($action == 'tambah') {
            $controller->tambah();
        } elseif ($action == 'store') {
            $controller->store();
        } elseif ($action == 'hapus') {
            $controller->hapus();
        } else {
            $controller->index();
        }
        break;

    case 'jadwal':
        require '../app/Controllers/JadwalController.php';
        $controller = new App\Controllers\JadwalController();
        $controller->index();
        break;

    case 'nilai':
        require '../app/Controllers/NilaiController.php';
        $controller = new App\Controllers\NilaiController();
        $controller->index();
        break;

    case 'profil':
        require '../app/Controllers/ProfilController.php';
        $controller = new App\Controllers\ProfilController();
        if ($action == 'update') {
            $controller->update();
        } elseif ($action == 'change_password') {
            $controller->changePassword();
        } else {
            $controller->index();
        }
        break;

    default:
        http_response_code(404);
        echo "<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .error-container {
            background: white;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 500px;
        }
        h1 {
            font-size: 72px;
            color: #667eea;
            margin-bottom: 20px;
        }
        p {
            color: #64748b;
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class='error-container'>
        <h1>404</h1>
        <h2 style='color: #1e293b; margin-bottom: 15px;'>Halaman Tidak Ditemukan</h2>
        <p>Maaf, halaman yang Anda cari tidak tersedia.</p>
        <a href='index.php?page=dashboard'>Kembali ke Dashboard</a>
    </div>
</body>
</html>";
        break;
}