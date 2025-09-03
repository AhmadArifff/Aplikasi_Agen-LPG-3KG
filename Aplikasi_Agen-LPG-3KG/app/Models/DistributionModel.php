<?php

namespace App\Models;

use CodeIgniter\Model;

class DistributionModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_distribution';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $returnType           = 'array';
    protected $allowedFields        = [
        'base_id',
        'distribution_date',
        'quantity',
        'status',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    // Validation
    protected $validationRules      = [
        'base_id' => 'required|integer',
        'distribution_date' => 'required|valid_date',
        'quantity' => 'required|integer',
        'status' => 'required|string|max_length[20]'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    public function getAllDistributions()
    {
        return $this->findAll();
    }

    public function getDistributionById($id)
    {
        return $this->find($id);
    }

    public function createDistribution($data)
    {
        return $this->insert($data);
    }

    public function updateDistribution($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteDistribution($id)
    {
        return $this->delete($id);
    }
}