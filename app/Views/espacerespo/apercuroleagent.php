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
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Rôle-Agent</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Agent</th>
              <th>Rôle</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>No.</th>
              <th>Agent</th>
              <th>Rôle</th>
            <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$i = 0;
			if (! empty($roleagent) && is_array($roleagent)) : 
			?>
            <?php foreach ($roleagent as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).'</td>';
                                        
										
										$db = \Config\Database::connect();

				$query = $db->query('SELECT matricule, nom from agent where IDagent='.$info['IDagent']);
											$results = $query->getRow();
								echo '<td>'.$results->matricule.' - '.$results->nom.'</td>';
								
				$query = $db->query('SELECT libelle from role where IDrole='.$info['IDrole']);
											$results = $query->getRow();
								echo '<td>'.$results->libelle.'</td>';

										
										
											
											
											//.$info['libelle'].'</td>
                                            
                                           echo ' <td style="text-align:center;">
										'.anchor('espacerespo/editroleagent/'.$info['IDroleagent'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espacerespo/delroleagent/'.$info['IDroleagent'],'<i class="fas fa-trash" title="Supprimer"></i>').'
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