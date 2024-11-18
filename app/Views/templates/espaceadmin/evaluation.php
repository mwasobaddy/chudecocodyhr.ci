<!-- app/Views/templates/espaceadmin/evaluation.php -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Gestion de l'évaluation</h1>
    </div>

    <!-- Overview Cards -->
    <div class="row">
        <!-- Total Evaluations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total des évaluations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($evaluations) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count(array_filter($evaluations, fn($e) => $e['status'] === 'Started')) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Terminé</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count(array_filter($evaluations, fn($e) => $e['status'] === 'Completed')) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Evaluations List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
            <h6 class="m-0 font-weight-bold text-primary">Toutes les évaluations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="evaluationsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th>Responsable hiérarchique N+1</th>
                            <th>Responsable hiérarchique N+2</th>
                            <th>Statut</th>
                            <th>Commencé</th>
                            <th>Terminé</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($evaluations as $eval): ?>
                            <tr>
                                <td><?= esc($eval['employee_name']) ?></td>
                                <td>
                                    <?= esc($eval['manager_n1_name']) ?>
                                    <button class="btn btn-sm btn-link" 
                                            data-toggle="modal" 
                                            data-target="#changeManagerModal"
                                            data-eval-id="<?= $eval['idevaluation'] ?>"
                                            data-manager-type="n1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <?= esc($eval['manager_n2_name']) ?>
                                    <button class="btn btn-sm btn-link"
                                            data-toggle="modal" 
                                            data-target="#changeManagerModal"
                                            data-eval-id="<?= $eval['idevaluation'] ?>"
                                            data-manager-type="n2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $eval['status'] === 'Completed' ? 'success' : 
                                        ($eval['status'] === 'Started' ? 'warning' : 'info') ?>">
                                        <?= esc($eval['status']) ?>
                                    </span>
                                </td>
                                <td><?= date('d M Y', strtotime($eval['started_at'])) ?></td>
                                <td><?= $eval['completed_at'] ? date('d M Y', strtotime($eval['completed_at'])) : '-' ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" 
                                            data-toggle="modal" 
                                            data-target="#viewDetailsModal_<?= $eval['idevaluation'] ?>">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Employé</th>
                            <th>Responsable hiérarchique N+1</th>
                            <th>Responsable hiérarchique N+2</th>
                            <th>Statut</th>
                            <th>Commencé</th>
                            <th>Terminé</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Change Manager Modal -->
<div class="modal fade" id="changeManagerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Changer le responsable hiérarchique</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="<?= base_url('espaceadmin/evaluation/change-manager') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="evaluation_id" id="modalEvalId">
                    <input type="hidden" name="manager_type" id="modalManagerType">
                    
                    <div class="form-group">
                        <label>Sélectionnez Nouveau Responsable Hiérarchique :</label>
                        <select name="new_manager_id" class="form-control" required>
                            <?php 
                                usort($managers, function($a, $b) {
                                    return strcmp($a['nom'], $b['nom']);
                                });
                                foreach ($managers as $manager): ?>
                                    <option value="<?= $manager['idagent'] ?>">
                                        <?= esc($manager['nom']) ?>
                                    </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DataTables JavaScript -->
<script>
$(document).ready(function() {
    $('#evaluationsTable').DataTable();

    $('#changeManagerModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const evalId = button.data('eval-id');
        const managerType = button.data('manager-type');
        
        const modal = $(this);
        modal.find('#modalEvalId').val(evalId);
        modal.find('#modalManagerType').val(managerType);
    });
});
</script>