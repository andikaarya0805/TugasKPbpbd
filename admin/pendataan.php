<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendataan - SIPADU BPBD</title>
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
                <h2>Form Pendataan Lapangan</h2>
            </header>
            
            <div class="admin-content">
                <div class="card">
                    <div class="card-header">
                        <h3>Input Data Kerusakan Bencana</h3>
                    </div>
                    <div class="card-body">
                        <form id="form-pendataan" data-validate>
                            <!-- Relasi Laporan -->
                            <h4 style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Relasi Laporan
                            </h4>
                            
                            <div class="form-group">
                                <label class="form-label">Pilih Laporan Terkait</label>
                                <select name="id_laporan" class="form-control form-select">
                                    <option value="">-- Pilih Laporan (Opsional) --</option>
                                    <option value="1">LAP-2024-0001 - Banjir Jakarta Selatan</option>
                                    <option value="2">LAP-2024-0002 - Longsor Bandung</option>
                                    <option value="3">LAP-2024-0003 - Kebakaran Surabaya</option>
                                    <option value="4">LAP-2024-0004 - Angin Jakarta Pusat</option>
                                    <option value="5">LAP-2024-0005 - Gempa Bandung</option>
                                </select>
                            </div>
                            
                            <!-- Data Lokasi -->
                            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Data Lokasi
                            </h4>
                            
                            <div class="form-group">
                                <label class="form-label">Nama Aset/Lokasi <span class="required">*</span></label>
                                <input type="text" name="nama_aset" class="form-control" placeholder="Contoh: Rumah Warga RT 05, Jembatan Desa, dll" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Sektor <span class="required">*</span></label>
                                    <select name="sektor" class="form-control form-select" required>
                                        <option value="">-- Pilih Sektor --</option>
                                        <option value="Perumahan">Perumahan</option>
                                        <option value="Infrastruktur">Infrastruktur</option>
                                        <option value="Sosial">Sosial</option>
                                        <option value="Ekonomi">Ekonomi</option>
                                        <option value="Lintas Sektor">Lintas Sektor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Provinsi <span class="required">*</span></label>
                                    <select name="provinsi" id="provinsi" class="form-control form-select" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Banten">Banten</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Kabupaten/Kota <span class="required">*</span></label>
                                    <select name="kabupaten" id="kabupaten" class="form-control form-select" required>
                                        <option value="">-- Pilih Kabupaten/Kota --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kecamatan <span class="required">*</span></label>
                                    <select name="kecamatan" id="kecamatan" class="form-control form-select" required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Kelurahan/Desa</label>
                                <input type="text" name="kelurahan" class="form-control" placeholder="Nama kelurahan/desa">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Alamat Detail</label>
                                <textarea name="alamat_detail" class="form-control" placeholder="RT/RW, nama jalan, patokan lokasi"></textarea>
                            </div>
                            
                            <!-- Koordinat GPS -->
                            <div class="form-group">
                                <label class="form-label">Titik Koordinat GPS</label>
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
                                        <input type="text" id="latitude" name="latitude" class="form-control" placeholder="-6.xxxxx">
                                    </div>
                                    <div class="coordinate-item">
                                        <label>Longitude</label>
                                        <input type="text" id="longitude" name="longitude" class="form-control" placeholder="106.xxxxx">
                                    </div>
                                </div>
                                <div id="map-preview" style="margin-top: 15px;"></div>
                            </div>
                            
                            <!-- Data Kerusakan -->
                            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Data Kerusakan
                            </h4>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Tingkat Kerusakan <span class="required">*</span></label>
                                    <select name="tingkat_kerusakan" class="form-control form-select" required>
                                        <option value="">-- Pilih Tingkat --</option>
                                        <option value="Ringan">Ringan</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Berat">Berat</option>
                                        <option value="Hancur">Hancur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jumlah Rusak</label>
                                    <div class="input-group">
                                        <input type="number" name="jumlah_rusak" class="form-control" placeholder="0" min="0">
                                        <select name="satuan" class="form-control form-select" style="max-width: 120px;">
                                            <option value="Unit">Unit</option>
                                            <option value="Meter">Meter</option>
                                            <option value="M2">M2</option>
                                            <option value="KM">KM</option>
                                            <option value="Hektar">Hektar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Estimasi Kerugian (Rp)</label>
                                <input type="number" name="estimasi_kerugian" class="form-control" placeholder="0" min="0">
                            </div>
                            
                            <!-- Data Korban -->
                            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Data Korban
                            </h4>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Korban Meninggal</label>
                                    <input type="number" name="korban_meninggal" class="form-control" placeholder="0" min="0">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Korban Luka</label>
                                    <input type="number" name="korban_luka" class="form-control" placeholder="0" min="0">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Jumlah Pengungsi</label>
                                <input type="number" name="pengungsi" class="form-control" placeholder="0" min="0">
                            </div>
                            
                            <!-- Dokumentasi -->
                            <h4 style="margin: 30px 0 20px; padding-bottom: 10px; border-bottom: 2px solid var(--primary);">
                                Dokumentasi
                            </h4>
                            
                            <div class="form-group">
                                <label class="form-label">Upload Foto Dokumentasi</label>
                                <div class="file-upload">
                                    <input type="file" name="foto" id="foto" accept="image/*">
                                    <div class="icon">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                    </div>
                                    <p>Klik atau drag & drop foto di sini</p>
                                    <p><span class="browse">Pilih file</span></p>
                                    <div class="file-preview"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Keterangan Tambahan</label>
                                <textarea name="keterangan" class="form-control" placeholder="Catatan atau keterangan tambahan"></textarea>
                            </div>
                            
                            <!-- Submit -->
                            <div style="margin-top: 30px; display: flex; gap: 15px;">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                        <polyline points="17 21 17 13 7 13 7 21"/>
                                        <polyline points="7 3 7 8 15 8"/>
                                    </svg>
                                    Simpan Data
                                </button>
                                <button type="reset" class="btn btn-outline btn-lg">Reset Form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/geolocation.js"></script>
    <script>
        // Dropdown wilayah
        const wilayahData = {
            'DKI Jakarta': {
                kabupaten: ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Barat', 'Jakarta Selatan', 'Jakarta Timur'],
                kecamatan: {
                    'Jakarta Selatan': ['Cilandak', 'Kebayoran Baru', 'Kebayoran Lama', 'Mampang Prapatan', 'Pancoran', 'Pasar Minggu', 'Pesanggrahan', 'Setiabudi', 'Tebet', 'Jagakarsa'],
                    'Jakarta Pusat': ['Menteng', 'Tanah Abang', 'Senen', 'Cempaka Putih', 'Johar Baru', 'Kemayoran', 'Sawah Besar', 'Gambir']
                }
            },
            'Jawa Barat': {
                kabupaten: ['Bandung', 'Bogor', 'Bekasi', 'Depok', 'Cirebon', 'Sukabumi', 'Tasikmalaya'],
                kecamatan: {
                    'Bandung': ['Astanaanyar', 'Andir', 'Antapani', 'Arcamanik', 'Babakan Ciparay', 'Bandung Kidul', 'Bandung Kulon', 'Bandung Wetan', 'Batununggal', 'Bojongloa Kaler'],
                    'Bogor': ['Bogor Barat', 'Bogor Selatan', 'Bogor Tengah', 'Bogor Timur', 'Bogor Utara', 'Tanah Sareal']
                }
            },
            'Jawa Timur': {
                kabupaten: ['Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Mojokerto', 'Pasuruan'],
                kecamatan: {
                    'Surabaya': ['Tegalsari', 'Genteng', 'Bubutan', 'Simokerto', 'Pabean Cantian', 'Semampir', 'Krembangan', 'Kenjeran', 'Bulak', 'Tambaksari'],
                    'Malang': ['Klojen', 'Blimbing', 'Kedungkandang', 'Sukun', 'Lowokwaru']
                }
            }
        };
        
        document.getElementById('provinsi').addEventListener('change', function() {
            const provinsi = this.value;
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            
            kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            
            if (provinsi && wilayahData[provinsi]) {
                wilayahData[provinsi].kabupaten.forEach(kab => {
                    kabupatenSelect.innerHTML += `<option value="${kab}">${kab}</option>`;
                });
            }
        });
        
        document.getElementById('kabupaten').addEventListener('change', function() {
            const provinsi = document.getElementById('provinsi').value;
            const kabupaten = this.value;
            const kecamatanSelect = document.getElementById('kecamatan');
            
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            
            if (provinsi && kabupaten && wilayahData[provinsi] && wilayahData[provinsi].kecamatan[kabupaten]) {
                wilayahData[provinsi].kecamatan[kabupaten].forEach(kec => {
                    kecamatanSelect.innerHTML += `<option value="${kec}">${kec}</option>`;
                });
            }
        });
        
        // Form submission
        document.getElementById('form-pendataan').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Data pendataan berhasil disimpan!');
            this.reset();
            document.getElementById('map-preview').innerHTML = '';
        });
    </script>
</body>
</html>
