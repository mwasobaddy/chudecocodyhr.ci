<!-- Begin Page Content -->
<?php
//print_r($_POST);
$db = \Config\Database::connect();

if(isset($lidagentplanpermanence)) {
		$query = $db->query("SELECT * from agentplanpermanence where idagentplanpermanence=$lidagentplanpermanence"); 
		$agentplanpermanence = $query->getRow();
		//print_r($direction);
	}

?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Planification -> Planning agent</h1>
  <p class="mb-4">Manipulez toutes les données relatives au Planning agent.
   
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche planning agent</h6>
        </div>
        <div class="card-body">
          <?php
helper('form');
if(isset($lidagentplanpermanence)) {
	echo form_open('espacerespo/editagentplanpermanence/'.$lidagentplanpermanence);
} else {
	echo form_open('espacerespo/editagentplanpermanence');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" class="form-control" id="idagentplanpermanence" name="idagentplanpermanence"   <?php   if(isset($lidagentplanpermanence)) {echo 'value="'.$agentplanpermanence->idagentplanpermanence.'"';} ?> >
            
             <label for="IDagent">Agent</label>
                <select id="Idagent" name="Idagent" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
				   
				   $myid = $_SESSION['cnxid'];
				  $query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'');
					$results = $query->getResult();

					foreach ($results as $row)
					{

				
			
			if(isset($lidagentplanpermanence)) {
	if($agentplanpermanence->Idagent == $row->idagent) {	
echo ' <option value="'.$row->idagent.'" selected>'.$row->matricule.' - '.$row->nom.'</option>';				
	} else { 
echo ' <option value="'.$row->idagent.'">'.$row->matricule.' - '.$row->nom.'</option>';	
		 }

} else {
			echo ' <option value="'.$row->idagent.'">'.$row->matricule.' - '.$row->nom.'</option>';				
}
				
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-6">
              <label for="IDplanpermanence">Plan permanence</label>
                <select id="IDplanpermanence" name="IDplanpermanence" class="form-control">
                
                  <?php 
				   
				   $myid = $_SESSION['cnxid'];
	$query   = $db->query('SELECT *, (select libelle from service where service.IDservice=planpermanence.IDservice) as serv, (select libelle from lemois where lemois.IDmois=planpermanence.IDmois) as moi FROM planpermanence WHERE IDservice=(select IDservice from agent where idagent='.$myid.')');
	$results = $query->getResult();
					foreach ($results as $row)
					{

					
			
			
			if(isset($lidagentplanpermanence)) {
	if($agentplanpermanence->IDplanpermanence == $row->IDplanpermanence) {
echo ' <option value="'.$row->IDplanpermanence.'"  selected>'.$row->libelle.'</option>';			
	} else { 
echo ' <option value="'.$row->IDplanpermanence.'">'.$row->libelle.'</option>';	
		 }

} else {
			echo ' <option value="'.$row->IDplanpermanence.'">'.$row->libelle.'</option>';					
}
			
				
					}
					
					?>
            		
                </select>
              
            </div>
            
             
          </div>
          
          
          
         
          
        
          
            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="IDjourplan">Jour plan</label>
                <select id="IDjourplan" name="IDjourplan" class="form-control">
                  
                  <?php 

				   
				   $myid = $_SESSION['cnxid'];
				   $ddd = date('Y-m');
	$query   = $db->query("SELECT * FROM jourplan WHERE datejourplan like '%$ddd%'");
	
	$results = $query->getResult();
					foreach ($results as $row)
					{
						if($row->jour < 10)
						$jjj = '0'.$row->jour;
						else
						$jjj = $row->jour;

						
					
					if(isset($lidagentplanpermanence)) {
	if($agentplanpermanence->IDjourplan == $row->IDjourplan) {		
echo ' <option value="'.$row->IDjourplan.'"  selected>'.$jjj.' / '.$row->mois.' / '.$row->annee.' ('.$row->libelle.')</option>';		
	} else { 
echo ' <option value="'.$row->IDjourplan.'">'.$jjj.' / '.$row->mois.' / '.$row->annee.' ('.$row->libelle.')</option>';	
		 }

} else {
			echo ' <option value="'.$row->IDjourplan.'">'.$jjj.' / '.$row->mois.' / '.$row->annee.' ('.$row->libelle.')</option>';					
}
					
					}
					
					?>
            		
                </select>
              <?php // echo "SELECT * FROM jourplan WHERE datejourplan like '%$ddd%'"; ?>
            </div>
  
             <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>          </div>
          </div>
          
          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->