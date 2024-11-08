<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT * from permissionhh where IDagent in(SELECT idagent FROM agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.') and (validationcs is null or validationsus is null or validationsdrh is null or validationcs=0 or validationsus=0 or validationsdrh=0)');
$permissionhh = $query->getResultArray();
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading  -->
  <h1 class="h3 mb-2 text-primary">Module employés > Liste des Permissions heure à heure</h1>
  <p class="mb-4">Traiter toutes les données de la liste de permissions heure par heure.</p>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Permissions heure à heure</h6></td>
          
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
              <th>Objet sortie</th>
              <th>Date sortie</th>
              <th>Lieu</th>
              <th>Heure depart</th>
              <th>Heure reprise</th>
              <th>Etat</th>
              <th>Actions</th>
              <th>Documents</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th data-orderable="false"><input id="selectAll" type="checkbox"></th>
               <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Objet sortie</th>
              <th>Date sortie</th>
              <th>Lieu</th>
              <th>Heure depart</th>
              <th>Heure reprise</th>
              <th>Etat</th>
              <th>Actions</th>
              <th>Documents</th>
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			if (! empty($permissionhh) && is_array($permissionhh)) : 
			?>
            <?php foreach ($permissionhh as $info): ?>
            <?php 
		
		
									echo '<tr>';
                                    echo '<td><input class="chk" type="checkbox" name="chk[]" value="'.$info['IDpermission'].'" /></td>';
                                            echo '<td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT idagent, matricule, nom, Responsablen1, Responsablen2 from agent where IDagent='.$info['Idagent']);
											$row   = $query->getRow();

								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
								
				//echo '<td></td><td></td>';
											
											echo '<td>'.$info['objetsortie'].'</td>
											<td>'.$info['datesortie'].'</td>
											<td>'.$info['lieu'].'</td>
											<td>'.$info['heuredepart'].'</td>
											<td>'.$info['heurearrivee'].'</td>
											<td>'.$info['etat'].'</td>
											
                                            <td style="text-align:center;">';
                                            $myid = $_SESSION['cnxid'];
                                            if($info['etat'] == 'REJET') {
                                                echo 'Rejetée<br><small>'.$info['motifrejet'].'</small>';
                                            }else {
                                                if ($myid == $row->idagent && ($info['validationcs'] == 1 || $info['validationsd'] == 1)) {
                                                    echo 'Modification impossibble!';
                                                } else {
                                                    if ($myid == $row->Responsablen1 && $info['validationcs'] == 1 && $info['validationsdrh'] != 1) {
                                                        echo 'Modification impossible!';
                                                    } else {
                                                        if ($myid == $row->Responsablen2 && $info['validationsd'] == 1 && $info['validationsdrh'] != 1) {
                                                            echo 'Modification impossible!';
                                                        } else {
                                                            if ($info['validationcs'] == 1 && $info['validationsdrh'] == 1) {
                                                                echo 'Modification impossible!';
                                                            } else echo anchor('espacerespo/validerphh/' . $info['IDpermission'], '<i class="fas fa-check-double" title="Valider"></i>') . '&nbsp;&nbsp;' . anchor('espacerespo/rejetphh/' . $info['IDpermission'], '<i class="fas fa-times" title="Rejeter"></i>');
                                                        }
                                                    }
                                                }
                                            }
                            //                                              echo anchor('espaceadmin/validerphh/'.$info['IDpermission'],'<i class="fas fa-check-double" title="Valider"></i>').'';
                                            echo '</td><td>';
                                            if($info['justificatif'])  {
                                                $lieu = './agents/'.$row->matricule.'/4-CONGES/';
                                                echo '&nbsp;&nbsp;<a target="new" href="'.base_url($lieu.$info['justificatif']).'"><i class="fas fa-file-download" title="Visualiser le justificatif"></i></a>';
                                            }

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
                $('#dataTable').DataTable({
                    stateSave: true
                });
                $("#selectAll").click(function() {
                  $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
                });

                $("input[type=checkbox]").click(function() {
                  if (!$(this).prop("checked")) {
                    $("#selectAll").prop("checked", false);
                  }
                });
                $("#approve_all").click(function() {
                  var url = '<?= base_url("/espacerespo/validerphhall/");?>';
                  var chkval = [];
                  $('.chk:checked').each(function() {
                    chkval.push($(this).val());
                  });
                  if(chkval.length>0){
                    window.location.href = url+"/"+chkval;
                  }
                });
                $("#reject_all").click(function() {
                  var url = '<?= base_url("/espacerespo/rejetphhall/");?>';
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