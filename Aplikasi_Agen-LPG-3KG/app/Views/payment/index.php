<?php

namespace App\Controllers;

use App\Models\PaymentModel;

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
        // Logic to create a new payment transaction
    }

    public function history()
    {
        // Logic to show payment history
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Transactions</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <?php include('templates/header.php'); ?>

    <div class="container">
        <h1>Payment Transactions</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?= $payment['id'] ?></td>
                    <td><?= $payment['amount'] ?></td>
                    <td><?= $payment['status'] ?></td>
                    <td><?= $payment['created_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include('templates/footer.php'); ?>
</body>
</html>