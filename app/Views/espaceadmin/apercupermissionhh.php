<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > Liste des Permissions heure à heure</h1>
  <p class="mb-4">Traiter toutes les données de la liste de permissions heure par heure.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Permissions heure à heure</h6></td>
          
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
              <th>Objet sortie</th>
              <th>Date demande</th>
              <th>Lieu</th>
              <th>Heure depart</th>
              <th>Heure reprise</th>
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
              <th>Objet sortie</th>
              <th>Date demande</th>
              <th>Lieu</th>
              <th>Heure depart</th>
              <th>Heure reprise</th>
              <th>Etat</th>
              <th>Actions</th>
              <th>Documents</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			if (! empty($permissionhh) && is_array($permissionhh)) : 
			?>
            <?php foreach ($permissionhh as $info): ?>
            <?php 
		
		
									
                                            
											

	$query = $db->query('SELECT IDagent, matricule, nom from agent where IDagent='.$info['Idagent']);
											$row   = $query->getRow();
              if (!empty($row)) {
                echo '<tr>
                      <td>'.($i++).' </td>';
								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
								
				//echo '<td></td><td></td>';
											
											echo '<td>'.$info['objetsortie'].'</td>
											<td>'.$info['datesortie'].'</td>
											<td>'.$info['lieu'].'</td>
											<td>'.$info['heuredepart'].'</td>
											<td>'.$info['heurearrivee'].'</td>
											<td>'.$info['etat'].'</td>
											
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/editpermissionhh/'.$info['IDpermission'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
									'.anchor('espaceadmin/delpermissionhh/'.$info['IDpermission'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
									';
                  echo '</td><td>';
                                    if($info['justificatif']){
                                      $lieu = './agents/'.$row->matricule.'/4-CONGES/';
                                      echo '<a target="new" href="'.base_url($lieu.$info['justificatif']).'"><i class="fas fa-file-download" title="Visualiser le justificatif"></i></a>';
                                    }


                echo '</td>
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