    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporkan Bencana - SIPADU BPBD</title>
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
                        <a href="lapor.php" class="active">Laporkan Bencana</a>
                        <a href="cek-status.php">Cek Status</a>
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
                    <span>Laporkan Bencana</span>
                </div>
                <h1>Laporkan Kejadian Bencana</h1>
                <p>Isi formulir di bawah ini dengan lengkap dan akurat untuk pelaporan bencana</p>
            </div>
        </section>

        <!-- Form Section -->
        <section class="section">
            <div class="container" style="max-width: 800px;">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; vertical-align: middle; margin-right: 8px;">
                                <path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            </svg>
                            Form Pelaporan Bencana
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="alert-container"></div>
                        
                        <form id="form-laporan" data-validate>
                            <!-- Data Pelapor -->
                            <h4 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Data Pelapor
                            </h4>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        Nama Lengkap <span class="required">*</span>
                                    </label>
                                    <input type="text" name="nama_pelapor" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        No. HP/WhatsApp <span class="required">*</span>
                                    </label>
                                    <input type="tel" name="no_hp" class="form-control" placeholder="Contoh: 081234567890" data-validate="phone" required>
                                </div>
                            </div>
                            
                            <!-- Lokasi Kejadian -->
                            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Lokasi Kejadian
                            </h4>
                            
                            <div class="form-group">
                                <label class="form-label">
                                    Alamat Lengkap <span class="required">*</span>
                                </label>
                                <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap lokasi kejadian (RT/RW, Kelurahan, Kecamatan, Kota)" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">
                                    Titik Koordinat GPS
                                </label>
                                <button type="button" id="gps-button" class="gps-button">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <circle cx="12" cy="12" r="3"/>
                                        <path d="M12 2v3M12 19v3M2 12h3M19 12h3"/>
                                    </svg>
                                    Ambil Koordinat GPS
                                </button>
                                <div id="gps-status" style="margin-top: 10px;"></div>
                                <div class="coordinate-display">
                                    <div class="coordinate-item">
                                        <label>Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control" placeholder="-6.xxxxx" readonly>
                                    </div>
                                    <div class="coordinate-item">
                                        <label>Longitude</label>
                                        <input type="text" id="longitude" name="longitude" class="form-control" placeholder="106.xxxxx" readonly>
                                    </div>
                                </div>
                                <div id="map-preview" style="margin-top: 15px;"></div>
                            </div>
                            
                            <!-- Detail Bencana -->
                            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Detail Bencana
                            </h4>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        Jenis Bencana <span class="required">*</span>
                                    </label>
                                    <select name="jenis_bencana" class="form-control form-select" required>
                                        <option value="">-- Pilih Jenis Bencana --</option>
                                        <option value="Banjir">Banjir</option>
                                        <option value="Gempa Bumi">Gempa Bumi</option>
                                        <option value="Tanah Longsor">Tanah Longsor</option>
                                        <option value="Kebakaran">Kebakaran</option>
                                        <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                                        <option value="Tsunami">Tsunami</option>
                                        <option value="Gunung Meletus">Gunung Meletus</option>
                                        <option value="Kekeringan">Kekeringan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        Tingkat Kerusakan <span class="required">*</span>
                                    </label>
                                    <select name="jenis_kerusakan" class="form-control form-select" required>
                                        <option value="">-- Pilih Tingkat Kerusakan --</option>
                                        <option value="Ringan">Ringan - Kerusakan minor, masih bisa digunakan</option>
                                        <option value="Sedang">Sedang - Kerusakan sebagian, perlu perbaikan</option>
                                        <option value="Berat">Berat - Kerusakan besar, tidak aman digunakan</option>
                                        <option value="Sangat Berat">Sangat Berat - Hancur total, perlu dibangun ulang</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">
                                    Deskripsi Kejadian <span class="required">*</span>
                                </label>
                                <textarea name="deskripsi" class="form-control" placeholder="Jelaskan secara detail kejadian bencana, jumlah korban/rumah terdampak, kondisi saat ini, dll." style="min-height: 150px;" required></textarea>
                            </div>
                            
                            <!-- Upload Foto -->
                            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Dokumentasi Foto
                            </h4>
                            
                            <div class="form-group">
                                <label class="form-label">Upload Foto Lokasi/Kerusakan</label>
                                <div class="file-upload">
    <label for="foto" class="upload-area">
        <div class="icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
            </svg>
        </div>
        <p>Klik atau drag & drop foto di sini</p>
        <p><span class="browse">Pilih file</span> (Maks. 5MB, format: JPG, PNG)</p>
    </label>

    <input type="file" name="foto" id="foto" accept="image/*">
    <div class="file-preview"></div>
</div>

                            </div>
                            
                            <!-- Submit -->
                            <div style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                                    </svg>
                                    Kirim Laporan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Info Box -->
                <div class="card" style="margin-top: 30px; background: var(--info-light); border: 1px solid #BFDBFE;">
                    <div class="card-body">
                        <h4 style="color: #1D4ED8; margin-bottom: 15px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; vertical-align: middle; margin-right: 8px;">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 16v-4M12 8h.01"/>
                            </svg>
                            Panduan Pelaporan
                        </h4>
                        <ul style="color: #1E40AF; margin-left: 20px;">
                            <li>Pastikan data yang diisi akurat dan dapat diverifikasi</li>
                            <li>Aktifkan GPS pada perangkat Anda untuk mendapatkan koordinat lokasi yang tepat</li>
                            <li>Foto yang diunggah akan membantu tim dalam verifikasi laporan</li>
                            <li>Setelah laporan terkirim, Anda akan mendapatkan kode laporan untuk tracking</li>
                            <li>Untuk keadaan darurat yang mengancam jiwa, segera hubungi 112 atau 119</li>
                        </ul>
                    </div>
                </div>
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

        <!-- Success Modal -->
        <div class="modal-overlay" id="modal-success">
            <div class="modal">
                <div class="modal-header">
                    <h3>Laporan Terkirim!</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body" style="text-align: center; padding: 40px;">
                    <div style="width: 80px; height: 80px; background: var(--success-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 10px;">Terima Kasih!</h4>
                    <p style="color: var(--gray-600); margin-bottom: 20px;">Laporan Anda telah berhasil dikirim dan akan segera diproses oleh petugas.</p>
                    <div style="background: var(--gray-100); padding: 20px; border-radius: var(--radius); margin-bottom: 20px;">
                        <p style="font-size: 0.875rem; color: var(--gray-600);">Kode Laporan Anda:</p>
                        <p id="kode-laporan" style="font-size: 1.5rem; font-weight: 700; color: var(--primary);"></p>
                    </div>
                    <p style="font-size: 0.875rem; color: var(--gray-500);">Simpan kode ini untuk melacak status laporan Anda</p>
                </div>
                <div class="modal-footer">
                    <a href="cek-status.php" class="btn btn-outline">Cek Status</a>
                    <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                </div>
            </div>
        </div>

        <script src="assets/js/main.js"></script>
        <script src="assets/js/geolocation.js"></script>
        <script>
    document.getElementById('form-laporan').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    const foto = document.getElementById("foto").files[0];
    if (foto) {
        formData.set("foto", foto);
    } else {
        formData.delete("foto");
    }

    try {
        const response = await fetch('laporan_simpan.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success === true) {
    document.getElementById('kode-laporan').textContent = result.kode;
    document.getElementById('modal-success').classList.add('active');
    form.reset();
} else {
    alert("Gagal mengirim laporan: " + result.message);
}


    } catch (err) {
        console.error(err);
        alert("Terjadi kesalahan saat mengirim data.");
    }
});

    </script>

    </body>
    </html>
