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
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
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
			//echo "SELECT * from equipe where IDservice=(select IDservice from agent where idagent=$myid)";
			
			
		//echo "SELECT * from equipe where IDservice=(select IDservice from agent where idagent=$myid)";
		
	
			
			$i = 1;
			if (! empty($equipe) && is_array($equipe)) : 
			?>
            <?php foreach ($equipe as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).'</td>
                                            <td>'.$info['libelle'].'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espacerespo/addagentequipe/'.$info['IDequipe'],'<i class="fas fa-user-plus" title="Ajouter des agents à l\'équipe"></i>').''.anchor('espacerespo/editequipe/'.$info['IDequipe'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
									'.anchor('espacerespo/delequipe/'.$info['IDequipe'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
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