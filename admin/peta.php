<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisasi Peta - SIPADU BPBD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map-full {
            height: calc(100vh - 200px);
            min-height: 500px;
            border-radius: var(--radius-lg);
        }
        .map-legend {
            background: white;
            padding: 15px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <?php include '../includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <h2>Visualisasi Peta Bencana</h2>
            </header>
            
            <div class="admin-content">
                <!-- Filter -->
                <div class="card" style="margin-bottom: 20px;">
                    <div class="card-body">
                        <div class="filter-bar">
                            <select class="form-control form-select" id="filter-jenis">
                                <option value="">Semua Jenis Bencana</option>
                                <option value="banjir">Banjir</option>
                                <option value="gempa">Gempa Bumi</option>
                                <option value="longsor">Tanah Longsor</option>
                                <option value="kebakaran">Kebakaran</option>
                                <option value="angin">Angin Puting Beliung</option>
                            </select>
                            <select class="form-control form-select" id="filter-status">
                                <option value="">Semua Status</option>
                                <option value="baru">Baru</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            <select class="form-control form-select" id="filter-layer">
                                <option value="all">Semua Layer</option>
                                <option value="laporan">Laporan Masuk</option>
                                <option value="pendataan">Data Pendataan</option>
                            </select>
                            <button class="btn btn-primary" onclick="applyFilter()">Terapkan Filter</button>
                        </div>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div id="map-full"></div>
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="card" style="margin-top: 20px;">
                    <div class="card-header">
                        <h3>Legenda</h3>
                    </div>
                    <div class="card-body">
                        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px;">
                            <div class="legend-item">
                                <div class="legend-color" style="background: #3B82F6;"></div>
                                <span>Banjir</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background: #8B5CF6;"></div>
                                <span>Gempa Bumi</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background: #F59E0B;"></div>
                                <span>Tanah Longsor</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background: #EF4444;"></div>
                                <span>Kebakaran</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background: #10B981;"></div>
                                <span>Angin Puting Beliung</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
        // Initialize map
        const map = L.map('map-full').setView([-6.2, 106.8], 8);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        // Custom icons
        function createIcon(color) {
            return L.divIcon({
                className: 'custom-marker',
                html: `<div style="background: ${color}; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>`,
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });
        }
        
        const icons = {
            'Banjir': createIcon('#3B82F6'),
            'Gempa Bumi': createIcon('#8B5CF6'),
            'Tanah Longsor': createIcon('#F59E0B'),
            'Kebakaran': createIcon('#EF4444'),
            'Angin Puting Beliung': createIcon('#10B981')
        };
        
        // Sample data
        const locations = [
            { lat: -6.2615, lng: 106.8106, title: 'Banjir - Jakarta Selatan', type: 'Banjir', status: 'Diproses', kode: 'LAP-2024-0001' },
            { lat: -6.9271, lng: 107.6131, title: 'Longsor - Bandung', type: 'Tanah Longsor', status: 'Baru', kode: 'LAP-2024-0002' },
            { lat: -7.2575, lng: 112.7521, title: 'Kebakaran - Surabaya', type: 'Kebakaran', status: 'Selesai', kode: 'LAP-2024-0003' },
            { lat: -6.1944, lng: 106.8229, title: 'Angin - Jakarta Pusat', type: 'Angin Puting Beliung', status: 'Diproses', kode: 'LAP-2024-0004' },
            { lat: -6.9175, lng: 107.6191, title: 'Gempa - Bandung', type: 'Gempa Bumi', status: 'Baru', kode: 'LAP-2024-0005' }
        ];
        
        let markers = [];
        
        function loadMarkers(data) {
            // Clear existing markers
            markers.forEach(m => map.removeLayer(m));
            markers = [];
            
            data.forEach(loc => {
                const icon = icons[loc.type] || createIcon('#6B7280');
                const marker = L.marker([loc.lat, loc.lng], { icon: icon })
                    .addTo(map)
                    .bindPopup(`
                        <div style="min-width: 200px;">
                            <strong>${loc.type}</strong><br>
                            <small style="color: #666;">${loc.kode}</small>
                            <hr style="margin: 8px 0;">
                            <p style="margin: 5px 0;"><strong>Lokasi:</strong> ${loc.title}</p>
                            <p style="margin: 5px 0;"><strong>Status:</strong> ${loc.status}</p>
                            <p style="margin: 5px 0;"><strong>Koordinat:</strong> ${loc.lat}, ${loc.lng}</p>
                            <hr style="margin: 8px 0;">
                            <a href="https://www.google.com/maps?q=${loc.lat},${loc.lng}" target="_blank" style="color: #EA580C;">Buka di Google Maps</a>
                        </div>
                    `);
                markers.push(marker);
            });
        }
        
        function applyFilter() {
            const jenis = document.getElementById('filter-jenis').value;
            const status = document.getElementById('filter-status').value;
            
            let filtered = locations;
            
            if (jenis) {
                filtered = filtered.filter(l => l.type.toLowerCase().includes(jenis));
            }
            
            if (status) {
                filtered = filtered.filter(l => l.status.toLowerCase() === status);
            }
            
            loadMarkers(filtered);
        }
        
        // Initial load
        loadMarkers(locations);
    </script>
</body>
</html>
