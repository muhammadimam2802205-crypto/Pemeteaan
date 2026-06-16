<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Sekolah - <?= $judul ?></title>
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
                <i class="fas fa-plus-circle me-2"></i>Tambah Data Sekolah
            </h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('lokasi/save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-school me-1"></i> Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-graduation-cap me-1"></i> Jenjang</label>
                            <select name="jenjang" class="form-control" required>
                                <option value="">Pilih Jenjang</option>
                                <option value="SD">SD / Sederajat</option>
                                <option value="SMP">SMP / Sederajat</option>
                                <option value="SMA">SMA / Sederajat</option>
                                <option value="SMK">SMK / Sederajat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><i class="fas fa-location-dot me-1"></i> Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-map-marker-alt me-1"></i> Kecamatan</label>
                            <select name="kecamatan" class="form-control" required>
                                <option value="">Pilih Kecamatan</option>
                                <option value="Batusangkar">Batusangkar</option>
                                <option value="Lima Kaum">Lima Kaum</option>
                                <option value="Rambatan">Rambatan</option>
                                <option value="Pariangan">Pariangan</option>
                                <option value="Salimpaung">Salimpaung</option>
                                <option value="Sungai Tarab">Sungai Tarab</option>
                                <option value="Batipuh">Batipuh</option>
                                <option value="Lintau Buo">Lintau Buo</option>
                                <option value="Padang Ganting">Padang Ganting</option>
                                <option value="Tanjung Emas">Tanjung Emas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="fas fa-star me-1"></i> Akreditasi</label>
                            <select name="akreditasi" class="form-control">
                                <option value="A">A (Unggul)</option>
                                <option value="B">B (Baik)</option>
                                <option value="C">C (Cukup)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="fas fa-tools me-1"></i> Fasilitas</label>
                            <input type="text" name="fasilitas" class="form-control" placeholder="Contoh: Lab, Perpus">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-arrow-up me-1"></i> Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-arrow-right me-1"></i> Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><i class="fas fa-map me-1"></i> Klik pada peta untuk mendapatkan koordinat</label>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Data
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
    // Koordinat default Kabupaten Tanah Datar (Batusangkar)
    var map = L.map('map').setView([-0.4464, 100.5872], 13);
    
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    
    var marker;
    
    function onMapClick(e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);
        
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        
        if (marker) {
            map.removeLayer(marker);
        }
        
        marker = L.marker(e.latlng).addTo(map);
        marker.bindPopup('Koordinat: ' + lat + ', ' + lng).openPopup();
    }
    
    map.on('click', onMapClick);
</script>
</body>
</html>