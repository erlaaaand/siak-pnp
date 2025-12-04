<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $errorTitle ?? '500 - Terjadi Kesalahan' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
            max-width: 600px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .error-code {
            font-size: 120px;
            font-weight: 700;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 20px;
        }

        h2 {
            color: #1e293b;
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            color: #64748b;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .error-detail {
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 15px;
            text-align: left;
            margin: 20px 0;
            font-size: 14px;
            color: #991b1b;
            max-height: 200px;
            overflow-y: auto;
        }

        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">500</div>
        <h2>Terjadi Kesalahan Server</h2>
        <p><?= strip_tags($errorMessage ?? 'Terjadi kesalahan pada sistem. Tim kami telah diberitahu dan sedang memperbaikinya.') ?></p>
        
        <?php if (isset($errorMessage) && strpos($errorMessage, 'Detail Error:') !== false): ?>
            <div class="error-detail">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>
        
        <div>
            <?php if (isset($_SESSION['is_login'])): ?>
                <a href="index.php?page=dashboard" class="btn">← Kembali ke Dashboard</a>
            <?php else: ?>
                <a href="index.php?page=login" class="btn">← Ke Halaman Login</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>