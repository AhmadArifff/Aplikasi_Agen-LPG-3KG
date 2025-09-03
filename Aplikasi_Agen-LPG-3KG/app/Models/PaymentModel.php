<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_payment';
    protected $primaryKey           = 'payment_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'payment_id',
        'user_id',
        'amount',
        'payment_date',
        'status',
        'transaction_id',
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
        'user_id'       => 'required|integer',
        'amount'        => 'required|decimal',
        'payment_date'  => 'required|valid_date',
        'status'        => 'required|string',
        'transaction_id' => 'required|string'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getPaymentByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getPaymentHistory()
    {
        return $this->orderBy('payment_date', 'DESC')->findAll();
    }

    public function countPayments()
    {
        return $this->countAllResults();
    }
}