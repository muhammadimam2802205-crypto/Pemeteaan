<?php

namespace App\Controllers;

use App\Models\ModelLokasi;

class Schools extends BaseController
{
    public function index()
    {
        $model = new ModelLokasi();
        $data['schools'] = $model->findAll();
        return view('v_schools_public', $data);
    }
    
    public function search()
    {
        $model = new ModelLokasi();
        $keyword = $this->request->getGet('keyword');
        $jenjang = $this->request->getGet('jenjang');
        $kecamatan = $this->request->getGet('kecamatan');
        
        $builder = $model->builder();
        
        if ($keyword) {
            $builder->groupStart()
                    ->like('nama_sekolah', $keyword)
                    ->orLike('alamat', $keyword)
                    ->orLike('kecamatan', $keyword)
                    ->groupEnd();
        }
        
        if ($jenjang && $jenjang != 'all') {
            $builder->like('jenjang', $jenjang);
        }
        
        if ($kecamatan && $kecamatan != 'all') {
            $builder->where('kecamatan', $kecamatan);
        }
        
        $data['schools'] = $builder->get()->getResultArray();
        return view('v_schools_public', $data);
    }
    
    public function getKecamatan()
    {
        $model = new ModelLokasi();
        $kecamatan = $model->select('kecamatan')->distinct()->findAll();
        $kecList = [];
        foreach ($kecamatan as $k) {
            if (!empty($k['kecamatan'])) {
                $kecList[] = $k['kecamatan'];
            }
        }
        return $this->response->setJSON($kecList);
    }
}