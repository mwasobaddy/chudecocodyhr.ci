<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Team Evaluations - Line Manager</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom styles -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Team Evaluations</h1>
        </div>

        <!-- Pending Evaluations Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 border-left-warning">
                <h6 class="m-0 font-weight-bold text-primary">Pending Evaluations</h6>
            </div>
            <div class="card-body">
                <?php if (!empty($pending_evaluations)): ?>
                    <div class="row">
                        <?php foreach ($pending_evaluations as $evaluation): ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary h-100 shadow-sm">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            <?= esc($evaluation['employee_name']); ?>
                                        </h6>
                                        <div class="dropdown no-arrow">
                                            <span class="badge badge-warning">Pending</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <small class="text-muted">Started: </small>
                                            <p class="mb-0"><?= date('d M Y', strtotime($evaluation['started_at'])); ?></p>
                                        </div>
                                        <hr>
                                        <div class="btn-group d-flex" role="group">
                                            <!-- Set Objectives -->
                                            <a href="<?= base_url('espacerespo/evaluation/set-objectives/' . $evaluation['idevaluation']); ?>" 
                                               class="btn btn-primary btn-sm flex-fill mr-1">
                                                <i class="fas fa-tasks fa-sm"></i>
                                                <span class="d-none d-md-inline ml-1">Set</span>
                                            </a>
                                            
                                            <!-- Validate Objectives -->
                                            <a href="<?= base_url('espacerespo/evaluation/objective-evaluation/' . $evaluation['idevaluation']); ?>" 
                                               class="btn btn-success btn-sm flex-fill mr-1">
                                                <i class="fas fa-check-circle fa-sm"></i>
                                                <span class="d-none d-md-inline ml-1">Validate</span>
                                            </a>
                                            
                                            <!-- Sign Off -->
                                            <button type="button" 
                                                    class="btn btn-info btn-sm flex-fill"
                                                    data-toggle="modal" 
                                                    data-target="#signOffModal<?= $evaluation['idevaluation'] ?>">
                                                <i class="fas fa-signature fa-sm"></i>
                                                <span class="d-none d-md-inline ml-1">Sign</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sign Off Modal -->
                            <div class="modal fade" id="signOffModal<?= $evaluation['idevaluation'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Sign Off Evaluation</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Line Manager Acknowledgement:</strong></p>
                                            <p>I confirm that I have conducted a thorough performance review with <?= esc($evaluation['employee_name']) ?>.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <form action="<?= base_url('espacerespo/evaluation/submit-sign-off') ?>" method="POST" class="d-inline">
                                                <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?>">
                                                <button type="submit" class="btn btn-primary">Sign Off</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <div class="text-gray-500">No pending evaluations</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>