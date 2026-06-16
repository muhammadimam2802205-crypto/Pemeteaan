<?php

namespace App\Controllers;

use App\Models\ModelLokasi;

class Search extends BaseController
{
    public function index()
    {
        $model = new ModelLokasi();
        $data['schools'] = $model->findAll();
        $data['judul'] = 'Pencarian Sekolah';
        $data['page'] = 'v_search_schools';
        
        return view('v_search_schools', $data);
    }
    
    public function compare()
    {
        $ids = $this->request->getGet('ids');
        if (empty($ids)) {
            return redirect()->to('/search');
        }
        
        $idArray = explode(',', $ids);
        $model = new ModelLokasi();
        
        $schools = [];
        foreach ($idArray as $id) {
            $school = $model->find($id);
            if ($school) {
                $schools[] = $school;
            }
        }
        
        $data = [
            'judul' => 'Bandingkan Sekolah',
            'page' => 'v_compare_schools',
            'schools' => $schools
        ];
        return view('v_compare_schools', $data);
    }
}