<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set Objectives - <?= $evaluation['employee_name']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom styles -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('espacerespo/evaluation'); ?>">Team Evaluations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Set Objectives for <?= $evaluation['employee_name']; ?></li>
          </ol>
        </nav>

        <!-- Set Objectives Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 border-left-warning">
                <h6 class="m-0 font-weight-bold text-primary">Set Objectives for <?= $evaluation['employee_name']; ?></h6>
            </div>
            <div class="card-body">
                <form id="objectivesForm" action="<?= base_url('espacerespo/evaluation/submit-objectives') ?>" method="POST">
                    <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?>">

                    <div id="objectivesContainer">
                        <!-- Objective template -->
                        <div class="objective-item">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold">Objective <span class="objective-number">1</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <!-- Title -->
                                            <div class="form-group">
                                                <label>Title *</label>
                                                <input type="text" name="objectives[0][title]" class="form-control" required>
                                            </div>
                                            <!-- Description -->
                                            <div class="form-group">
                                                <label>Description *</label>
                                                <textarea name="objectives[0][description]" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <!-- Specific Goals -->
                                            <div class="form-group">
                                                <label>Specific Goals</label>
                                                <textarea name="objectives[0][specific_goals]" class="form-control" rows="3"></textarea>
                                            </div>
                                            <!-- Key Actions -->
                                            <div class="form-group">
                                                <label>Key Actions</label>
                                                <textarea name="objectives[0][key_actions]" class="form-control" rows="3"></textarea>
                                            </div>
                                            <!-- Resources Required -->
                                            <div class="form-group">
                                                <label>Resources Required</label>
                                                <textarea name="objectives[0][resources_required]" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <!-- Start Date -->
                                            <div class="form-group">
                                                <label>Start Date *</label>
                                                <input type="date" name="objectives[0][start_date]" class="form-control" required>
                                            </div>
                                            <!-- End Date -->
                                            <div class="form-group">
                                                <label>End Date *</label>
                                                <input type="date" name="objectives[0][end_date]" class="form-control" required>
                                            </div>
                                            <!-- Success Metrics -->
                                            <div class="form-group">
                                                <label>Success Metrics</label>
                                                <textarea name="objectives[0][success_metrics]" class="form-control" rows="3"></textarea>
                                            </div>
                                            <!-- Potential Challenges -->
                                            <div class="form-group">
                                                <label>Potential Challenges</label>
                                                <textarea name="objectives[0][potential_challenges]" class="form-control" rows="3"></textarea>
                                            </div>
                                            <!-- Support Needed -->
                                            <div class="form-group">
                                                <label>Support Needed</label>
                                                <textarea name="objectives[0][support_needed]" class="form-control" rows="3"></textarea>
                                            </div>
                                            <!-- Weight -->
                                            <div class="form-group">
                                                <label>Weight (%) *</label>
                                                <input type="number" name="objectives[0][weight]" class="form-control weight-input" min="0" max="100" required>
                                            </div>
                                            <!-- Remove Objective Button -->
                                            <button type="button" class="btn btn-danger remove-objective-btn mt-3">Remove Objective</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Objective template -->
                    </div>

                    <div class="alert alert-info">
                        Total Weight: <span id="totalWeight">0</span>%
                    </div>

                    <button type="button" id="addObjectiveBtn" class="btn btn-secondary">Add Objective</button>
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
            let maxObjectives = 5;
            let objectiveIndex = 1; // Start from 1 since one objective is already present

            // Calculate total weight
            function calculateTotalWeight() {
                let total = 0;
                $('.weight-input').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });
                $('#totalWeight').text(total.toFixed(2));
            }

            // Update total weight when inputs change
            $(document).on('input', '.weight-input', calculateTotalWeight);

            // Add Objective
            $('#addObjectiveBtn').click(function() {
                if ($('.objective-item').length >= maxObjectives) {
                    alert('Maximum objectives reached.');
                    return;
                }

                let newObjective = $('.objective-item').first().clone();
                // Update names and clear values
                newObjective.find('input, textarea').each(function() {
                    let name = $(this).attr('name');
                    let newName = name.replace(/\[\d+\]/, '[' + objectiveIndex + ']');
                    $(this).attr('name', newName).val('');
                });
                newObjective.find('.objective-number').text(objectiveIndex + 1);
                $('#objectivesContainer').append(newObjective);
                objectiveIndex++;
            });

            // Remove Objective
            $(document).on('click', '.remove-objective-btn', function() {
                if ($('.objective-item').length <= 1) {
                    alert('At least one objective is required.');
                    return;
                }
                $(this).closest('.objective-item').remove();
                calculateTotalWeight();
            });

        });
    </script>
</body>
</html>