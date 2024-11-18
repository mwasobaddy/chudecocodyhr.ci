<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];

$query   = $db->query('SELECT * from congematernite where IDagent in(SELECT idagent FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.') and (validationcs is null or validationsus is null or validationcs=0 or validationsus=0)');

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
              <th data-orderable="false"><input id="selectAll" type="checkbox"></th>
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
              <th>Documents</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th data-orderable="false"><input id="selectAll" type="checkbox"></th>
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
              <th>Documents</th>
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
		
		
										echo '<tr>';
                      echo '<td><input class="chk" type="checkbox" name="chk[]" value="'.$info['IDconge'].'" /></td>';
                                            echo '<td>'.($i++).' </td>';
                                            
											

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
										'.anchor('espacerespo/validercm/'.$info['IDconge'],'<span class="btn btn-success mb-2"><i class="m-0 fas a-check-double" title="Valider"></i></span>').'
									';

                  echo '</td><td style="text-align:center;">';
                  $lieu = './agents/'.$row->matricule.'/4-CONGES/';
                  if (!empty($info['justificatif1'])) {
                    echo '<a target="new" href="'.base_url($lieu.$info['justificatif1']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 1"></i></span></a>'; 
                  }
                  if (!empty($info['justificatif2'])) {
                    echo '<a target="new" href="'.base_url($lieu.$info['justificatif2']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 2"></i></span></a>'; 
                  }
                  if (!empty($info['justificatif3'])) {
                    echo '<a target="new" href="'.base_url($lieu.$info['justificatif3']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif 3"></i></span></a>'; 
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
        <button type="button" class="btn btn-primary" id="approve_all">Valider toutes les demandes</button>
        <script type="text/javascript">
        	$(document).ready(function() {
            $('dataTable').DataTable();
            $("#selectAll").click(function() {
              $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            });

            $("input[type=checkbox]").click(function() {
              if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
              }
            });
            $("#approve_all").click(function() {
              var url = '<?= base_url("/espacerespo/validercmall/");?>';
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