
<?php

	$db = \Config\Database::connect();
	if(isset($lidsd)) {
		$query = $db->query("SELECT * from sousdirection where IDsousdirection=$lidsd"); 
		$sousdirection = $query->getRow();
		//print_r($direction);
	}
?>



<!-- Begin Page Content -->
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Sous-Direction</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Sous-Direction.
  
  
  </p>
  <?php
if (isset($toast) && isset($_POST['go']) && !empty($_POST['go'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">  
	   '.$toast.' 
    </div>';
}

if (isset($_SESSION['toast']) && !empty($_SESSION['toast'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert" style="color: #0f6848; background-color: #d2f4e8; border-color: #bff0de;
">  
	   '.$_SESSION['toast'].' 
    </div>';
	unset($_SESSION['toast']);
} ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Sous-Direction</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
if(isset($lidsd)) {
	echo form_open('espaceadmin/editsousdirection/'.$lidsd);
} else {
	echo form_open('espaceadmin/creersousdirection');
}



?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" class="form-control" id="IDsousdirection" name="IDsousdirection"   <?php   if(isset($lidsd)) {echo 'value="'.$sousdirection->IDsousdirection.'"';} ?> >
            
            <label for="libelle">Nom de la sous-Direction</label>
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom de la Sous-Direction"  <?php   if(isset($lidsd)) {echo 'value="'.$sousdirection->libelle.'"';} ?>>
            </div>
            
          </div>
          
          
                    <div class="form-row">
            <div class="form-group col-md-6">
            <label for="IDdirection">Direction associée</label>
                <select id="IDdirection" name="IDdirection" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
				   
				  	$query = $db->query("SELECT * from direction"); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

					
			
			if(isset($lidsd)) {
	if($sousdirection->IDdirection == $row->IDdirection) {
		
		echo ' <option value="'.$row->IDdirection.'"   selected>'.$row->libelle.'</option>';
		
	} else { echo ' <option value="'.$row->IDdirection.'" >'.$row->libelle.'</option>';	 }

} else {
echo ' <option value="'.$row->IDdirection.'" >'.$row->libelle.'</option>';				
}
						
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-6">
             <label for="sousdirecteur">Sous-Directeur</label>
                <select id="sousdirecteur" name="sousdirecteur" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
				   $db = \Config\Database::connect();
				  	$query = $db->query("SELECT idagent, matricule, nom from agent where idagent IN(select idagent from agent where IDdroitaccess = 2 or IDdroitaccess=3) or IDlafonction in(select IDlafonction from lafonction where libelle like '%directeur%') or idagent IN(select Responsablen1 from agent) or idagent IN(select Responsablen2 from agent)"); 
					$results = $query->getResult();

					foreach ($results as $row)
					{
		
					if(isset($lidsd)) {
	if($sousdirection->sousdirecteur == $row->idagent) {
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
          </div>
          
          
          
           <div class="form-row">
           
            <div class="form-group col-md-12 d-flex justify-content-center">
              <button type="submit" name="go" value="go" class="btn btn-primary" style="height: 100%;">Valider formulaire</button>
            </div>
          </div>
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->