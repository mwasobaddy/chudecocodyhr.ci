
<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Rapport sur les primes des mes collaborateurs</h1>

    <?php if (empty($evaluations)): ?>
        <div class="alert alert-info">Il n'y a pas encore d'évaluations notées pour votre équipe.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Matricule</th>
                        <th>Nom et Prénoms</th>
                        <th>Titre du poste</th>
                        <th>Niveau</th>
                        <th>Score d'évaluation</th>
                        <th>Pourcentage de bonus convenu</th>
                        <th>Bonus à payer</th>
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