<!-- Begin Page Content -->
<?php
	$db = \Config\Database::connect();
	$query = $db->query("SELECT *, (select libelle from service where service.IDservice=besoinservice.IDservice) as service, 
(select libelle from lafonction where lafonction.IDlafonction=besoinservice.IDposte) as fonction, (select libelle from emploi where emploi.IDemploi=besoinservice.IDposte) as emploi from besoinservice where etat not IN('ACCEPTEE','REFUSEE')");	
	$besoinservice = $query->getResultArray();
		

?>
<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Codification de postes > Liste des besoins</h1>
  <p class="mb-4">Traiter toutes les données relatives à la liste des besoins.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des besoins</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
               <th>Service</th> 
              <th>Emploi</th>
             
              <th>Besoin</th>  
               <th>Justificatif</th> 
                       
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>No.</th>
              <th>Service</th> 
              <th>Emploi</th>
             
              <th>Besoin</th>  
               <th>Justificatif</th>     
               
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
											<td>'.$info['service'].'</td>
											<td>'.$info['emploi'].'</td>
											
											<td>'.$info['total'].'</td>
											<td>'.$info['justificatif'].'</td>
											
											';
											
											
                                            
                                            echo '<td style="text-align:center;">
										'.anchor('espaceadmin/validerbesoinservice/'.$info['IDbesoinservice'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Valider la demande"></i></span>').'
									'.anchor('espaceadmin/invaliderbesoinservice/'.$info['IDbesoinservice'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Invalider la demande"></i></span>').'
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