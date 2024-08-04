<?php

namespace App\Models;

use CodeIgniter\Model;

class InisialModel extends Model
{
    protected $table            = 'inisials';
    protected $primaryKey       = 'id_inisial';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_inisial', 'id_order', 'area', 'inisial', 'style_size', 'qty_po', 'jarum'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function checkInisial($data)
    {
        return $this->where('inisial', $data['inisial'])
            ->where('style_size', $data['style_size'])
            ->first();
    }

    public function getId($data)
    {
        return $this->select('id_inisial,qty_po')
            ->where('id_order', $data['id_order'])
            ->where('id_inisial', $data['inisial'])
            ->first();
    }

    public function getIdInisial($inisial)
    {
        return $this->select('id_inisial')
            ->where('inisial', $inisial)
            ->first();
    }

    public function getdata()
    {
        return $this->select('inisials.id_inisial,inisials.area, inisials.inisial, inisials.style_size,inisials.jarum, inisials.qty_po,orders.no_model, orders.buyer')
            ->join('orders', 'orders.id_order=inisials.id_order')
            ->findAll();
    }
    public function getByOrder($id_order)
    {
        $query = $this->select('id_inisial, inisial');
        if ($id_order !== 0) {
            $query = $query->where('id_order', $id_order);
        }
        return $query->findAll();
    }
}
