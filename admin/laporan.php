<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekspor Data - SIPADU BPBD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <h2>Ekspor Data</h2>
            </header>
            
            <div class="admin-content">
                <!-- Export Options -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">
                    <!-- Export Laporan -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Ekspor Data Laporan</h3>
                        </div>
                        <div class="card-body">
                            <form id="form-export-laporan">
                                <div class="form-group">
                                    <label class="form-label">Rentang Tanggal</label>
                                    <div class="form-row">
                                        <input type="date" name="tanggal_mulai" class="form-control">
                                        <input type="date" name="tanggal_akhir" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control form-select">
                                        <option value="">Semua Status</option>
                                        <option value="Baru">Baru</option>
                                        <option value="Diproses">Diproses</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jenis Bencana</label>
                                    <select name="jenis" class="form-control form-select">
                                        <option value="">Semua Jenis</option>
                                        <option value="Banjir">Banjir</option>
                                        <option value="Gempa Bumi">Gempa Bumi</option>
                                        <option value="Tanah Longsor">Tanah Longsor</option>
                                        <option value="Kebakaran">Kebakaran</option>
                                        <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                                    </select>
                                </div>
                                <div style="display: flex; gap: 10px; margin-top: 20px;">
                                    <button type="button" class="btn btn-success" onclick="exportCSV('laporan')">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                            <polyline points="7 10 12 15 17 10"/>
                                            <line x1="12" y1="15" x2="12" y2="3"/>
                                        </svg>
                                        Export CSV
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="exportPDF('laporan')">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                        </svg>
                                        Export PDF
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Export Pendataan -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Ekspor Data Pendataan</h3>
                        </div>
                        <div class="card-body">
                            <form id="form-export-pendataan">
                                <div class="form-group">
                                    <label class="form-label">Rentang Tanggal</label>
                                    <div class="form-row">
                                        <input type="date" name="tanggal_mulai" class="form-control">
                                        <input type="date" name="tanggal_akhir" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sektor</label>
                                    <select name="sektor" class="form-control form-select">
                                        <option value="">Semua Sektor</option>
                                        <option value="Perumahan">Perumahan</option>
                                        <option value="Infrastruktur">Infrastruktur</option>
                                        <option value="Sosial">Sosial</option>
                                        <option value="Ekonomi">Ekonomi</option>
                                        <option value="Lintas Sektor">Lintas Sektor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tingkat Kerusakan</label>
                                    <select name="kerusakan" class="form-control form-select">
                                        <option value="">Semua Tingkat</option>
                                        <option value="Ringan">Ringan</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Berat">Berat</option>
                                        <option value="Hancur">Hancur</option>
                                    </select>
                                </div>
                                <div style="display: flex; gap: 10px; margin-top: 20px;">
                                    <button type="button" class="btn btn-success" onclick="exportCSV('pendataan')">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                            <polyline points="7 10 12 15 17 10"/>
                                            <line x1="12" y1="15" x2="12" y2="3"/>
                                        </svg>
                                        Export CSV
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="exportPDF('pendataan')">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                        </svg>
                                        Export PDF
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
          <!-- Preview Data -->
<div class="card" style="margin-top: 30px;">
    <div class="card-header">
        <h3>Preview Data Laporan</h3>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="table" id="table-preview">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Pelapor</th>
                        <th>Jenis Bencana</th>
                        <th>Lokasi</th>
                        <th>Koordinat</th>
                        <th>Kerusakan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
        <tbody>
<?php
include '../config/database.php';

// Ambil semua data laporan
$query = mysqli_query($koneksi, "SELECT * FROM tb_laporan ORDER BY tanggal_lapor DESC");
if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}

while ($row = mysqli_fetch_assoc($query)) :
    $koordinat = $row['latitude'] . ', ' . $row['longitude'];
?>
<tr>
    <td><?php echo $row['kode_laporan']; ?></td>
    <td><?php echo $row['nama_pelapor']; ?></td>
    <td><?php echo $row['jenis_bencana']; ?></td>
    <td><?php echo $row['alamat']; ?></td>
    <td><?php echo $koordinat; ?></td>
    <td><?php echo $row['jenis_kerusakan']; ?></td>
    
    <!-- Kolom Status: tampilkan badge/text -->
    <td>
        <?php
        $status_color = [
            'Menunggu' => 'badge bg-secondary',
            'Diproses' => 'badge bg-warning',
            'Selesai'  => 'badge bg-success'
        ];
        $badge_class = isset($status_color[$row['status']]) ? $status_color[$row['status']] : 'badge bg-dark';
        ?>
        <span class="<?php echo $badge_class; ?>"><?php echo htmlspecialchars($row['status']); ?></span>
    </td>
    
    <td><?php echo date("d M Y", strtotime($row['tanggal_lapor'])); ?></td>
    
    <!-- Kolom Aksi: dropdown update status + tombol lainnya -->
    <td>
        <form method="POST" action="laporan_update.php" style="margin-bottom:5px;">
            <input type="hidden" name="id" value="<?php echo $row['id_laporan']; ?>">
            <select name="status" class="form-control form-select" onchange="this.form.submit()">
                <?php
                $all_status = ['Menunggu', 'Diproses', 'Selesai'];
                foreach ($all_status as $status_option) {
                    $selected = $row['status'] == $status_option ? 'selected' : '';
                    echo '<option value="'.htmlspecialchars($status_option).'" '.$selected.'>'.htmlspecialchars($status_option).'</option>';
                }
                ?>
            </select>
        </form>

        <a href="laporan_detail.php?id=<?php echo $row['id_laporan']; ?>" class="btn btn-info btn-sm">Detail</a>
        <button class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $row['id_laporan']; ?>)">Hapus</button>

    </td>
</tr>

<?php endwhile; ?>


</tbody>

            </table>
        </div>
    </div>
</div>


    <script src="../assets/js/main.js"></script>
    <script>
        function exportCSV(type) {
            // Generate CSV content
            const table = document.getElementById('table-preview');
            let csv = [];
            const rows = table.querySelectorAll('tr');
            
            rows.forEach(row => {
                const cols = row.querySelectorAll('td, th');
                const rowData = [];
                cols.forEach(col => {
                    rowData.push('"' + col.textContent.trim().replace(/"/g, '""') + '"');
                });
                csv.push(rowData.join(','));
            });
            
            const csvContent = csv.join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `data-${type}-${new Date().toISOString().split('T')[0]}.csv`;
            link.click();
            
            alert(`Data ${type} berhasil diekspor ke CSV!`);
        }
        
        function exportPDF(type) {
            // In real implementation, this would generate a PDF
            alert(`Fitur export PDF untuk ${type} akan menggunakan library seperti jsPDF atau server-side PDF generation.`);
        }
    </script>
</body>
</html>
