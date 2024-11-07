<!-- Begin Page Content -->
<?php
//print_r($_POST);
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
if(isset($lidagentplanpermanence)) {
		$query = $db->query("SELECT * from agentplanpermanence where idagentplanpermanence=$lidagentplanpermanence"); 
		$agentplanpermanence = $query->getRow();
		//print_r($direction);
	}

?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Planification > Planning agent</h1>
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
	echo form_open('espacerespo/attribuerplanpermanence');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
              <input type="hidden" class="form-control" id="idagentplanpermanence" name="idagentplanpermanence"   <?php   if(isset($lidagentplanpermanence)) {echo 'value="'.$agentplanpermanence->idagentplanpermanence.'"';} ?> >
            
             <label for="IDequipe">Equipe</label>
                <select id="IDequipe" name="IDequipe" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
				   
				   $myid = $_SESSION['cnxid'];
				  $query   = $db->query('SELECT * from equipe where IDservice = (select IDservice from agent where idagent = '.$myid.')');
					$results = $query->getResult();

					foreach ($results as $row)
					{

				
			
			if(isset($lidagentplanpermanence)) {
	if($agentplanpermanence->IDequipe == $row->IDequipe ) {	
echo ' <option value="'.$row->IDequipe .'" selected>'.$row->libelle.'</option>';				
	} else { 
echo ' <option value="'.$row->IDequipe .'">'.$row->libelle.' </option>';	
		 }

} else {
			echo ' <option value="'.$row->IDequipe .'">'.$row->libelle.' </option>';			
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
	$query   = $db->query('SELECT *, (select libelle from service where service.IDservice=planpermanence.IDservice) as serv, (select libelle from lemois where lemois.IDmois=planpermanence.IDmois) as moi FROM planpermanence WHERE IDplanpermanence='.$_SESSION['leplan'].' and IDservice=(select IDservice from agent where idagent='.$myid.')');
	$results = $query->getResult();
					foreach ($results as $row)
					{
	$indic = $row->IDmois;
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
           
            <div class="form-group col-md-12">
             
           <?php
		   
		   $query   = $db->query("SELECT * FROM lemois WHERE lemois.IDmois=$indic");
			$r= $query->getRow();
			$dd = $r->numero;
			if($dd<=9) $dd = '0'.$dd;
			$ddd = substr($r->libelle,-4).'-'.$dd;
			//echo 'ddd = '.$ddd;
		   
		   $myid = $_SESSION['cnxid'];
				   //$ddd = date('Y-m');
	$query   = $db->query("SELECT * FROM jourplan WHERE datejourplan like '%$ddd%'");
	
	$results = $query->getResult();
	$cpt = 0;
					foreach ($results as $row)
					{
						$cpt++;
						
						if($row->jour < 10)
						$jjj = '0'.$row->jour;
						else
						$jjj = $row->jour;

						echo '<input name="jour[]" type="checkbox"  value="'.$row->IDjourplan.'"> '.$jjj.' / '.$row->mois.' / '.$row->annee.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					
	if(($cpt%6) == 0) {echo '<br/>'; }
		//	echo ' <option value="'.$row->IDjourplan.'">'.$jjj.' / '.$row->mois.' / '.$row->annee.' ('.$row->libelle.')</option>';					
					}
					

		   ?>
          
            </div>
            
            
          </div>
          
         <div class="form-row">
           
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary" style="width:100%">Valider formulaire</button>
            </div>
            
            
          </div>
          

          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->