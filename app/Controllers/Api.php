<?php
namespace App\Controllers;

class Api extends BaseController
{
    public function getSchoolsByRegion($region)
    {
        // Query ke database model lokasi
        $model = new \App\Models\ModelLokasi();
        $data = $model->where('kecamatan', $region)->findAll();
        
        return $this->response->setJSON($data);
    }
}