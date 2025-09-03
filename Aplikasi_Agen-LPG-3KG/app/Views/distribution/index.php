<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribution Planning Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>
<body>
    <?php include(APPPATH . 'Views/templates/header.php'); ?>

    <div class="container">
        <h1>Distribution Planning Dashboard</h1>
        <p>Welcome to the LPG Distribution Planning System. Here you can manage your distribution plans.</p>

        <div class="actions">
            <a href="<?= site_url('distribution/plan'); ?>" class="btn">Create New Distribution Plan</a>
            <a href="<?= site_url('distribution/view'); ?>" class="btn">View Existing Plans</a>
        </div>

        <h2>Recent Distribution Plans</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Base Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($plans)): ?>
                    <?php foreach ($plans as $plan): ?>
                        <tr>
                            <td><?= esc($plan['id']); ?></td>
                            <td><?= esc($plan['base_name']); ?></td>
                            <td><?= esc($plan['quantity']); ?></td>
                            <td><?= esc($plan['date']); ?></td>
                            <td><?= esc($plan['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No distribution plans found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include(APPPATH . 'Views/templates/footer.php'); ?>
</body>
</html>