<!-- Begin Page Content -->

<?php
	
	
	$db = \Config\Database::connect();
	$myid = $_SESSION['cnxid'];
	if(isset($lidarrettravail)) {
		$query = $db->query("SELECT * from arrettravail where arrettravail.Idagent IN(SELECT idagent FROM agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.')");
		//echo "SELECT * from arrettravail where arrettravail.Idagent IN(SELECT idagent FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'')";
		$arrettravail = $query->getResultArray();
	}

?>

<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des arrêts de travail</h6></td>
          
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
			
			
			$myid = $_SESSION['cnxid'];

		$query = $db->query("SELECT * from arrettravail where arrettravail.Idagent IN(SELECT idagent FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and idagent=$myid or agent.Responsablen1=$myid or agent.Responsablen2=$myid or agent.Sousdrh=$myid)");
		//$gg = "SELECT * from arrettravail where arrettravail.Idagent IN(SELECT idagent FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and idagent=$myid or agent.Responsablen1=$myid or agent.Responsablen2=$myid or agent.Sousdrh=$myid')";
		
		//var_dump($gg);
		//echo "SELECT * from arrettravail where arrettravail.Idagent IN(SELECT idagent FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'')";
		$arrettravail = $query->getResultArray();


			//print_r($arrettravail);
			if (! empty($arrettravail) && is_array($arrettravail)) : 
			?>
            <?php foreach ($arrettravail as $info): ?>
            <?php 
		
		
									if(($info['datereprise'] < date('Y-m-d')) && $info['etat'] != 'TERMINE' ) {
			echo '<tr style="background-color: #f8d7da !important; color: #842029 !important;">';
		} else {
			echo '<tr>';
		}
										echo '
                                            <td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT IDagent, matricule, nom, IDservice from agent where IDagent='.$info['Idagent']);
											$agent   = $query->getRow();
								echo '<td>'.$agent->matricule.'</td>';
								echo '<td>'.$agent->nom.'</td>';
								$leservice = $agent->IDservice;
								
								$query = $db->query('SELECT libelle from service where IDservice='.$leservice);
											$row   = $query->getRow();
								echo '<td>'.$row->libelle.'</td>';
								
								
				
											echo '
											<td>'.$info['datedepart'].'</td>
											<td>'.$info['datereprise'].'</td>
											
											<td>'.$info['etat'].'</td>
                                            
                                            <td style="text-align:center;">
										';
										
										if(strcmp($info['etat'],'EN COURS')==0 || strcmp($info['etat'], 'PROROGATION')==0) {
										echo anchor('espacerespo/editarrettravail/'.$info['IDarrettravail'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier arrêt de travail"></i></span>').'
                       '.anchor('espacerespo/retourarrettravail/'.$info['IDarrettravail'],'<span class="btn btn-info mb-2"><i class="m-0 fas fa-angle-double-left" title="Retour Arrêt travail"></i></span>').'
                       '.anchor('espacerespo/prorogerarrettravail/'.$info['IDarrettravail'],'<span class="btn btn-secondary mb-2"><i class="m-0 fas fa-redo-alt" title="Proroger arrêt de travail"></i></span>').'
                       '.anchor('espacerespo/delarrettravail/'.$info['IDarrettravail'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer arrêt de travail"></i></span>').'
                    ';
                                            if($info['justificatif1']) {
                                                $lieu = './agents/'.$agent->matricule.'/5-MALADIE/';
                                                echo '<a target="new" href="'.base_url($lieu.$info['justificatif1']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif"></i></span></a>';
                                            }
										} else {
									echo 'TERMINE'; 
										}
									echo '</td>
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