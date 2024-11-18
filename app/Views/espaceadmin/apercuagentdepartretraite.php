
 <?php
				$db = \Config\Database::connect();

			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent order by nom asc');
			$agent = $query->getResultArray();
			
			
			
			
			?>
<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Module employés > Départ à la retraite</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier des départs à la retraite.</p>
   <?php
if (isset($_SESSION['toast']) && !empty($_SESSION['toast'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert" style="color: #0f6848; background-color: #d2f4e8; border-color: #bff0de;
">  
	   '.$_SESSION['toast'].' 
    </div>';
	unset($_SESSION['toast']);
}
 ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des agents</h6></td>
          <td></td>
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
              <th>Emploi</th>
              <th>Service</th>
              <th>Depart retraite</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
             
              <th>Emploi</th>
              <th>Service</th>
              <th>Depart retraite</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (! empty($agent) && is_array($agent)) : ?>
            <?php foreach ($agent as $info): ?>
            <?php 
		
		$forma = ($info['alaretraite']==1)?('OUI'):('NON');
										echo '<tr>
                                            <td>'.$info['matricule'].'</td>
                                            <td>'.$info['nom'].'</td>
                                            
                                            <td>'.$info['llemploi'].'</td>
											
                                            <td>'.$info['llservice'].'</td>
											
											<td>'.$forma.'</td>
                                            <td style="text-align:center;">';
											
											if($info['alaretraite']==1){
												//echo '<a href="">Acte retraite</a><br/>';
												echo '<a target="new" href="'.base_url('/espaceadmin/pdfretraiteagent/'.$info['idagent'].'').'"><img src="'.base_url('/img/okok.jpg').'" alt="TELECHARGER ACTE" /></a>&nbsp;&nbsp;&nbsp;';
											
											} else {
												echo '
											'.anchor('espaceadmin/departretraite/'.$info['idagent'],'<span class="btn btn-info mb-2"><i class="m-0 fas fa-angle-double-right" title="Départ à la retraite"></i></span>').'	';
											}
											
											
									
									echo '</td>
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
	$('#dataTable').DataTable( {
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