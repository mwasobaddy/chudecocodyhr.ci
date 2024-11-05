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
  <h1 class="h3 mb-2 text-gray-800">Employés -> Depart du CHU</h1>
  <p class="mb-4">Manipulez toutes les données relatives au Depart du CHU.
   
  </p>
 <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Depart du CHU</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');


if(isset($lidretourchu)) {
	echo form_open('espaceadmin/retourchu/'.$agent->idagent);
} else {
	echo form_open('espaceadmin/departchu/'.$agent->idagent);
}

  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-4">
            <input type="hidden" class="form-control" id="idagent" name="idagent"   <?php   if(isset($lidagent)) {echo 'value="'.$agent->idagent.'"';} ?> >
            
          <label for="datedepart">Date départ/retour du CHU </label>
              <input type="date" class="form-control" id="datedepart" name="datedepart"  placeholder="Depart" required="required" <?php   if(isset($lidenformation)) {echo 'value="'.$enformation->datedepart.'"';} ?>>
              
            </div>
            
            <div class="form-group col-md-4">
              <label for="motif">Motif départ/retour</label>
              <input list="lmotif" class="form-control" id="motif" name="motif" autocomplete="off" required="required" placeholder="Ex : Mutation" <?php   if(isset($lidretourchu)) {echo 'value="'.$agent->motifquitterchu.'"';} ?>/>
<datalist id="lmotif">

<option value="Abandon de poste">
  <option value="Décès">
    <option value="Formation-promotion" >
  <option value="Mutation">
  <option value="Permutation">


  
</datalist>
              
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