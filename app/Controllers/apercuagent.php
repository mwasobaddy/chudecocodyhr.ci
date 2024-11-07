
 <?php
				$db = \Config\Database::connect();

			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) order by nom asc');
			$agent = $query->getResultArray();
			
			
			
			
			?>
<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
  <?php
if (isset($toast) && isset($_POST['go']) && !empty($_POST['go'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">  
	   '.$toast.' 
    </div>';
}

if (isset($_SESSION['toast']) && !empty($_SESSION['toast'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color:#4877f4; color:#fff">  
	   '.$_SESSION['toast'].' 
    </div>';
	unset($_SESSION['toast']);
} ?>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des agents</h6></td>
          <td><p class="text-right font-weight-bold text-primary"> <a href="<?php echo base_url('espaceadmin/creeragent');?>" class="btn btn-primary btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Créer nouvel agent</span> </a> </p></td>
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataT" width="100%" cellspacing="0">
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
              echo '
                <tr>
                  <td>'.$info['matricule'].'</td>
                  <td>'.$info['nom'].'</td>
                  <td>'.$info['mobile'].'</td>
                  <td>'.$info['llemploi'].'</td>

                  <td>'.$info['llservice'].'</td>
                  <td style="text-align:center;">
                    '.anchor('espaceadmin/ficheagent/'.$info['idagent'],'<span class="btn btn-success mb-2"><i class="m-0 fas fa-eye" title="Voir fiche"></i></span>').'
                    '.anchor('espaceadmin/delagent/'.$info['idagent'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Désactiver agent"></i></span>').'
                  </td>
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
	$('#dataT').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	} );
} );

	</script> 
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->