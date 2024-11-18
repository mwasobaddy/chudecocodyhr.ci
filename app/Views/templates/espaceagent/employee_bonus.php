
<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Détails de mon bonus</h1>

    <?php if ($bonus): ?>
    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">Éligible à la prime</div>
        <div class="card-body">
            <h5 class="card-title">Montant de la prime : <?= esc(number_format($bonus['bonus_amount'], 2)) ?> USD</h5>
            <p class="card-text">
                Score d'évaluation : <?= esc($bonus['score']) ?><br>
                Pourcentage de bonus : <?= esc($bonus['bonus_percentage']) ?>%<br>
                Date de paiement : <?= esc($bonus['created_at']) ?>
            </p>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        Vous n'êtes pas éligible pour un bonus pour le moment.<br>
        Veuillez compléter votre évaluation pour être considéré.
    </div>
<?php endif; ?>
</div>