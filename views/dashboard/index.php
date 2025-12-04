<?php
$title = 'Dashboard - SIAK PNP';
$page = 'dashboard';
$headerTitle = 'Dashboard';
$headerSubtitle = 'Ringkasan informasi akademik Anda';

// Hitung statistik
$totalKRS = \App\Models\Krs::where('nim', $_SESSION['nim'])->count();
$totalSKS = \App\Models\Krs::where('nim', $_SESSION['nim'])
    ->join('jadwal_kelas', 'krs.jadwal_kelas_id', '=', 'jadwal_kelas.id')
    ->join('matakuliahs', 'jadwal_kelas.matakuliah_id', '=', 'matakuliahs.id')
    ->sum('matakuliahs.sks');

$nilaiDiinput = \App\Models\Krs::where('nim', $_SESSION['nim'])
    ->where('nilai_angka', '>', 0)
    ->count();

// IPK Calculation (simple average)
$avgNilai = \App\Models\Krs::where('nim', $_SESSION['nim'])
    ->where('nilai_angka', '>', 0)
    ->avg('nilai_angka');

$ipk = $avgNilai ? number_format($avgNilai / 25, 2) : '0.00'; // Convert 0-100 to 0-4 scale

ob_start();
?>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            📚
        </div>
        <div class="stat-info">
            <h3><?= $totalKRS ?></h3>
            <p>Matakuliah Diambil</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            ✓
        </div>
        <div class="stat-info">
            <h3><?= $totalSKS ?></h3>
            <p>Total SKS</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            📊
        </div>
        <div class="stat-info">
            <h3><?= $ipk ?></h3>
            <p>IPK Sementara</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            📝
        </div>
        <div class="stat-info">
            <h3><?= $nilaiDiinput ?></h3>
            <p>Nilai Terinput</p>
        </div>
    </div>
</div>

<!-- Profil Akademik -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Profil Akademik</h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        <div>
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b; width: 150px;">NIM</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->nim ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b;">Nama Lengkap</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->nama ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b;">Jenis Kelamin</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                </tr>
            </table>
        </div>
        <div>
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b; width: 150px;">Program Studi</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->prodi->nama ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b;">Jenjang</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->prodi->jenjang ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b;">Jurusan</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->prodi->jurusan->nama ?></td>
                </tr>
            </table>
        </div>
        <div>
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b; width: 150px;">Angkatan</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->angkatan ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b;">Status</td>
                    <td style="border: none; padding: 8px 0;">: <span style="color: #10b981; font-weight: 600;">● Aktif</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Menu Cepat</h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
        <a href="index.php?page=krs" style="display: block; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 10px; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 10px;">📚</div>
            <div style="font-weight: 600;">Kartu Rencana Studi</div>
        </a>
        <a href="index.php?page=jadwal" style="display: block; padding: 20px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; text-decoration: none; border-radius: 10px; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 10px;">📅</div>
            <div style="font-weight: 600;">Jadwal Kuliah</div>
        </a>
        <a href="index.php?page=nilai" style="display: block; padding: 20px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; text-decoration: none; border-radius: 10px; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 10px;">📊</div>
            <div style="font-weight: 600;">Nilai & Transkrip</div>
        </a>
        <a href="index.php?page=profil" style="display: block; padding: 20px; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; text-decoration: none; border-radius: 10px; text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="font-size: 32px; margin-bottom: 10px;">👤</div>
            <div style="font-weight: 600;">Profil Saya</div>
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>