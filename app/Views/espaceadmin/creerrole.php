<?php

	$db = \Config\Database::connect();
	if(isset($lidrole)) {
		$query = $db->query("SELECT * from role where IDrole=$lidrole"); 
		$role = $query->getRow();
	}
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Rôle</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Rôle.
    
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
          <h6 class="m-0 font-weight-bold text-primary">Fiche Rôle</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
if(isset($lidrole)) {
	echo form_open('espaceadmin/editrole/'.$lidrole);
} else {
	echo form_open('espaceadmin/creerrole');
}

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-10">
            <input type="hidden" class="form-control" id="IDrole" name="IDrole"   <?php   if(isset($lidrole)) {echo 'value="'.$role->IDrole.'"';} ?> >
            
            
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom du Rôle" <?php   if(isset($lidrole)) {echo 'value="'.$role->libelle.'"';} ?>>
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