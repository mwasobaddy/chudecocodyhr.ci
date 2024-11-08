<!-- Begin Page Content -->
<?php

		$db = \Config\Database::connect();
	$query = $db->query('SELECT *, (select libelle from direction where direction.IDdirection=poste_direction.IDdirection) as work, 
(select libelle from emploi where emploi.IDemploi=poste_direction.IDposte) as fonction, (select count(*) from agent where agent.IDdirection=poste_direction.IDdirection and agent.IDsousdirection is null and agent.IDservice is null and agent.IDemploi=poste_direction.IDposte) as nbr, null as besoin, null as raison from poste_direction');
		$postdirection = $query->getResultArray();
		
	$query = $db->query('SELECT *, (select libelle from sousdirection where sousdirection.IDsousdirection=poste_sousdirection.IDsousdirection) as work, 
(select libelle from emploi where emploi.IDemploi=poste_sousdirection.IDposte) as fonction, (select count(*) from agent where agent.IDsousdirection=poste_sousdirection.IDsousdirection and agent.IDdirection is null and agent.IDservice is null and agent.IDemploi=poste_sousdirection.IDposte) as nbr, null as besoin, null as raison  from poste_sousdirection');
		$postesousdirection = $query->getResultArray();
		
		
	$query = $db->query('SELECT *, (select libelle from service where service.IDservice=poste_service.IDservice) as work, 
(select libelle from emploi where emploi.IDemploi=poste_service.IDposte) as fonction, (select count(*) from agent where agent.IDservice=poste_service.IDservice and agent.IDemploi=poste_service.IDposte) as nbr, (select total from besoinservice where besoinservice.IDservice=poste_service.IDservice and besoinservice.IDposte=poste_service.IDposte) as besoin, (select justificatif from besoinservice where besoinservice.IDservice=poste_service.IDservice and besoinservice.IDposte=poste_service.IDposte) as raison from poste_service');	
	$posteservice = $query->getResultArray();
	
	
	$all = array_merge($postdirection,$postesousdirection,$posteservice);
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
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Rapport général de la codification des postes</h6></td>
       
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Direction <br/> Sous-Direction <br/> Service</th>
              <th>Emploi</th>
              <th>Référentiel</th>  
               <th>Existant</th>   
               <th>Besoins</th>     
              <th>Mise à disposition</th>             
              <th>Observation</th>  
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>No.</th>
              <th>Direction <br/> Sous-Direction <br/> Service</th>
              <th>Emploi</th>
              <th>Référentiel</th>  
               <th>Existant</th>   
               <th>Besoins</th>     
              <th>Mise à disposition</th>             
              <th>Observation</th>  
            </tr>
          </tfoot>
          <tbody>
            <?php 
			
			$i = 1;
			//print_r($congeannuel);
			if (! empty($all) && is_array($all)) : 
			?>
            <?php foreach ($all as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											echo '
											<td>'.$info['work'].'</td>
											<td>'.$info['fonction'].'</td>
											
											<td>'.$info['total'].'</td>
											
										';
											
											$diff = $info['total']-$info['nbr'];
											
											echo '<td> '.$info['nbr'].'</td>
												<td>'.$info['besoin'].'</td>';
												
												echo '<td>'.$diff.'</td>';
												/*if($diff==0) {
										echo '<td> </td>';
											} else {
												if($diff > 0) {
									echo '<td>'.$diff.' </td>';
												} else {
									echo '<td>'.($diff*(-1)).'</td>';			
												}
											}*/
                                            
                                            echo '
										
										<td>'.$info['raison'].'</td>
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