<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIG Pemetaan Sekolah | Kabupaten Tanah Datar</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('sbadmin/css/landing.css') ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <i class="fas fa-layer-group brand-icon"></i> SIG <span>Pemetaan Sekolah</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item"><a class="nav-link active" href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('lokasi/pemetaanLokasi') ?>">Peta Sekolah</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('search') ?>">Data Sekolah</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('home/dashboard') ?>">Dashboard</a></li>
            </ul>
            <div class="text-center">
                <a class="btn-portal" href="<?= base_url('auth/login') ?>">Login Admin</a>
            </div>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container text-center">
        <div class="hero-badge">
            <span>SISTEM INFORMASI GEOGRAFIS PEMETAAN SEKOLAH</span>
        </div>
        
        <h1 class="hero-title">
            Pemetaan Sekolah <br>Kabupaten Tanah Datar
        </h1>
        
        <p class="hero-subtitle mx-auto">
            Akses data pemetaan sekolah terlengkap untuk membantu Anda menemukan lokasi sekolah 
            berdasarkan kecamatan, jenjang pendidikan, dan fasilitas di Kabupaten Tanah Datar.
        </p>
        
        <!-- FORM PENCARIAN -->
        <div class="search-capsule-container mx-auto">
            <div class="search-capsule d-flex align-items-center justify-content-between">
                
                <div class="search-field flex-grow-1 text-start">
                    <label><i class="fas fa-map-marker-alt me-1"></i> LOKASI / KECAMATAN</label>
                    <input type="text" id="lokasi" placeholder="Masukkan nama kecamatan">
                </div>
                
                <div class="search-divider"></div>
                
                <div class="search-field flex-grow-1 text-start">
                    <label><i class="fas fa-graduation-cap me-1"></i> JENJANG PENDIDIKAN</label>
                    <select id="jenjang">
                        <option value="all">Pilih Jenjang (SD/SMP/SMA/SMK)</option>
                        <option value="SD">SD / Sederajat</option>
                        <option value="SMP">SMP / Sederajat</option>
                        <option value="SMA">SMA / Sederajat</option>
                        <option value="SMK">SMK / Sederajat</option>
                    </select>
                </div>
                
                <button class="btn-search-submit d-flex align-items-center gap-2" id="searchBtn">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </div>
        
        <div class="hero-stats-row d-flex justify-content-center align-items-center gap-5">
            <div class="stat-item-block d-flex align-items-center gap-2">
                <div class="stat-ico"><i class="fas fa-building-user"></i></div>
                <div class="stat-meta text-start">
                    <h3 class="counter-number" id="totalSekolah">0</h3>
                    <p>TOTAL SEKOLAH</p>
                </div>
            </div>
            <div class="stat-item-block d-flex align-items-center gap-2">
                <div class="stat-ico"><i class="fas fa-chalkboard-user"></i></div>
                <div class="stat-meta text-start">
                    <h3 class="counter-number" id="totalSD">0</h3>
                    <p>SD SEDERAJAT</p>
                </div>
            </div>
            <div class="stat-item-block d-flex align-items-center gap-2">
                <div class="stat-ico"><i class="fas fa-book-open"></i></div>
                <div class="stat-meta text-start">
                    <h3 class="counter-number" id="totalSMP">0</h3>
                    <p>SMP SEDERAJAT</p>
                </div>
            </div>
            <div class="stat-item-block d-flex align-items-center gap-2">
                <div class="stat-ico"><i class="fas fa-graduation-cap"></i></div>
                <div class="stat-meta text-start">
                    <h3 class="counter-number" id="totalSMA">0</h3>
                    <p>SMA/SMK SEDERAJAT</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Jelajahi Berdasarkan Kecamatan -->
<section class="zonasi-section">
    <div class="container">
        <div class="row align-items-end mb-4">
            <div class="col-md-8 text-start">
                <h2 class="zonasi-main-title">Jelajahi Berdasarkan Kecamatan</h2>
                <p class="zonasi-sub-title mb-0">Temukan sekolah di kecamatan favorit Anda dengan navigasi berbasis peta yang presisi.</p>
            </div>
            <div class="col-md-4 text-md-end text-start mt-2 mt-md-0">
                <a href="<?= base_url('search') ?>" class="link-view-all" id="viewAllLink">Lihat Semua Kecamatan <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
        
        <div class="row g-4" id="kecamatanContainer">
            <!-- Kartu kecamatan akan diisi oleh JavaScript -->
        </div>
    </div>
</section>

<footer class="footer-simple border-top mt-5 py-4">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span class="copyright-txt">&copy; 2026 SIG Pemetaan Sekolah Kabupaten Tanah Datar. All rights reserved.</span>
        <div class="footer-policies d-flex gap-3">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('sbadmin/js/landing.js') ?>"></script>
</body>
</html>