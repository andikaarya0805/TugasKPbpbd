<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIPADU BPBD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
    <?php include '../includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <div>
                    <button class="sidebar-toggle btn btn-sm" style="display: none;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12h18M3 6h18M3 18h18"/>
                        </svg>
                    </button>
                    <h2 style="display: inline; margin-left: 10px;">Dashboard</h2>
                </div>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span style="color: var(--gray-600);">Selamat datang, Administrator</span>
                    <a href="../index.php" class="btn btn-outline btn-sm">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Lihat Website
                    </a>
                </div>
            </header>
            
            <div class="admin-content">
                <!-- Alert for new reports -->
                <div class="alert alert-warning" style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4M12 16h.01"/>
                        </svg>
                        <span><strong>2 Laporan Baru</strong> membutuhkan perhatian Anda</span>
                    </div>
                    <a href="laporan.php" class="btn btn-warning btn-sm">Lihat Laporan</a>
                </div>
                
                <!-- Stats -->
      <div class="dashboard-stats">

    <!-- Total Laporan -->
    <div class="dashboard-stat">
        <div class="icon orange">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            </svg>
        </div>
        <div>
            <div class="number" id="total-laporan">0</div>
            <div class="label">Total Laporan</div>
        </div>
    </div>

    <!-- Laporan Baru / Hari Ini -->
    <div class="dashboard-stat">
        <div class="icon yellow">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 8v4M12 16h.01"/>
            </svg>
        </div>
        <div>
            <div class="number" id="laporan-hari-ini">0</div>
            <div class="label">Laporan Baru</div>
        </div>
    </div>

    <!-- Sedang diproses -->
    <div class="dashboard-stat">
        <div class="icon blue">
            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
        <div>
            <div class="number" id="diproses">0</div>
            <div class="label">Sedang Diproses</div>
        </div>
    </div>

    <!-- Selesai -->
    <div class="dashboard-stat">
        <div class="icon green">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div>
            <div class="number" id="selesai">0</div>
            <div class="label">Selesai</div>
        </div>
    </div>

</div>
                
                <!-- Quick Actions -->
                <h3 style="margin-bottom: 20px;">Aksi Cepat</h3>
                <div class="quick-actions">
                    <a href="laporan.php" class="quick-action">
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Kelola Laporan</h4>
                            <p>Lihat dan proses laporan masuk</p>
                        </div>
                    </a>
                    <a href="pendataan.php" class="quick-action">
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Input Pendataan</h4>
                            <p>Tambah data kerusakan baru</p>
                        </div>
                    </a>
                    <a href="peta.php" class="quick-action">
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Lihat Peta</h4>
                            <p>Visualisasi sebaran bencana</p>
                        </div>
                    </a>
                    <a href="export.php" class="quick-action">
                        <div class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Ekspor Data</h4>
                            <p>Download laporan Excel/PDF</p>
                        </div>
                    </a>
                </div>
                
                <!-- Two Column Layout -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px;">
                    <!-- Recent Reports -->
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <h3>Laporan Terbaru</h3>
                            <a href="laporan.php" style="color: var(--primary); font-size: 0.875rem;">Lihat Semua →</a>
                        </div>
                        <div class="card-body" style="padding: 0;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>LAP-2024-0005</strong></td>
                                        <td>Gempa Bumi</td>
                                        <td><span class="badge badge-baru">Baru</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>LAP-2024-0004</strong></td>
                                        <td>Angin Puting Beliung</td>
                                        <td><span class="badge badge-diproses">Diproses</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>LAP-2024-0003</strong></td>
                                        <td>Kebakaran</td>
                                        <td><span class="badge badge-selesai">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>LAP-2024-0002</strong></td>
                                        <td>Tanah Longsor</td>
                                        <td><span class="badge badge-baru">Baru</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>LAP-2024-0001</strong></td>
                                        <td>Banjir</td>
                                        <td><span class="badge badge-diproses">Diproses</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Map Preview -->
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <h3>Peta Sebaran Bencana</h3>
                            <a href="peta.php" style="color: var(--primary); font-size: 0.875rem;">Lihat Peta Lengkap →</a>
                        </div>
                        <div class="card-body">
                            <div id="map-preview" class="map-container"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Statistics by Disaster Type -->
                <div class="card" style="margin-top: 30px;">
    <div class="card-header">
        <h3>Statistik Berdasarkan Jenis Bencana</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px;">

            <div style="text-align: center; padding: 20px; background: var(--info-light); border-radius: var(--radius);">
                <div id="bencana-banjir" style="font-size: 2rem; font-weight: 700; color: var(--info);">0</div>
                <div style="color: var(--gray-600); font-size: 0.875rem;">Banjir</div>
            </div>

            <div style="text-align: center; padding: 20px; background: var(--warning-light); border-radius: var(--radius);">
                <div id="bencana-longsor" style="font-size: 2rem; font-weight: 700; color: #B45309;">0</div>
                <div style="color: var(--gray-600); font-size: 0.875rem;">Tanah Longsor</div>
            </div>

            <div style="text-align: center; padding: 20px; background: var(--danger-light); border-radius: var(--radius);">
                <div id="bencana-kebakaran" style="font-size: 2rem; font-weight: 700; color: var(--danger);">0</div>
                <div style="color: var(--gray-600); font-size: 0.875rem;">Kebakaran</div>
            </div>

            <div style="text-align: center; padding: 20px; background: var(--success-light); border-radius: var(--radius);">
                <div id="bencana-gempa" style="font-size: 2rem; font-weight: 700; color: var(--success);">0</div>
                <div style="color: var(--gray-600); font-size: 0.875rem;">Gempa Bumi</div>
            </div>

            <div style="text-align: center; padding: 20px; background: var(--primary-lighter); border-radius: var(--radius);">
                <div id="bencana-lainnya" style="font-size: 2rem; font-weight: 700; color: var(--primary-dark);">0</div>
                <div style="color: var(--gray-600); font-size: 0.875rem;">Lainnya</div>
            </div>

        </div>
    </div>
</div>

                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map-preview').setView([-6.2, 106.8], 10);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            const locations = [
                { lat: -6.2615, lng: 106.8106, title: 'Banjir - Jakarta Selatan', type: 'Banjir' },
                { lat: -6.9271, lng: 107.6131, title: 'Longsor - Bandung', type: 'Tanah Longsor' },
                { lat: -7.2575, lng: 112.7521, title: 'Kebakaran - Surabaya', type: 'Kebakaran' },
                { lat: -6.1944, lng: 106.8229, title: 'Angin - Jakarta Pusat', type: 'Angin Puting Beliung' },
                { lat: -6.9175, lng: 107.6191, title: 'Gempa - Bandung', type: 'Gempa Bumi' }
            ];
            
            locations.forEach(loc => {
                L.marker([loc.lat, loc.lng])
                    .addTo(map)
                    .bindPopup(`<strong>${loc.type}</strong><br>${loc.title}`);
            });
        });

        //update data dashboard stats from API
document.addEventListener("DOMContentLoaded", () => {

    setInterval(() => {
        fetch("/kpfinal1/public/api_dashboard.php")
            .then(res => res.json())
            .then(data => {
                document.getElementById("total-laporan").innerText = data.total_laporan ?? 0;
                document.getElementById("laporan-hari-ini").innerText = data.laporan_hari_ini ?? 0;
                document.getElementById("diproses").innerText = data.diproses ?? 0;
                document.getElementById("selesai").innerText = data.selesai ?? 0;
            })
            .catch(err => console.error("Dashboard Error:", err));
    }, 1000);

    setInterval(() => {
        fetch("/kpfinal1/public/api_statistik_bencana.php")
            .then(res => res.json())
            .then(data => {
                document.getElementById("bencana-banjir").innerText = data.Banjir ?? 0;
                document.getElementById("bencana-longsor").innerText = data["Tanah Longsor"] ?? 0;
                document.getElementById("bencana-kebakaran").innerText = data.Kebakaran ?? 0;
                document.getElementById("bencana-gempa").innerText = data["Gempa Bumi"] ?? 0;
                document.getElementById("bencana-lainnya").innerText = data.Lainnya ?? 0;
            })
            .catch(err => console.error("Bencana Error:", err));
    }, 1000);

});

    </script>
</body>
</html>
