<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > Liste des Congés de maternité</h1>
  <p class="mb-4">Traiter toutes les données relatives à la liste des congés de maternité.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Congés de maternité</h6></td>
          
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
              <th>Date demande</th>
              <th>Terme théorique</th>
              
              <th>Date départ</th>
              <th>Date reprise</th>
              <th>Durée</th>
              <th>Etat</th>
              <th>Actions</th>
              <th>Documents</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Date demande</th>
              <th>Terme théorique</th>
             
              <th>Date départ</th>
              <th>Date reprise</th>
              <th>Durée</th>
              <th>Etat</th>
              <th>Actions</th>
              <th>Documents</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			
			?>
           
            <?php 
		$query   = $db->query('SELECT * FROM congematernite where Idagent='.$_SESSION['cnxid']);
$results = $query->getResultArray();

foreach ($results as $info)
{
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT IDagent, matricule, nom from agent where IDagent='.$info['Idagent']);
											$row   = $query->getRow();

								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
								
				//echo '<td></td><td></td>';
											
											echo '<td>'.$info['datedemande'].'</td>
											<td>'.$info['dateterme'].'</td>
											
											<td>'.$info['datedepart'].'</td>
											<td>'.$info['datereprise'].'</td>
											<td>'.$info['duree'].'</td>
											<td>'.$info['etat'].'</td>
                                            
                                            <td style="text-align:center;">
											';
											
											if($info['validationcs']==1 && $info['validationsus']==1) {
												//echo '<img src="'.base_url('/img/okok.jpg').'" alt="DEJA VALIDE" />';
												echo '<a target="new" href="'.base_url('/espaceagent/pdfcongemagentdecret/'.$info['IDconge'].'').'"><img src="'.base_url('/img/okok.jpg').'" alt="TELECHARGER ACTE" style="width:30px; height:30px;"/></a><a target="new" href="'.base_url('/espaceagent/pdfcongemagentattestation/'.$info['IDconge'].'').'">&nbsp;&nbsp;<img src="'.base_url('/img/okok.jpg').'" alt="TELECHARGER ACTE" style="width:30px; height:30px;"/></a>';
											
                       
                      } else { //pdfcongeagentpays
											///espaceagent/pdfcongeagentpays/'.$info['IDconge'].'
												echo anchor('espaceagent/editcongematernite/'.$info['IDconge'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
											'.anchor('espaceagent/delcongematernite/'.$info['IDconge'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>');
                     
                  
											}
										
									
									echo '
									</td>';
                    echo '<td style="text-align:center;">';
                    if($info['validationcs']==1 && $info['validationsus']==1) {}else{
                    $lieu = './agents/'.$row->matricule.'/4-CONGES/';
                      echo '<a target="new" href="'.base_url($lieu.$info['justificatif1']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 1"></i></span></a>'; 
                      echo '<a target="new" href="'.base_url($lieu.$info['justificatif2']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 2"></i></span></a>'; 
                      echo '<a target="new" href="'.base_url($lieu.$info['justificatif3']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 3"></i></span></a>'; 
                    }
                    echo '</td>';
                                        echo '</tr>
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
<!-- End of Main Content