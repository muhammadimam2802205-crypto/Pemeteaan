<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Load landing page
        return view('v_landing');
    }

    public function dashboard()
    {
        // Cek apakah sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }
        
        $data = [
            'judul' => 'Dashboard GIS',
            'page' => 'v_dashboard'
        ];
        return view('v_template', $data);
    }

    public function viewMap()
    {
        $data = [
            'judul' => 'View Map',
            'page' => 'v_viewmap'
        ];
        return view('v_template', $data);
    }

    public function baseMap()
    {
        $data = [
            'judul' => 'Base Map',
            'page' => 'v_basemap'
        ];
        return view('v_template', $data);
    }

    public function marker()
    {
        $data = [
            'judul' => 'Marker',
            'page' => 'v_marker'
        ];
        return view('v_template', $data);
    }

    public function polygon()
    {
        $data = [
            'judul' => 'Polygon',
            'page' => 'v_polygon'
        ];
        return view('v_template', $data);
    }

    public function geojson()
    {
        $data = [
            'judul' => 'GeoJSON',
            'page' => 'v_geojson'
        ];
        return view('v_template', $data);
    }
}