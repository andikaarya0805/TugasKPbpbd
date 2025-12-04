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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>LAP-2024-0001</td>
                                        <td>Ahmad Wijaya</td>
                                        <td>Banjir</td>
                                        <td>Jakarta Selatan</td>
                                        <td>-6.2615, 106.8106</td>
                                        <td>Sedang</td>
                                        <td>Diproses</td>
                                        <td>11 Mar 2024</td>
                                    </tr>
                                    <tr>
                                        <td>LAP-2024-0002</td>
                                        <td>Siti Rahayu</td>
                                        <td>Tanah Longsor</td>
                                        <td>Bandung</td>
                                        <td>-6.9271, 107.6131</td>
                                        <td>Berat</td>
                                        <td>Baru</td>
                                        <td>12 Mar 2024</td>
                                    </tr>
                                    <tr>
                                        <td>LAP-2024-0003</td>
                                        <td>Rizki Pratama</td>
                                        <td>Kebakaran</td>
                                        <td>Surabaya</td>
                                        <td>-7.2575, 112.7521</td>
                                        <td>Berat</td>
                                        <td>Selesai</td>
                                        <td>13 Mar 2024</td>
                                    </tr>
                                    <tr>
                                        <td>LAP-2024-0004</td>
                                        <td>Dewi Lestari</td>
                                        <td>Angin Puting Beliung</td>
                                        <td>Jakarta Pusat</td>
                                        <td>-6.1944, 106.8229</td>
                                        <td>Ringan</td>
                                        <td>Diproses</td>
                                        <td>14 Mar 2024</td>
                                    </tr>
                                    <tr>
                                        <td>LAP-2024-0005</td>
                                        <td>Hendra Gunawan</td>
                                        <td>Gempa Bumi</td>
                                        <td>Bandung</td>
                                        <td>-6.9175, 107.6191</td>
                                        <td>Sedang</td>
                                        <td>Baru</td>
                                        <td>15 Mar 2024</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
