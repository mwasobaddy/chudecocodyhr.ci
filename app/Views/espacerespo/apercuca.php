<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];


$query   = $db->query('SELECT * from congeannuel where etat!= \'REJET\' and IDagent in(SELECT idagent FROM agent where idagent='.$myid.' or idagent="1959" or idagent="1954" or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.') and (validationcs is null or validationsdrh is null or validationdg is null or validationsd is null or validationcs=0 or validationsdrh=0 or validationdg=0 or validationsd=0)');
$isSpecialUser = ($myid == '1959' || $myid == '1954');


$congeannuel = $query->getResultArray();
?>




<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Congés annuels</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            	<th data-orderable="false"><input id="selectAll" type="checkbox"></th>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Service</th>
              <th>Planning congés</th>
              <th>Date départ</th>
              <th>Date reprise</th>
    
              <th>Etat</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            	<th data-orderable="false"><input id="selectAll" type="checkbox"></th>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Service</th>
              <th>Planning congés</th>
              <th>Date départ</th>
              <th>Date reprise</th>
              
              <th>Etat</th>
              <th>Actions</th>
           
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
				
						// echo "<pre>".print_r($congeannuel,true)."</pre>";
// exit;
			if (! empty($congeannuel) && is_array($congeannuel)) : 
		
			?>
            <?php foreach ($congeannuel as $info): ?>
            <?php 
			// echo $info['Idagent'];
	
		
		
										echo '<tr>';
																		echo '<td><input class="chk" type="checkbox" name="chk[]" value="'.$info['IDconge'].'" /></td>';
                                            echo '<td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT idagent, matricule, nom, IDservice, Responsablen1, Responsablen2  from agent where idagent='.$info['Idagent']);
											$roww   = $query->getRow();

								echo '<td>'.$roww->matricule.'</td>';
								echo '<td>'.$roww->nom.'</td>';
								$leservice = $roww->IDservice;
								
								$query = $db->query('SELECT libelle from service where IDservice='.$leservice);
											$row   = $query->getRow();
								echo '<td>'.$row->libelle.'</td>';
								
								
									$query = $db->query('SELECT IDplancongeannuel, libelle from plancongeannuel where IDplancongeannuel='.$info['IDplancongeannuel']);
											$row   = $query->getRow();
								echo '<td>'.$row->libelle.'</td>';
												
				
											echo '
											<td>'.$info['datedepart'].'</td>
											<td>'.$info['datereprise'].'</td>
											
											<td>'.$info['etat'].'</td>
                                            
                                            <td style="text-align:center;">';
											
										$myid = $_SESSION['cnxid'];
										
										if($myid==$roww->idagent && ($info['validationcs']==1 || $info['validationsd']==1) ) {
											echo 'Modification impossible!';
										} else {
											if($myid==$roww->Responsablen1 && $info['validationcs']==1 && $info['validationsdrh']!=1) {
                                                echo 'Modification impossible!';
                                            } else {
                                                if($myid==$roww->Responsablen2 && $info['validationsd']==1  && $info['validationsdrh']!=1) {
                                                echo 'Modification impossible!';
                                                } else {
													if($info['validationcs']==1 && $info['validationsdrh']==1) {
													echo 'Modification impossible!';
													}
													else {
														
														if ($isSpecialUser) {
															echo anchor('espacerespo/validerca/'.$info['IDconge'],'<span class="btn btn-success mb-2"><i class="m-0 fas fa-check-double" title="Valider"></i></span>').'
															 '.anchor('espacerespo/rejetca/'.$info['IDconge'],'<span class="btn btn-warning mb-2"><i class="m-0 fas fa-times" title="Rejeter"></i></span>');
														}
														else{
														  echo'Vous ne pouvez pas valider';
														}
													}
                                                }
                                            }
										}
										
				
										/*'.anchor('espacerespo/validerca/'.$info['IDconge'],'<span class="btn btn-success mb-2"><i class="m-0 fas fa-check-double" title="Valider"></i></span>').'*/
										
									echo '</td>
                                        </tr>
											';
		
										?>
            <?php endforeach; ?>
            <?php else : ?>
         
          <?php endif ?>
          </tbody>
          
        </table>
        <button type="button" class="btn btn-primary" id="approve_all">Valider toutes les demandes</button> &nbsp;&nbsp; <button type="button" class="btn btn-danger" id="reject_all">Rejeter toutes les demandes</button>
        <script type="text/javascript">
					$(document).ready(function() {
						$('#dataTable').DataTable( {
							stateSave: true,
							"order": [[ 1, "asc" ]],
							dom: 'Bfrtip',
							buttons: [
								'copy', 'csv', 'excel', 'pdf', 'print'
							]
						} );
						$("#selectAll").click(function() {
						  $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
						});

						$("input[type=checkbox]").click(function() {
						  if (!$(this).prop("checked")) {
						    $("#selectAll").prop("checked", false);
						  }
						});
						$("#approve_all").click(function() {
							var url = '<?= base_url("/espacerespo/validercaall/");?>';
							var chkval = [];
							$('.chk:checked').each(function() {
								chkval.push($(this).val());
							});
							if(chkval.length>0){
								window.location.href = url+"/"+chkval;
							}
						});
						$("#reject_all").click(function() {
							var url = '<?= base_url("/espacerespo/rejetcaall/");?>';
							var chkval = [];
							$('.chk:checked').each(function() {
								chkval.push($(this).val());
							});
							if(chkval.length>0){
								window.location.href = url+"/"+chkval;
							}
						});
					} );
				</script> 
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->