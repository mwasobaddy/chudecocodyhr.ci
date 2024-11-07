<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT *, (select libelle from planpermanence where planpermanence.IDplanpermanence=agentplanpermanence.IDplanpermanence) as plan, (select datejourplan from jourplan where jourplan.IDjourplan=agentplanpermanence.IDjourplan) as jour from agentplanpermanence where where IDequipe in(SELECT IDequipe from equipe where IDservice = (select IDservice from agent where idagent = '.$myid.'))');


$congeannuel = $query->getResultArray();
?>




<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
     <?php
echo view('toast');
 ?>
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Modification de planning</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Service</th>
              <th>Plan de permanence</th>
              <th>Jour de permanence</th>
               <th>Demande changement</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Service</th>
              <th>Plan de permanence</th>
              <th>Jour de permanence</th>
              <th>Demande changement</th>
              <th>Actions</th>
           
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			//print_r($congeannuel);
			if (! empty($congeannuel) && is_array($congeannuel)) : 
			?>
            <?php foreach ($congeannuel as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT Idagent, matricule, nom, IDservice from agent where IDagent='.$info['Idagent']);
											$row   = $query->getRow();
								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
								$leservice = $row->IDservice;
								
								$query = $db->query('SELECT libelle from service where IDservice='.$row->IDservice);
											$row   = $query->getRow();
								echo '<td>'.$row->libelle.'</td>';
								
								
				
											echo '
											<td>'.$info['plan'].'</td>
											<td>'.$info['jour'].'</td>
											<td>'.$info['justificatif'].'</td>
											
											                                            
                                            <td style="text-align:center;">';
											
											if($info['changement']==1) {
													echo anchor('espaceagent/editplanningn/'.$info['idagentplanpermanence'],'<i class="fas fa-trash" title="Annuler demande de changement"></i>');
											} else {
												echo anchor('espaceagent/editplanning/'.$info['idagentplanpermanence'],'<i class="fas fa-user-edit" title="Initier changement"></i>');
												
											
											}
											
										
										
										echo '
									</td>
                                        </tr>
											';
		
										?>
            <?php endforeach; ?>
            <?php else : ?>
         
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