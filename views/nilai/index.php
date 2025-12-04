<?php
$title = 'Nilai & Transkrip - SIAK PNP';
$page = 'nilai';
$headerTitle = 'Nilai & Transkrip';
$headerSubtitle = 'Lihat nilai dan IPK Anda';

// --- LOGIC PERBAIKAN: Definisi Fungsi diletakkan di luar loop ---
// Cek function_exists agar aman jika file ini di-load berulang
if (!function_exists('getNilaiHuruf')) {
    function getNilaiHuruf($nilai) {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 50) return 'C-';
        if ($nilai >= 40) return 'D';
        return 'E';
    }
}

if (!function_exists('getBobot')) {
    function getBobot($nilai) {
        if ($nilai >= 85) return 4.00;
        if ($nilai >= 80) return 3.67;
        if ($nilai >= 75) return 3.33;
        if ($nilai >= 70) return 3.00;
        if ($nilai >= 65) return 2.67;
        if ($nilai >= 60) return 2.33;
        if ($nilai >= 55) return 2.00;
        if ($nilai >= 50) return 1.67;
        if ($nilai >= 40) return 1.00;
        return 0.00;
    }
}
// ---------------------------------------------------------------

ob_start();
?>

<div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div style="text-align: center;">
        <h3 style="font-size: 48px; font-weight: 700; margin-bottom: 10px;"><?= number_format((float)$ipk, 2) ?></h3>
        <p style="font-size: 18px; opacity: 0.9;">Indeks Prestasi Kumulatif (IPK)</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Nilai</h3>
    </div>

    <?php if ($nilaiList->count() > 0): ?>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Semester</th>
                    <th>Kode MK</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Nilai Angka</th>
                    <th>Nilai Huruf</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($nilaiList as $krs): 
                    // Pastikan relasi ada sebelum diakses untuk mencegah error "Trying to get property of non-object"
                    $mk = $krs->jadwal_kelas->matakuliah ?? null;
                    $tahunAkademik = $krs->jadwal_kelas->tahunAkademik ?? null;
                    
                    if (!$mk) continue; // Skip jika data MK rusak
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?= $tahunAkademik ? ($tahunAkademik->tahun . ' - ' . $tahunAkademik->semester) : '-' ?>
                    </td>
                    <td><strong><?= $mk->kode_mk ?></strong></td>
                    <td><?= $mk->nama_mk ?></td>
                    <td><?= $mk->sks ?></td>
                    <td>
                        <?php if ($krs->nilai_angka > 0): ?>
                            <strong style="color: #667eea;"><?= $krs->nilai_angka ?></strong>
                        <?php else: ?>
                            <span style="color: #94a3b8;">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($krs->nilai_angka > 0): 
                            $huruf = getNilaiHuruf($krs->nilai_angka);
                            // Logic warna berdasarkan nilai huruf
                            $bg = ($krs->nilai_angka >= 70) ? '#d1fae5' : (($krs->nilai_angka >= 50) ? '#fef3c7' : '#fee2e2');
                            $color = ($krs->nilai_angka >= 70) ? '#065f46' : (($krs->nilai_angka >= 50) ? '#92400e' : '#991b1b');
                        ?>
                            <span style="padding: 4px 12px; background: <?= $bg ?>; color: <?= $color ?>; border-radius: 6px; font-weight: 600;">
                                <?= $huruf ?>
                            </span>
                        <?php else: ?>
                            <span style="color: #94a3b8;">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($krs->nilai_angka > 0): ?>
                            <?= number_format(getBobot($krs->nilai_angka), 2) ?>
                        <?php else: ?>
                            <span style="color: #94a3b8;">-</span>
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
        <h3>Belum Ada Nilai</h3>
        <p>Nilai Anda belum diinput oleh dosen.</p>
    </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>