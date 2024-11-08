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
			
			?>
          
            <?php 
		$query   = $db->query('SELECT * FROM congeannuel where Idagent='.$_SESSION['cnxid'].'');
$results = $query->getResultArray();

foreach ($results as $info)
{
  //  echo $info['Idagent'];

		if($info['datereprise'] < date('Y-m-d')) {
			echo '<tr style="background-color: #f8d7da !important; color: #842029 !important;">';
		} else {
			echo '<tr>';
		}
										echo '
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
                                            
                                            <td style="text-align:center;">';
											if($info['validationcs']==1 && $info['validationsdrh']==1) {
												//echo '<img src="'.base_url('/img/okok.jpg').'" alt="DEJA VALIDE" />';
												echo '<a target="new" href="'.base_url('/espaceagent/pdfcongeagent/'.$info['IDconge'].'').'"><i class="fas fa-file-alt" title="TELECHARGER ATTESTATION"></i></a>';
                        if($info['horspays']==1 || $info['horspays']=='1') {
                          echo '&nbsp;&nbsp;&nbsp;<a target="new" href="'.base_url('/espaceagent/pdfcongecertificatagent/'.$info['IDconge'].'').'"><i class="fas fa-file-alt" title="TELECHARGER DECISION"></i></a>';
                        }
                        echo '&nbsp;&nbsp;&nbsp;<a target="new" href="'.base_url('/espaceagent/pdfrepriseconge/'.$info['IDconge'].'').'"><i class="fas fa-hiking" title="Certificat de reprise"></i></a>';	
										
                      } else { //pdfcongeagentpays
											///espaceagent/pdfcongeagentpays/'.$info['IDconge'].'
												
												$ladif = date_diff(date_create(date('Y-m-d')),date_create($info['datedepart']));
			
			$dd = $ladif->format("%a");									
					
			$delai = 0;
			$delai = $delai + $dd;
												
				if($delai > 11) {
					
					if($info['validationcs'] != 1) {
						echo ''.anchor('espaceagent/editcongeannuel/'.$info['IDconge'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;';
										
										
										echo anchor('espaceagent/delcongeannuel/'.$info['IDconge'],'<i class="fas fa-trash" title="Supprimer"></i>').'';
					} else {
						echo 'Modification impossible!';
					}
					
					
				} else {
					
					echo 'Modification impossible!';
				}
												
											}
											
										
										echo '
									</td>
                                        </tr>
											';
		}
										?>
           
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