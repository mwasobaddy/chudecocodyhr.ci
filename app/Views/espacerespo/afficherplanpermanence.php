<!-- Begin Page Content -->

<div class="container-fluid"> 
  <!-- Page Heading -->
  
     <?php
				 $db = \Config\Database::connect();
				 $myid = $_SESSION['cnxid'];
				 
				 $query   = $db->query('SELECT IDservice FROM agent where agent.idagent='.$myid);
			$leserv= $query->getRow();
			$leservice = $leserv->IDservice;
			
			$ladate = date("F Y");
			$ladate = preg_replace('/January/', 'JANVIER', $ladate);
					$ladate = preg_replace('/February/', 'FEVRIER', $ladate);
					$ladate = preg_replace('/March/', 'MARS', $ladate);
					$ladate = preg_replace('/April/', 'AVRIL', $ladate);
					$ladate = preg_replace('/May/', 'MAI', $ladate);
					$ladate = preg_replace('/June/', 'JUIN', $ladate);
					$ladate = preg_replace('/July/', 'JUILLET', $ladate);
					$ladate = preg_replace('/August/', 'AOUT', $ladate);
					$ladate = preg_replace('/September/', 'SEPTEMBRE', $ladate);
					$ladate = preg_replace('/October/', 'OCTOBRE', $ladate);
					$ladate = preg_replace('/November/', 'NOVEMBRE', $ladate);
					$ladate = preg_replace('/December/', 'DECEMBRE', $ladate);
			
			$ll = '%'.$ladate.'%';
			
			$moi = date('n');
				 $an = date('Y');
			
	$query   = $db->query('SELECT * FROM planpermanence where IDservice='.$leservice.' and IDmois =(select IDmois from lemois where numero='.$moi.' and libelle like(\'%'.$an.'%\') ) and publier=1 order by creele');
	
	//echo 'SELECT * FROM planpermanence where IDservice='.$leservice.' and libelle like(\''.$ll.'\') order by creele';
	

			$results = $query->getResult();
			$idplan = 0;
			$libplan = '';
			$nbrlit = 0;
			$nbrjourmois = 0;
			//print_r($results);
			$nn = 0;
			
			foreach ($results as $row)
			{
			
				$idplan =  $row->IDplanpermanence;
				$libplan =  $row->libelle;
				$nbrlit =  $row->lit;
				$signataires = '<table style="width:100%; text-align:center"><tr>';
				if ($row->validationcs==1) {$signataires .= '<td>Chef de service</td>';} 
				if ($row->validationsus==1) {$signataires .= '<td>S.U.S</td>';} 
				if ($row->validationsd==1) {$signataires .= '<td>Sous-Directeur</td>';}
				if ($row->validationdsio==1) {$signataires .= '<td>S/DSIO</td>';} 
				if ($row->validationcctos==1) {$signataires .= '<td>Coordinateur CCTOS</td>';} 
				if ($row->validationdms==1) {$signataires .= '<td>DMS</td>';} 		
				if ($row->validationdaf==1) {$signataires .= '<td>DAF</td>';} 	
				if ($row->validationdg==1) {$signataires .= '<td>Directeur Général</td>';} 
				$signataires .='</tr></table>';

			}
			
			
				 
				 if($libplan=='') {
					 $libplan = 'Aucun planning actif trouvé pour ce mois';
					 echo $libplan;
					// exit;
				 } else {
				 
			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from grade where grade.IDgrade=agent.IDgrade) as lgrade FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'');
			$agents= $query->getResult();
				 
				 setlocale (LC_TIME, 'fr_FR.utf8','fra');
			// echo '<span style="color:blue; font-size:large; font-weight:bold">PLANNING '.date('F').' '.date('Y').'<br/></span>';*/
			 $dd = date('Y-m');
											//$db = \Config\Database::connect();
											$query   = $db->query("SELECT * FROM jourplan where datejourplan like '%$dd%' order by IDjourplan");
$results = $query->getResult();

$nbrjourmois = count($results) + 2 ;
$tt = round($nbrjourmois/4);
$tt1 = $tt-4;
$tt2 = $tt-4;
$tt3 = $tt+4;
$tt4 = $nbrjourmois - $tt1 -$tt2 - $tt3;

											//echo $libplan;
											?>
                                           <div class="table-responsive" id="dataT">
             <table width="100%" cellspacing="0" border="1" bordercolor="#CCCCCC">
             
          <thead>
           <tr style="vertical-align:top" >
 <td colspan="<?php echo $nbrjourmois; ?>"><?php echo $libplan; ?></td>
 </tr>
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
	
	$query   = $db->query('SELECT count(*) as nbr FROM agentplanpermanence where IDequipe IN (select IDequipe from agent_equipe where Idagent='.$perso->idagent.') and IDjourplan='.$row->IDjourplan.' and IDplanpermanence='.$idplan.'');
					$pp = $query->getRow();
					$ppp = ($pp->nbr == 0)?(''):('P');
					
    echo '<td>'.$ppp.'</td>';
}
echo '</tr>';
}
		  
			
			  ?>
 
 <tr style="vertical-align:top" >
 <td colspan="<?php echo $nbrjourmois; ?>">&nbsp;</td>
 </tr>
          <tr style="vertical-align:top; border-bottom:none" >
          <?php
		  
		  $query   = $db->query('SELECT count(IDemploi) as nbr, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as lemploi FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.' GROUP BY IDemploi');
			$agenteffe= $query->getResult();
			
			 $query   = $db->query('SELECT nom, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as lemploi FROM agent where idagent in(select Idagent from arrettravail where arrettravail.etat != \'TERMINE\') and (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and (agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.') ORDER BY nom ASC');
			$agentmalade= $query->getResult();
			
			 $query   = $db->query('SELECT nom, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as lemploi FROM agent where idagent in(select Idagent from congeannuel where congeannuel.validationsdrh=1) and (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) and actif=1 and (agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.') ORDER BY nom ASC');
			$agentconge= $query->getResult();
	
		  ?>
          <!-------------- LES EFFECTIFS -------->
          <td colspan="<?php echo $tt1; ?>" style="width:100%; border:none">
          
          <table border="1" class="effectifs" style="width:100%;" bordercolor="#CCCCCC">
          <tr>
          <td colspan="2" style="text-align:center">EFFECTIFS</td>
          </tr>
          
         
          <?php  
		  foreach ($agenteffe as $row)
			{
				echo '  <tr><td>'.$row->lemploi.'</td><td>'.$row->nbr.'</td></tr>';
			}
		   ?>
          
          </table>
          
          </td>
          
           <!-------------- NOMBRE DE LIT-------->
          <td colspan="<?php echo $tt2; ?>" style="text-align:center; width:100%; border:none">
          
          <table border="1" class="effectifs" style="width:100%; height:100%;" bordercolor="#CCCCCC">
          <tr>
          <td colspan="2" style="text-align:center">NOMBRE DE LIT</td>
          </tr>
           <tr>
         <td><?php echo $nbrlit; ?></td>
          </tr>
          </table>
          
          </td>
          
           <!-------------- LES CONGES ANNUELS -------->
          <td colspan="<?php echo $tt3; ?>" style="width:100%; border:none">
          
          <table border="1" class="effectifs" style="width:100%" bordercolor="#CCCCCC">
         
           <tr>
          <td colspan="2"  style="text-align:center">CONGE ANNUEL(<?php echo count($agentconge); ?>)</td>
          </tr>
          <tr>
          <td colspan="2" style="text-align:center">NOM ET PRENOMS</td></td>
          </tr>
          
           <?php  
		  foreach ($agentconge as $row)
			{
				echo '  <tr><td colspan="2">'.$row->nom.'</td></tr>';
			}
		   ?>
          </table>
          
          </td>
          
           <!-------------- LES CONGES MALADIE -------->
          <td colspan="<?php echo $tt4; ?>" style="width:100%; border:none">
          
          <table border="1" class="effectifs" style="width:100%" bordercolor="#CCCCCC">
          <tr>
          <td colspan="2"  style="text-align:center">ARRET DE TRAVAIL (<?php echo count($agentmalade); ?>)</td>
          </tr>
           <tr>
          <td colspan="2" style="text-align:center">NOM ET PRENOMS</td></td>
          </tr>
          
           <?php  
		  foreach ($agentmalade as $row)
			{
				echo '  <tr><td colspan="2">'.$row->nom.'</td></tr>';
			}
		   ?>
          </table>
          
          </td>
       
          
          </tr>
          
           <tr>
            <td colspan="33" style=" text-align:center"><br />
            <?php
			
			echo $signataires;
			
			?>
            <br /><br /><br /><br /><br /><br /><br /><br />
            </td>
           </tr>
          
          </table>
           <script type="text/javascript">
	


	</script> 
             </div> <br/><br/>
          <button onClick="imprimer('dataT')">Imprimer</button>
               <?php
			
				 }
				 
				 ?>
  
  
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->