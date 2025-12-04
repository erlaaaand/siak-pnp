<!-- views/auth/register.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIAK PNP</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .auth-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-left h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .auth-left p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .auth-right {
            padding: 60px 40px;
        }

        .auth-header {
            margin-bottom: 30px;
        }

        .auth-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
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

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .auth-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .auth-left {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-left">
            <h1>Daftar Akun Baru</h1>
            <p>Hanya mahasiswa yang terdaftar di sistem akademik yang dapat membuat akun. Pastikan Anda menggunakan nama lengkap sesuai data akademik.</p>
        </div>
        <div class="auth-right">
            <div class="auth-header">
                <h2>Registrasi</h2>
                <p>Buat akun untuk mengakses sistem</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="alert alert-info">
                <strong>Catatan:</strong> Gunakan nama lengkap sesuai data akademik Anda.
            </div>

            <form action="index.php?page=auth_register" method="POST">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Sesuai data akademik" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn">Daftar</button>
            </form>

            <div class="auth-footer">
                Sudah punya akun? <a href="index.php?page=login">Login Sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>