<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use CodeIgniter\Controller;

class PaymentController extends BaseController
{
    protected $paymentModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
    }

    public function index()
    {
        $data['payments'] = $this->paymentModel->findAll();
        return view('payment/index', $data);
    }

    public function create()
    {
        return view('payment/create');
    }

    public function store()
    {
        $data = $this->request->getPost();
        $this->paymentModel->insert($data);
        return redirect()->to('/payment');
    }

    public function history()
    {
        $data['paymentHistory'] = $this->paymentModel->getPaymentHistory();
        return view('payment/history', $data);
    }

    public function checkStatus($id)
    {
        $payment = $this->paymentModel->find($id);
        if ($payment) {
            return $this->response->setJSON($payment);
        } else {
            return $this->response->setStatusCode(404, 'Payment not found');
        }
    }
}