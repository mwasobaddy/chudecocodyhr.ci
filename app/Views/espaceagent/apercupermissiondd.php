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
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Motif</th>
              <th>Date demande</th>
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
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Motif</th>
              <th>Date demande</th>
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
		
              $query   = $db->query('SELECT * FROM permissiondd where Idagent='.$_SESSION['cnxid']);
              $results = $query->getResultArray();

              foreach ($results as $info)
              {
                echo '<tr>
                  <td>'.($i++).' </td>
                ';
                $query = $db->query('SELECT IDagent, matricule, nom from agent where IDagent='.$info['Idagent']);
								$row   = $query->getRow();

								echo '<td>'.$row->matricule.'</td>';
								echo '<td>'.$row->nom.'</td>';
											
                echo '
                  <td>'.$info['motif'].'</td>
                  <td>'.$info['datesortie'].'</td>
                  <td>'.$info['lieu'].'</td>
                  <td>'.$info['jourdepart'].'</td>
                  <td>'.$info['jourarrivee'].'</td>
                  <td>'.$info['etat'].'</td>
                  <td style="text-align:center;">
                ';
                
                if($info['validationcs']==1 && $info['validationsus']==1) {
                  echo '<a href="'.base_url('espaceagent/pdfpermissiondd/'.$info['IDpermission'].'').'"><img src="'.base_url('/img/okok.jpg').'" alt="TELECHARGER ACTE" style="width:30px; height:30px;"/></a>';
                } 
                else {
                  echo anchor('espaceagent/editpermissiondd/'.$info['IDpermission'],'<span class="btn btn-primary mb-2"><i class="m-0 fas fa-user-edit" title="Modifier"></i></span>').'
                      '.anchor('espaceagent/delpermissiondd/'.$info['IDpermission'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>')
                    ;
                  echo '</td><td>';
                  $lieu = './agents/'.$row->matricule.'/4-CONGES/';
                  echo '<a target="new" href="'.base_url($lieu.$info['justificatif']).'"><span class="btn btn-outline-dark mb-2"><i class="m-0 fas fa-file-download" title="Visualiser le justificatif"></i></span></a>';	
            
								}
                echo '
									  </td>
                  </tr>
                ';
              }
            ?>
           
          </tbody>
          
        </table>
        <script type="text/javascript">
        	$(document).ready(function() {
              $('dataTable').DataTable({
                  stateSave: true
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