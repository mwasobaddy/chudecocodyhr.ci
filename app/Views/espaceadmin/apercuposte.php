<!-- Begin Page Content -->
<?php
	$db = \Config\Database::connect();
	$query = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=poste.IDemploi) as emploi, (select libelle from emploi where emploi.IDemploi=poste.IDlafonction) as fonction from poste');
		
		$poste = $query->getResultArray();

?>
<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
  
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
              <th>Fonction</th>
              <th>Emploi</th>
              <th>Intitulé</th>            
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Fonction</th>
              <th>Emploi</th>
              <th>Intitulé</th>            
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			
			$i = 1;
			//print_r($congeannuel);
			if (! empty($poste) && is_array($poste)) : 
			?>
            <?php foreach ($poste as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
						
				
											echo '
											<td>'.$info['fonction'].'</td>
											<td>'.$info['emploi'].'</td>
											
											<td>'.$info['Intitule'].'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/editposte/'.$info['IDposte'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
									'.anchor('espaceadmin/delposte/'.$info['IDposte'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
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