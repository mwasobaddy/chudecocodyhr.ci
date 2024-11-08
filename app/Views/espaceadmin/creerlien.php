
<?php

	$db = \Config\Database::connect();
	if(isset($lidunite)) {
		$query = $db->query("SELECT * from unite where IDunite=$lidunite"); 
		$unite = $query->getRow();
		//print_r($unite);
	}
?>
<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Video</h1>

   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche video</h6>
        </div>
        <div class="card-body">
          <?php


helper('form');

	echo form_open('espaceadmin/creerlien/1');





?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-7">
             <input type="hidden" class="form-control" id="IDunite" name="IDunite"   <?php   if(isset($lidunite)) {echo 'value="'.$unite->IDunite.'"';} ?> >
            
            </div>
            <div class="form-group col-md-5">

          
            </div>
          </div>
          
           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="titreadm">Titre guide administrateur</label>
              <input type="text" class="form-control" id="titreadm" name="titreadm"  placeholder="Titre guide administrateur" required <?php   if(isset($lidunite)) {echo 'value="'.$unite->titreadm.'"';} ?>>
            </div>
            <div class="form-group col-md-6">
             <label for="lienadm">Lien guide administrateur </label>
              <input type="text" class="form-control" id="lienadm" name="lienadm"  placeholder="Lien guide administrateur" required <?php   if(isset($lidunite)) {echo 'value="'.$unite->lienadm.'"';} ?>>
            </div>
          </div>
          
           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="titrerespo">Titre guide responsable</label>
              <input type="text" class="form-control" id="titrerespo" name="titrerespo"  placeholder="Titre guide responsable" required <?php   if(isset($lidunite)) {echo 'value="'.$unite->titrerespo.'"';} ?>>
            </div>
            <div class="form-group col-md-6">
             <label for="lienrespo">Lien guide responsable </label>
              <input type="text" class="form-control" id="lienrespo" name="lienrespo"  placeholder="Lien guide responsable" required <?php   if(isset($lidunite)) {echo 'value="'.$unite->lienrespo.'"';} ?>>
            </div>
          </div>
          
           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="titreuser">Titre guide utilisateur</label>
              <input type="text" class="form-control" id="titreuser" name="titreuser"  placeholder="Titre guide  utilisateur" required <?php   if(isset($lidunite)) {echo 'value="'.$unite->titreuser.'"';} ?>>
            </div>
            <div class="form-group col-md-6">
             <label for="lienuser">Lien guide utilisateur </label>
              <input type="text" class="form-control" id="lienuser" name="lienuser"  placeholder="Lien guide  utilisateurr" required <?php   if(isset($lidunite)) {echo 'value="'.$unite->lienuser.'"';} ?>>
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