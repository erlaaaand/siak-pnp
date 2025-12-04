<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIAK PNP' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: #1e293b;
            padding: 20px 0;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 0 20px 20px;
            border-bottom: 1px solid #334155;
            margin-bottom: 20px;
        }

        .sidebar-brand h1 {
            color: white;
            font-size: 24px;
            font-weight: 700;
        }

        .sidebar-brand p {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 5px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #334155;
            color: white;
            border-left: 3px solid #667eea;
        }

        .sidebar-menu a svg {
            width: 20px;
            height: 20px;
            margin-right: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 0;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title h2 {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
        }

        .header-title p {
            font-size: 14px;
            color: #64748b;
            margin-top: 5px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table thead {
            background: #f8fafc;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        table tbody tr:hover {
            background: #f8fafc;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.blue {
            background: #dbeafe;
            color: #3b82f6;
        }

        .stat-icon.green {
            background: #d1fae5;
            color: #10b981;
        }

        .stat-icon.purple {
            background: #e9d5ff;
            color: #a855f7;
        }

        .stat-icon.orange {
            background: #fed7aa;
            color: #f59e0b;
        }

        .stat-info h3 {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        .stat-info p {
            font-size: 14px;
            color: #64748b;
            margin-top: 5px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state svg {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 20px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #94a3b8;
            margin-bottom: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .header {
                padding: 15px 20px;
            }

            .content-area {
                padding: 20px 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h1>SIAK PNP</h1>
            <p>Sistem Informasi Akademik</p>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="index.php?page=dashboard" class="<?= ($page ?? '') == 'dashboard' ? 'active' : '' ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="index.php?page=krs" class="<?= ($page ?? '') == 'krs' ? 'active' : '' ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Kartu Rencana Studi
                </a>
            </li>
            <li>
                <a href="index.php?page=jadwal" class="<?= ($page ?? '') == 'jadwal' ? 'active' : '' ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Jadwal Kuliah
                </a>
            </li>
            <li>
                <a href="index.php?page=nilai" class="<?= ($page ?? '') == 'nilai' ? 'active' : '' ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Nilai & Transkrip
                </a>
            </li>
            <li>
                <a href="index.php?page=profil" class="<?= ($page ?? '') == 'profil' ? 'active' : '' ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil Saya
                </a>
            </li>
            <li>
                <a href="index.php?page=logout" onclick="return confirm('Yakin ingin logout?')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-title">
                <h2><?= $headerTitle ?? 'Dashboard' ?></h2>
                <p><?= $headerSubtitle ?? 'Selamat datang di Sistem Informasi Akademik' ?></p>
            </div>
            <div class="header-actions">
                <div class="user-info">
                    <div class="user-avatar">
                        <?= strtoupper(substr($_SESSION['nama'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="user-name">
                        <?= $_SESSION['nama'] ?? 'User' ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="content-area">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </div>
    </div>
</body>
</html>