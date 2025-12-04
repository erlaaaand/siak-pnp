<?php
// views/krs/index.php (Updated)
$title = 'KRS Saya - SIAK PNP';
$page = 'krs';
$headerTitle = 'Kartu Rencana Studi';
$headerSubtitle = 'Daftar matakuliah yang Anda ambil';

ob_start();
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">KRS Saya</h3>
        <a href="index.php?page=krs&action=tambah" class="btn btn-primary">+ Tambah Matakuliah</a>
    </div>

    <?php if ($krsSaya->count() > 0): 
        $totalSks = 0;
    ?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Kelas</th>
                    <th>Dosen</th>
                    <th>Jadwal</th>
                    <th>Ruang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($krsSaya as $item): 
                    $mk = $item->jadwal_kelas->matakuliah;
                    $totalSks += $mk->sks;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $mk->kode_mk ?></strong></td>
                    <td><?= $mk->nama_mk ?></td>
                    <td><?= $mk->sks ?></td>
                    <td><?= $item->jadwal_kelas->nama_kelas ?></td>
                    <td><?= $item->jadwal_kelas->dosen->nama ?></td>
                    <td><?= $item->jadwal_kelas->hari ?>, <?= substr($item->jadwal_kelas->jam_mulai, 0, 5) ?> - <?= substr($item->jadwal_kelas->jam_selesai, 0, 5) ?></td>
                    <td><?= $item->jadwal_kelas->ruangan->nama_ruang ?? '-' ?></td>
                    <td>
                        <a href="index.php?page=krs&action=hapus&id=<?= $item->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin batalkan MK ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr style="background: #f8fafc; font-weight: 600;">
                    <td colspan="3" style="text-align: right; padding: 15px;">Total SKS:</td>
                    <td colspan="6" style="padding: 15px; color: #667eea; font-size: 16px;"><?= $totalSks ?> SKS</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php else: ?>
    <div class="empty-state">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <h3>Belum Ada KRS</h3>
        <p>Anda belum mengambil matakuliah apapun.</p>
        <a href="index.php?page=krs&action=tambah" class="btn btn-primary">Tambah Matakuliah</a>
    </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>