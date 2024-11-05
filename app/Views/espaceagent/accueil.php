<?php
// Récuperation des variables passées, on donne soit année; mois; année+mois
if(!isset($_GET['mois'])) $num_mois = date("n"); else $num_mois = $_GET['mois'];
if(!isset($_GET['annee'])) $num_an = date("Y"); else $num_an = $_GET['annee'];

$num_mois = 4;
$num_an = '2021';
$num_jour = '20';


// pour pas s'embeter a les calculer a l'affchage des fleches de navigation...
if($num_mois < 1) { $num_mois = 12; $num_an = $num_an - 1; }
elseif($num_mois > 12) {	$num_mois = 1; $num_an = $num_an + 1; }

// nombre de jours dans le mois et numero du premier jour du mois
$int_nbj = date("t", mktime(0,0,0,$num_mois,1,$num_an));
$int_premj = date("w",mktime(0,0,0,$num_mois,1,$num_an));

// tableau des jours, tableau des mois...
$tab_jours = array("","Lu","Ma","Me","Je","Ve","Sa","Di");
$tab_mois = array("","Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

$int_nbjAV = date("t", mktime(0,0,0,($num_mois-1<1)?12:$num_mois-1,1,$num_an)); // nb de jours du moi d'avant
$int_nbjAP = date("t", mktime(0,0,0,($num_mois+1>12)?1:$num_mois+1,1,$num_an)); // b de jours du mois d'apres

// on affiche les jours du mois et aussi les jours du mois avant/apres, on les indique par une * a l'affichage on modifie l'apparence des chiffres *
$tab_cal = array(array(),array(),array(),array(),array(),array()); // tab_cal[Semaine][Jour de la semaine]
$int_premj = ($int_premj == 0)?7:$int_premj;
$t = 1; $p = "";
for($i=0;$i<6;$i++) {
	for($j=0;$j<7;$j++) {
		if($j+1 == $int_premj && $t == 1) { $tab_cal[$i][$j] = $t; $t++; } // on stocke le premier jour du mois
		elseif($t > 1 && $t <= $int_nbj) { $tab_cal[$i][$j] = $p.$t; $t++; } // on incremente a chaque fois...
		elseif($t > $int_nbj) { $p="*"; $tab_cal[$i][$j] = $p."1"; $t = 2; } // on a mis tout les numeros de ce mois, on commence a mettre ceux du suivant
		elseif($t == 1) { $tab_cal[$i][$j] = "*".($int_nbjAV-($int_premj-($j+1))+1); } // on a pas encore mis les num du mois, on met ceux de celui d'avant
	}
}
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
  </div>
  
  <!-- Content Row -->
  <div class="row"> 
    
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-8 col-md-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col-2 m-3 pl-1">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Année</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
									$db = \Config\Database::connect();
									$query = $db->query('SELECT count(*) as nbr FROM permissiondd where IDagent='.$_SESSION['cnxid']);
                  $row   = $query->getRow();
                  echo date("Y") ;	
								?>
              </div>
            </div>
            <div class="col-2 m-3 pl-1">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Acquis</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                30 jours
              </div>
            </div>
            <div class="col-2 m-3 pl-1">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Pris à ce jour</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                  $query = $db->query('SELECT * FROM congeannuel where validationagent = 1 and Idagent='.$_SESSION['cnxid']);
                  $results   = $query->getResult();
                  $TotalLeaves = 0;
                  foreach ($results as $row) {
                    $TotalLeaves = $TotalLeaves+$row->duree;
                  }

                  if($TotalLeaves>0){
                    echo $TotalLeaves;
                  }
                  else{
                    echo "0";
                  }
                ?>
              </div>
              <div class="col-auto"> </div>
            </div>
            <div class="col-2 m-3 pl-1">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Solde à ce jour</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                 $remainjours=30-$TotalLeaves;
                 echo $remainjours;
                ?>
              </div>
               <div class="col-auto"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Validations en attente</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
									//$db = \Config\Database::connect();
									$query   = $db->query('SELECT count(*) as nbr FROM congeannuel where validationagent = 0 and IDagent='.$_SESSION['cnxid']);
                 $row   = $query->getRow();
                  echo $row->nbr;
											
								?>
              </div>
            </div>
            <div class="col-auto"> <i class="fas fa-comments fa-2x text-gray-300"></i> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Content Row -->
  
  <div class="row"> 
    
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4"> 
        <!-- Card Header - Dropdown -->
        <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Mon planning du mois</h6>
          
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="">
                 <?php
				 
				 $myid = $_SESSION['cnxid'];
				 
					 $query   = $db->query('SELECT IDservice FROM agent where agent.idagent='.$myid);
			$leserv= $query->getRow();
			$leservice = $leserv->IDservice;
			
			 $moi = date('n');
				 $an = date('Y');
			
	$query   = $db->query('SELECT * FROM planpermanence where IDservice='.$leservice.' and IDmois =(select IDmois from lemois where numero='.$moi.' and libelle like(\'%'.$an.'%\') ) order by creele');
	

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
				 } else {
					 $libplan = $libplan;
				 }
				 
			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from grade where grade.IDgrade=agent.IDgrade) as lgrade FROM agent where agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'');
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
              <th rowspan="2">Emploi</th>
              
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
              <td>'.$perso->llemploi.'</td>';
	
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
        </div>
      </div>
    </div>
     
    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-7">
      <div class="card shadow mb-5"> 
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Dates de congés approuvés</h6>
          <div class="dropdown no-arrow"> 
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> 
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body"  style="display: flex;">
          <div>
            <?php
            //$db = \Config\Database::connect();
            $query   = $db->query('SELECT * FROM congeannuel where validationagent = 1 and Idagent='.$_SESSION['cnxid']);
            $rows   = $query->getResult();
            foreach ($rows as $row) {
               echo '<p style="font-size:18px; color:#03C">Départ : '.substr($row->datedepart, -2).' - '.substr($row->datedepart, 5,2).' - '.substr($row->datedepart, 0,4);
              echo '</p>';
              echo '<p style="font-size:18px; color:#03C">Reprise : '.substr($row->datereprise, -2).' - '.substr($row->datereprise, 5,2).' - '.substr($row->datereprise, 0,4);
              echo '</p><br>'; 
              if($row->datedepart=='') {
                echo '<br/><br/><p style="font-size:18px; color:red">Aucun congé trouvé</p><br/>';
              } 
            } 
          ?> 
          </div>
          
          <div>
            <div class="form-group col-md-6 float-right" style=" position: absolute; bottom: 3px;">
              <a href="<?php echo base_url('/espaceagent/creercongeannuel');?>" class="btn btn-primary" style="width:100%; height:100%">Demander une fraction de congés approuvés</a>          
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 

