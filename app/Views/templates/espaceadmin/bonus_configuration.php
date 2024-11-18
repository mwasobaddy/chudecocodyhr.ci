
<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Configuration du bonus</h1>

    <!-- Success Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Bonus Configuration Form -->
    <form action="<?= base_url('espaceadmin/bonus/save-configuration') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="evaluation_period">Période</label>
                <select id="evaluation_period" name="evaluation_period" class="form-control" required>
                    <option value="">Sélectionner la période</option>
                    <option value="3 months">3 Mois</option>
                    <option value="6 months">6 Mois</option>
                    <option value="12 months">12 Mois</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="bonus_percentage">Pourcentage de bonus</label>
                <select id="bonus_percentage" name="bonus_percentage" class="form-control" required>
                    <option value="">Sélectionner le bonus</option>
                    <option value="5">5%</option>
                    <option value="10">10%</option>
                    <option value="15">15%</option>
                    <option value="20">20%</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="evaluation_score_threshold">Note d'évaluation</label>
                <input type="number" step="0.1" id="evaluation_score_threshold" name="evaluation_score_threshold" class="form-control" placeholder="e.g., 3.5" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sauvegarder la configuration</button>
    </form>

    <!-- Bonus Report -->
    <h2 class="mt-5">Rapport sur les bonus</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Matricule</th>
                    <th>Nom et Prénoms</th>
                    <th>Grade</th>
                    <th>Note d'évaluation</th>
                    <th>Pourcentage de bonus convenu</th>
                    <th>Prime à payer</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($evaluations)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Il n'y a pas encore d'évaluations notées.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($evaluations as $evaluation): ?>
                        <tr>
                            <td><?= esc($evaluation['matricule']) ?></td>
                            <td><?= esc($evaluation['nom']) ?></td>
                            <td><?= esc($evaluation['grade']) ?></td>
                            <td><?= esc($evaluation['evaluation_score']) ?></td>
                            <td><?= esc($bonusPercentage) ?>%</td>
                            <td><?= esc(number_format($evaluation['bonus_to_be_paid'], 2)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>