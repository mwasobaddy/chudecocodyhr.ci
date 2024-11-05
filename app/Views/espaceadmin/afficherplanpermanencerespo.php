<!-- Begin Page Content -->

<div class="container-fluid"> 
  <!-- Page Heading -->
  
     <?php
				 $db = \Config\Database::connect();
				 $myid = $_SESSION['cnxid'];
				 
				 $query   = $db->query('SELECT IDservice FROM agent where agent.idagent='.$myid);
			$leserv= $query->getRow();
			$leservice = $leserv->IDservice;
			
	$query   = $db->query('SELECT * FROM planpermanence where IDservice='.$leservice.' order by creele');
	

			$results = $query->getResult();
			$idplan = 0;
			$libplan = '';
			foreach ($results as $row)
			{
				$idplan =  $row->IDplanpermanence;
				$libplan =  $row->libelle;
			}
				 
				 if($libplan=='') {
					 $libplan = 'Aucun planning trouvé pour ce mois';
				 } 
				 
			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from grade where grade.IDgrade=agent.IDgrade) as lgrade FROM agent where agent.idagent='.$myid.'');
			$agents= $query->getResult();
				 
				 setlocale (LC_TIME, 'fr_FR.utf8','fra');
			// echo '<span style="color:blue; font-size:large; font-weight:bold">PLANNING '.date('F').' '.date('Y').'<br/></span>';*/
			 $dd = date('Y-m');
											//$db = \Config\Database::connect();
											$query   = $db->query("SELECT * FROM jourplan where datejourplan like '%$dd%' order by IDjourplan");
$results = $query->getResult();

											echo $libplan;
											?>
             <table width="100%" cellspacing="0" border="1" bordercolor="#CCCCCC">
          <thead>
            <tr>
              <th rowspan="2">Nom et prénoms</th>
              <th rowspan="2">Grade</th>
              
              <?php
			  foreach ($results as $row)
{
	$jj = ($row->jour<=9)?('0'.$row->jour):($row->jour);
	
    echo '<th>'.$jj.'</th>';
}
			  ?>
            
            </tr>
             <tr>
              <?php
			  foreach ($results as $row)
{
    echo '<th>'.$row->initiale.'</th>';
}
			  ?>
            </tr>
          </thead>
          <?php
		 // print_r($agents);
		    foreach ($agents as $perso)
{
   
	echo ' <tr>
              <td>'.$perso->nom.'</td>
              <td>'.$perso->lgrade.'</td>';
	
	  foreach ($results as $row)
{
	
	$query   = $db->query('SELECT count(*) as nbr FROM agentplanpermanence where IDequipe IN (select IDequipe from agent_equipe where Idagent='.$myid.') and IDjourplan='.$row->IDjourplan.' and IDplanpermanence='.$idplan.'');
					$pp = $query->getRow();
					$ppp = ($pp->nbr == 0)?(''):('P');
					
    echo '<td>'.$ppp.'</td>';
}
echo '</tr>';
}
		  
			
			  ?>
 
          
          </table>
            
            
  
  
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->