<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLokasi extends Model
{
    protected $table = 'tb_lokasi';
    protected $primaryKey = 'id_lokasi';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nama_sekolah',
        'jenjang',
        'alamat',
        'kecamatan',
        'latitude',
        'longitude',
        'fasilitas',
        'akreditasi'
    ];

    protected $useTimestamps = true;  // Aktifkan timestamps otomatis
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Untuk mendapatkan statistik per kecamatan
    public function getStatistikPerKecamatan()
    {
        return $this->select('kecamatan, COUNT(*) as jumlah')
                    ->groupBy('kecamatan')
                    ->orderBy('jumlah', 'DESC')
                    ->findAll();
    }
    
    // Untuk mendapatkan statistik per jenjang
    public function getStatistikPerJenjang()
    {
        return $this->select('jenjang, COUNT(*) as jumlah')
                    ->groupBy('jenjang')
                    ->findAll();
    }
}