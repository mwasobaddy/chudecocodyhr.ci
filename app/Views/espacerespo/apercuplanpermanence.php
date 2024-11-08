<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	
	$myid = $_SESSION['cnxid'];
	$query   = $db->query('SELECT *, (select libelle from service where service.IDservice=planpermanence.IDservice) as serv, (select libelle from lemois where lemois.IDmois=planpermanence.IDmois) as moi FROM planpermanence WHERE IDservice=(select IDservice from agent where idagent='.$myid.')');
	$planpermanence = $query->getResultArray();
				
			


?>
<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des plannings de permanance</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
               <th>No.</th>
               <th>Nom planning</th>
               <th>Service</th>
               <th>Nombre de lit</th>
               <th>Publié ?</th>
            	<th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                             <th>No.</th>
               <th>Nom planning</th>
               <th>Service</th>
               <th>Nombre de lit</th>
               <th>Publié ?</th>
            	<th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			if (! empty($planpermanence) && is_array($planpermanence)) : 
			?>
            <?php foreach ($planpermanence as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).'</td>
                                            <td>'.$info['libelle'].'</td>
											<td>'.$info['serv'].'</td>
											<td>'.$info['lit'].'</td>
											<td>'.(($info['publier']=='1')?('OUI'):('NON')).'</td>
                                            
                                            <td style="text-align:center;">
										'.anchor('espacerespo/editplanpermanence/'.$info['IDplanpermanence'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').''.anchor('espacerespo/delplanpermanence/'.$info['IDplanpermanence'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
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