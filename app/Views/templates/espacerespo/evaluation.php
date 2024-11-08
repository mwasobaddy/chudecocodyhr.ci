<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Evaluations</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom styles -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Team Evaluations</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Employee Objectives</h6>
            </div>
            <div class="card-body">
            <form id="objectivesForm" action="<?= base_url('espacerespo/evaluation/submit-objectives') ?>" method="POST">
            <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?? '' ?>">
                    
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold">Objective <?= $i ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="objectives[<?= $i ?>][title]" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="objectives[<?= $i ?>][description]" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weight (%)</label>
                                        <input type="number" name="objectives[<?= $i ?>][weight]" class="form-control weight-input" min="0" max="100" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Timeline</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="date" name="objectives[<?= $i ?>][start_date]" class="form-control" required>
                                            </div>
                                            <div class="col">
                                                <input type="date" name="objectives[<?= $i ?>][end_date]" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>

                    <div class="alert alert-info">
                        Total Weight: <span id="totalWeight">0</span>%
                    </div>

                    <button type="submit" class="btn btn-primary">Save Objectives</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    
    <!-- Custom scripts -->
    <script>
        $(document).ready(function() {
            // Calculate total weight
            function calculateTotalWeight() {
                let total = 0;
                $('.weight-input').each(function() {
                    total += parseInt($(this).val()) || 0;
                });
                $('#totalWeight').text(total);
            }

            // Update total weight when inputs change
            $('.weight-input').on('input', calculateTotalWeight);
        });
    </script>
</body>
</html>