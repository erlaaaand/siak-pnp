<?php
// views/jadwal/index.php
$title = 'Jadwal Kuliah - SIAK PNP';
$page = 'jadwal';
$headerTitle = 'Jadwal Kuliah';
$headerSubtitle = 'Jadwal kuliah Anda minggu ini';

ob_start();
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jadwal Kuliah Saya</h3>
    </div>

    <?php if ($jadwalKuliah->count() > 0): 
        // Group by hari
        $jadwalPerHari = $jadwalKuliah->groupBy('hari');
    ?>
    <?php foreach ($jadwalPerHari as $hari => $jadwalList): ?>
    <div style="margin-bottom: 25px;">
        <h4 style="color: #667eea; font-size: 18px; font-weight: 600; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0;">
            📅 <?= $hari ? $hari : 'Jadwal Lainnya' ?>
        </h4>
        <div style="display: grid; gap: 15px;">
            <?php foreach ($jadwalList as $jadwal): 
                // PERBAIKAN: Cek dulu apakah jam ada isinya sebelum di-substr
                $jamMulai = $jadwal->jam_mulai ? substr($jadwal->jam_mulai, 0, 5) : '-';
                $jamSelesai = $jadwal->jam_selesai ? substr($jadwal->jam_selesai, 0, 5) : '-';
            ?>
            <div style="background: #f8fafc; border-left: 4px solid #667eea; padding: 15px; border-radius: 8px;">
                <div style="display: grid; grid-template-columns: 100px 1fr auto; gap: 15px; align-items: center;">
                    <div style="font-weight: 600; color: #667eea; font-size: 16px;">
                        <?= $jamMulai ?><br>
                        <span style="font-size: 12px; color: #64748b;">s/d</span><br>
                        <?= $jamSelesai ?>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #1e293b; font-size: 16px; margin-bottom: 5px;">
                            <?= $jadwal->matakuliah->nama_mk ?? 'Nama MK Tidak Ditemukan' ?>
                        </div>
                        <div style="color: #64748b; font-size: 14px;">
                            <?= $jadwal->matakuliah->kode_mk ?? '-' ?> • <?= $jadwal->matakuliah->sks ?? 0 ?> SKS • Kelas <?= $jadwal->nama_kelas ?>
                        </div>
                        <div style="color: #64748b; font-size: 14px; margin-top: 5px;">
                            👨‍🏫 <?= $jadwal->dosen->nama ?? 'Dosen Belum Ditentukan' ?>
                        </div>
                    </div>
                    <div style="text-align: right; color: #667eea; font-weight: 600;">
                        🏛️ <?= $jadwal->ruangan->nama_ruang ?? 'TBA' ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="empty-state">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <h3>Belum Ada Jadwal</h3>
        <p>Anda belum mengambil matakuliah. Silakan isi KRS terlebih dahulu.</p>
        <a href="index.php?page=krs&action=tambah" class="btn btn-primary">Isi KRS</a>
    </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>