<?php

	$db = \Config\Database::connect();
	if(isset($lidequipe)) {
		$query = $db->query("SELECT * from equipe where IDequipe=$lidequipe"); 
		$equipe = $query->getRow();
	}
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Planification > Equipe</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Equipe.
  
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Equipe</h6>
        </div>
        <div class="card-body">

 <?php
helper('form');
if(isset($lidequipe)) {
	echo form_open('espacerespo/editequipe/'.$lidequipe);
} else {
	echo form_open('espacerespo/creerequipe');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
               <input type="hidden" class="form-control" id="IDequipe" name="IDequipe"   <?php   if(isset($lidequipe)) {echo 'value="'.$equipe->IDequipe.'"';} ?> >
            <label for="libelle">Nom de l'équipe</label>
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom de l'équipe" <?php   if(isset($lidequipe)) {echo 'value="'.$equipe->libelle.'"';} ?>>
            </div>
            <div class="form-group col-md-6">
             
             
              <label for="IDservice">Service</label>
                <select id="IDservice" name="IDservice" class="form-control">
                
                  <?php 
				  
				  /* if(isset($lidequipe)) {
					   $query = $db->query('SELECT * from service where service.IDservice='.$equipe->IDservice); 
				   } else {*/
					   $query = $db->query('SELECT * from service where service.IDservice=(select IDservice from agent where idagent='.$_SESSION['cnxid'].')'); 
				  // }
				  	
					$results = $query->getResult();

					foreach ($results as $row)
					{
			if(isset($lidequipe)) {
	if($equipe->IDservice == $row->IDservice) {
echo ' <option value="'.$row->IDservice.'" selected>'.$row->libelle.'</option>';				
	} else { 
echo ' <option value="'.$row->IDservice.'">'.$row->libelle.'</option>';	
		 }

} else {
			echo ' <option value="'.$row->IDservice.'">'.$row->libelle.'</option>';					
}
					}
					
					?>
            		
                </select>
             
             
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