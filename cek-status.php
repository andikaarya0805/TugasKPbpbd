<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Laporan - SIPADU BPBD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <span>Hotline Bencana: <a href="tel:119">119</a> | <a href="tel:112">112</a></span>
                <span>Email: <a href="mailto:info@bpbd.go.id">info@bpbd.go.id</a></span>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <a href="index.php" class="logo">
                    <div class="logo-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div class="logo-text">
                        <h1>SIPADU BPBD</h1>
                        <span>Sistem Pendataan Bencana Terpadu</span>
                    </div>
                </a>
                <button class="nav-toggle" aria-label="Toggle navigation">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12h18M3 6h18M3 18h18"/>
                    </svg>
                </button>
                <nav class="nav">
                    <a href="index.php">Beranda</a>
                    <a href="lapor.php">Laporkan Bencana</a>
                    <a href="cek-status.php" class="active">Cek Status</a>
                    <a href="informasi.php">Informasi</a>
                    <a href="admin/login.php" class="btn btn-outline-white btn-sm">Login Admin</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php">Beranda</a>
                <span>/</span>
                <span>Cek Status Laporan</span>
            </div>
            <h1>Cek Status Laporan</h1>
            <p>Lacak perkembangan laporan bencana yang telah Anda kirimkan</p>
        </div>
    </section>

    <!-- Search Section -->
    <section class="section">
        <div class="container" style="max-width: 800px;">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; vertical-align: middle; margin-right: 8px;">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                        Cari Laporan
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Search by Code -->
                    <form id="form-search-code">
                        <div class="form-group">
                            <label class="form-label">Cari Berdasarkan Kode Laporan</label>
                            <div class="input-group">
                                <input type="text" id="kode-laporan" class="form-control" placeholder="Contoh: LAP-2024-0001">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                    
                    <div style="text-align: center; margin: 30px 0; color: var(--gray-500);">
                        <span style="background: var(--white); padding: 0 15px;">atau</span>
                        <hr style="margin-top: -10px; border-color: var(--gray-200);">
                    </div>
                    
                    <!-- Search by Name & Date -->
                    <form id="form-search-name">
                        <div class="form-group">
                            <label class="form-label">Cari Berdasarkan Nama & Tanggal</label>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" id="nama-pelapor" class="form-control" placeholder="Nama Pelapor">
                            </div>
                            <div class="form-group">
                                <input type="date" id="tanggal-lapor" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline btn-block">Cari Laporan</button>
                    </form>
                </div>
            </div>
            
            <!-- Search Results -->
            <div id="search-results" style="display: none; margin-top: 30px;">
                <div class="card">
                    <div class="card-header">
                        <h3>Hasil Pencarian</h3>
                    </div>
                    <div class="card-body" id="results-content">
                        <!-- Results will be inserted here -->
                    </div>
                </div>
            </div>
            
            <!-- Demo: Sample Result -->
           <!--
<div class="card" style="margin-top: 30px;">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Contoh: LAP-2024-0001</h3>
        <span class="badge badge-diproses">Diproses</span>
    </div>

    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px;">
            <div>
                <p style="color: var(--gray-500); font-size: 0.875rem;">Nama Pelapor</p>
                <p style="font-weight: 600;">Ahmad Wijaya</p>
            </div>
            <div>
                <p style="color: var(--gray-500); font-size: 0.875rem;">No. HP</p>
                <p style="font-weight: 600;">081234567890</p>
            </div>
            <div>
                <p style="color: var(--gray-500); font-size: 0.875rem;">Jenis Bencana</p>
                <p style="font-weight: 600;">Banjir</p>
            </div>
            <div>
                <p style="color: var(--gray-500); font-size: 0.875rem;">Tingkat Kerusakan</p>
                <span class="badge badge-sedang">Sedang</span>
            </div>
            <div style="grid-column: span 2;">
                <p style="color: var(--gray-500); font-size: 0.875rem;">Alamat</p>
                <p style="font-weight: 600;">Jl. Merdeka No. 45, Kel. Sukamaju, Kec. Cilandak, Jakarta Selatan</p>
            </div>
            <div style="grid-column: span 2;">
                <p style="color: var(--gray-500); font-size: 0.875rem;">Deskripsi</p>
                <p>Banjir setinggi 1 meter merendam permukiman warga sejak dini hari. Sekitar 50 rumah terdampak.</p>
            </div>
        </div>

        <h4 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
            Riwayat Status
        </h4>

        <div class="timeline">
            <div class="timeline-item completed">
                <div class="timeline-date">15 Mar 2024, 08:30</div>
                <div class="timeline-content">
                    <strong>Laporan Diterima</strong>
                </div>
            </div>
            <div class="timeline-item completed">
                <div class="timeline-date">15 Mar 2024, 09:15</div>
                <div class="timeline-content">
                    <strong>Verifikasi Data</strong>
                </div>
            </div>
            <div class="timeline-item active">
                <div class="timeline-date">15 Mar 2024, 10:00</div>
                <div class="timeline-content">
                    <strong>Sedang Diproses</strong>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">-</div>
                <div class="timeline-content">
                    <strong>Selesai</strong>
                </div>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <h4 style="margin-bottom: 15px;">Lokasi Kejadian</h4>
            <div style="height: 250px; border-radius: var(--radius-lg); overflow: hidden;">
                <iframe width="100%" height="250"></iframe>
            </div>
        </div>
    </div>
</div>
-->

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-bottom" style="border-top: none; padding-top: 0;">
                <p>&copy; 2025 SIPADU - Sistem Pendataan Bencana Terpadu. Badan Nasional Penanggulangan Bencana.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
    <script>
document.getElementById('form-search-code').addEventListener('submit', async function(e) {
    e.preventDefault();
    const kode = document.getElementById('kode-laporan').value.trim();
    if (!kode) return;

    const res = await fetch(`cek_status_api.php?kode=${kode}`);
    const data = await res.json();
    data && Object.keys(data).length ? tampilkanHasil([data]) : tampilkanKosong();
});

document.getElementById('form-search-name').addEventListener('submit', async function(e) {
    e.preventDefault();
    const nama = document.getElementById('nama-pelapor').value.trim();
    const tanggal = document.getElementById('tanggal-lapor').value;
    if (!nama && !tanggal) return;

    const res = await fetch(`cek_status_api.php?nama=${nama}&tanggal=${tanggal}`);
    const data = await res.json();
    data.length ? tampilkanHasil(data) : tampilkanKosong();
});

let pollingIntervals = {}; 

function tampilkanHasil(list) {
    const container = document.getElementById('search-results');
    const content = document.getElementById('results-content');
    container.style.display = 'block';
    content.innerHTML = '';

    list.forEach(item => {
        const kode = item.kode_laporan;
        content.innerHTML += `
        <div class="card" id="laporan-${kode}" style="margin-top: 30px;">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h3>${kode}</h3>
                <span class="badge badge-${item.status.toLowerCase()}">${item.status}</span>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: repeat(2,1fr); gap: 20px; margin-bottom: 30px;">
                    <div><p class="label">Nama Pelapor</p><p class="value">${item.nama_pelapor || '-'}</p></div>
                    <div><p class="label">No. HP</p><p class="value">${item.no_hp || '-'}</p></div>
                    <div><p class="label">Jenis Bencana</p><p class="value">${item.jenis_bencana || '-'}</p></div>
                    <div><p class="label">Tingkat Kerusakan</p><span class="badge">${item.jenis_kerusakan || '-'}</span></div>
                    <div style="grid-column: span 2;"><p class="label">Alamat</p><p class="value">${item.alamat || '-'}</p></div>
                    <div style="grid-column: span 2;"><p class="label">Deskripsi</p><p>${item.deskripsi || '-'}</p></div>
                </div>

                <h4 class="section-title">Riwayat Status</h4>
                <div class="timeline" id="timeline-${kode}">
                    ${(item.timeline || []).map(t => `
                        <div class="timeline-item ${t.completed ? 'completed' : ''}">
                            <div class="timeline-date">${t.waktu}</div>
                            <div class="timeline-content">
                                <strong>${t.status || '-'}</strong>
                                <p>${t.keterangan || ''}</p>
                            </div>
                        </div>
                    `).join('')}
                </div>

                <div style="margin-top:30px;">
                    <h4 style="margin-bottom:15px;">Lokasi Kejadian</h4>
                    <div style="height:250px; border-radius:var(--radius-lg); overflow:hidden;">
                        <iframe 
                            width="100%" 
                            height="250" 
                            frameborder="0"
                            scrolling="no"
                            src="https://www.openstreetmap.org/export/embed.html?marker=${item.latitude},${item.longitude}"
                        ></iframe>
                    </div>
                    <div style="margin-top:10px;">
                        <a href="https://www.google.com/maps?q=${item.latitude},${item.longitude}" target="_blank" class="btn btn-outline btn-sm">
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
        `;

        // mulai polling per laporan
        if (pollingIntervals[kode]) clearInterval(pollingIntervals[kode]);
        pollingIntervals[kode] = setInterval(async () => {
            try {
                const res = await fetch(`cek_status_api.php?kode=${kode}`);
                const data = await res.json();
                if (!data) return;

                const badgeEl = document.querySelector(`#laporan-${kode} .badge`);
                if (badgeEl && badgeEl.textContent !== data.status) {
                    badgeEl.textContent = data.status;
                    badgeEl.className = `badge badge-${data.status.toLowerCase()}`;
                }

                const timelineEl = document.getElementById(`timeline-${kode}`);
                if (timelineEl && data.timeline) {
                    timelineEl.innerHTML = data.timeline.map(t => `
                        <div class="timeline-item ${t.completed ? 'completed' : ''}">
                            <div class="timeline-date">${t.waktu}</div>
                            <div class="timeline-content">
                                <strong>${t.status || '-'}</strong>
                                <p>${t.keterangan || ''}</p>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (err) {
                console.error(err);
            }
        }, 1000); 
    });
}

</script>

</body>
</html>
