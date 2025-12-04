<?php ob_start(); ?>

<div class="card" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="margin:0; font-size:24px;">Halo, <?= $me->nama ?></h2>
            <p style="margin:5px 0 0 0; opacity:0.8;"><?= $me->nim ?> • Kelas <?= $me->kelas_profil ?></p>
        </div>
        <div style="text-align:right;">
            <div style="font-size:12px; text-transform:uppercase; letter-spacing:1px; opacity:0.7;">Semester Saat Ini</div>
            <div style="font-size:28px; font-weight:bold;">Semester <?= $semesterSaya ?></div>
            <div style="font-size:14px;"><?= $taSaatIni->nama ?></div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
    
    <div class="card">
        <h3 style="display:flex; align-items:center; gap:8px; border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            <svg class="icon" style="color:#3b82f6" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            Pra-Kuliah
        </h3>
        <p style="font-size:13px; color:#64748b;">Informasi kelas & teman seangkatan.</p>
        
        <div style="margin-top:15px;">
            <strong>Daftar Teman Kelas (<?= $me->kelas_profil ?>)</strong>
            <ul style="padding-left:20px; margin-top:5px; color:#334155; font-size:14px;">
                <?php foreach($temanSekelas as $t): ?>
                    <li><?= $t->nama ?> (<?= $t->nim ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div style="margin-top:15px;">
            <strong>Dosen Pengampu</strong>
            <ul style="padding-left:20px; margin-top:5px; color:#334155; font-size:14px;">
                <?php foreach($dosenKelas as $d): ?>
                    <li><?= $d->nama ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="card">
        <h3 style="display:flex; align-items:center; gap:8px; border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            <svg class="icon" style="color:#f59e0b" viewBox="0 0 24 24"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/></svg>
            Perkuliahan
        </h3>
        <p style="font-size:13px; color:#64748b;">KRS, KHS, dan Transkrip.</p>
        
        <div style="background:#f0f9ff; padding:15px; border-radius:8px; border:1px solid #bae6fd; text-align:center; margin-bottom:15px;">
            <div style="font-size:32px; font-weight:bold; color:#0284c7;"><?= $ipk ?></div>
            <div style="font-size:12px; color:#0369a1;">Indeks Prestasi Kumulatif</div>
        </div>

        <table style="font-size:13px;">
            <thead><tr><th>MK</th><th>Nilai</th></tr></thead>
            <tbody>
                <?php foreach($krsSaya as $k): ?>
                <tr>
                    <td><?= $k->jadwal_kelas->matakuliah->nama_mk ?></td>
                    <td><span style="font-weight:bold; color:<?= $k->nilai_angka >= 70 ? '#10b981':'#ef4444' ?>"><?= $k->nilai_huruf ?? '-' ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3 style="display:flex; align-items:center; gap:8px; border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            <svg class="icon" style="color:#10b981" viewBox="0 0 24 24"><path d="M19 8h-1V3H6v5H5c-1.1 0-2 .9-2 2v6h4v4h12v-4h4v-6c0-1.1-.9-2-2-2zM8 5h8v3H8V5zm8 12v2H8v-4h8v2zm2-2v-2H6v2H4v-4c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v4h-2z"/><circle cx="18" cy="11.5" r="1"/></svg>
            Pasca-Kuliah
        </h3>
        <p style="font-size:13px; color:#64748b;">Cetak Rapor Semester & Laporan.</p>
        
        <div style="text-align:center; padding:20px;">
            <button class="btn btn-primary" style="width:100%;">
                <svg class="icon" style="width:16px; height:16px; margin-right:5px;" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
                Download Rapor Semester <?= $semesterSaya ?>
            </button>
            <p style="font-size:12px; margin-top:10px; color:#94a3b8;">Format PDF (Siap Cetak)</p>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); require '../views/layouts/main.php'; ?>