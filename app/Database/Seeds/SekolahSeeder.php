<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SekolahSeeder extends Seeder
{
    public function run()
    {
        // Data sekolah di Kabupaten Tanah Datar
        $data = [
            [
                'nama_sekolah' => 'SD Negeri 01 Batusangkar',
                'jenjang' => 'SD',
                'alamat' => 'Jl. Pendidikan No. 1, Batusangkar',
                'kecamatan' => 'Batusangkar',
                'latitude' => -0.44640000,
                'longitude' => 100.58720000,
                'fasilitas' => 'Laboratorium, Perpustakaan, Lapangan Olahraga',
                'akreditasi' => 'A',
            ],
            [
                'nama_sekolah' => 'SD Negeri 05 Lima Kaum',
                'jenjang' => 'SD',
                'alamat' => 'Jl. Raya Lima Kaum, Batusangkar',
                'kecamatan' => 'Lima Kaum',
                'latitude' => -0.45000000,
                'longitude' => 100.58000000,
                'fasilitas' => 'Perpustakaan, Ruang Komputer',
                'akreditasi' => 'B',
            ],
            [
                'nama_sekolah' => 'SMP Negeri 1 Batusangkar',
                'jenjang' => 'SMP',
                'alamat' => 'Jl. Sudirman No. 15, Batusangkar',
                'kecamatan' => 'Batusangkar',
                'latitude' => -0.44150000,
                'longitude' => 100.59000000,
                'fasilitas' => 'Laboratorium IPA, Perpustakaan, Lapangan Basket',
                'akreditasi' => 'A',
            ],
            [
                'nama_sekolah' => 'SMP Negeri 2 Tanah Datar',
                'jenjang' => 'SMP',
                'alamat' => 'Jl. By Pass, Batusangkar',
                'kecamatan' => 'Batusangkar',
                'latitude' => -0.43800000,
                'longitude' => 100.59500000,
                'fasilitas' => 'Laboratorium, Perpustakaan',
                'akreditasi' => 'A',
            ],
            [
                'nama_sekolah' => 'SMAN 1 Batusangkar',
                'jenjang' => 'SMA',
                'alamat' => 'Jl. Merdeka No. 20, Batusangkar',
                'kecamatan' => 'Batusangkar',
                'latitude' => -0.44800000,
                'longitude' => 100.58500000,
                'fasilitas' => 'Laboratorium, Perpustakaan, Lapangan Futsal',
                'akreditasi' => 'A',
            ],
            [
                'nama_sekolah' => 'SMK Negeri 1 Tanah Datar',
                'jenjang' => 'SMK',
                'alamat' => 'Jl. Pendidikan No. 10, Batusangkar',
                'kecamatan' => 'Lima Kaum',
                'latitude' => -0.45200000,
                'longitude' => 100.58200000,
                'fasilitas' => 'Bengkel, Laboratorium Komputer',
                'akreditasi' => 'A',
            ],
            [
                'nama_sekolah' => 'SD Negeri 10 Pariangan',
                'jenjang' => 'SD',
                'alamat' => 'Nagari Pariangan, Kecamatan Pariangan',
                'kecamatan' => 'Pariangan',
                'latitude' => -0.40900000,
                'longitude' => 100.56300000,
                'fasilitas' => 'Perpustakaan',
                'akreditasi' => 'B',
            ],
            [
                'nama_sekolah' => 'SMP Negeri 1 Rambatan',
                'jenjang' => 'SMP',
                'alamat' => 'Jl. Raya Rambatan, Rambatan',
                'kecamatan' => 'Rambatan',
                'latitude' => -0.48500000,
                'longitude' => 100.55200000,
                'fasilitas' => 'Laboratorium, Perpustakaan',
                'akreditasi' => 'B',
            ],
            [
                'nama_sekolah' => 'SD Negeri 25 Sungai Tarab',
                'jenjang' => 'SD',
                'alamat' => 'Nagari Sungai Tarab, Kecamatan Sungai Tarab',
                'kecamatan' => 'Sungai Tarab',
                'latitude' => -0.44000000,
                'longitude' => 100.62000000,
                'fasilitas' => 'Perpustakaan',
                'akreditasi' => 'B',
            ],
            [
                'nama_sekolah' => 'SMP Negeri 3 Salimpaung',
                'jenjang' => 'SMP',
                'alamat' => 'Nagari Salimpaung, Kecamatan Salimpaung',
                'kecamatan' => 'Salimpaung',
                'latitude' => -0.46500000,
                'longitude' => 100.53500000,
                'fasilitas' => 'Laboratorium, Perpustakaan',
                'akreditasi' => 'C',
            ],
            [
                'nama_sekolah' => 'SMAN 1 Lintau Buo',
                'jenjang' => 'SMA',
                'alamat' => 'Nagari Lintau Buo, Kecamatan Lintau Buo',
                'kecamatan' => 'Lintau Buo',
                'latitude' => -0.42100000,
                'longitude' => 100.62900000,
                'fasilitas' => 'Laboratorium, Perpustakaan',
                'akreditasi' => 'B',
            ],
            [
                'nama_sekolah' => 'SD Negeri 05 Batipuh',
                'jenjang' => 'SD',
                'alamat' => 'Nagari Batipuh, Kecamatan Batipuh',
                'kecamatan' => 'Batipuh',
                'latitude' => -0.43000000,
                'longitude' => 100.54000000,
                'fasilitas' => 'Perpustakaan, Ruang UKS',
                'akreditasi' => 'B',
            ],
        ];

        foreach ($data as $sekolah) {
            $this->db->table('tb_lokasi')->insert($sekolah);
        }
    }
}