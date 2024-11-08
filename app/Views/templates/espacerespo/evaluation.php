<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Team Evaluations - Line Manager</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom styles -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Team Evaluations</h1>
        </div>

        <!-- Pending Evaluations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 border-left-warning">
                <h6 class="m-0 font-weight-bold text-primary">Pending Evaluations</h6>
            </div>
            <div class="card-body">
                <?php if (!empty($pending_evaluations)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Started At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pending_evaluations as $evaluation): ?>
                                <tr>
                                    <td><?= $evaluation['employee_name']; ?></td>
                                    <td><?= date('Y-m-d', strtotime($evaluation['started_at'])); ?></td>
                                    <td>
                                        <a href="<?= base_url('espacerespo/evaluation/set-objectives/' . $evaluation['idevaluation']); ?>" class="btn btn-primary btn-sm">Set Objectives</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No pending evaluations.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>