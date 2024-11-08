<!-- app/Views/templates/espaceagent/self_appraisal.php -->

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Self-Appraisal</h1>

    <!-- Display success or error messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('espaceagent/evaluation/submit-self-appraisal') ?>" method="POST">
        <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?>">

        <?php foreach ($objectives as $objective): ?>
            <?php
                // Fetch existing self-appraisal for this objective
                $selfAppraisal = isset($selfAppraisals[$objective['idobjective']]) ? $selfAppraisals[$objective['idobjective']] : null;
            ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Objective: <?= esc($objective['title']) ?></h5>
                </div>
                <div class="card-body">
                    <!-- Objective Details -->
                    <p><strong>Description:</strong> <?= esc($objective['description']) ?></p>
                    <p><strong>Specific Goals:</strong> <?= esc($objective['specific_goals']) ?></p>
                    <p><strong>Key Actions:</strong> <?= esc($objective['key_actions']) ?></p>
                    <p><strong>Resources Required:</strong> <?= esc($objective['resources_required']) ?></p>
                    <p><strong>Timeline:</strong> <?= esc($objective['timeline']) ?></p>
                    <p><strong>Success Metrics:</strong> <?= esc($objective['success_metrics']) ?></p>
                    <p><strong>Potential Challenges:</strong> <?= esc($objective['potential_challenges']) ?></p>
                    <p><strong>Support Needed:</strong> <?= esc($objective['support_needed']) ?></p>
                    <p><strong>Weight:</strong> <?= esc($objective['weight']) ?>%</p>
                    <p><strong>Agreement:</strong> <?= esc($objective['agreement']) ?></p>
                    <p><strong>Comments:</strong> <?= esc($objective['employee_comments']) ?></p>

                    <!-- Self-appraisal -->
                    <div class="form-group">
                        <label><strong>Self-appraisal Score (≤ <?= $objective['weight'] ?>%):</strong></label>
                        <input type="number" name="self_scores[]" class="form-control"
                               max="<?= $objective['weight'] ?>" required
                               value="<?= $selfAppraisal ? esc($selfAppraisal['self_score']) : '' ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Employee Comments:</strong></label>
                        <textarea name="comments[]" class="form-control" rows="3"><?= $selfAppraisal ? esc($selfAppraisal['comments']) : '' ?></textarea>
                    </div>
                    <input type="hidden" name="objective_ids[]" value="<?= $objective['idobjective'] ?>">
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Action Buttons -->
        <button type="submit" name="action" value="Save" class="btn btn-secondary">Save</button>
        <button type="submit" name="action" value="Save and Share" class="btn btn-primary">Save and Share</button>
    </form>
</div>