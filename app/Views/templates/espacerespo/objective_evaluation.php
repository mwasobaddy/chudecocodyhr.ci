<!-- app/Views/templates/espacerespo/objective_evaluation.php -->

<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Objectives Evaluation</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('espacerespo/evaluation/submit-objective-evaluation') ?>" method="POST">
        <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?? '' ?>">

        <?php if (!empty($objectives) && is_array($objectives)): ?>
            <?php foreach ($objectives as $objective): ?>
                <?php
                    $objectiveEvaluation = isset($objectiveEvaluations[$objective['idobjective']]) ? 
                        $objectiveEvaluations[$objective['idobjective']] : null;
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Objective: <?= esc($objective['title'] ?? 'Untitled') ?></h5>
                    </div>
                    <div class="card-body">
                        <!-- Core Details -->
                        <?php if (!empty($objective['description'])): ?>
                            <p><strong>Description:</strong> <?= esc($objective['description']) ?></p>
                        <?php endif; ?>

                        <!-- Goals and Actions -->
                        <?php if (!empty($objective['specific_goals'])): ?>
                            <p><strong>Specific Goals:</strong> <?= esc($objective['specific_goals']) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($objective['key_actions'])): ?>
                            <p><strong>Key Actions:</strong> <?= esc($objective['key_actions']) ?></p>
                        <?php endif; ?>

                        <!-- Resources and Timeline -->
                        <?php if (!empty($objective['resources_required'])): ?>
                            <p><strong>Resources Required:</strong> <?= esc($objective['resources_required']) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($objective['timeline'])): ?>
                            <p><strong>Timeline:</strong> <?= esc($objective['timeline']) ?></p>
                        <?php endif; ?>

                        <!-- Success Metrics and Challenges -->
                        <?php if (!empty($objective['success_metrics'])): ?>
                            <p><strong>Success Metrics:</strong> <?= esc($objective['success_metrics']) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($objective['potential_challenges'])): ?>
                            <p><strong>Potential Challenges:</strong> <?= esc($objective['potential_challenges']) ?></p>
                        <?php endif; ?>

                        <!-- Support and Agreement -->
                        <?php if (!empty($objective['support_needed'])): ?>
                            <p><strong>Support Needed:</strong> <?= esc($objective['support_needed']) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($objective['weight'])): ?>
                            <p><strong>Weight:</strong> <?= esc($objective['weight']) ?>%</p>
                        <?php endif; ?>

                        <?php if (!empty($objective['agreement'])): ?>
                            <p><strong>Agreement:</strong> <?= esc($objective['agreement']) ?></p>
                        <?php endif; ?>

                        <?php if (!empty($objective['employee_comments'])): ?>
                            <p><strong>Employee Comments:</strong> <?= esc($objective['employee_comments']) ?></p>
                        <?php endif; ?>

                        <!-- Self Appraisal Section -->
                        <?php
                        // Initialize variables with null checks
                        $selfAppraisal = null;
                        if (!empty($selfAppraisals) && is_array($selfAppraisals)) {
                            $filtered = array_filter($selfAppraisals, function($sa) use ($objective) {
                                return isset($sa['objective_id']) && 
                                    isset($objective['idobjective']) && 
                                    $sa['objective_id'] == $objective['idobjective'];
                            });
                            $selfAppraisal = !empty($filtered) ? reset($filtered) : null;
                        }
                        ?>

                        <?php if ($selfAppraisal && isset($selfAppraisal['self_score'])): ?>
                            <div class="border p-3 mt-3">
                                <h5>Employee Self-Appraisal</h5>
                                <p>
                                    <strong>Self Rating:</strong> 
                                    <?= esc($selfAppraisal['self_score']) ?>/5
                                </p>
                                <?php if (isset($selfAppraisal['employee_comments'])): ?>
                                    <p>
                                        <strong>Comments:</strong> 
                                        <?= esc($selfAppraisal['employee_comments']) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No self-appraisal submitted yet.</p>
                        <?php endif; ?>

                        <!-- Manager Evaluation -->
                        <div class="form-group mt-4">
                            <label><strong>Manager Score (≤ <?= $objective['weight'] ?? 0 ?>%):</strong></label>
                            <input type="number" name="manager_scores[]" class="form-control"
                                   max="<?= $objective['weight'] ?? 100 ?>" min="0" required
                                   value="<?= $objectiveEvaluation ? esc($objectiveEvaluation['manager_score']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <label><strong>Line Manager Comments:</strong></label>
                            <textarea name="comments[]" class="form-control" rows="3"
                                    ><?= $objectiveEvaluation ? esc($objectiveEvaluation['comments']) : '' ?></textarea>
                        </div>
                        <input type="hidden" name="objective_ids[]" value="<?= $objective['idobjective'] ?? '' ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">No objectives found for evaluation.</div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="mb-4">
            <button type="submit" name="action" value="Save" class="btn btn-secondary">Save Draft</button>
            <button type="submit" name="action" value="Save and Share" class="btn btn-primary">Save and Share</button>
        </div>
    </form>
</div>