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
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Equipes</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nom de l'équipe</th>
             <th>Nom de l'agent</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>No.</th>
               <th>Nom de l'équipe</th>
                   <th>Nom de l'agent</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			
			
			
			$i = 1;
			if (! empty($agentequipe) && is_array($agentequipe)) {
			
			
			//print_r($agentequipe);
			foreach ($agentequipe as $info) {		
		
										echo '<tr>
                                            <td>'.($i++).'</td>
                                            <td>'.$agentequipe[($i-2)]->equipe.'</td>
											 <td>'.$agentequipe[($i-2)]->agent.'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/delagentequipe/'.$agentequipe[($i-2)]->idagentequipe,'<i class="fas fa-trash" title="Supprimer"></i>').'
									</td>
                                        </tr>
											';
		
										
			}
            } 
            
             ?>
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