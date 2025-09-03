<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPG Distribution System</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>
</head>
<body>
    <header>
        <h1>Welcome to the LPG Distribution System</h1>
        <nav>
            <ul>
                <li><a href="<?= site_url('auth/login'); ?>">Login</a></li>
                <li><a href="<?= site_url('auth/register'); ?>">Register</a></li>
                <li><a href="<?= site_url('distribution'); ?>">Distribution Planning</a></li>
                <li><a href="<?= site_url('payment'); ?>">Payment Transactions</a></li>
            </ul>
        </nav>
    </header>