<?php

	$db = \Config\Database::connect();
	if(isset($lidgrade)) {
		$query = $db->query("SELECT * from grade where IDgrade=$lidgrade"); 
		$grade = $query->getRow();
	}
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Configuration -> Grade</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Grade.
  
  </p>
   <?php
if (isset($toast) && isset($_POST['go']) && !empty($_POST['go'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">  
	   '.$toast.' 
    </div>';
}

if (isset($_SESSION['toast']) && !empty($_SESSION['toast'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color:#4877f4; color:#fff">  
	   '.$_SESSION['toast'].' 
    </div>';
	unset($_SESSION['toast']);
} ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Grade</h6>
        </div>
        <div class="card-body">

 <?php
helper('form');
if(isset($lidgrade)) {
	echo form_open('espaceadmin/editgrade/'.$lidgrade);
} else {
	echo form_open('espaceadmin/creergrade');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-10">
               <input type="hidden" class="form-control" id="IDgrade" name="IDgrade"   <?php   if(isset($lidgrade)) {echo 'value="'.$grade->IDgrade.'"';} ?> >
            
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom du grade" <?php   if(isset($lidgrade)) {echo 'value="'.$grade->libelle.'"';} ?>>
            </div>
            <div class="form-group col-md-2">
               <button type="submit" name="go" value="go" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->