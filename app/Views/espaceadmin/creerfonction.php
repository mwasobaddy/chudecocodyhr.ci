<?php

	$db = \Config\Database::connect();
	if(isset($lidfonction)) {
		$query = $db->query("SELECT * from lafonction where IDlafonction=$lidfonction"); 
		$lafonction = $query->getRow();
		//print_r($direction);
	}
?>
<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Fonction</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Fonction.
 
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
          <h6 class="m-0 font-weight-bold text-primary">Fiche Fonction</h6>
        </div>
        <div class="card-body">


 <?php
helper('form');
if(isset($lidfonction)) {
	echo form_open('espaceadmin/editfonction/'.$lidfonction);
} else {
	echo form_open('espaceadmin/creerfonction');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-10">
               <input type="hidden" class="form-control" id="IDfonction" name="IDfonction"   <?php   if(isset($lidfonction)) {echo 'value="'.$lafonction->IDlafonction.'"';} ?> >
               
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom de la fonction" <?php   if(isset($lidfonction)) {echo 'value="'.$lafonction->libelle.'"';} ?>>
            </div>
            <div class="form-group col-md-2">
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