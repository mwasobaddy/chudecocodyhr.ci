<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT * from permissiondd where IDagent in(SELECT idagent FROM agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.')');
$permissiondd = $query->getResultArray();
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > Liste des Permissions jour à jour</h1>
  <p class="mb-4">Traitez toute la liste d’autorisations quotidienne.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
     <?php
echo view('toast');
 ?>
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
              <th>Date sortie</th>
              <th>Lieu</th>
              <th>Jour depart</th>
              <th>Jour arrivé</th>
              <th>Etat</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Motif</th>
              <th>Date sortie</th>
              <th>Lieu</th>
              <th>Jour depart</th>
              <th>Jour arrivé</th>
              <th>Etat</th>
              <th>Actions</th>
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
										'.anchor('espacerespo/editpermissiondd/'.$info['IDpermission'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
									'.anchor('espacerespo/delpermissiondd/'.$info['IDpermission'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
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