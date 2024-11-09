<!-- app/Views/templates/espacerespo/objective_evaluation.php -->

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Objectives Evaluation</h1>

    <!-- Display success or error messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('espacerespo/evaluation/submit-objective-evaluation') ?>" method="POST">
        <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?>">

        <?php if (is_array($objectives)): ?>
            <?php foreach ($objectives as $objective): ?>
                <?php
                    // Fetch existing evaluation for this objective
                    $objectiveEvaluation = isset($objectiveEvaluations[$objective['idobjective']]) ? $objectiveEvaluations[$objective['idobjective']] : null;
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
                    <p><strong>Employee Comments:</strong> <?= esc($objective['employee_comments']) ?></p>
                    <p><strong>Description:</strong> <?= esc($objective['description']) ?></p>

                    <?php
                        $selfAppraisal = null;
                        if (is_array($selfAppraisals)) {
                            foreach ($selfAppraisals as $sa) {
                                if ($sa['objective_id'] == $objective['idobjective']) {
                                    $selfAppraisal = $sa;
                                    break;
                                }
                            }
                        }
                    ?>
                    <?php if ($selfAppraisal): ?>
                            <div class="border p-3 mt-3">
                                <h5>Employee Self-Appraisal</h5>
                                <p><strong>Self Rating:</strong> <?= esc($selfAppraisal['self_score']) ?>/5</p>
                                <p><strong>Comments:</strong> <?= esc($selfAppraisal['employee_comments']) ?></p>
                            </div>
                        <?php else: ?>
                        <p>No self-appraisal submitted by the employee.</p>
                    <?php endif; ?>


                    <!-- Manager Evaluation -->
                    <div class="form-group">
                        <label><strong>Manager Score (≤ <?= $objective['weight'] ?>%):</strong></label>
                        <input type="number" name="manager_scores[]" class="form-control"
                               max="<?= $objective['weight'] ?>" required
                               value="<?= $objectiveEvaluation ? esc($objectiveEvaluation['manager_score']) : '' ?>">
                    </div>
                    <div class="form-group">
                        <label><strong>Line Manager Comments:</strong></label>
                        <textarea name="comments[]" class="form-control" rows="3"><?= $objectiveEvaluation ? esc($objectiveEvaluation['comments']) : '' ?></textarea>
                    </div>
                    <input type="hidden" name="objective_ids[]" value="<?= $objective['idobjective'] ?>">
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>No objectives found.</p>
        <?php endif; ?>
        <!-- Action Buttons -->
        <button type="submit" name="action" value="Save" class="btn btn-secondary">Save</button>
        <button type="submit" name="action" value="Save and Share" class="btn btn-primary">Save and Share</button>
    </form>
</div>