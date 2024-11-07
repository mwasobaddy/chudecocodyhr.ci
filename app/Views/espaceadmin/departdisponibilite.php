<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	if(isset($lidagent)) {
		$query = $db->query("SELECT * from agent where IDagent=$lidagent"); 
		$agent = $query->getRow();
		//print_r($posteservice);
			//print_r($posteservice);
	}
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Employés > Mise en disponibilité</h1>
  <p class="mb-4">Manipulez toutes les données relatives à la disponibilité.
   
  </p>
 <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Mise en disponibilité</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');


if(isset($lidretourchu)) {
	echo form_open('espaceadmin/retourdisponibilite/'.$agent->idagent);
} else {
	echo form_open('espaceadmin/departdisponibilite/'.$agent->idagent);
}

  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-4">
            <input type="hidden" class="form-control" id="idagent" name="idagent"   <?php   if(isset($lidagent)) {echo 'value="'.$enformation->idagent.'"';} ?> >
            
          <label for="datedepart">Date départ/retour disponibilité </label>
              <input type="date" class="form-control" id="datedepart" name="datedepart"  placeholder="Depart" required <?php   if(isset($lidenformation)) {echo 'value="'.$enformation->datedisponibilite.'"';} ?>>
              
            </div>
            
            <div class="form-group col-md-4">
              <label for="motif">Motif disponibilité</label>
              <input type="text" class="form-control" id="motif" name="motif" autocomplete="off" required placeholder="Ex : affaires" <?php   if(isset($lidretourchu)) {echo 'value="'.$agent->motifdisponibilite.'" readonly="readonly"';} ?>/>
              
            </div>
            
            <div class="form-group col-md-4">
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