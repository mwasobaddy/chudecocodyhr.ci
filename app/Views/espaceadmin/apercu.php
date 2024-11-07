<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des agents</h6></td>
          <td><p class="text-right font-weight-bold text-primary"> <a href="<?php echo base_url('/espaceadmin/afficher/creeragent');?>" class="btn btn-primary btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Créer nouvel agent</span> </a> </p></td>
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Contact</th>
              <th>Emploi</th>
              <th>Service</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Contact</th>
              <th>Emploi</th>
              <th>Service</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (! empty($agent) && is_array($agent)) : ?>
            <?php foreach ($agent as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.$info['matricule'].'</td>
                                            <td>'.$info['nom'].'</td>
                                            <td>'.$info['mobile'].'</td>
                                            <td>'.$info['emploi'].'</td>
											
                                            <td>'.$info['service'].'</td>
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/delagent/'.$info['idagent'],'<i class="fas fa-info-circle" title="Voir fiche"></i>').'	&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delagent/'.$info['idagent'],'<i class="fas fa-user-edit" title="Modifier fiche"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delagent/'.$info['idagent'],'<i class="fas fa-trash" title="Supprimer agent"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delagent/'.$info['idagent'],'<i class="fas fa-times" title="Désactiver agent"></i>').'</td>
                                        </tr>
											';
		
										?>
            <?php endforeach; ?>
            <?php else : ?>
          <h3>Rien à afficher</h3>
          <p>Pas de nouveaux agents à afficher.</p>
          <?php endif ?>
          </tbody>
          
        </table>
        <script type="text/javascript">
	$(document).ready(function() {
    $('dataTable').DataTable();
} );
	</script> 
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->