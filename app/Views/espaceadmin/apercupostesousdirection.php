<!-- Begin Page Content -->
<?php
	$db = \Config\Database::connect();
	$query = $db->query('SELECT *, (select libelle from sousdirection where sousdirection.IDsousdirection=poste_sousdirection.IDsousdirection) as sousdirection, 
(select libelle from emploi where emploi.IDemploi=poste_sousdirection.IDposte) as fonction, (select count(*) from agent where agent.IDsousdirection=poste_sousdirection.IDsousdirection and agent.IDlafonction=poste_sousdirection.IDposte) as nbr from poste_sousdirection');
		
		$postesousdirection = $query->getResultArray();

/*echo 'SELECT *, (select libelle from sousdirection where sousdirection.IDsousdirection=poste_sousdirection.IDsousdirection) as sousdirection, 
(select libelle from lafonction where lafonction.IDlafonction=poste_sousdirection.IDposte) as fonction, (select count(*) from agent where agent.IDsousdirection=poste_sousdirection.IDsousdirection and agent.IDlafonction=poste_sousdirection.IDposte) as nbr from poste_sousdirection';*/
?>
<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Poste<->Sous-Direction</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
               <th>Sous-Direction</th>
              <th>Emploi</th>
             
              <th>Total</th>  
               <th>Details</th>          
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>No.</th>
               <th>Sous-Direction</th>
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
			if (! empty($postesousdirection) && is_array($postesousdirection)) : 
			?>
            <?php foreach ($postesousdirection as $info): ?>
            <?php 
		
		
										echo '<tr>
                                            <td>'.($i++).' </td>';
                                            
											echo '
											<td>'.$info['sousdirection'].'</td>
											<td>'.$info['fonction'].'</td>
											
											<td>'.$info['total'].'</td>';
											$diff = $info['total']-$info['nbr'];
											echo '<td>'.$diff.' poste(s) </td>';
											
											/*	if($diff==0) {
										echo '<td> </td>';
											} else {
												if($diff > 0) {
									echo '<td>'.$diff.' poste(s) disponible(s) </td>';
												} else {
									echo '<td>'.($diff*(-1)).' poste(s) en surplus </td>';			
												}
											}
                                            
                                            */
                                            echo '<td style="text-align:center;">
										'.anchor('espaceadmin/editpostesousdirection/'.$info['IDpostesousdirection'],'<i class="fas fa-user-edit" title="Modifier"></i>').'&nbsp;&nbsp;&nbsp;
									'.anchor('espaceadmin/delpostesousdirection/'.$info['IDpostesousdirection'],'<i class="fas fa-trash" title="Supprimer"></i>').'
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