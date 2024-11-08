<!-- Begin Page Content -->
<?php
	$db = \Config\Database::connect();
	$query = $db->query('SELECT *, (select libelle from direction where direction.IDdirection=poste_direction.IDdirection) as direction,   
(select libelle from emploi where emploi.IDemploi=poste_direction.IDposte) as fonction, (select count(*) from agent where agent.IDdirection=poste_direction.IDdirection and agent.IDlafonction=poste_direction.IDposte) as nbr from poste_direction');
		
		$postdirection = $query->getResultArray();
		
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
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Poste<->Direction</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
               <th>Direction</th>
              <th>Emploi</th>
              <th>Total</th>  
               <th>Details</th>          
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>No.</th>
                 <th>Direction</th>
              <th>Emploi</th>
             
              <th>Total</th>  
               <th>Details</th>          
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			
			$i = 1;
			//print_r($congeannuel);
			if (! empty($postdirection) && is_array($postdirection)) : 
			?>
            <?php foreach ($postdirection as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											echo '
											<td>'.$info['direction'].'</td>
											<td>'.$info['fonction'].'</td>
											
											<td>'.$info['total'].'</td>';
											
											$diff = $info['total']-$info['nbr'];
											
											echo '<td>'.$diff.' poste(s) </td>';
				
										/*	if($diff==0) {
										echo '<td> </td>';
											} else {
												if($diff > 0) {
									echo '<td>'.$diff.' poste(s) </td>';
												} else {
									echo '<td>'.($diff*(-1)).' poste(s)</td>';			
												}
											}*/
											
											echo '                                           
                                            <td style="text-align:center;">
										'.anchor('espaceadmin/editpostedirection/'.$info['IDpostedirection'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delpostedirection/'.$info['IDpostedirection'],'<i class="fas fa-trash" title="Supprimer"></i>').'
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