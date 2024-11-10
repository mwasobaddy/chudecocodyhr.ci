
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Bonus Configuration</h1>

    <!-- Success Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Bonus Configuration Form -->
    <form action="<?= base_url('bonus/saveConfiguration') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="evaluation_period">Evaluation Period</label>
                <select id="evaluation_period" name="evaluation_period" class="form-control" required>
                    <option value="">Select Period</option>
                    <option value="3 months">3 Months</option>
                    <option value="6 months">6 Months</option>
                    <option value="12 months">12 Months</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="bonus_percentage">Bonus Percentage</label>
                <select id="bonus_percentage" name="bonus_percentage" class="form-control" required>
                    <option value="">Select Percentage</option>
                    <option value="5">5%</option>
                    <option value="10">10%</option>
                    <option value="15">15%</option>
                    <option value="20">20%</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="evaluation_score_threshold">Evaluation Score Threshold</label>
                <input type="number" step="0.1" id="evaluation_score_threshold" name="evaluation_score_threshold" class="form-control" placeholder="e.g., 3.5" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Configuration</button>
    </form>

    <!-- Bonus Report -->
    <h2 class="mt-5">Bonus Report</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Employee Number</th>
                    <th>Full Name</th>
                    <th>Job Title</th>
                    <th>Grade</th>
                    <th>Evaluation Score</th>
                    <th>Bonus Percentage Agreed</th>
                    <th>Bonus to be Paid</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($evaluations)): ?>
                    <tr>
                        <td colspan="7" class="text-center">No scored evaluations yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($evaluations as $evaluation): ?>
                        <tr>
                            <td><?= esc($evaluation['employee_number']) ?></td>
                            <td><?= esc($evaluation['full_name']) ?></td>
                            <td><?= esc($evaluation['job_title']) ?></td>
                            <td><?= esc($evaluation['grade']) ?></td>
                            <td><?= esc($evaluation['score']) ?></td>
                            <td><?= esc($bonusPercentage) ?>%</td>
                            <td><?= esc(number_format($evaluation['bonus_to_be_paid'], 2)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>