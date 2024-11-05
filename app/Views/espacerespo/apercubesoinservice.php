<!-- Begin Page Content -->
<?php
	$db = \Config\Database::connect();
	$query = $db->query('SELECT *, (select libelle from service where service.IDservice=besoinservice.IDservice) as service, 
(select libelle from lafonction where lafonction.IDlafonction=besoinservice.IDposte) as fonction from besoinservice');	
	$besoinservice = $query->getResultArray();
		

?>
<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-gray-800">Module employés -> liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des besoins du service : <?php  echo $besoinservice[0]['service']; ?></h6></td>
          
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
             
              <th>Besoin</th>  
               <th>Justificatif</th> 
                <th>Etat</th>         
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>No.</th>
              
              <th>Fonction</th>
             
              <th>Besoin</th>  
               <th>Justificatif</th>     
                <th>Etat</th>     
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			
			$i = 1;
			//print_r($congeannuel);
			if (! empty($besoinservice) && is_array($besoinservice)) : 
			?>
            <?php foreach ($besoinservice as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											echo '
											
											<td>'.$info['fonction'].'</td>
											
											<td>'.$info['total'].'</td>
											<td>'.$info['justificatif'].'</td>
											<td>'.$info['etat'].'</td>
											<td style="text-align:center;">';
											
											if($info['etat']=='ACCEPTEE' || $info['etat']=='REFUSEE') {
												echo 'DEMANDE TERMINEE';
											} else {
												 echo anchor('espacerespo/editbesoinservice/'.$info['IDbesoinservice'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espacerespo/delbesoinservice/'.$info['IDbesoinservice'],'<i class="fas fa-trash" title="Supprimer"></i>');
											}
                                            
                                           
									
									echo '
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