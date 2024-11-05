<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-gray-800">Module employés -> liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Permissions jour à jour</h6></td>
          
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
              <th>Motif</th>
              <th>Date demande</th>
              <th>Lieu</th>
              <th>Jour depart</th>
              <th>Jour reprise</th>
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
              <th>Motif</th>
              <th>Date demande</th>
              <th>Lieu</th>
              <th>Jour depart</th>
              <th>Jour reprise</th>
              <th>Etat</th>
              <th>Actions</th>
              <th>Documents</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
        			$db = \Config\Database::connect();
        			$i = 1;
        			if (! empty($permissiondd) && is_array($permissiondd)) : 
        			?>
              <?php foreach ($permissiondd as $info): ?>
              <?php 
              $rslt = $db->query('SELECT IDagent from agent where IDagent='.$info['Idagent']);
              $rslt   = $rslt->getRow();
              if(!empty($rslt)){
		            echo '<tr>
                        <td>'.($i++).' </td>';                     
							           $query = $db->query('SELECT IDagent, matricule, nom from agent where IDagent='.$info['Idagent']);
											   $row   = $query->getRow();

        								echo '<td>'.$row->matricule.'</td>';
        								echo '<td>'.$row->nom.'</td>';
								
				                //echo '<td></td><td></td>';
											
  											echo '<td>'.$info['motif'].'</td>
  											<td>'.$info['datesortie'].'</td>
  											<td>'.$info['lieu'].'</td>
  											<td>'.$info['jourdepart'].'</td>
  											<td>'.$info['jourarrivee'].'</td>
  											<td>'.$info['etat'].'</td>
                                              
  											<td style="text-align:center;">
  										    '.anchor('espaceadmin/editpermissiondd/'.$info['IDpermission'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;
  									      '.anchor('espaceadmin/delpermissiondd/'.$info['IDpermission'],'<i class="fas fa-trash" title="Supprimer"></i>').'
  									     ';
                        echo '</td><td>';
                            if($info['justificatif']){
                               $lieu = './agents/'.$row->matricule.'/4-CONGES/';
                               echo '&nbsp;&nbsp;&nbsp;<a target="new" href="'.base_url($lieu.$info['justificatif']).'"><i class="fas fa-file-download" title="Visualiser le justificatif"></i></a>';
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