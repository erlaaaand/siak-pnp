<!-- views/krs/tambah.php (Updated) -->
<?php
$title = 'Tambah KRS - SIAK PNP';
$page = 'krs';
$headerTitle = 'Tambah Matakuliah';
$headerSubtitle = 'Pilih matakuliah yang ingin diambil';

ob_start();
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jadwal Matakuliah Tersedia</h3>
        <a href="index.php?page=krs" class="btn btn-secondary">← Kembali</a>
    </div>

    <?php if ($jadwalTersedia->count() > 0): ?>
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
                    <th>Kuota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($jadwalTersedia as $jadwal): 
                    // Cek apakah sudah diambil
                    $sudahDiambil = \App\Models\Krs::where('nim', $_SESSION['nim'])
                        ->where('jadwal_kelas_id', $jadwal->id)
                        ->exists();
                    
                    // Hitung jumlah mahasiswa yang sudah ambil
                    $jumlahPeserta = \App\Models\Krs::where('jadwal_kelas_id', $jadwal->id)->count();
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $jadwal->matakuliah->kode_mk ?></strong></td>
                    <td><?= $jadwal->matakuliah->nama_mk ?></td>
                    <td><?= $jadwal->matakuliah->sks ?></td>
                    <td><?= $jadwal->nama_kelas ?></td>
                    <td><?= $jadwal->dosen->nama ?></td>
                    <td><?= $jadwal->hari ?>, <?= substr($jadwal->jam_mulai, 0, 5) ?> - <?= substr($jadwal->jam_selesai, 0, 5) ?></td>
                    <td><?= $jadwal->ruangan->nama_ruang ?? '-' ?></td>
                    <td><?= $jumlahPeserta ?> / <?= $jadwal->kuota ?></td>
                    <td>
                        <?php if ($sudahDiambil): ?>
                            <span style="color: #10b981; font-weight: 600;">✓ Sudah Diambil</span>
                        <?php elseif ($jumlahPeserta >= $jadwal->kuota): ?>
                            <span style="color: #ef4444; font-weight: 600;">Penuh</span>
                        <?php else: ?>
                            <form action="index.php?page=krs&action=store" method="POST" style="display: inline;">
                                <input type="hidden" name="jadwal_id" value="<?= $jadwal->id ?>">
                                <button type="submit" class="btn btn-success btn-sm">Ambil</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="empty-state">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <h3>Tidak Ada Jadwal</h3>
        <p>Belum ada jadwal matakuliah yang tersedia untuk semester ini.</p>
    </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>