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
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des emplois</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Intitulé de l'emploi</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
             <th>No.</th>
              <th>Intitulé de l'emploi</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			if (! empty($emploi) && is_array($emploi)) : 
			?>
            <?php foreach ($emploi as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).'</td>
                                            <td>'.$info['libelle'].'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/editemploi/'.$info['IDemploi'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delemploi/'.$info['IDemploi'],'<i class="fas fa-trash" title="Supprimer"></i>').'
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