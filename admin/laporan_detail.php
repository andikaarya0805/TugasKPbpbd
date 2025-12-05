<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$id_laporan = intval($_GET['id'] ?? 0);
if ($id_laporan <= 0) die("ID laporan tidak valid!");

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_laporan WHERE id_laporan = $id_laporan"));
if (!$data) die("Data laporan tidak ditemukan!");

$riwayat = [];
$riq = mysqli_query($koneksi, "SELECT aksi, keterangan, tanggal FROM tb_log_aktivitas WHERE id_laporan = $id_laporan ORDER BY tanggal ASC");
while($r = mysqli_fetch_assoc($riq)){
    $riwayat[] = $r;
}

$lat = htmlspecialchars($data['latitude'] ?? '');
$lng = htmlspecialchars($data['longitude'] ?? '');
$maps_url = ($lat && $lng) ? "https://www.google.com/maps?q={$lat},{$lng}" : "#";

$petugas_list = [];
$q = mysqli_query($koneksi,"SELECT id_petugas, nama_petugas FROM tb_petugas ORDER BY nama_petugas ASC");
while($p = mysqli_fetch_assoc($q)){
    $petugas_list[] = $p;
}
?>

<link rel="stylesheet" href="../assets/css/laporan_detail.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
/* Timeline */
.timeline-laporan { list-style: none; padding-left: 0; }
.timeline-laporan-item { margin-bottom: 12px; position: relative; padding-left: 140px; }
.timeline-laporan-item::before {
    content: ''; position: absolute; left: 5px; top: 15px; width: 12px; height: 12px; background: var(--primary); border-radius: 50%;
}
.timeline-laporan-time { position: absolute; right: 0; width: 130px; font-size: 0.8rem; color: var(--gray-500); }
.timeline-laporan-content { display: inline-block; }

/* Modal */
#modal-tugaskan { display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:1000; }
.modal-content { background:#fff; padding:25px; border-radius:10px; width:320px; box-shadow:0 4px 15px rgba(0,0,0,0.2); display:flex; flex-direction:column; gap:15px; animation:fadeIn 0.3s ease-out; }
.modal-content h4 { margin:0; font-weight:600; font-size:1.2em; text-align:center; }
.modal-content select, .modal-content textarea { padding:8px 12px; border-radius:6px; border:1px solid #ccc; width:100%; }
.modal-content button { padding:8px 12px; border-radius:6px; border:none; cursor:pointer; font-weight:500; }
#submit-tugaskan { background-color:#22c55e; color:#fff; }
#close-tugaskan { background-color:#64748b; color:#fff; }
#modal-tugaskan button:hover { opacity:0.9; }

@keyframes fadeIn { from {opacity:0; transform:translateY(-20px);} to {opacity:1; transform:translateY(0);} }
</style>

<div class="card card-laporan">
    <div class="card-body">
        <h2>Detail Laporan</h2>
        <p><strong>Kode Laporan:</strong> <?= htmlspecialchars($data['kode_laporan'] ?? '-') ?></p>
        <p><strong>Pelapor:</strong> <?= htmlspecialchars($data['nama_pelapor'] ?? '-') ?></p>
        <p><strong>No. HP:</strong> <?= htmlspecialchars($data['no_hp'] ?? '-') ?></p>
        <p><strong>Waktu Lapor:</strong> <?= htmlspecialchars($data['tanggal_lapor'] ?? '-') ?></p>
        <p><strong>Jenis Bencana:</strong> <?= htmlspecialchars($data['jenis_bencana'] ?? '-') ?></p>
        <p><strong>Deskripsi:</strong> <?= htmlspecialchars($data['deskripsi'] ?? '-') ?></p>
        <p><strong>Lokasi:</strong> <?= htmlspecialchars($data['alamat'] ?? '-') ?></p>
        <p><strong>Koordinat:</strong> <?= $lat ?>, <?= $lng ?></p>

        <?php if(!empty($data['foto'])): ?>
            <p><strong>Foto Laporan:</strong></p>
            <img src="../uploads/<?= htmlspecialchars($data['foto']) ?>" alt="Foto Laporan" style="max-width:300px; border-radius: var(--radius); margin-bottom:15px;">
        <?php endif; ?>

        <p><strong>Status Saat Ini:</strong> 
            <span class="badge badge-<?= strtolower($data['status'] ?? 'menunggu') ?>">
                <?= htmlspecialchars($data['status'] ?? '-') ?>
            </span>
        </p>

        <h4>Riwayat Status & Catatan:</h4>
        <div id="riwayat-container">
            <ul class="timeline-laporan">
                <?php foreach($riwayat as $r): ?>
                    <li class="timeline-laporan-item <?= ($r['aksi'] == $data['status']) ? 'active' : '' ?>">
                        <span class="timeline-laporan-time"><?= !empty($r['tanggal']) ? date('d M Y H:i:s', strtotime($r['tanggal'])) : '—' ?></span>
                        <span class="timeline-laporan-content">
                            <?= htmlspecialchars($r['aksi']) ?><?= !empty($r['keterangan']) ? ' - ' . htmlspecialchars($r['keterangan']) : '' ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <h4>Aksi Admin:</h4>
        <div class="laporan-actions">
            <form id="form-update-status">
                <input type="hidden" name="id" value="<?= $data['id_laporan'] ?>">
                <label>Status Baru</label>
                <select name="status" class="form-control" required>
                    <?php
                    $all_status = ['Menunggu','Diproses','Selesai'];
                    foreach($all_status as $s){
                        $selected = ($data['status'] ?? '') == $s ? 'selected' : '';
                        echo '<option value="'.htmlspecialchars($s).'" '.$selected.'>'.htmlspecialchars($s).'</option>';
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-success mt-2">Update Status</button>
            </form>

            <form id="form-tambah-catatan" style="margin-top:10px;">
                <input type="hidden" name="id" value="<?= $data['id_laporan'] ?>">
                <textarea name="catatan" class="form-control" placeholder="Tambah catatan petugas"></textarea>
                <button type="submit" class="btn btn-primary mt-2">Simpan Catatan</button>
            </form>

            <button id="btn-tugaskan" class="btn btn-info mt-2">Tugaskan Petugas</button>
            <a href="<?= $maps_url ?>" target="_blank" class="btn btn-secondary mt-2">Lihat Lokasi di Peta</a>
        </div>
    </div>
</div>

<!-- Modal Pilih Petugas -->
<div id="modal-tugaskan">
    <div class="modal-content">
        <h4>Pilih Petugas</h4>
        <select id="select-petugas" class="form-control">
            <option value="">-- Pilih Petugas --</option>
            <?php foreach($petugas_list as $p): ?>
                <option value="<?= $p['id_petugas'] ?>"><?= htmlspecialchars($p['nama_petugas']) ?></option>
            <?php endforeach; ?>
        </select>
        <button id="submit-tugaskan">Tugaskan</button>
        <button id="close-tugaskan">Batal</button>
    </div>
</div>

<script>
document.getElementById('form-update-status').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);
    fetch('laporan_update_ajax.php', { method:'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            const badge = document.querySelector('.badge');
            badge.textContent = data.new_status;
            badge.className = 'badge badge-' + data.new_status.toLowerCase();
            document.getElementById('riwayat-container').innerHTML = data.riwayat_html;
        } else alert(data.message || 'Gagal update status');
    });
});

document.getElementById('form-tambah-catatan').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);
    fetch('tambah_catatan_ajax.php', { method:'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            document.getElementById('riwayat-container').innerHTML = data.riwayat_html;
            this.catatan.value = '';
        } else alert(data.message || 'Gagal tambah catatan');
    });
});

const modal = document.getElementById('modal-tugaskan');
document.getElementById('btn-tugaskan').addEventListener('click', ()=>{ modal.style.display='flex'; });
document.getElementById('close-tugaskan').addEventListener('click', ()=>{ modal.style.display='none'; });

document.getElementById('submit-tugaskan').addEventListener('click', ()=>{
    const id_laporan = document.querySelector('input[name="id"]').value;
    const id_petugas = document.getElementById('select-petugas').value;
    if(!id_petugas){ alert('Pilih petugas terlebih dahulu'); return; }

    const formData = new FormData();
    formData.append('id', id_laporan);
    formData.append('id_petugas', id_petugas);

    fetch('tugaskan_petugas_ajax.php', { method:'POST', body: formData })
    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            document.getElementById('riwayat-container').innerHTML = data.riwayat_html;
            const badge = document.querySelector('.badge');
            badge.textContent = data.new_status;
            badge.className = 'badge badge-' + data.new_status.toLowerCase();
            modal.style.display='none';
            alert('Petugas berhasil ditugaskan');
        } else alert(data.message || 'Terjadi error saat menugaskan petugas');
    }).catch(err=>{ console.error(err); alert('Terjadi error saat menugaskan petugas'); });
});
</script>
