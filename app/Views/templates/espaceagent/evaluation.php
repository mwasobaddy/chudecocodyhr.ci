<!-- app/Views/templates/espaceagent/evaluation.php -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Evaluation</h1>
    </div>

    <?php if (!isset($current_evaluation)): ?>
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <h4 class="mb-3">Start Your Evaluation</h4>
                <form action="<?= base_url('espaceagent/evaluation/start') ?>" method="POST">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-play mr-2"></i> Begin Evaluation
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3 border-left-warning">
                <h6 class="m-0 font-weight-bold text-primary">Objectives Review</h6>
            </div>
            <div class="card-body">
                <?php if (!empty($objectives)): ?>
                    <?php foreach ($objectives as $objective): ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="font-weight-bold">Objective: <?= esc($objective['title']) ?></h5>
                            </div>
                            <div class="card-body">
                                <!-- 1. Objective Title -->
                                <p><strong>Objective Title:</strong> <?= esc($objective['title']) ?></p>
                                <!-- 2. Description -->
                                <p><strong>Description:</strong> <?= nl2br(esc($objective['description'])) ?></p>
                                <!-- 3. Specific Goals -->
                                <p><strong>Specific Goals:</strong> <?= nl2br(esc($objective['specific_goals'])) ?></p>
                                <!-- 4. Key Actions to be Carried Out -->
                                <p><strong>Key Actions to be Carried Out:</strong> <?= nl2br(esc($objective['key_actions'])) ?></p>
                                <!-- 5. Resources Required -->
                                <p><strong>Resources Required:</strong> <?= nl2br(esc($objective['resources_required'])) ?></p>
                                <!-- 6. Timeline -->
                                <p><strong>Timeline:</strong></p>
                                <ul>
                                    <li><strong>Start Date:</strong> <?= esc($objective['start_date']) ?></li>
                                    <li><strong>End Date:</strong> <?= esc($objective['end_date']) ?></li>
                                </ul>
                                <!-- 7. Success Metrics -->
                                <p><strong>Success Metrics:</strong> <?= nl2br(esc($objective['success_metrics'])) ?></p>
                                <!-- 8. Potential Challenges -->
                                <p><strong>Potential Challenges:</strong> <?= nl2br(esc($objective['potential_challenges'])) ?></p>
                                <!-- 9. Support Needed -->
                                <p><strong>Support Needed:</strong> <?= nl2br(esc($objective['support_needed'])) ?></p>
                                <!-- 10. Weight -->
                                <p><strong>Weight:</strong> <?= esc($objective['weight']) ?>%</p>
                                <!-- 11. Agreement -->
                                <form action="<?= base_url('espaceagent/evaluation/agree-objective') ?>" method="POST">
                                    <input type="hidden" name="objective_id" value="<?= $objective['idobjective'] ?>">
                                    <p><strong>Do you agree with this objective?</strong></p>
                                    <div class="form-group">
                                        <select name="agreement" class="form-control" required>
                                            <option value="" <?= empty($objective['agreement']) ? 'selected' : '' ?>>Select Agreement</option>
                                            <option value="Yes" <?= ($objective['agreement'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
                                            <option value="No" <?= ($objective['agreement'] == 'No') ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                    <!-- 12. Comments -->
                                    <div class="form-group">
                                        <label><strong>Comments:</strong></label>
                                        <textarea name="comments" class="form-control" rows="3"><?= esc($objective['employee_comments']) ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit Response</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No objectives have been set by your line manager yet.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>