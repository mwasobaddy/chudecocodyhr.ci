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
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Objectives Review</h6>
        </div>
        <div class="card-body">
            <?php foreach ($objectives ?? [] as $objective): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="m-0"><?= esc($objective['title']) ?></h6>
                </div>
                <div class="card-body">
                    <p><?= nl2br(esc($objective['description'])) ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Weight:</strong> <?= $objective['weight'] ?>%</p>
                        </div>
                        <div class="col-md-6">
                            <form action="<?= base_url('espaceagent/evaluation/agree-objective') ?>" method="POST">
                                <input type="hidden" name="objective_id" value="<?= $objective['idobjective'] ?>">
                                <div class="form-group">
                                    <select name="agreement" class="form-control" required>
                                        <option value="">Select Agreement</option>
                                        <option value="Yes">I Agree</option>
                                        <option value="No">I Disagree</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea name="comments" class="form-control" placeholder="Comments"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Submit Response</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>