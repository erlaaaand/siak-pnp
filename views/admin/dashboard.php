<?php ob_start(); ?>

<div class="card">
    <h2>🛠️ Panel Kontrol Data Master</h2>
    <p class="text-muted">Kelola seluruh data universitas. Data yang diubah di sini akan langsung tampil di Mode Mahasiswa.</p>
</div>

<div class="grid grid-2">
    <div class="card" style="background:#f8fafc; border:1px dashed #cbd5e1;">
        <details>
            <summary style="cursor:pointer; font-weight:bold; color:#3b82f6;">+ Form Tambah Dosen</summary>
            <form action="index.php?page=admin&action=store_dosen" method="POST" style="margin-top:15px;">
                <div class="form-group"><input type="text" name="nidn" placeholder="NIDN" class="form-control" required></div>
                <div class="form-group"><input type="text" name="nama" placeholder="Nama Lengkap" class="form-control" required></div>
                <div class="form-group">
                    <select name="jenis_kelamin" class="form-control">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Dosen</button>
            </form>
        </details>
    </div>

    <div class="card" style="background:#f8fafc; border:1px dashed #cbd5e1;">
        <details>
            <summary style="cursor:pointer; font-weight:bold; color:#3b82f6;">+ Form Tambah Mahasiswa</summary>
            <form action="index.php?page=admin&action=store_mhs" method="POST" style="margin-top:15px;">
                <div class="form-group"><input type="text" name="nim" placeholder="NIM" class="form-control" required></div>
                <div class="form-group"><input type="text" name="nama" placeholder="Nama Mahasiswa" class="form-control" required></div>
                <div class="form-group" style="display:flex; gap:10px;">
                    <input type="number" name="angkatan" placeholder="Angkatan (2024)" class="form-control" required>
                    <input type="text" name="kelas" placeholder="Kelas (3A)" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Mahasiswa</button>
            </form>
        </details>
    </div>
</div>

<div class="grid grid-2">
    <div class="card">
        <h3>Data Dosen</h3>
        <table>
            <thead><tr><th>NIDN</th><th>Nama</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php foreach($data['dosens'] as $d): ?>
                <tr>
                    <td class="font-bold"><?= $d->nidn ?></td>
                    <td><?= $d->nama ?></td>
                    <td>
                        <a href="index.php?page=admin&action=delete_dosen&id=<?= $d->nidn ?>" class="btn btn-danger" style="padding:4px 8px; font-size:12px;" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>Data Mahasiswa</h3>
        <table>
            <thead><tr><th>NIM</th><th>Nama</th><th>Kelas</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php foreach($data['mahasiswas'] as $m): ?>
                <tr>
                    <td class="font-bold"><?= $m->nim ?></td>
                    <td><?= $m->nama ?></td>
                    <td><span style="background:#e0f2fe; color:#0369a1; padding:2px 6px; border-radius:4px; font-size:12px; font-weight:700;"><?= $m->kelas_profil ?></span></td>
                    <td>
                        <a href="index.php?page=admin&action=delete_mhs&id=<?= $m->nim ?>" class="btn btn-danger" style="padding:4px 8px; font-size:12px;" onclick="return confirm('Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); require '../views/layouts/app.php'; ?>