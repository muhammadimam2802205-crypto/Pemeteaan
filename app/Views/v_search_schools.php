<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduMap GIS</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?= base_url('sbadmin/css/search-schools.css') ?>">
</head>
<body>

    <header class="top-navbar">
        <div class="nav-left">
            <div class="logo">
                <span class="logo-edu">EduMap</span> 
                <span class="logo-gis">GIS</span>
            </div>
            <nav class="nav-links">
                <a href="#" class="active">Explore Map</a>
                <a href="#">School Statistics</a>
                <a href="#">About Us</a>
                <a href="#">Help Center</a>
            </nav>
        </div>
        <button class="btn-login">Login to Portal</button>
    </header>

    <main class="app-container">
        
        <aside class="results-sidebar">
            <div class="results-header">
                <h2 class="search-title">Search Results</h2>
                <p class="search-subtitle">Showing schools near Jakarta Center</p>
                <div class="level-badges">
                    <span class="badge active">SMA (12)</span>
                    <span class="badge">SMP (8)</span>
                    <span class="badge">SD (15)</span>
                </div>
            </div>

            <div class="school-list-container" id="schoolList">
                
                <div class="school-card">
                    <div class="school-header-row">
                        <div class="school-photo">
                            <img src="https://via.placeholder.com/80" alt="SMA 70">
                        </div>
                        <div class="school-info">
                            <div class="info-top">
                                <div>
                                    <h3 class="school-name">SMA Negeri 70 Jakarta</h3>
                                    <p class="school-address">Jl. Bulungan No.1, Jakarta Selatan</p>
                                </div>
                                <span class="akreditasi-badge">AKREDITASI A</span>
                            </div>
                            <div class="school-details">
                                <span><i class="fa-solid fa-location-dot"></i> 1.2 km</span>
                                <span><i class="fa-solid fa-graduation-cap"></i> Negeri</span>
                            </div>
                        </div>
                    </div>
                    <div class="school-actions">
                        <button class="btn-route">Lihat Rute</button>
                        <button class="btn-compare-small">Pilih Bandingkan</button>
                    </div>
                </div>

                <div class="school-card">
                    <div class="school-header-row">
                        <div class="school-photo">
                            <img src="https://via.placeholder.com/80" alt="SMP Labschool">
                        </div>
                        <div class="school-info">
                            <div class="info-top">
                                <div>
                                    <h3 class="school-name">SMP Labschool Kebayoran</h3>
                                    <p class="school-address">Jl. KH. Ahmad Dahlan No.14</p>
                                </div>
                                <span class="akreditasi-badge">AKREDITASI A</span>
                            </div>
                            <div class="school-details">
                                <span><i class="fa-solid fa-location-dot"></i> 0.8 km</span>
                                <span><i class="fa-solid fa-graduation-cap"></i> Swasta</span>
                            </div>
                        </div>
                    </div>
                    <div class="school-actions">
                        <button class="btn-route">Lihat Rute</button>
                        <button class="btn-compare-small">Pilih Bandingkan</button>
                    </div>
                </div>

                <div class="school-card">
                    <div class="school-header-row">
                        <div class="school-photo">
                            <img src="https://via.placeholder.com/80" alt="SD Tarakanita 1">
                        </div>
                        <div class="school-info">
                            <div class="info-top">
                                <div>
                                    <h3 class="school-name">SD Tarakanita 1</h3>
                                    <p class="school-address">Jl. Wolter Monginsidi No.118</p>
                                </div>
                                <span class="akreditasi-badge gray-badge">AKREDITASI B</span>
                            </div>
                            <div class="school-details">
                                <span><i class="fa-solid fa-location-dot"></i> 2.1 km</span>
                                <span><i class="fa-solid fa-graduation-cap"></i> Swasta</span>
                            </div>
                        </div>
                    </div>
                    <div class="school-actions">
                        <button class="btn-route">Lihat Rute</button>
                        <button class="btn-compare-small">Pilih Bandingkan</button>
                    </div>
                </div>

            </div>
        </aside>

        <section class="map-view-container">
            <div id="searchMap" class="map-background"></div>

            <div class="map-top-filters">
                <div class="filters-left">
                    <div class="search-input-wrapper">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" placeholder="Search schools, area...">
                    </div>
                    
                    <button class="filter-dropdown">Radius: <strong>2km</strong> <i class="fa-solid fa-chevron-down"></i></button>
                    <button class="filter-dropdown">Akreditasi: <strong>A</strong> <i class="fa-solid fa-chevron-down"></i></button>
                    <button class="filter-dropdown">Status: <strong>Negeri/Swasta</strong> <i class="fa-solid fa-chevron-down"></i></button>
                </div>
                
                <button class="target-btn"><i class="fa-solid fa-crosshairs"></i></button>
            </div>

            <div class="map-bottom-action">
                <div class="compare-widget">
                    <div class="compare-avatars">
                        <div class="avatar bg-green"></div>
                        <div class="avatar bg-dark"></div>
                    </div>
                    <span class="compare-text">2 Sekolah Dipilih</span>
                    <button class="btn-bandingkan-sekarang">Bandingkan Sekarang <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="map-controls-right">
                <button>+</button>
                <button>-</button>
                <button><i class="fa-solid fa-layer-group"></i></button>
            </div>
        </section>
    </main>

</body>
</html>