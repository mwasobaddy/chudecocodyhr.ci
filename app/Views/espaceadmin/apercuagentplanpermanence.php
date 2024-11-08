<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT *, (SELECT libelle from equipe where equipe.IDequipe=agentplanpermanence.IDequipe) as libequipe, (SELECT libelle from planpermanence where planpermanence.IDplanpermanence=agentplanpermanence.IDplanpermanence) as libplan from agentplanpermanence where IDequipe in(SELECT IDequipe from equipe where IDservice = (select IDservice from agent where idagent = '.$myid.')) ORDER BY agentplanpermanence.IDequipe');
$agentplanpermanence = $query->getResultArray();
?>


<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading 
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des permanences</h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
            
              <th>Equipe</th>
              <th>Planning permanence</th>
              <th>Jour</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No.</th>
             
              <th>Equipe</th>
              <th>Planning permanence</th>
              <th>Jour</th>
              <th>Actions</th>
           
            </tr>
          </tfoot>
          <tbody>
            <?php 
			$db = \Config\Database::connect();
			$i = 1;
			//print_r($congeannuel);
			if (!empty($agentplanpermanence) && is_array($agentplanpermanence)) {
			$lastcat ="";
			$lastid = 0;
			$cpt = 0;
			$nbr = 0;
			$total = count($agentplanpermanence);
			$libdel = 0;
			
            foreach ($agentplanpermanence as $info) {
				$nbr++;
				$libdel = $info['idagentplanpermanence'];
				$query = $db->query('SELECT * from jourplan where IDjourplan='.$info['IDjourplan']);
				$row   = $query->getRow();
											
				if($row->jour < 10) {
					$jjj = '0'.$row->jour;
				} else {
					$jjj = $row->jour;
				}
				//echo $lastid.' => '.$info['IDequipe'].'<br/><br/>';
           		if($lastid == $info['IDequipe']) {
					
					echo $jjj.'/'.$row->mois.'/'.$row->annee.'
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					
					
					
				} else {
					if($cpt==0) {
						echo '<tr><td>'.($i++).' </td>
						<td>'.$info['libequipe'].'</td>
						<td>'.$info['libplan'].'</td>
						<td>'.$jjj.'/'.$row->mois.'/'.$row->annee.'
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						$cpt++; 
						
						
					} else {
						
						echo '
							</td>
								<td style="text-align:center;">
									'.anchor('espaceadmin/delagentplanpermanence/'.$libdel,'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
								</td>
							</tr>
						';
						
						echo '
						<tr>
							<td>'.($i++).' </td>
							<td>'.$info['libequipe'].'</td>
							<td>'.$info['libplan'].'</td>
							<td>'.$jjj.'/'.$row->mois.'/'.$row->annee.'
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						';
							//$cpt=0; 
						
						
					}
					
					
				}

if($nbr == $total) {
	echo '
		</td>
			<td style="text-align:center;">
				'.anchor('espaceadmin/delagentplanpermanence/'.$libdel,'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Supprimer"></i></span>').'
			</td>
		</tr>
	';
}
$lastid = $info['IDequipe'];




							}			
			}
			
			?>
          </tbody>
          
        </table>
        <script type="text/javascript">
	$(document).ready(function() {
    $('dataTable').DataTable();
} );
	</script> 
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->