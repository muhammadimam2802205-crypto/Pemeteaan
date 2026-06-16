<?php

namespace App\Controllers;

use App\Models\ModelLokasi;

class Lokasi extends BaseController
{
    public function index()
    {
        $model = new ModelLokasi();
        $data['lokasi'] = $model->findAll();
        $data['judul'] = 'Data Sekolah';
        $data['page'] = 'lokasi/v_data_lokasi';
        return view('v_template', $data);
    }

    public function pemetaanLokasi()
    {
        $model = new ModelLokasi();
        $data['lokasi'] = $model->findAll();
        $data['judul'] = 'Pemetaan Sekolah';
        $data['page'] = 'lokasi/v_pemetaan_lokasi';
        return view('v_template', $data);
    }

    public function inputLokasi()
    {
        $data['judul'] = 'Input Data Sekolah';
        $data['page'] = 'lokasi/v_input_lokasi';
        return view('v_template', $data);
    }

    public function editLokasi($id)
    {
        $model = new ModelLokasi();
        $data['lokasi'] = $model->find($id);
        $data['judul'] = 'Edit Data Sekolah';
        $data['page'] = 'lokasi/v_edit_lokasi';
        return view('v_template', $data);
    }

    public function save()
    {
        $model = new ModelLokasi();
        $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'jenjang' => $this->request->getPost('jenjang'),
            'alamat' => $this->request->getPost('alamat'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'fasilitas' => $this->request->getPost('fasilitas'),
            'akreditasi' => $this->request->getPost('akreditasi')
        ];
        $model->insert($data);
        return redirect()->to('/lokasi/index');
    }

    public function update($id)
    {
        $model = new ModelLokasi();
        $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'jenjang' => $this->request->getPost('jenjang'),
            'alamat' => $this->request->getPost('alamat'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'fasilitas' => $this->request->getPost('fasilitas'),
            'akreditasi' => $this->request->getPost('akreditasi')
        ];
        $model->update($id, $data);
        return redirect()->to('/lokasi/index');
    }

    public function delete($id)
    {
        $model = new ModelLokasi();
        $model->delete($id);
        return redirect()->to('/lokasi/index');
    }

    public function getStatistics()
    {
        $model = new ModelLokasi();
        $allSchools = $model->findAll();
        
        $total_all = count($allSchools);
        $total_sd = 0;
        $total_smp = 0;
        $total_sma = 0;
        $per_kecamatan = [];
        
        foreach ($allSchools as $school) {
            $jenjang = strtolower($school['jenjang']);
            if (strpos($jenjang, 'sd') !== false) {
                $total_sd++;
            } elseif (strpos($jenjang, 'smp') !== false) {
                $total_smp++;
            } elseif (strpos($jenjang, 'sma') !== false || strpos($jenjang, 'smk') !== false) {
                $total_sma++;
            }
            
            $kec = $school['kecamatan'];
            if (!empty($kec)) {
                if (!isset($per_kecamatan[$kec])) {
                    $per_kecamatan[$kec] = 0;
                }
                $per_kecamatan[$kec]++;
            }
        }
        
        $kecamatan_array = [];
        foreach ($per_kecamatan as $kec => $jumlah) {
            $kecamatan_array[] = [
                'kecamatan' => $kec,
                'jumlah' => $jumlah
            ];
        }
        
        return $this->response->setJSON([
            'success' => true,
            'total_all' => $total_all,
            'total_sd' => $total_sd,
            'total_smp' => $total_smp,
            'total_sma' => $total_sma,
            'per_kecamatan' => $kecamatan_array
        ]);
    }
}