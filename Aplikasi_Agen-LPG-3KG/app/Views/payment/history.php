<?php

namespace App\Views\payment;

?>

<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>
<h1>History of Payment Transactions</h1>

<table>
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>User</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($payments)): ?>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?= esc($payment['transaction_id']) ?></td>
                    <td><?= esc($payment['user_fullname']) ?></td>
                    <td><?= esc($payment['amount']) ?></td>
                    <td><?= esc($payment['status']) ?></td>
                    <td><?= esc($payment['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No payment transactions found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>

<?= $this->extend('templates/footer') ?>