<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KepalaAreaController extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'TLS System',
            'active1' => 'active',
            'active2' => '',
            'active3' => '',

        ];
        return view('Head/index', $data);
    }
}
