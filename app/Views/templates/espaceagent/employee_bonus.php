
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">My Bonus Details</h1>

    <?php if ($bonus): ?>
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">Eligible for Bonus</div>
            <div class="card-body">
                <h5 class="card-title">Bonus Amount: <?= esc(number_format($bonus['bonus_amount'], 2)) ?> USD</h5>
                <p class="card-text">
                    <strong>Evaluation Score:</strong> <?= esc($bonus['score']) ?><br>
                    <strong>Bonus Percentage:</strong> <?= esc($bonus['bonus_percentage']) ?>%<br>
                    <strong>Payment Date:</strong> <?= esc(date('F j, Y', strtotime($bonus['created_at']))) ?>
                </p>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">You are not eligible for a bonus at this time.</div>
    <?php endif; ?>
</div>