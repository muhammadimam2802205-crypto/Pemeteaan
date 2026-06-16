<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemetaan Sekolah - <?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map { height: 70vh; border-radius: 10px; }
        .info-panel { 
            position: absolute; 
            top: 80px; 
            right: 20px; 
            z-index: 1000; 
            background: white; 
            padding: 15px; 
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            min-width: 250px;
            max-width: 300px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .info-panel h6 { margin-bottom: 10px; color: #1a2a4f; }
        .school-item { 
            cursor: pointer; 
            padding: 8px; 
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }
        .school-item:hover { background: #f0f0f0; }
        .login-alert {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background: #ffc107;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container-fluid p-0">
    <div id="map"></div>
    <div class="info-panel">
        <h6><i class="fas fa-school me-2"></i>Data Sekolah</h6>
        <div id="school-list">
            <?php if (!empty($lokasi)): ?>
                <?php foreach ($lokasi as $row): ?>
                    <div class="school-item" data-lat="<?= $row['latitude'] ?>" data-lng="<?= $row['longitude'] ?>" data-id="<?= $row['id_lokasi'] ?>">
                        <strong><?= esc($row['nama_sekolah']) ?></strong><br>
                        <small><i class="fas fa-map-marker-alt"></i> <?= esc($row['kecamatan']) ?></small><br>
                        <small><i class="fas fa-graduation-cap"></i> <?= esc($row['jenjang']) ?> | Akreditasi <?= esc($row['akreditasi']) ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Belum ada data sekolah</p>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if (!session()->get('logged_in')): ?>
        <div class="login-alert">
            <i class="fas fa-lock me-1"></i> 
            <a href="<?= base_url('auth/login') ?>" class="text-dark fw-bold">Login Admin</a> untuk edit data
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    // Koordinat Kabupaten Tanah Datar
    var map = L.map('map').setView([-0.4464, 100.5872], 12);
    
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    
    // Geocoder untuk pencarian
    L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: 'Cari lokasi...',
        position: 'topleft'
    }).on('markgeocode', function(e) {
        var bbox = e.geocode.bbox;
        var center = e.geocode.center;
        map.fitBounds(bbox);
    }).addTo(map);
    
    // Icon sekolah
    var schoolIcon = L.divIcon({
        html: '<i class="fas fa-school" style="font-size: 20px; color: #1a2a4f; background: white; padding: 8px; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.2);"></i>',
        iconSize: [36, 36],
        className: 'custom-div-icon'
    });
    
    // Data sekolah dari PHP
    var schools = <?= json_encode($lokasi) ?>;
    var isLoggedIn = <?= session()->get('logged_in') ? 'true' : 'false' ?>;
    
    // Tambahkan marker ke peta
    schools.forEach(function(school) {
        if (school.latitude && school.longitude) {
            // Popup content tanpa tombol edit untuk pengunjung
            var popupContent = `
                <div style="min-width: 200px;">
                    <strong>${school.nama_sekolah}</strong><br>
                    <i class="fas fa-graduation-cap"></i> ${school.jenjang}<br>
                    <i class="fas fa-map-marker-alt"></i> ${school.kecamatan}<br>
                    <i class="fas fa-location-dot"></i> ${school.alamat}<br>
                    <i class="fas fa-star"></i> Akreditasi ${school.akreditasi}<br>
                    <i class="fas fa-tools"></i> ${school.fasilitas || '-'}
            `;
            
            // Tambahkan tombol edit hanya jika admin login
            if (isLoggedIn) {
                popupContent += `<br><a href="<?= base_url('lokasi/editLokasi/') ?>${school.id_lokasi}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-edit"></i> Edit Data
                                </a>`;
            } else {
                popupContent += `<br><small class="text-muted mt-2">Login sebagai admin untuk edit data</small>`;
            }
            
            popupContent += `</div>`;
            
            var marker = L.marker([parseFloat(school.latitude), parseFloat(school.longitude)], { icon: schoolIcon })
                .addTo(map)
                .bindPopup(popupContent);
        }
    });
    
    // Klik pada item daftar untuk zoom ke sekolah
    document.querySelectorAll('.school-item').forEach(function(item) {
        item.addEventListener('click', function() {
            var lat = parseFloat(this.dataset.lat);
            var lng = parseFloat(this.dataset.lng);
            if (lat && lng) {
                map.setView([lat, lng], 18);
            }
        });
    });
</script>
</body>
</html>