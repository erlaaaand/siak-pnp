<?php
$title = 'Jadwal Kuliah - SIAK PNP';
$page = 'jadwal';
$headerTitle = 'Jadwal Kuliah';
$headerSubtitle = 'Jadwal kuliah Anda minggu ini';

ob_start();
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Jadwal Kuliah Saya
        </h3>
    </div>

    <?php if ($jadwalKuliah->count() > 0): 
        $jadwalPerHari = $jadwalKuliah->groupBy('hari');
    ?>
    <?php foreach ($jadwalPerHari as $hari => $jadwalList): ?>
    <div style="margin-bottom: 30px;">
        <h4 style="color: #667eea; font-size: 18px; font-weight: 600; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0; display: flex; align-items: center; gap: 10px;">
            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <?= $hari ? $hari : 'Jadwal Lainnya' ?>
        </h4>
        <div style="display: grid; gap: 15px;">
            <?php foreach ($jadwalList as $jadwal): 
                $jamMulai = $jadwal->jam_mulai ? substr($jadwal->jam_mulai, 0, 5) : '-';
                $jamSelesai = $jadwal->jam_selesai ? substr($jadwal->jam_selesai, 0, 5) : '-';
            ?>
            <div style="background: #f8fafc; border-left: 4px solid #667eea; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="display: grid; grid-template-columns: 100px 1fr auto; gap: 20px; align-items: center;">
                    <!-- Waktu -->
                    <div style="font-weight: 600; color: #667eea; font-size: 16px; text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px; margin-bottom: 4px;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <?= $jamMulai ?>
                        <div style="font-size: 11px; color: #64748b; margin: 4px 0;">s/d</div>
                        <?= $jamSelesai ?>
                    </div>
                    
                    <!-- Info Matakuliah -->
                    <div>
                        <div style="font-weight: 600; color: #1e293b; font-size: 16px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                            <svg style="width: 18px; height: 18px; color: #667eea;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <?= $jadwal->matakuliah->nama_mk ?? 'Nama MK Tidak Ditemukan' ?>
                        </div>
                        <div style="color: #64748b; font-size: 14px; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <span><?= $jadwal->matakuliah->kode_mk ?? '-' ?></span>
                            <span>•</span>
                            <span><?= $jadwal->matakuliah->sks ?? 0 ?> SKS</span>
                            <span>•</span>
                            <span>Kelas <?= $jadwal->nama_kelas ?></span>
                        </div>
                        <div style="color: #64748b; font-size: 14px; margin-top: 8px; display: flex; align-items: center; gap: 6px;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <?= $jadwal->dosen->nama ?? 'Dosen Belum Ditentukan' ?>
                        </div>
                    </div>
                    
                    <!-- Ruangan -->
                    <div style="text-align: right;">
                        <div style="display: inline-flex; align-items: center; gap: 8px; background: #ede9fe; color: #6d28d9; padding: 10px 16px; border-radius: 8px; font-weight: 600; font-size: 14px;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <?= $jadwal->ruangan->nama_ruang ?? 'TBA' ?>
                        </div>
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