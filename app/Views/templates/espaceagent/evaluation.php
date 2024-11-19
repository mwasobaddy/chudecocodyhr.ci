<!-- app/Views/templates/espaceagent/evaluation.php -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mon évaluation</h1>
    </div>

    <?php if (!isset($current_evaluation)): ?>
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <h4 class="mb-3">Commencez votre évaluation</h4>
                <form action="<?= base_url('espaceagent/evaluation/start') ?>" method="POST">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-play mr-2"></i> Commencer l'évaluation
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <!-- Revue des objectifs -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 border-left-warning">
                <h6 class="m-0 font-weight-bold text-primary">Revue des objectifs</h6>
            </div>
            <div class="card-body">
                <?php if (!empty($objectives)): ?>
                    <div id="objectivesAccordion">
                        <?php foreach ($objectives as $index => $objective): ?>
                            <!-- Detailed Objective Card -->
                            <div class="card mb-4 objective-card" id="detailedCard_<?= $objective['idobjective'] ?>" 
                                 <?= ($objective['agreement'] == 'Yes') ? 'style="display:none;"' : '' ?>>
                                <div class="card-header">
                                    <h5 class="mb-0">Objectif: <?= esc($objective['title']) ?></h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Description:</strong> <?= nl2br(esc($objective['description'])) ?></p>
                                    <p><strong>Objectifs spécifiques:</strong> <?= nl2br(esc($objective['specific_goals'])) ?></p>
                                    <p><strong>Actions clés:</strong> <?= nl2br(esc($objective['key_actions'])) ?></p>
                                    <p><strong>Ressources nécessaires:</strong> <?= nl2br(esc($objective['resources_required'])) ?></p>
                                    <p><strong>Chronologie:</strong> <?= date('d M Y', strtotime($objective['start_date'])) ?> - <?= date('d M Y', strtotime($objective['end_date'])) ?></p>
                                    <p><strong>Mesures de réussite:</strong> <?= nl2br(esc($objective['success_metrics'])) ?></p>
                                    <p><strong>Défis potentiels:</strong> <?= nl2br(esc($objective['potential_challenges'])) ?></p>
                                    <p><strong>Soutien nécessaire:</strong> <?= nl2br(esc($objective['support_needed'])) ?></p>
                                    <p><strong>Poids:</strong> <?= esc($objective['weight']) ?>%</p>

                                    <form action="<?= base_url('espaceagent/evaluation/agree-objective') ?>" 
                                          method="POST" 
                                          class="objective-agreement-form"
                                          data-objective-id="<?= $objective['idobjective'] ?>">
                                        <input type="hidden" name="objective_id" value="<?= $objective['idobjective'] ?>">
                                        <div class="form-group">
                                            <label><strong>Êtes-vous d'accord avec cet objectif ?</strong></label>
                                            <select name="agreement" class="form-control agreement-select" required>
                                                <option value="" <?= empty($objective['agreement']) ? 'selected' : '' ?>>Sélectionner</option>
                                                <option value="Yes" <?= ($objective['agreement'] == 'Yes') ? 'selected' : '' ?>>Oui</option>
                                                <option value="No" <?= ($objective['agreement'] == 'No') ? 'selected' : '' ?>>Non</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><strong>Commentaires:</strong></label>
                                            <textarea name="comments" class="form-control" rows="3"><?= esc($objective['employee_comments']) ?></textarea>
                                        </div>


                                        <button type="submit" class="btn btn-primary">Soumettre une réponse</button>
                                        <?php
                                            $allObjectivesAgreed = true;
                                            foreach ($objectives as $objective) {
                                                if ($objective['agreement'] !== 'Yes') {
                                                    $allObjectivesAgreed = false;
                                                    break;
                                                }
                                            }

                                            $selfAppraisalSubmitted = false;
                                            // Check if self-appraisal has already been submitted (implement logic as needed)

                                            if ($allObjectivesAgreed && !$selfAppraisalSubmitted): ?>
                                                <div class="text-center mb-4">
                                                    <a href="<?= base_url('espaceagent/evaluation/self-appraisal/' . $current_evaluation['idevaluation']) ?>" class="btn btn-primary">
                                                        <i class="fas fa-star-half-alt"></i> Procéder à l'auto-évaluation
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                    </form>
                                </div>
                            </div>

                            <!-- Summary Card -->
                            <div class="card mb-4 summary-card" 
                                 id="summaryCard_<?= $objective['idobjective'] ?>"
                                 <?= ($objective['agreement'] != 'Yes') ? 'style="display:none;"' : '' ?>>
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-success">
                                        <?= esc($objective['title']) ?>
                                        <span class="badge badge-success ml-2">D'accord</span>
                                    </h6>
                                    <div class="btn-group">
                                        <button type="button" 
                                                class="btn btn-sm btn-primary mr-2"
                                                onclick="toggleObjectiveDetails(<?= $objective['idobjective'] ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-info"
                                                data-toggle="modal" 
                                                data-target="#signOffModal_<?= $objective['idobjective'] ?>">
                                            <i class="fas fa-signature"></i> Signe
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Sign Off Modal -->
                            <div class="modal fade" id="signOffModal_<?= $objective['idobjective'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Objectif de la signature</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Objectif:</strong> <?= esc($objective['title']) ?></p>
                                            <p>
                                                <strong>Reconnaissance du collaborateur::</strong><br>
                                                Je reconnais avoir pris connaissance de cet objectif et l'avoir accepté.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <form action="<?= base_url('espaceagent/evaluation/submit-sign-off') ?>" method="POST">
                                                <input type="hidden" name="evaluation_id" value="<?= $current_evaluation['idevaluation'] ?>">
                                                <input type="hidden" name="objective_id" value="<?= $objective['idobjective'] ?>">
                                                <button type="submit" class="btn btn-primary">Signer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Aucun objectif n'a encore été fixé par votre responsable hiérarchique.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Approbation finale Section -->
        <div class="card shadow mb-4" id="signOffSection" style="display: none;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Approbation finale</h6>
            </div>
            <div class="card-body">
                <p>
                    <strong>Reconnaissance du collaborateur::</strong><br>
                    Je reconnais avoir pris connaissance de l'ensemble des objectifs et les accepte sans réserve.
                </p>
                
                <?php if (isset($signOff) && $signOff['employee_signed']): ?>
                    <p><strong>Signé par:</strong> <?= esc($signOff['employee_signature']) ?> sur <?= date('d-m-Y H:i:s', strtotime($signOff['employee_signed_at'])) ?></p>
                <?php else: ?>
                    <form action="<?= base_url('espaceagent/evaluation/submit-sign-off') ?>" method="POST">
                        <input type="hidden" name="evaluation_id" value="<?= $current_evaluation['idevaluation'] ?>">
                        <button type="submit" class="btn btn-primary">Approuver tous les objectifs</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submissions
    document.querySelectorAll('.objective-agreement-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const objectiveId = this.dataset.objectiveId;
            const agreementValue = this.querySelector('select[name="agreement"]').value;
            
            if (agreementValue === 'Yes') {
                document.getElementById(`detailedCard_${objectiveId}`).style.display = 'none';
                document.getElementById(`summaryCard_${objectiveId}`).style.display = 'block';
            }
            
            // Submit the form
            this.submit();
        });
    });
});

function toggleObjectiveDetails(objectiveId) {
    const detailedCard = document.getElementById(`detailedCard_${objectiveId}`);
    const summaryCard = document.getElementById(`summaryCard_${objectiveId}`);
    
    if (detailedCard.style.display === 'none') {
        detailedCard.style.display = 'block';
        summaryCard.style.display = 'none';
    } else {
        detailedCard.style.display = 'none';
        summaryCard.style.display = 'block';
    }
}

// Check if all objectives are agreed to show final sign-off
function checkAllObjectivesAgreed() {
    const forms = document.querySelectorAll('.objective-agreement-form');
    const signOffSection = document.getElementById('signOffSection');
    
    let allAgreed = true;
    forms.forEach(form => {
        const select = form.querySelector('select[name="agreement"]');
        if (select.value !== 'Yes') {
            allAgreed = false;
        }
    });

    signOffSection.style.display = allAgreed ? 'block' : 'none';
}

// Initialize state
checkAllObjectivesAgreed();
</script>