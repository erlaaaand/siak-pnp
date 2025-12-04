<!DOCTYPE html>
<html>
<head>
    <title>Tambah KRS</title>
    <style> body { font-family: sans-serif; padding: 20px; } table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; } </style>
</head>
<body>
    <h2>Pilih Matakuliah Ditawarkan</h2>
    <a href="index.php?page=krs">Kembali</a>
    <br><br>
    
    <table>
        <thead>
            <tr>
                <th>Matakuliah</th>
                <th>SKS</th>
                <th>Kelas</th>
                <th>Jadwal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jadwalTersedia as $jadwal): ?>
            <tr>
                <td><?= $jadwal->matakuliah->nama_mk ?></td>
                <td><?= $jadwal->matakuliah->sks ?></td>
                <td><?= $jadwal->nama_kelas ?></td>
                <td><?= $jadwal->hari ?>, <?= $jadwal->jam_mulai ?></td>
                <td>
                    <form action="index.php?page=krs&action=store" method="POST">
                        <input type="hidden" name="jadwal_id" value="<?= $jadwal->id ?>">
                        <button type="submit" style="cursor:pointer; background:blue; color:white; border:none; padding:5px 10px;">Ambil</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>