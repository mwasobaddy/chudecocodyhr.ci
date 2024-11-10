
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manager Bonus Report</h1>

    <?php if (empty($evaluations)): ?>
        <div class="alert alert-info">No scored evaluations for your team yet.</div>
    <?php else: ?>
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
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>