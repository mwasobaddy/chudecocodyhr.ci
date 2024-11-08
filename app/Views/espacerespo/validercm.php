<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT * from congematernite where IDagent in(SELECT idagent FROM agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.')');
$congematernite = $query->getResultArray();
?>
<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > Liste des Congés de maternité</h1>
  <p class="mb-4">Traiter toutes les données relatives à la liste des congés de maternité.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
     <?php
echo view('toast');
 ?>
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Congés de maternité</h6></td>
          
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
              <th>Date terme</th>
              <th>Date demande</th>
              <th>Date départ</th>
              <th>Date reprise</th>
              <th>Durée</th>
              <th>Etat</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Date terme</th>
              <th>Date demande</th>
              <th>Date départ</th>
              <th>Date reprise</th>
              <th>Durée</th>
              <th>Etat</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			if (! empty($congematernite) && is_array($congematernite)) : 
			?>
            <?php foreach ($congematernite as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT IDagent, matricule, nom from agent where IDagent='.$info['Idagent']);
											$row   = $query->getRow();

								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
								
				//echo '<td></td><td></td>';
											
											echo '<td>'.$info['dateterme'].'</td>
											<td>'.$info['datedemande'].'</td>
											<td>'.$info['datedepart'].'</td>
											<td>'.$info['datereprise'].'</td>
											<td>'.$info['duree'].'</td>
											<td>'.$info['etat'].'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espacerespo/editcongematernite/'.$info['IDconge'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
									'.anchor('espacerespo/delcongematernite/'.$info['IDconge'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
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