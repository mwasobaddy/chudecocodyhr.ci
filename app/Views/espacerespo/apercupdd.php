<?php
$db = \Config\Database::connect();

$myid = $_SESSION['cnxid'];

$query   = $db->query('SELECT * from permissiondd where IDagent in(SELECT idagent FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.') and (validationcs is null or validationsus is null or validationsdrh is null or validationsd is null or validationdms is null or validationcs = 0 or validationsus = 0 or validationsdrh = 0 or validationsd = 0 or validationdms = 0)');

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
                <th data-orderable="false"><input id="selectAll" type="checkbox"></th>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Motif</th>
              <th>Date sortie</th>
              <th>Lieu</th>
              <th>Jour depart</th>
              <th>Jour reprise</th>
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
              <th>Motif</th>
              <th>Date sortie</th>
              <th>Lieu</th>
              <th>Jour depart</th>
              <th>Jour reprise</th>
              <th>Etat</th>
              <th>Actions</th>
              <th>Documents</th>
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
		
		
										
										echo '<tr>';
                                        echo '<td><input class="chk" type="checkbox" name="chk[]" value="'.$info['IDpermission'].'" /></td>';
                                            echo '<td>'.($i++).' </td>';
                                            
											

	$query = $db->query('SELECT idagent, matricule, nom, Responsablen1, Responsablen2 from agent where IDagent='.$info['Idagent']);
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
                                                            } else echo anchor('espacerespo/validerpdd/' . $info['IDpermission'], '<i class="fas fa-check-double" title="Valider"></i>') . '&nbsp;&nbsp;' . anchor('espacerespo/rejetpdd/' . $info['IDpermission'], '<i class="fas fa-times" title="Rejeter"></i>');
                                                        }
                                                    }
                                                }
                                            }

                            //										    echo anchor('espaceadmin/validerpdd/'.$info['IDpermission'],'<i class="fas fa-check-double" title="Valider"></i>').'';
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
                $('dataTable').DataTable({
                    stateSave: true,
                    aaSorting: [[2, 'asc']]
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
                  var url = '<?= base_url("/espacerespo/validerpddall/");?>';
                  var chkval = [];
                  $('.chk:checked').each(function() {
                    chkval.push($(this).val());
                  });
                  if(chkval.length>0){
                    window.location.href = url+"/"+chkval;
                  }
                });
                $("#reject_all").click(function() {
                  var url = '<?= base_url("/espacerespo/rejetpddall/");?>';
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