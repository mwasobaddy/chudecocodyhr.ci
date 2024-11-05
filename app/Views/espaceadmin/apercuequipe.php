<?php
//print_r($_POST);

$db = \Config\Database::connect();
		$myid = $_SESSION['cnxid'];

		$query = $db->query("SELECT * from equipe where IDservice=(select IDservice from agent where idagent=$myid)"); 
		
			$equipe = $query->getResultArray();
?>

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
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>No.</th>
              <th>Nom de l'équipe</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$i = 1;
			if (! empty($equipe) && is_array($equipe)) : 
			?>
            <?php foreach ($equipe as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).'</td>
                                            <td>'.$info['libelle'].'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/addagentequipe/'.$info['IDequipe'],'<i class="fas fa-user-plus" title="Ajouter des agents à l\'équipe"></i>').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.anchor('espaceadmin/editequipe/'.$info['IDequipe'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delequipe/'.$info['IDequipe'],'<i class="fas fa-trash" title="Supprimer"></i>').'
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