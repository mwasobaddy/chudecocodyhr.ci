<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Self-Appraisal</h1>
    <form action="<?= base_url('espaceagent/evaluation/submit-self-appraisal') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="evaluation_id" value="<?= esc($evaluation['idevaluation']) ?>">
        <?php foreach ($objectives as $objective): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <?= esc($objective['title']) ?>
                </div>
                <div class="card-body">
                    <p><?= esc($objective['description']) ?></p>
                    <div class="form-group">
                        <label>Self Rating (out of 5):</label>
                        <input type="number" name="self_scores[]" min="0" max="5" step="0.5" class="form-control" required>
                        <input type="hidden" name="objective_ids[]" value="<?= esc($objective['idobjective']) ?>">
                    </div>
                    <div class="form-group">
                        <label>Your Comments:</label>
                        <textarea name="comments[]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success">Submit Self-Appraisal</button>
    </form>
</div>