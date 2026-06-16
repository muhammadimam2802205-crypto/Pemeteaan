<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah - <?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .btn-group-action { gap: 5px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-database me-2"></i>Data Sekolah Kabupaten Tanah Datar
            </h6>
            <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('lokasi/inputLokasi') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Tambah Data
                </a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Sekolah</th>
                            <th>Jenjang</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Fasilitas</th>
                            <th>Akreditasi</th>
                            <?php if (session()->get('logged_in')): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lokasi)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($lokasi as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama_sekolah']) ?></td>
                                    <td>
                                        <span class="badge <?= ($row['jenjang'] == 'SD') ? 'bg-primary' : (($row['jenjang'] == 'SMP') ? 'bg-success' : 'bg-warning') ?>">
                                            <?= esc($row['jenjang']) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($row['alamat']) ?></td>
                                    <td><?= esc($row['kecamatan']) ?></td>
                                    <td><?= esc($row['latitude']) ?></td>
                                    <td><?= esc($row['longitude']) ?></td>
                                    <td><?= esc($row['fasilitas']) ?></td>
                                    <td>
                                        <span class="badge <?= ($row['akreditasi'] == 'A') ? 'bg-success' : (($row['akreditasi'] == 'B') ? 'bg-warning' : 'bg-danger') ?>">
                                            <?= esc($row['akreditasi']) ?>
                                        </span>
                                    </td>
                                    <?php if (session()->get('logged_in')): ?>
                                        <td>
                                            <div class="btn-group-action d-flex">
                                                <a href="<?= base_url('lokasi/editLokasi/' . $row['id_lokasi']) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= base_url('lokasi/delete/' . $row['id_lokasi']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= session()->get('logged_in') ? '10' : '9' ?>" class="text-center">Belum ada data sekolah</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>