<!DOCTYPE html>
<html>
<head>
    <title>Evaluation Module</title>
    <style>
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-control { width: 100%; padding: 8px; margin-top: 5px; }
        .btn { padding: 10px 15px; cursor: pointer; }
        .btn-primary { background: #007bff; color: white; border: none; }
        .error { color: red; margin-top: 5px; }
        .objective { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($role === 'employee' && !isset($evaluation)): ?>
            <form action="<?= base_url('evaluation/start') ?>" method="POST">
                <button type="submit" class="btn btn-primary">Start Evaluation</button>
            </form>
        <?php endif; ?>

        <?php if ($role === 'line_manager' && isset($evaluation) && $evaluation['status'] === 'Started'): ?>
            <form action="<?= base_url('evaluation/submit-objectives') ?>" method="POST">
                <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?>">
                
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="objective">
                        <h3>Objective <?= $i ?></h3>
                        
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" name="objectives[<?= $i ?>][title]" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="objectives[<?= $i ?>][description]" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Specific Goals:</label>
                            <textarea name="objectives[<?= $i ?>][specific_goals]" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Key Actions:</label>
                            <textarea name="objectives[<?= $i ?>][key_actions]" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Resources Required:</label>
                            <textarea name="objectives[<?= $i ?>][resources_required]" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Timeline:</label>
                            <input type="date" name="objectives[<?= $i ?>][start_date]" class="form-control" required>
                            <input type="date" name="objectives[<?= $i ?>][end_date]" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Weight (%):</label>
                            <input type="number" name="objectives[<?= $i ?>][weight]" class="form-control" 
                                   min="0" max="100" step="0.01" required>
                        </div>
                    </div>
                <?php endfor; ?>

                <button type="submit" name="action" value="save" class="btn">Save</button>
                <button type="submit" name="action" value="save_share" class="btn btn-primary">Save and Share</button>
            </form>
        <?php endif; ?>

        <?php if ($role === 'employee' && isset($objectives)): ?>
            <?php foreach ($objectives as $objective): ?>
                <div class="objective">
                    <h3><?= htmlspecialchars($objective['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($objective['description'])) ?></p>
                    
                    <form action="<?= base_url('evaluation/submit-agreement') ?>" method="POST">
                        <input type="hidden" name="objective_id" value="<?= $objective['idobjective'] ?>">
                        
                        <div class="form-group">
                            <label>Agreement:</label>
                            <select name="agreement" class="form-control" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Comments:</label>
                            <textarea name="employee_comments" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Agreement</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($evaluation) && $evaluation['status'] === 'Ready to be signed off'): ?>
            <form action="<?= base_url('evaluation/sign-off') ?>" method="POST">
                <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?>">
                <button type="submit" class="btn btn-primary">Sign Off</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>