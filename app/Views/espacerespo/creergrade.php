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
	echo form_open('espacerespo/editgrade/'.$lidgrade);
} else {
	echo form_open('espacerespo/creergrade');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-10">
               <input type="hidden" class="form-control" id="IDgrade" name="IDgrade"   <?php   if(isset($lidgrade)) {echo 'value="'.$grade->IDgrade.'"';} ?> >
            
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom du grade" <?php   if(isset($lidgrade)) {echo 'value="'.$grade->libelle.'"';} ?>>
            </div>
            <div class="form-group col-md-2">
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