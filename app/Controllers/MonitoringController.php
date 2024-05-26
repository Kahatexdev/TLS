<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\OrderModel;
use App\Models\ProduksiModel;
use App\Models\InisialModel;

class MonitoringController extends BaseController
{
    protected $ordermodel;
    protected $inisialmodel;
    protected $produksimodel;

    public function __construct()
    {

        $this->produksimodel = new ProduksiModel();
        $this->ordermodel = new OrderModel();
        $this->inisialmodel = new InisialModel();
    }
    public function index()
    {

        $data = [
            'title' => 'TLS System',
            'active1' => 'active',
            'active2' => '',
            'active3' => '',

        ];
        return view('Monitoring/produksi', $data);
    }
    public function dataproduksi()
    {
        $produksi = $this->produksimodel->getdata();
        $data = [
            'title' => 'TLS System',
            'active1' => '',
            'active2' => 'active',
            'active3' => '',
            'produksi' => $produksi

        ];
        return view('Monitoring/produksi', $data);
    }
    public function editproduksi($id)
    {
        $qty = $this->request->getPost('qty');
        $bs = $this->request->getPost('bs');
        $update = $this->produksimodel->update($id, ['qty_production' => $qty, 'bs_mc' => $bs]);
        if ($update) {
            return redirect()->to(base_url('/monitoring/dataproduksi'))->with('success', 'Data berhasil di update');
        } else {
            return redirect()->to(base_url('/monitoring/dataproduksi'))->with('error', 'Data gagal di update');
        }
    }
    public function deleteproduksi($id)
    {

        $delete = $this->produksimodel->delete($id);
        if ($delete) {
            return redirect()->to(base_url('/monitoring/dataproduksi'))->with('success', 'Data berhasil di hapus');
        } else {
            return redirect()->to(base_url('/monitoring/dataproduksi'))->with('error', 'Data gagal di hapus');
        }
    }
    public function dataorder()
    {
        $order = $this->inisialmodel->getdata();
        $data = [
            'title' => 'TLS System',
            'active1' => '',
            'active2' => '',
            'active3' => 'active',
            'order' => $order

        ];
        return view('Monitoring/order', $data);
    }
    public function editorder($id)
    {
        $inisial = $this->request->getPost('inisial');
        $qty = $this->request->getPost('qty');
        $style = $this->request->getPost('style');
        $jarum = $this->request->getPost('jarum');
        $update = $this->inisialmodel->update($id, ['qty_po' => $qty, 'inisial' => $inisial, 'style_size' => $style, 'jarum' => $jarum]);
        if ($update) {
            return redirect()->to(base_url('/monitoring/dataorder'))->with('success', 'Data berhasil di update');
        } else {
            return redirect()->to(base_url('/monitoring/dataorder'))->with('error', 'Data gagal di update');
        }
    }
    public function deleteorder($id)
    {

        $delete = $this->inisialmodel->delete($id);
        if ($delete) {
            return redirect()->to(base_url('/monitoring/dataorder'))->with('success', 'Data berhasil di hapus');
        } else {
            return redirect()->to(base_url('/monitoring/dataorder'))->with('error', 'Data gagal di hapus');
        }
    }
}
