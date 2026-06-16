<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandingkan Sekolah - SIG Pemetaan Sekolah Tanah Datar</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f7fb; }
        
        /* Header */
        .compare-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 20px 24px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .compare-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }
        .compare-title span { color: #2563eb; }
        .compare-title i { color: #2563eb; margin-right: 12px; }
        
        /* Container */
        .compare-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px;
        }
        
        /* Comparison Table */
        .comparison-wrapper {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
        }
        .comparison-table th,
        .comparison-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .comparison-table th {
            background: #f8fafc;
            font-weight: 600;
            color: #1e293b;
            width: 180px;
        }
        .comparison-table td {
            color: #475569;
        }
        
        /* School Card in Table */
        .school-header-compare {
            text-align: center;
            margin-bottom: 16px;
        }
        .school-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }
        .school-icon i {
            font-size: 2rem;
            color: white;
        }
        .school-name-compare {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }
        .school-jenjang {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        /* Badge */
        .badge-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .badge-negeri { background: #dbeafe; color: #2563eb; }
        .badge-swasta { background: #f1f5f9; color: #475569; }
        .badge-a { background: #dcfce7; color: #10b981; }
        .badge-b { background: #fef3c7; color: #d97706; }
        .badge-c { background: #fee2e2; color: #dc2626; }
        
        /* Fasilitas List */
        .fasilitas-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .fasilitas-list li {
            padding: 4px 0;
            font-size: 0.8rem;
        }
        .fasilitas-list li i {
            color: #10b981;
            width: 20px;
        }
        
        /* Winner Badge */
        .winner-badge {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: white;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 50px;
            display: inline-block;
            margin-left: 8px;
        }
        
        /* Compare Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            justify-content: center;
        }
        .btn-back {
            background: #64748b;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
        }
        .btn-back:hover { background: #475569; color: white; }
        
        .btn-route {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
        }
        .btn-route:hover { background: #1e40af; color: white; }
        
        /* No Data */
        .no-data {
            text-align: center;
            padding: 60px;
            background: white;
            border-radius: 20px;
        }
        .no-data i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 16px;
        }
        
        @media (max-width: 768px) {
            .comparison-table th,
            .comparison-table td {
                padding: 12px;
                font-size: 0.8rem;
            }
            .comparison-table th { width: 100px; }
            .school-icon { width: 50px; height: 50px; }
            .school-icon i { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

<div class="compare-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="compare-title">
            <i class="fas fa-chart-simple"></i>
            Bandingkan <span>Sekolah</span>
        </div>
        <a href="<?= base_url('/search') ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Pencarian
        </a>
    </div>
</div>

<div class="compare-container">
    <?php if (!empty($schools) && count($schools) > 0): ?>
        <div class="comparison-wrapper">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <?php foreach ($schools as $school): ?>
                            <th class="text-center">
                                <div class="school-header-compare">
                                    <div class="school-icon">
                                        <i class="fas fa-school"></i>
                                    </div>
                                    <div class="school-name-compare"><?= esc($school['nama_sekolah']) ?></div>
                                    <div class="school-jenjang"><?= esc($school['jenjang']) ?></div>
                                </div>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- Status -->
                    <tr>
                        <th><i class="fas fa-building me-2"></i> Status</th>
                        <?php foreach ($schools as $school): ?>
                            <td class="text-center">
                                <span class="badge-status <?= ($school['status'] ?? 'Negeri') == 'Negeri' ? 'badge-negeri' : 'badge-swasta' ?>">
                                    <?= esc($school['status'] ?? 'Negeri') ?>
                                </span>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    
                    <!-- Akreditasi -->
                    <tr>
                        <th><i class="fas fa-star me-2"></i> Akreditasi</th>
                        <?php foreach ($schools as $school): ?>
                            <td class="text-center">
                                <span class="badge-status badge-<?= strtolower($school['akreditasi']) ?>">
                                    Akreditasi <?= esc($school['akreditasi']) ?>
                                </span>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    
                    <!-- Alamat -->
                    <tr>
                        <th><i class="fas fa-location-dot me-2"></i> Alamat</th>
                        <?php foreach ($schools as $school): ?>
                            <td><?= esc($school['alamat'] ?? '-') ?></td>
                        <?php endforeach; ?>
                    </tr>
                    
                    <!-- Kecamatan -->
                    <tr>
                        <th><i class="fas fa-map-marker-alt me-2"></i> Kecamatan</th>
                        <?php foreach ($schools as $school): ?>
                            <td><?= esc($school['kecamatan'] ?? '-') ?></td>
                        <?php endforeach; ?>
                    </tr>
                    
                    <!-- Fasilitas -->
                    <tr>
                        <th><i class="fas fa-tools me-2"></i> Fasilitas</th>
                        <?php foreach ($schools as $school): ?>
                            <td>
                                <?php 
                                $fasilitas = $school['fasilitas'] ?? '';
                                $fasilitasArray = !empty($fasilitas) ? explode(',', $fasilitas) : [];
                                ?>
                                <?php if (!empty($fasilitasArray)): ?>
                                    <ul class="fasilitas-list">
                                        <?php foreach ($fasilitasArray as $f): ?>
                                            <li><i class="fas fa-check-circle"></i> <?= trim($f) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    
                    <!-- Koordinat -->
                    <tr>
                        <th><i class="fas fa-map me-2"></i> Koordinat</th>
                        <?php foreach ($schools as $school): ?>
                            <td>
                                <?php if ($school['latitude'] && $school['longitude']): ?>
                                    <small><?= esc($school['latitude']) ?>, <?= esc($school['longitude']) ?></small>
                                    <button class="btn btn-sm btn-outline-primary mt-2 w-100" onclick="openMap(<?= $school['latitude'] ?>, <?= $school['longitude'] ?>, '<?= esc($school['nama_sekolah']) ?>')">
                                        <i class="fas fa-directions"></i> Lihat Rute
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    
                    <!-- Keunggulan / Nilai Plus -->
                    <tr style="background: #fefce8;">
                        <th><i class="fas fa-trophy me-2"></i> Keunggulan</th>
                        <?php 
                        $keunggulan = [
                            'Fasilitas Lengkap, Lokasi Strategis',
                            'Akreditasi A, Tenaga Pengajar Berkualitas',
                            'Lingkungan Nyaman, Prestasi Akademik'
                        ];
                        foreach ($schools as $index => $school): ?>
                            <td>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <i class="fas fa-medal" style="color: #f59e0b;"></i>
                                    <span class="fw-semibold"><?= $keunggulan[$index % count($keunggulan)] ?></span>
                                </div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="<?= base_url('/search') ?>" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Pencarian
            </a>
            <a href="<?= base_url('/lokasi/pemetaanLokasi') ?>" class="btn-route">
                <i class="fas fa-map me-2"></i>Lihat di Peta
            </a>
        </div>
        
        <!-- Rekomendasi -->
        <div class="alert alert-primary mt-4" role="alert">
            <i class="fas fa-lightbulb me-2"></i>
            <strong>Tips:</strong> Pilih sekolah dengan akreditasi A dan fasilitas lengkap untuk kualitas pendidikan terbaik. 
            Pertimbangkan juga jarak dari rumah ke sekolah.
        </div>
        
    <?php else: ?>
        <div class="no-data">
            <i class="fas fa-school-circle-xmark"></i>
            <h5>Belum Ada Sekolah Dipilih</h5>
            <p class="text-muted">Silakan pilih minimal 2 sekolah untuk dibandingkan dari halaman pencarian.</p>
            <a href="<?= base_url('/search') ?>" class="btn btn-primary mt-3">
                <i class="fas fa-search me-2"></i>Ke Halaman Pencarian
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
function openMap(lat, lng, name) {
    if (lat && lng) {
        // Buka Google Maps
        var url = `https://www.google.com/maps/search/?api=1&query=${lat},${lng}&query_place_id=${encodeURIComponent(name)}`;
        window.open(url, '_blank');
    } else {
        alert('Koordinat sekolah tidak tersedia');
    }
}
</script>
</body>
</html>