<?php
$title = 'Admin Dashboard - SIAK PNP';
$page = 'dashboard';
$headerTitle = 'Admin Dashboard';
$headerSubtitle = 'Kelola data master sistem akademik';

ob_start();
?>

<style>
.admin-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 10px;
    flex-wrap: wrap;
}

.admin-tab {
    padding: 12px 24px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px 8px 0 0;
    color: #64748b;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s;
    cursor: pointer;
}

.admin-tab:hover {
    background: #f1f5f9;
    color: #334155;
}

.admin-tab.active {
    background: #ef4444;
    color: white;
    border-color: #ef4444;
}

.form-inline {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.form-group-inline {
    display: flex;
    flex-direction: column;
}

.form-group-inline label {
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 6px;
}

.form-group-inline input,
.form-group-inline select {
    padding: 10px 12px;
    border: 2px solid #e2e8f0;
    border-radius: 6px;
    font-size: 14px;
}

.btn-group {
    display: flex;
    gap: 8px;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 0;
    border-radius: 16px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    animation: slideDown 0.3s;
}

@keyframes slideDown {
    from { 
        transform: translateY(-50px);
        opacity: 0;
    }
    to { 
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    padding: 25px 30px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    border-radius: 16px 16px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
}

.close {
    color: white;
    font-size: 32px;
    font-weight: 300;
    cursor: pointer;
    transition: 0.3s;
    line-height: 1;
}

.close:hover {
    transform: rotate(90deg);
}

.modal-body {
    padding: 30px;
}

.btn-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
}
</style>

<!-- Admin Statistics -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3><?= $dosens->count() ?></h3>
            <p>Total Dosen</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3><?= $mahasiswas->count() ?></h3>
            <p>Total Mahasiswa</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3><?= $matakuliahs->count() ?></h3>
            <p>Total Matakuliah</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div class="stat-info">
            <h3><?= $jadwals->count() ?></h3>
            <p>Total Jadwal</p>
        </div>
    </div>
</div>

<div class="admin-tabs">
    <a href="#dosen" class="admin-tab active" onclick="showTab('dosen', event)">
        🧑‍🏫 Dosen
    </a>
    <a href="#mahasiswa" class="admin-tab" onclick="showTab('mahasiswa', event)">
        👨‍🎓 Mahasiswa
    </a>
    <a href="#matakuliah" class="admin-tab" onclick="showTab('matakuliah', event)">
        📚 Matakuliah
    </a>
    <a href="#ruangan" class="admin-tab" onclick="showTab('ruangan', event)">
        🏢 Ruangan
    </a>
    <a href="#jadwal" class="admin-tab" onclick="showTab('jadwal', event)">
        📅 Jadwal
    </a>
</div>

<!-- TAB: DOSEN -->
<div id="tab-dosen" class="tab-content active">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">➕ Tambah Dosen Baru</h3>
        </div>
        <form action="index.php?page=admin&action=store_dosen" method="POST">
            <div class="form-inline">
                <div class="form-group-inline">
                    <label>NIDN *</label>
                    <input type="text" name="nidn" required>
                </div>
                <div class="form-group-inline">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="form-group-inline">
                    <label>Jenis Kelamin *</label>
                    <select name="jenis_kelamin" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group-inline">
                    <label>Jurusan *</label>
                    <select name="jurusan_id" required>
                        <option value="1">Teknologi Informasi</option>
                        <option value="2">Teknik Elektro</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Simpan Dosen</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📋 Daftar Dosen</h3>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dosens as $d): ?>
                    <tr>
                        <td><strong><?= $d->nidn ?></strong></td>
                        <td><?= $d->nama ?></td>
                        <td><?= $d->jenis_kelamin ?></td>
                        <td><?= $d->jurusan->nama ?? '-' ?></td>
                        <td>
                            <div class="btn-group">
                                <button onclick="editDosen('<?= $d->nidn ?>', '<?= htmlspecialchars($d->nama) ?>', '<?= $d->jenis_kelamin ?>', '<?= $d->jurusan_id ?>')" class="btn btn-warning btn-sm">✏️ Edit</button>
                                <a href="index.php?page=admin&action=delete_dosen&id=<?= $d->nidn ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus dosen ini?')">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TAB: MAHASISWA -->
<div id="tab-mahasiswa" class="tab-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">➕ Tambah Mahasiswa Baru</h3>
        </div>
        <form action="index.php?page=admin&action=store_mhs" method="POST">
            <div class="form-inline">
                <div class="form-group-inline">
                    <label>NIM *</label>
                    <input type="text" name="nim" required>
                </div>
                <div class="form-group-inline">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" required>
                </div>
                <div class="form-group-inline">
                    <label>Jenis Kelamin *</label>
                    <select name="jenis_kelamin" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group-inline">
                    <label>Angkatan *</label>
                    <input type="number" name="angkatan" value="<?= date('Y') - 2 ?>" required>
                </div>
                <div class="form-group-inline">
                    <label>Kelas *</label>
                    <input type="text" name="kelas" placeholder="3A" required>
                </div>
                <div class="form-group-inline">
                    <label>Program Studi *</label>
                    <select name="prodi_id" required>
                        <option value="1">D4 TRPL</option>
                        <option value="2">D3 MI</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Simpan Mahasiswa</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📋 Daftar Mahasiswa</h3>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Angkatan</th>
                        <th>Kelas</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mahasiswas as $m): ?>
                    <tr>
                        <td><strong><?= $m->nim ?></strong></td>
                        <td><?= $m->nama ?></td>
                        <td><?= $m->jenis_kelamin ?></td>
                        <td><?= $m->angkatan ?></td>
                        <td><span style="background:#e0f2fe;color:#0369a1;padding:4px 10px;border-radius:6px;font-weight:600;font-size:12px;"><?= $m->kelas_profil ?></span></td>
                        <td><?= $m->prodi->nama ?? '-' ?></td>
                        <td>
                            <div class="btn-group">
                                <button onclick="editMahasiswa('<?= $m->nim ?>', '<?= htmlspecialchars($m->nama) ?>', '<?= $m->jenis_kelamin ?>', '<?= $m->angkatan ?>', '<?= $m->kelas_profil ?>', '<?= $m->prodi_id ?>')" class="btn btn-warning btn-sm">✏️ Edit</button>
                                <a href="index.php?page=admin&action=delete_mhs&id=<?= $m->nim ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus mahasiswa ini?')">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TAB: MATAKULIAH -->
<div id="tab-matakuliah" class="tab-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">➕ Tambah Matakuliah Baru</h3>
        </div>
        <form action="index.php?page=admin&action=store_mk" method="POST">
            <div class="form-inline">
                <div class="form-group-inline">
                    <label>Kode MK *</label>
                    <input type="text" name="kode_mk" required>
                </div>
                <div class="form-group-inline">
                    <label>Nama Matakuliah *</label>
                    <input type="text" name="nama_mk" required>
                </div>
                <div class="form-group-inline">
                    <label>SKS *</label>
                    <input type="number" name="sks" min="1" max="6" required>
                </div>
                <div class="form-group-inline">
                    <label>Semester Paket</label>
                    <input type="number" name="semester_paket" min="1" max="8">
                </div>
                <div class="form-group-inline">
                    <label>Program Studi *</label>
                    <select name="prodi_id" required>
                        <option value="1">D4 TRPL</option>
                        <option value="2">D3 MI</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Simpan Matakuliah</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📋 Daftar Matakuliah</h3>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kode MK</th>
                        <th>Nama Matakuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($matakuliahs as $mk): ?>
                    <tr>
                        <td><strong><?= $mk->kode_mk ?></strong></td>
                        <td><?= $mk->nama_mk ?></td>
                        <td><?= $mk->sks ?></td>
                        <td><?= $mk->semester_paket ?? '-' ?></td>
                        <td><?= $mk->prodi->nama ?? '-' ?></td>
                        <td>
                            <div class="btn-group">
                                <button onclick="editMatakuliah('<?= $mk->id ?>', '<?= htmlspecialchars($mk->kode_mk) ?>', '<?= htmlspecialchars($mk->nama_mk) ?>', '<?= $mk->sks ?>', '<?= $mk->semester_paket ?>', '<?= $mk->prodi_id ?>')" class="btn btn-warning btn-sm">✏️ Edit</button>
                                <a href="index.php?page=admin&action=delete_mk&id=<?= $mk->id ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus matakuliah ini?')">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TAB: RUANGAN -->
<div id="tab-ruangan" class="tab-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">➕ Tambah Ruangan Baru</h3>
        </div>
        <form action="index.php?page=admin&action=store_ruangan" method="POST">
            <div class="form-inline">
                <div class="form-group-inline">
                    <label>Kode Ruang *</label>
                    <input type="text" name="kode_ruang" required>
                </div>
                <div class="form-group-inline">
                    <label>Nama Ruang *</label>
                    <input type="text" name="nama_ruang" required>
                </div>
                <div class="form-group-inline">
                    <label>Kapasitas *</label>
                    <input type="number" name="kapasitas" value="40" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Simpan Ruangan</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📋 Daftar Ruangan</h3>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Kode Ruang</th>
                        <th>Nama Ruang</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ruangans as $r): ?>
                    <tr>
                        <td><strong><?= $r->kode_ruang ?></strong></td>
                        <td><?= $r->nama_ruang ?></td>
                        <td><?= $r->kapasitas ?> orang</td>
                        <td>
                            <div class="btn-group">
                                <button onclick="editRuangan('<?= $r->id ?>', '<?= htmlspecialchars($r->kode_ruang) ?>', '<?= htmlspecialchars($r->nama_ruang) ?>', '<?= $r->kapasitas ?>')" class="btn btn-warning btn-sm">✏️ Edit</button>
                                <a href="index.php?page=admin&action=delete_ruangan&id=<?= $r->id ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus ruangan ini?')">🗑️ Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TAB: JADWAL -->
<div id="tab-jadwal" class="tab-content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📋 Daftar Jadwal Kelas</h3>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Matakuliah</th>
                        <th>Dosen</th>
                        <th>Kelas</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Ruang</th>
                        <th>TA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jadwals as $j): ?>
                    <tr>
                        <td><strong><?= $j->matakuliah->nama_mk ?? '-' ?></strong></td>
                        <td><?= $j->dosen->nama ?? '-' ?></td>
                        <td><?= $j->nama_kelas ?></td>
                        <td><?= $j->hari ?></td>
                        <td><?= substr($j->jam_mulai, 0, 5) ?> - <?= substr($j->jam_selesai, 0, 5) ?></td>
                        <td><?= $j->ruangan->nama_ruang ?? '-' ?></td>
                        <td><?= $j->tahunAkademik->nama ?? '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL EDIT MATAKULIAH -->
<div id="modalEditMatakuliah" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>✏️ Edit Data Matakuliah</h3>
            <span class="close" onclick="closeModal('modalEditMatakuliah')">&times;</span>
        </div>
        <div class="modal-body">
            <form action="index.php?page=admin&action=update_mk" method="POST">
                <input type="hidden" name="id" id="edit_mk_id">
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Kode MK *</label>
                    <input type="text" name="kode_mk" id="edit_mk_kode" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Nama Matakuliah *</label>
                    <input type="text" name="nama_mk" id="edit_mk_nama" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>SKS *</label>
                    <input type="number" name="sks" id="edit_mk_sks" min="1" max="6" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Semester Paket</label>
                    <input type="number" name="semester_paket" id="edit_mk_semester" min="1" max="8">
                </div>
                <div class="form-group-inline" style="margin-bottom: 20px;">
                    <label>Program Studi *</label>
                    <select name="prodi_id" id="edit_mk_prodi" required>
                        <option value="1">D4 TRPL</option>
                        <option value="2">D3 MI</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Update Data</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditMatakuliah')">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT RUANGAN -->
<div id="modalEditRuangan" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>✏️ Edit Data Ruangan</h3>
            <span class="close" onclick="closeModal('modalEditRuangan')">&times;</span>
        </div>
        <div class="modal-body">
            <form action="index.php?page=admin&action=update_ruangan" method="POST">
                <input type="hidden" name="id" id="edit_ruangan_id">
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Kode Ruang *</label>
                    <input type="text" name="kode_ruang" id="edit_ruangan_kode" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Nama Ruang *</label>
                    <input type="text" name="nama_ruang" id="edit_ruangan_nama" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 20px;">
                    <label>Kapasitas *</label>
                    <input type="number" name="kapasitas" id="edit_ruangan_kapasitas" required>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Update Data</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditRuangan')">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showTab(tabName, event) {
    event.preventDefault();
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    document.querySelectorAll('.admin-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById('tab-' + tabName).classList.add('active');
    event.target.classList.add('active');
}

// Edit Dosen
function editDosen(nidn, nama, jk, jurusan) {
    document.getElementById('edit_dosen_nidn').value = nidn;
    document.getElementById('edit_dosen_nidn_display').value = nidn;
    document.getElementById('edit_dosen_nama').value = nama;
    document.getElementById('edit_dosen_jk').value = jk;
    document.getElementById('edit_dosen_jurusan').value = jurusan;
    document.getElementById('modalEditDosen').style.display = 'block';
}

// Edit Mahasiswa
function editMahasiswa(nim, nama, jk, angkatan, kelas, prodi) {
    document.getElementById('edit_mhs_nim').value = nim;
    document.getElementById('edit_mhs_nim_display').value = nim;
    document.getElementById('edit_mhs_nama').value = nama;
    document.getElementById('edit_mhs_jk').value = jk;
    document.getElementById('edit_mhs_angkatan').value = angkatan;
    document.getElementById('edit_mhs_kelas').value = kelas;
    document.getElementById('edit_mhs_prodi').value = prodi;
    document.getElementById('modalEditMahasiswa').style.display = 'block';
}

// Edit Matakuliah
function editMatakuliah(id, kode, nama, sks, semester, prodi) {
    document.getElementById('edit_mk_id').value = id;
    document.getElementById('edit_mk_kode').value = kode;
    document.getElementById('edit_mk_nama').value = nama;
    document.getElementById('edit_mk_sks').value = sks;
    document.getElementById('edit_mk_semester').value = semester || '';
    document.getElementById('edit_mk_prodi').value = prodi;
    document.getElementById('modalEditMatakuliah').style.display = 'block';
}

// Edit Ruangan
function editRuangan(id, kode, nama, kapasitas) {
    document.getElementById('edit_ruangan_id').value = id;
    document.getElementById('edit_ruangan_kode').value = kode;
    document.getElementById('edit_ruangan_nama').value = nama;
    document.getElementById('edit_ruangan_kapasitas').value = kapasitas;
    document.getElementById('modalEditRuangan').style.display = 'block';
}

// Close Modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>

<?php
$content = ob_get_clean();
require '../views/layouts/app.php';
?>
<div id="modalEditDosen" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>✏️ Edit Data Dosen</h3>
            <span class="close" onclick="closeModal('modalEditDosen')">&times;</span>
        </div>
        <div class="modal-body">
            <form action="index.php?page=admin&action=update_dosen" method="POST">
                <input type="hidden" name="nidn" id="edit_dosen_nidn">
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>NIDN</label>
                    <input type="text" id="edit_dosen_nidn_display" disabled style="background: #f1f5f9;">
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" id="edit_dosen_nama" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Jenis Kelamin *</label>
                    <select name="jenis_kelamin" id="edit_dosen_jk" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group-inline" style="margin-bottom: 20px;">
                    <label>Jurusan *</label>
                    <select name="jurusan_id" id="edit_dosen_jurusan" required>
                        <option value="1">Teknologi Informasi</option>
                        <option value="2">Teknik Elektro</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Update Data</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditDosen')">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT MAHASISWA -->
<div id="modalEditMahasiswa" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>✏️ Edit Data Mahasiswa</h3>
            <span class="close" onclick="closeModal('modalEditMahasiswa')">&times;</span>
        </div>
        <div class="modal-body">
            <form action="index.php?page=admin&action=update_mhs" method="POST">
                <input type="hidden" name="nim" id="edit_mhs_nim">
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>NIM</label>
                    <input type="text" id="edit_mhs_nim_display" disabled style="background: #f1f5f9;">
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" id="edit_mhs_nama" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Jenis Kelamin *</label>
                    <select name="jenis_kelamin" id="edit_mhs_jk" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Angkatan *</label>
                    <input type="number" name="angkatan" id="edit_mhs_angkatan" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 15px;">
                    <label>Kelas *</label>
                    <input type="text" name="kelas" id="edit_mhs_kelas" required>
                </div>
                <div class="form-group-inline" style="margin-bottom: 20px;">
                    <label>Program Studi *</label>
                    <select name="prodi_id" id="edit_mhs_prodi" required>
                        <option value="1">D4 TRPL</option>
                        <option value="2">D3 MI</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">💾 Update Data</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditMahasiswa')">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL