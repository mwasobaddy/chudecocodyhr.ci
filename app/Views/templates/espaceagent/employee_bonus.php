
<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Détails de mon bonus</h1>

    <?php if ($bonus): ?>
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">Éligible à la prime</div>
            <div class="card-body">
                <h5 class="card-title">Montant de la prime : <?= esc(number_format($bonus['bonus_amount'], 2)) ?> USD</h5>
                <p class="card-text">
                    <strong>Note d'évaluation :</strong> <?= esc($bonus['score']) ?><br>
                    <strong>Pourcentage de bonus :</strong> <?= esc($bonus['bonus_percentage']) ?>%<br>
                    <strong>Date de paiement :</strong> <?= esc(date('F j, Y', strtotime($bonus['created_at']))) ?>
                </p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Vous n'avez pas droit à une prime pour le moment.</div>
    <?php endif; ?>
</div>