<!-- views/profil/index.php -->
<?php
$title = 'Profil Saya - SIAK PNP';
$page = 'profil';
$headerTitle = 'Profil Saya';
$headerSubtitle = 'Kelola informasi pribadi Anda';

ob_start();
?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <!-- Profil Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi Pribadi</h3>
        </div>
        
        <form action="index.php?page=profil&action=update" method="POST">
            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">NIM</label>
                <input type="text" class="form-control" value="<?= $mahasiswa->nim ?>" readonly style="background: #f1f5f9; width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">Nama Lengkap</label>
                <input type="text" class="form-control" value="<?= $mahasiswa->nama ?>" readonly style="background: #f1f5f9; width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">Jenis Kelamin</label>
                <input type="text" class="form-control" value="<?= $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?>" readonly style="background: #f1f5f9; width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?= $mahasiswa->tempat_lahir ?? '' ?>" placeholder="Masukkan tempat lahir" style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?= $mahasiswa->tanggal_lahir ?? '' ?>" style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <!-- Akademik & Password -->
    <div>
        <!-- Info Akademik -->
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header">
                <h3 class="card-title">Informasi Akademik</h3>
            </div>
            
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b;">Program Studi</td>
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
                <tr>
                    <td style="border: none; padding: 8px 0; font-weight: 600; color: #64748b;">Angkatan</td>
                    <td style="border: none; padding: 8px 0; color: #1e293b;">: <?= $mahasiswa->angkatan ?></td>
                </tr>
            </table>
        </div>

        <!-- Change Password -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
            </div>
            
            <form action="index.php?page=profil&action=change_password" method="POST">
                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">Password Lama</label>
                    <input type="password" name="old_password" class="form-control" required style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">Password Baru</label>
                    <input type="password" name="new_password" class="form-control" required minlength="6" style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 500; font-size: 14px;">Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" class="form-control" required style="width: 100%; padding: 12px 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                </div>

                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>