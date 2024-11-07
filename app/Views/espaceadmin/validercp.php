<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT * from agentplanpermanence where changement=1 and Idagent in(SELECT idagent FROM agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.')');

$agentplanpermanence = $query->getResultArray();

//print_r($agentplanpermanence);
?>


<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des permanences</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      Avant de valider une demande, rassurez-vous d'avoir effectué les modifications nécessaires dans l'espace d'attribution de planning :  <a href="<?php echo base_url('espaceadmin/attribuerplanpermanence');?>"> ICI </a><br/><br/>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Planning permance</th>
              <th>Jour</th>
               <th>Proposition et motif</th>
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
              <th>Proposition et motif</th>
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
								
								
									echo '<td>'.$info['justificatif'].'</td>';
				
											echo '
											
                                            
                                            <td style="text-align:center;">';
										
										
										
						
											echo anchor('espaceadmin/acceptercp/'.$info['idagentplanpermanence'],'<i class="fas fa-check-double" title="Valider modification"></i>').'&nbsp;&nbsp;&nbsp;'.anchor('espaceadmin/refusercp/'.$info['idagentplanpermanence'],'<i class="fas fa-trash" title="Refuser modification"></i>');
									
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