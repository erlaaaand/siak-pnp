<!DOCTYPE html>
<html>
<head>
    <title>Kartu Rencana Studi</title>
    <style>
        /* ... copy style dari dashboard ... */
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; background: #3498db; border-radius: 3px; }
        .btn-del { background: #e74c3c; }
    </style>
</head>
<body>
    <h2>Kartu Rencana Studi (KRS)</h2>
    <a href="index.php?page=dashboard" class="btn">Kembali ke Dashboard</a>
    <a href="index.php?page=krs&action=tambah" class="btn" style="background:green;">+ Tambah Matakuliah</a>

    <table>
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Matakuliah</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Jadwal</th>
                <th>Ruang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalSks = 0;
            foreach ($krsSaya as $item): 
                $mk = $item->jadwal_kelas->matakuliah;
                $totalSks += $mk->sks;
            ?>
            <tr>
                <td><?= $mk->kode_mk ?></td>
                <td><?= $mk->nama_mk ?></td>
                <td><?= $mk->sks ?></td>
                <td><?= $item->jadwal_kelas->dosen->nama ?></td>
                <td><?= $item->jadwal_kelas->hari ?>, <?= substr($item->jadwal_kelas->jam_mulai, 0, 5) ?></td>
                <td><?= $item->jadwal_kelas->ruangan->nama_ruang ?? '-' ?></td>
                <td>
                    <a href="index.php?page=krs&action=hapus&id=<?= $item->id ?>" class="btn btn-del" onclick="return confirm('Yakin batalkan MK ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" style="font-weight:bold; text-align:right;">Total SKS</td>
                <td colspan="5" style="font-weight:bold;"><?= $totalSks ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>