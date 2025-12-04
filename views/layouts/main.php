<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAK Integrated System</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f8; margin: 0; }
        
        /* Navbar Super Admin */
        .navbar { background: #1e293b; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .nav-tabs { display: flex; gap: 10px; background: #0f172a; padding: 5px; border-radius: 8px; }
        .nav-link { padding: 8px 16px; color: #94a3b8; text-decoration: none; border-radius: 6px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .nav-link:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-link.active { background: #3b82f6; color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        
        /* Icons (SVG) */
        .icon { width: 18px; height: 18px; fill: currentColor; }
        
        /* Content */
        .container { padding: 20px; max-width: 1200px; margin: auto; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 20px; }
        
        /* Tables */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #f8fafc; color: #475569; font-weight: 600; font-size: 13px; text-transform: uppercase; }
        
        /* Forms */
        .form-group { margin-bottom: 15px; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; color: white; }
        .btn-primary { background: #3b82f6; }
        .btn-danger { background: #ef4444; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div style="display:flex; align-items:center; gap:10px;">
            <svg class="icon" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
            <span style="font-weight:bold; font-size:18px;">SIAK SUPER ADMIN</span>
        </div>
        
        <div class="nav-tabs">
            <a href="index.php?mode=admin" class="nav-link <?= ($_GET['mode']??'admin')=='admin'?'active':'' ?>">
                <svg class="icon" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                Mode Admin (CRUD)
            </a>
            <a href="index.php?mode=student" class="nav-link <?= ($_GET['mode']??'')=='student'?'active':'' ?>">
                <svg class="icon" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                Mode Mahasiswa (View)
            </a>
        </div>
    </nav>

    <div class="container">
        <?php echo $content; ?>
    </div>

</body>
</html>