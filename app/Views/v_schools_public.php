<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah - SIG Pemetaan Sekolah Kabupaten Tanah Datar</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <link rel="stylesheet" href="<?= base_url('sbadmin/css/schools-public.css') ?>">
</head>
<body>

<!-- Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div class="page-title">
            <i class="fas fa-school me-2" style="color: #2563eb;"></i>
            Data <span>Sekolah</span> Kabupaten Tanah Datar
        </div>
        <a href="<?= base_url('/') ?>" class="text-decoration-none text-secondary">
            <i class="fas fa-home me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>

<div class="main-container">
    <!-- Search Section -->
    <div class="search-section">
        <div class="search-form">
            <div class="search-group">
                <label><i class="fas fa-search me-1"></i> Cari Sekolah</label>
                <input type="text" id="searchKeyword" class="form-control" placeholder="Nama sekolah atau alamat...">
            </div>
            <div class="search-group">
                <label><i class="fas fa-graduation-cap me-1"></i> Jenjang</label>
                <select id="jenjangFilter" class="form-select">
                    <option value="all">Semua Jenjang</option>
                    <option value="SD">SD / Sederajat</option>
                    <option value="SMP">SMP / Sederajat</option>
                    <option value="SMA">SMA / Sederajat</option>
                    <option value="SMK">SMK / Sederajat</option>
                </select>
            </div>
            <div class="search-group">
                <label><i class="fas fa-map-marker-alt me-1"></i> Kecamatan</label>
                <select id="kecamatanFilter" class="form-select">
                    <option value="all">Semua Kecamatan</option>
                </select>
            </div>
            <button id="searchBtn" class="btn-search">
                <i class="fas fa-search me-2"></i>Cari
            </button>
        </div>
    </div>
    
    <!-- Stats Bar -->
    <div class="stats-bar">
        <div class="stats-badge">
            <div class="stat-item"><span id="totalSD">0</span> SD</div>
            <div class="stat-item"><span id="totalSMP">0</span> SMP</div>
            <div class="stat-item"><span id="totalSMA">0</span> SMA/SMK</div>
            <div class="stat-item"><span id="totalAll">0</span> Total Sekolah</div>
        </div>
    </div>
    
    <!-- Map and Schools List -->
    <div class="map-schools-wrapper">
        <!-- Map Container -->
        <div class="map-container">
            <div id="schoolsMap"></div>
        </div>
        
        <!-- Schools List -->
        <div class="schools-list" id="schoolsListContainer">
            <div class="loading">
                <i class="fas fa-spinner fa-spin"></i>
                <p>Memuat data sekolah...</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var BASE_URL = '<?= base_url() ?>';
    var allSchools = <?= json_encode($schools) ?>;
</script>

<script src="<?= base_url('sbadmin/js/schools-public.js') ?>"></script>
</body>
</html>