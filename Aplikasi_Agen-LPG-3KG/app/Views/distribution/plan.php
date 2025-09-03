<?php

namespace App\Views\distribution;

?>

<?= $this->extend('templates/header') ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Rencana Distribusi LPG</h2>
    <form action="<?= site_url('distribution/save') ?>" method="post">
        <div class="form-group">
            <label for="base">Pangkalan LPG:</label>
            <select name="base" id="base" class="form-control" required>
                <option value="">Pilih Pangkalan</option>
                <?php foreach ($bases as $base): ?>
                    <option value="<?= $base['id'] ?>"><?= $base['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Jumlah LPG (kg):</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Tanggal Distribusi:</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Rencana</button>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->extend('templates/footer') ?>