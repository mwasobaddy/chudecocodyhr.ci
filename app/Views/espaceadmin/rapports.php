<!-- Begin Page Content -->

<div class="container-fluid"> 
  <div>
    <?php
            $db = \Config\Database::connect();
              $query   = $db->query("SELECT IDconge,Idagent,datevalidation,datedepart,datereprise,daterepriseeffective,duree,etat  FROM congeannuel WHERE datedepart BETWEEN '2021-11-10' AND '2021-11-25' UNION 
                SELECT IDconge,Idagent,datevalidation,datedepart,datereprise,daterepriseeffective,duree,etat FROM congematernite 
                WHERE datedepart BETWEEN '2021-11-10' AND '2021-11-25'"); 
              $reports = $query->getResult();
             // foreach ($reports as  $value) {
             //   print_r ( $value->IDconge );
             //   exit;
             // }
             // exit;
            ?>
  </div>
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
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
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Date_départ</th>
              <th>Date_reprise</th>
              <th>Durée</th>
              <th>Etat</th>
              
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Date_départ</th>
              <th>Date_reprise</th>
              <th>Durée</th>
              <th>Etat</th>
             
            </tr>
          </tfoot>
          <tbody>
            <?php
            foreach ($reports as $key=> $info) {
                            
                echo '<tr>
                <td>'. $key.'</td>';
                $query = $db->query('SELECT IDagent, matricule, nom from agent where IDagent='.$info->IDconge);
                $row   = $query->getRow();
                echo '<td>'.$row->matricule.'</td>';
                echo '<td>'.$row->nom.'</td>';
                echo '<td>'.$info->datedepart.'</td>
                      <td>'.$info->datereprise.'</td>
                      <td>'.$info->duree.'</td>
                      <td>'.$info->etat.'</td>
                    </tr>';
            }
              
          ?>
          </tbody>
          
        </table>
        <script type="text/javascript">
        	$(document).ready(function() {
        	$('#dataTable').DataTable( {
            stateSave: true,
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

