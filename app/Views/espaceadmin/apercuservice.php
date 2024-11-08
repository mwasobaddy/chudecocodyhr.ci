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
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Services</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nom du Services</th>
              <th>Sous-Direction associée</th>
              <th>Chef service</th>
              <th>SUS</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Nom du Services</th>
              <th>Sous-Direction associée</th>
               <th>Chef service</th>
                <th>SUS</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
							$i = 1;
							if (! empty($service) && is_array($service)) : 
						?>
            <?php foreach ($service as $info): ?>
            <?php 
		
		
										echo '<tr>
                          <td>'.($i++).'</td>
                          <td>'.$info['libelle'].'</td>
											<td>';

												$db = \Config\Database::connect();
												$query = $db->query('SELECT libelle from sousdirection where IDsousdirection='.$info['IDsousdirection']);
												$results = $query->getResult();
												
												foreach ($results as $row)
												{
												
													echo $row->libelle;
													
												}
											
											echo '</td><td>';
											
											$query = $db->query('SELECT Idagent, matricule, nom from agent where Idagent ='.$info['chefservice']); 
											
											$results = $query->getResult();
											
											foreach ($results as $row)
											{
											
												echo $row->matricule.' - '.$row->nom;
												
											}
											/////////////////////////////
											echo '</td><td>';
											
											$query = $db->query('SELECT * from agent where Idagent ='.$info['sus']); 
											
											$results = $query->getResult();
											
											foreach ($results as $row)
											{
											
												echo $row->matricule.' - '.$row->nom;
												
											}
											
											
											// echo '</td><td>'.$info['sus'].'</td>
                      echo '</td>                     
                      <td style="text-align:center;">
												'.anchor('espaceadmin/editservice/'.$info['IDservice'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
												'.anchor('espaceadmin/delservice/'.$info['IDservice'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
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
	$('#dataTable').DataTable( {
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