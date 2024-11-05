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
  <h1 class="h3 mb-2 text-gray-800">Planification -> Planning agent</h1>
  <p class="mb-4">Manipulez toutes les données relatives au Planning agent.
   
  </p>
  
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
	echo form_open('espaceadmin/editagentplanpermanence/'.$lidagentplanpermanence);
} else {
	echo form_open('espaceadmin/selectplan');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="IDplanpermanence">Plan permanence</label>
                <select id="IDplanpermanence" name="IDplanpermanence" class="form-control">
                
                  <?php 
				   
				   $myid = $_SESSION['cnxid'];
	$query   = $db->query('SELECT *, (select libelle from service where service.IDservice=planpermanence.IDservice) as serv, (select libelle from lemois where lemois.IDmois=planpermanence.IDmois) as moi FROM planpermanence WHERE IDservice=(select IDservice from agent where idagent='.$myid.')');
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