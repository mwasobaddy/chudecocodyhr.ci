<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT * from agentplanpermanence where Idagent in(SELECT idagent FROM agent where  (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.')');
$agentplanpermanence = $query->getResultArray();
?>


<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > Liste des permanences</h1>
  <p class="mb-4">Traiter toutes les données relatives Liste des permanences</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des permanences</h6></td>
          
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
              <th>Planning permance</th>
              <th>Jour</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Planning permance</th>
              <th>Jour</th>
              <th>Actions</th>
           
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			//print_r($congeannuel);
			if (! empty($agentplanpermanence) && is_array($agentplanpermanence)) : 
			?>
            <?php foreach ($agentplanpermanence as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT idagent, matricule, nom, IDservice from agent where IDagent='.$info['Idagent']);
											$row   = $query->getRow();
								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
								$leservice = $row->IDservice;
								
								$query = $db->query('SELECT libelle from planpermanence where IDplanpermanence='.$info['IDplanpermanence']);
											$row   = $query->getRow();
								echo '<td>'.$row->libelle.'</td>';
								
								$query = $db->query('SELECT * from jourplan where IDjourplan='.$info['IDjourplan']);
											$row   = $query->getRow();
											
											if($row->jour < 10)
						$jjj = '0'.$row->jour;
						else
						$jjj = $row->jour;
											
								echo '<td>'.$jjj.' / '.$row->mois.' / '.$row->annee.' ('.$row->libelle.')</td>';
								
								
									
				
											echo '
											
                                            
                                            <td style="text-align:center;">';
										
										
											echo anchor('espacerespo/editagentplanpermanence/'.$info['idagentplanpermanence'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;'.anchor('espacerespo/delagentplanpermanence/'.$info['idagentplanpermanence'],'<i class="fas fa-trash" title="Supprimer"></i>');
										
									
									
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