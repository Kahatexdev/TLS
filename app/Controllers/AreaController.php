<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InisialModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\OrderModel;
use App\Models\ProduksiModel;

class AreaController extends BaseController
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
        return view('Area/index', $data);
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
        return view('Area/Produksi/produksi', $data);
    }

    function produksi()
    {
        $data = 'sa';
        return $data;
    }
    public function dataorder()
    {
        $order = $this->inisialmodel->getdata();
        $data = [
            'title' => 'TLS System',
            'active1' => 'active',
            'active2' => '',
            'active3' => '',
            'order' => $order

        ];
        return view('Area/order/order', $data);
    }
    public function inputproduksi()
    {

        $no_model = $this->request->getPost('no_model');
        $idorder = $this->ordermodel->getModel($no_model);
        $inisial = $this->request->getPost('inisial');
        $getId = [
            'id_order' => $idorder,
            'inisial' => $inisial
        ];
        $inisial = $this->inisialmodel->getId($getId);
        if (!$inisial) {
            return redirect()->to(base_url('/area/dataproduksi'))->with('error', 'Data Model tidak ditemukan');
        }
        $idInisial = $inisial['id_inisial'];
        $qtyorder = $inisial['qty_po'];
        $user = session()->get('id_user');

        $date = $this->request->getPost('date');
        $qty = $this->request->getPost('qty');
        $bs = $this->request->getPost('bs');
        $runmc = $this->request->getPost('runmc');
        $data = [
            'id_inisial' => $idInisial,
            'date_production' => $date,
            'qty_production' => $qty,
            'run_mc' => $runmc,
            'bs_mc' => $bs,
            'id_user' => $user
        ];
        $sisa = $qtyorder - $qty;

        $insert = $this->produksimodel->insert($data);
        if ($insert) {
            $this->inisialmodel->update($idInisial, ['qty_po' => $sisa]);
            return redirect()->to(base_url('/area/dataproduksi'))->with('success', 'Data produksi berhasil di input');
        }
    }
    function importorder()
    {
        $file = $this->request->getFile('excel_file');
        if ($file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file);
            $data = $spreadsheet->getActiveSheet();
            $startRow = 2; // Ganti dengan nomor baris mulai
            $qtyorder = 0;
            foreach ($spreadsheet->getActiveSheet()->getRowIterator($startRow) as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }
                if ($data[2] == null) {
                    break;
                }
                if (!empty($data)) {
                    $buyer = $data[1];
                    $no_model = $data[2];

                    $ordercat = $data[5];
                    $startmc = $data[8];
                    $delivery = $data[9];
                    $qtyorder =  $data[6];

                    $dataorder = [
                        'no_model' => $no_model,
                        'order_qty' => $qtyorder,
                        'buyer' => $buyer,
                        'order_category' => $ordercat,
                        'start_mc' => $startmc,
                        'delivery' => $delivery

                    ];
                    $check = $this->ordermodel->check($dataorder);
                    if (!$check) {
                        $this->ordermodel->insert($dataorder);
                    }

                    $area  = $data[0];
                    $inisial = $data[3];
                    $style = $data[4];
                    $jarum = $data[10];
                    $qtyinisial = $data[7];
                    $idOrder = $this->ordermodel->getId($no_model);
                    $datains = [
                        'id_order' => $idOrder,
                        'area' => $area,
                        'inisial' => $inisial,
                        'style_size' => $style,
                        'jarum' => $jarum,
                        'qty_po' => $qtyinisial
                    ];
                    $checkInisial = $this->inisialmodel->checkInisial($datains);
                    if (!$checkInisial) {
                        $this->inisialmodel->insert($datains);
                    }
                } else {
                    return redirect()->to(base_url('/area/dataorder'))->with('error', 'No data found in the Excel file');
                }
            }
            return redirect()->to(base_url('/area/dataorder'))->with('success', 'Data berhasil di import');
        } else {

            return redirect()->to(base_url('/area/dataorder'))->with('error', 'No data found in the Excel file');
        }
    }
}
