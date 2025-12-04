<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Mahasiswa</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px; }
        .btn { padding: 8px 15px; text-decoration: none; color: white; border-radius: 4px; }
        .btn-red { background: #e74c3c; }
        .btn-blue { background: #3498db; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .label { font-weight: bold; width: 150px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Selamat Datang, <?= $mahasiswa->nama ?></h2>
        <div>
            <a href="index.php?page=krs" class="btn btn-blue">Lihat KRS</a>
            <a href="index.php?page=logout" class="btn btn-red">Logout</a>
        </div>
    </div>

    <h3>Profil Akademik</h3>
    <table>
        <tr><td class="label">NIM</td><td>: <?= $mahasiswa->nim ?></td></tr>
        <tr><td class="label">Nama Lengkap</td><td>: <?= $mahasiswa->nama ?></td></tr>
        <tr><td class="label">Program Studi</td><td>: <?= $mahasiswa->prodi->nama ?> (<?= $mahasiswa->prodi->jenjang ?>)</td></tr>
        <tr><td class="label">Jurusan</td><td>: <?= $mahasiswa->prodi->jurusan->nama ?></td></tr>
        <tr><td class="label">Angkatan</td><td>: <?= $mahasiswa->angkatan ?></td></tr>
        <tr><td class="label">Status</td><td>: <span style="color:green">Aktif</span></td></tr>
    </table>
</div>

</body>
</html>