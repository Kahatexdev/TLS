<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AreaController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'TLS System',
            'active1' => 'active',
            'active2' => '',
            'active3' => '',

        ];
        return view('Area/index', $data);
    }
    public function dataproduksi()
    {
        $produksi = dataproduksi();
        $data = [
            'title' => 'TLS System',
            'active1' => '',
            'active2' => 'active',
            'active3' => '',

        ];
        return view('Area/Produksi/produksi', $data);
    }

    private function dataproduksi()
    {
        $data = $this->pro;
        return
    }
    public function dataorder()
    {

        $data = [
            'title' => 'TLS System',
            'active1' => '',
            'active2' => '',
            'active3' => 'active',

        ];
        return view('Area/order/order', $data);
    }
}
