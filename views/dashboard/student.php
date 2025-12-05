<?php
$title = 'Dashboard Mahasiswa - SIAK PNP';
$page = 'dashboard';
$headerTitle = 'Dashboard Mahasiswa';
$headerSubtitle = 'Ringkasan informasi akademik Anda';

ob_start();
?>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3><?= $totalKRS ?></h3>
            <p>Matakuliah Diambil</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3><?= $totalSKS ?></h3>
            <p>Total SKS</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3><?= $ipk ?></h3>
            <p>IPK Sementara</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
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
        <h3 class="card-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Profil Akademik
        </h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
        <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 20px; border-radius: 12px;">
            <h4 style="color: #667eea; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px;">Informasi Pribadi</h4>
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b; width: 160px;">NIM</td>
                    <td style="border: none; padding: 10px 0; color: #1e293b; font-weight: 500;">: <?= $mahasiswa->nim ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b;">Nama Lengkap</td>
                    <td style="border: none; padding: 10px 0; color: #1e293b; font-weight: 500;">: <?= $mahasiswa->nama ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b;">Jenis Kelamin</td>
                    <td style="border: none; padding: 10px 0; color: #1e293b; font-weight: 500;">: <?= $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                </tr>
            </table>
        </div>
        <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 20px; border-radius: 12px;">
            <h4 style="color: #667eea; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px;">Program Studi</h4>
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b; width: 160px;">Program Studi</td>
                    <td style="border: none; padding: 10px 0; color: #1e293b; font-weight: 500;">: <?= $mahasiswa->prodi->nama ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b;">Jenjang</td>
                    <td style="border: none; padding: 10px 0; color: #1e293b; font-weight: 500;">: <?= $mahasiswa->prodi->jenjang ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b;">Jurusan</td>
                    <td style="border: none; padding: 10px 0; color: #1e293b; font-weight: 500;">: <?= $mahasiswa->prodi->jurusan->nama ?></td>
                </tr>
            </table>
        </div>
        <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 20px; border-radius: 12px;">
            <h4 style="color: #667eea; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px;">Status Akademik</h4>
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b; width: 160px;">Angkatan</td>
                    <td style="border: none; padding: 10px 0; color: #1e293b; font-weight: 500;">: <?= $mahasiswa->angkatan ?></td>
                </tr>
                <tr>
                    <td style="border: none; padding: 10px 0; font-weight: 600; color: #64748b;">Status</td>
                    <td style="border: none; padding: 10px 0;">: <span style="color: #10b981; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Aktif
                    </span></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Menu Cepat
        </h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
        <a href="index.php?page=krs" style="display: block; padding: 28px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 14px; text-align: center; transition: all 0.3s; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.3)';">
            <div style="margin-bottom: 14px;">
                <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <div style="font-weight: 700; font-size: 16px;">Kartu Rencana Studi</div>
            <div style="font-size: 13px; opacity: 0.9; margin-top: 6px;">Kelola KRS Anda</div>
        </a>
        <a href="index.php?page=jadwal" style="display: block; padding: 28px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; text-decoration: none; border-radius: 14px; text-align: center; transition: all 0.3s; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 24px rgba(16, 185, 129, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.3)';">
            <div style="margin-bottom: 14px;">
                <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div style="font-weight: 700; font-size: 16px;">Jadwal Kuliah</div>
            <div style="font-size: 13px; opacity: 0.9; margin-top: 6px;">Lihat jadwal kuliah</div>
        </a>
        <a href="index.php?page=nilai" style="display: block; padding: 28px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; text-decoration: none; border-radius: 14px; text-align: center; transition: all 0.3s; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 24px rgba(245, 158, 11, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)';">
            <div style="margin-bottom: 14px;">
                <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div style="font-weight: 700; font-size: 16px;">Nilai & Transkrip</div>
            <div style="font-size: 13px; opacity: 0.9; margin-top: 6px;">Lihat nilai Anda</div>
        </a>
        <a href="index.php?page=profil" style="display: block; padding: 28px; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white; text-decoration: none; border-radius: 14px; text-align: center; transition: all 0.3s; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 24px rgba(139, 92, 246, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.3)';">
            <div style="margin-bottom: 14px;">
                <svg style="width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div style="font-weight: 700; font-size: 16px;">Profil Saya</div>
            <div style="font-size: 13px; opacity: 0.9; margin-top: 6px;">Kelola profil</div>
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>