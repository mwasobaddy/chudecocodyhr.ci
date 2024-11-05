<?php

	$db = \Config\Database::connect();
  if(!empty($lidplanca)){
    $lidplanca = $lidplanca;
  }
	if(isset($lidplanca)) {
		$query = $db->query("SELECT * from plancongeannuel where IDplancongeannuel=$lidplanca"); 
		$planca = $query->getRow();
    // echo "<pre>".print_r($planca,true)."</pre>";
	}

 
?>


<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Configuration -> Planning Congés annuel</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier planning Congés annuel.
   
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
          <h6 class="m-0 font-weight-bold text-primary">Fiche planning Congés annuel</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
if(isset($lidplanca)) {
	echo form_open('espaceadmin/editplancongeannuel/'.$lidplanca);
} else {
	echo form_open('espaceadmin/creerplancongeannuel');
}

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-12">
             <input type="hidden" class="form-control" id="IDplancongeannuel" name="IDplancongeannuel"   <?php   if(isset($lidplanca)) {echo 'value="'.$planca->IDplancongeannuel.'"';} ?> >
            
             <label for="matricule">Nom du planning congés annuel</label>
              <input type="text" class="form-control" required="required" id="libelle" name="libelle"  placeholder="Nom du planning congés annuel" <?php   if(isset($lidplanca)) {echo 'value="'.$planca->libelle.'"';} ?>>
            </div>
           
          </div>
          
          
          <div class="form-row">
            <div class="form-group col-md-6">
               <label for="matricule">Date debut</label>
              <input type="date" class="form-control" id="pdebut" name="pdebut" required="required" placeholder="debut" <?php   if(isset($lidplanca)) {echo 'value="'.$planca->pdebut.'"';} ?>>
            </div>
           
           <div class="form-group col-md-6">
              <label for="pfin">Date fin</label>
                <input type="date" class="form-control" id="pfin" name="pfin" required="required" placeholder="Matricule" <?php   if(isset($lidplanca)) {echo 'value="'.$planca->pfin.'"';} ?>>
            </div>
           
          </div>
          
          <div class="form-row">
          
            <div class="form-group col-md-6">
            
              <label for="publier">Publier le planning</label>
                <select id="publier" name="publier" class="form-control">
                 <!--- <option value="">Choisir...</option> -->
                 
                  <option value="1" <?php  echo (isset($planca) && $planca->publier==1)?('selected'):(''); ?>>OUI</option>
                  <option value="0" <?php  echo (isset($planca) && $planca->publier==0)?('selected'):(''); ?>>NON</option>
                   
                </select>
                  
            </div>
            
            <div class="form-group col-md-6">
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