<!-- app/Views/templates/espaceagent/sign_off.php || app/Views/templates/espacerespo/sign_off.php -->

<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Sign-Off</h1>

    <!-- Display success or error messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url(($userAccess == 1 ? 'espaceagent' : 'espacerespo') . '/evaluation/submit-sign-off') ?>" method="POST">
        <input type="hidden" name="evaluation_id" value="<?= $evaluation['idevaluation'] ?>">

        <?php if ($userAccess == 1): ?>
            <p>
                <strong>Employee Acknowledgement:</strong><br>
                I acknowledge that I have reviewed this appraisal with my manager and understand the content discussed. My signature does not necessarily indicate agreement with the appraisal but confirms that I have been informed of my performance ratings and areas for improvement.
            </p>
            <?php if ($signOff && $signOff['employee_signed']): ?>
                <p><strong>Signed by:</strong> <?= esc($signOff['employee_signature']) ?> on <?= date('d-m-Y H:i:s', strtotime($signOff['employee_signed_at'])) ?></p>
            <?php else: ?>
                <button type="submit" class="btn btn-primary">Sign</button>
            <?php endif; ?>
        <?php elseif ($userAccess == 2): ?>
            <p>
                <strong>Line Manager N+1 Acknowledgement:</strong><br>
                I confirm that I have conducted a thorough performance review with the employee and have discussed their strengths, areas for improvement, and future goals. I am committed to supporting the employee's development and addressing any concerns they may have.
            </p>
            <?php if ($signOff && $signOff['manager_signed']): ?>
                <p><strong>Signed by:</strong> <?= esc($signOff['manager_signature']) ?> on <?= date('d-m-Y H:i:s', strtotime($signOff['manager_signed_at'])) ?></p>
            <?php else: ?>
                <button type="submit" class="btn btn-primary">Sign</button>
            <?php endif; ?>
        <?php endif; ?>
    </form>
</div>