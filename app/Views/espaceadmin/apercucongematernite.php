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
			if (! empty($congematernite) && is_array($congematernite)) : 
			?>
            <?php foreach ($congematernite as $info): ?>
            <?php 
		
		
                                            
											

	$query = $db->query('SELECT * from agent where idagent='.$info['Idagent']);
											$row   = $query->getRow();
              if (!empty($row)) {
                if($info['datereprise'] < date('Y-m-d')) {
                  echo '<tr style="background-color: #f8d7da !important; color: #842029 !important;">';
                } else {
                  echo '<tr>';
                }
                      echo '<td>'.($i++).' </td>';
											
                      echo '<td>'.$row->matricule.'</td>';
                      echo '<td>'.$row->nom.'</td>';
											echo '<td>'.$info['datedemande'].'</td>
											<td>'.$info['dateterme'].'</td>
											
											<td>'.$info['datedepart'].'</td>
											<td>'.$info['datereprise'].'</td>
											<td>'.$info['duree'].'</td>
											<td>'.$info['etat'].'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/editcongematernite/'.$info['IDconge'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
									'.anchor('espaceadmin/delcongematernite/'.$info['IDconge'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
								';
                echo '</td><td>';
                $lieu = './agents/'.$row->matricule.'/4-CONGES/';
                if (!empty($info['justificatif1'])) {
                  echo '<a target="new" href="'.base_url($lieu.$info['justificatif1']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 1"></i></span></a>';	
                }
                if (!empty($info['justificatif2'])) {
                  echo '<a target="new" href="'.base_url($lieu.$info['justificatif2']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 2"></i></span></a>';	
                }
                if (!empty($info['justificatif3'])) {
                  echo '<a target="new" href="'.base_url($lieu.$info['justificatif3']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 3"></i></span></a>';	
                }
            

                echo '            
                  </td>
                                        </tr>
											';
              }
										?>
            <?php endforeach; ?>
            <?php else : ?>
         
          <?php endif ?>
          </tbody>
          
        </table>
        <script type="text/javascript">
	$(document).ready(function() {
	$('#dataTable').DataTable( {
    stateSave: true,
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