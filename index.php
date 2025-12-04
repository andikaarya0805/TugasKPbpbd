<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPADU - Sistem Pendataan Bencana Terpadu | BPBD</title>
    <meta name="description" content="Sistem Pendataan Bencana Terpadu untuk pelaporan dan penanganan bencana oleh BPBD">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Laporkan Bencana dengan Cepat dan Mudah</h1>
                <p>Sistem Pendataan Bencana Terpadu (SIPADU) memudahkan masyarakat untuk melaporkan kejadian bencana secara real-time dengan teknologi GPS yang akurat.</p>
                <div class="hero-buttons">
                    <a href="/kpfinal1/lapor.php" class="btn btn-secondary btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        Laporkan Bencana
                    </a>
                    <a href="/kpfinal1/cek-status.php" class="btn btn-outline-white btn-lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                        Cek Status Laporan
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <svg width="400" height="300" viewBox="0 0 400 300" fill="none">
                    <rect x="50" y="100" width="300" height="180" rx="10" fill="white" opacity="0.1"/>
                    <circle cx="200" cy="120" r="60" fill="white" opacity="0.15"/>
                    <path d="M200 80v80M160 120h80" stroke="white" stroke-width="4" stroke-linecap="round"/>
                    <circle cx="200" cy="120" r="20" fill="white" opacity="0.3"/>
                    <rect x="80" y="200" width="240" height="60" rx="5" fill="white" opacity="0.1"/>
                    <circle cx="110" cy="230" r="15" fill="#22C55E"/>
                    <rect x="140" y="220" width="160" height="8" rx="4" fill="white" opacity="0.3"/>
                    <rect x="140" y="235" width="100" height="6" rx="3" fill="white" opacity="0.2"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                    </div>
                    <div class="stat-number" id="total-laporan">156</div>
                    <div class="stat-label">Total Laporan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="stat-number" id="laporan-diproses">42</div>
                    <div class="stat-label">Sedang Diproses</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    </div>
                    <div class="stat-number" id="laporan-selesai">98</div>
                    <div class="stat-label">Selesai Ditangani</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="stat-number" id="total-pengungsi">1,250</div>
                    <div class="stat-label">Warga Terdampak</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-header">
                <h2>Fitur Unggulan SIPADU</h2>
                <p>Sistem yang dirancang untuk mempercepat pelaporan dan penanganan bencana di Indonesia</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M12 2v3M12 19v3M2 12h3M19 12h3"/>
                        </svg>
                    </div>
                    <h3>GPS Otomatis</h3>
                    <p>Pengambilan koordinat lokasi secara otomatis menggunakan teknologi GPS untuk akurasi tinggi</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h3>Pemetaan Real-time</h3>
                    <p>Visualisasi lokasi bencana pada peta interaktif untuk memudahkan koordinasi penanganan</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <h3>Respon Cepat</h3>
                    <p>Sistem notifikasi otomatis kepada petugas lapangan untuk penanganan yang lebih cepat</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                    </div>
                    <h3>Dokumentasi Lengkap</h3>
                    <p>Pencatatan data kerusakan, foto dokumentasi, dan estimasi kerugian secara terstruktur</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                    </div>
                    <h3>Lacak Status</h3>
                    <p>Pantau perkembangan laporan Anda secara real-time melalui sistem tracking yang mudah</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                    </div>
                    <h3>Ekspor Data</h3>
                    <p>Unduh laporan dalam format Excel dan PDF untuk keperluan dokumentasi dan analisis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Contact -->
    <section class="emergency">
        <div class="container">
            <div class="emergency-info">
                <h3>Butuh Bantuan Darurat?</h3>
                <p>Hubungi nomor darurat di bawah ini untuk pertolongan segera</p>
            </div>
            <div class="emergency-contacts">
                <div class="emergency-contact">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="number">119</div>
                        <div class="label">BPBD</div>
                    </div>
                </div>
                <div class="emergency-contact">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="number">112</div>
                        <div class="label">Darurat Nasional</div>
                    </div>
                </div>
                <div class="emergency-contact">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="number">113</div>
                        <div class="label">Pemadam Kebakaran</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="/assets/js/main.js"></script>

</body>
</html>
