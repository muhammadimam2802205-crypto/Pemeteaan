<?php if (!session()->get('logged_in')): ?>
    <?php header('Location: ' . base_url('auth/login')); ?>
    <?php exit(); ?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sekolah - <?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 300px; border-radius: 10px; margin-top: 10px; }
        .form-group { margin-bottom: 1rem; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-edit me-2"></i>Edit Data Sekolah
            </h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('lokasi/update/' . $lokasi['id_lokasi']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-school me-1"></i> Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control" value="<?= esc($lokasi['nama_sekolah']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-graduation-cap me-1"></i> Jenjang</label>
                            <select name="jenjang" class="form-control" required>
                                <option value="SD" <?= $lokasi['jenjang'] == 'SD' ? 'selected' : '' ?>>SD / Sederajat</option>
                                <option value="SMP" <?= $lokasi['jenjang'] == 'SMP' ? 'selected' : '' ?>>SMP / Sederajat</option>
                                <option value="SMA" <?= $lokasi['jenjang'] == 'SMA' ? 'selected' : '' ?>>SMA / Sederajat</option>
                                <option value="SMK" <?= $lokasi['jenjang'] == 'SMK' ? 'selected' : '' ?>>SMK / Sederajat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><i class="fas fa-location-dot me-1"></i> Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2" required><?= esc($lokasi['alamat']) ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-map-marker-alt me-1"></i> Kecamatan</label>
                            <select name="kecamatan" class="form-control" required>
                                <option value="">Pilih Kecamatan</option>
                                <option value="Batusangkar" <?= $lokasi['kecamatan'] == 'Batusangkar' ? 'selected' : '' ?>>Batusangkar</option>
                                <option value="Lima Kaum" <?= $lokasi['kecamatan'] == 'Lima Kaum' ? 'selected' : '' ?>>Lima Kaum</option>
                                <option value="Rambatan" <?= $lokasi['kecamatan'] == 'Rambatan' ? 'selected' : '' ?>>Rambatan</option>
                                <option value="Pariangan" <?= $lokasi['kecamatan'] == 'Pariangan' ? 'selected' : '' ?>>Pariangan</option>
                                <option value="Salimpaung" <?= $lokasi['kecamatan'] == 'Salimpaung' ? 'selected' : '' ?>>Salimpaung</option>
                                <option value="Sungai Tarab" <?= $lokasi['kecamatan'] == 'Sungai Tarab' ? 'selected' : '' ?>>Sungai Tarab</option>
                                <option value="Batipuh" <?= $lokasi['kecamatan'] == 'Batipuh' ? 'selected' : '' ?>>Batipuh</option>
                                <option value="Lintau Buo" <?= $lokasi['kecamatan'] == 'Lintau Buo' ? 'selected' : '' ?>>Lintau Buo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="fas fa-star me-1"></i> Akreditasi</label>
                            <select name="akreditasi" class="form-control">
                                <option value="A" <?= $lokasi['akreditasi'] == 'A' ? 'selected' : '' ?>>A (Unggul)</option>
                                <option value="B" <?= $lokasi['akreditasi'] == 'B' ? 'selected' : '' ?>>B (Baik)</option>
                                <option value="C" <?= $lokasi['akreditasi'] == 'C' ? 'selected' : '' ?>>C (Cukup)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="fas fa-tools me-1"></i> Fasilitas</label>
                            <input type="text" name="fasilitas" class="form-control" value="<?= esc($lokasi['fasilitas']) ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-arrow-up me-1"></i> Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" value="<?= esc($lokasi['latitude']) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-arrow-right me-1"></i> Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" value="<?= esc($lokasi['longitude']) ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><i class="fas fa-map me-1"></i> Klik pada peta untuk mengubah koordinat</label>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Update Data
                    </button>
                    <a href="<?= base_url('lokasi/index') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var lat = <?= $lokasi['latitude'] ?: -0.4464 ?>;
    var lng = <?= $lokasi['longitude'] ?: 100.5872 ?>;
    
    var map = L.map('map').setView([lat, lng], 15);
    
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    
    var marker = L.marker([lat, lng]).addTo(map);
    
    function onMapClick(e) {
        var newLat = e.latlng.lat.toFixed(6);
        var newLng = e.latlng.lng.toFixed(6);
        
        document.getElementById('latitude').value = newLat;
        document.getElementById('longitude').value = newLng;
        
        map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);
        marker.bindPopup('Koordinat: ' + newLat + ', ' + newLng).openPopup();
    }
    
    map.on('click', onMapClick);
</script>
</body>
</html>