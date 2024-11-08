<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT * from congeannuel where IDagent in(SELECT idagent FROM agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.')');
$congeannuel = $query->getResultArray();
?>


<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Congés annuels</h6></td>
          
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
              <th>Planning congés</th>
              <th>Date départ</th>
              <th>Date reprise</th>
    
              <th>Etat</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Service</th>
              <th>Planning congés</th>
              <th>Date départ</th>
              <th>Date reprise</th>
              
              <th>Etat</th>
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
                                            
											

	$query = $db->query('SELECT IDagent, matricule, nom, IDservice from agent where IDagent='.$info['Idagent']);
											$row   = $query->getRow();
								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
								$leservice = $row->IDservice;
								
								$query = $db->query('SELECT libelle from service where IDservice='.$leservice);
											$row   = $query->getRow();
								echo '<td>'.$row->libelle.'</td>';
								
								
									$query = $db->query('SELECT IDplancongeannuel, libelle from plancongeannuel where IDplancongeannuel='.$info['IDplancongeannuel']);
											$row   = $query->getRow();
								echo '<td>'.$row->libelle.'</td>';
												
				
											echo '
											<td>'.$info['datedepart'].'</td>
											<td>'.$info['datereprise'].'</td>
											
											<td>'.$info['etat'].'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/validerca/'.$info['IDconge'],'<i class="fas fa-user-edit" title="Valider"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delcongeannuel/'.$info['IDconge'],'<i class="fas fa-trash" title="Supprimer"></i>').'
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