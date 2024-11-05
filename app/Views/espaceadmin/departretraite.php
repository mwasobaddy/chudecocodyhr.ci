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
  <h1 class="h3 mb-2 text-gray-800">Employés -> Depart à la retraite</h1>
  <p class="mb-4">Manipulez toutes les données relatives au Depart à la retraite.
   
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
          <h6 class="m-0 font-weight-bold text-primary">Fiche Depart à la retraite/h6>
        </div>
        <div class="card-body">
          <?php

helper('form');


if(isset($lidretourchu)) {
	echo form_open('espaceadmin/retourretraite/'.$agent->idagent);
} else {
	echo form_open('espaceadmin/departretraite/'.$agent->idagent);
}

  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
            <input type="hidden" class="form-control" id="idagent" name="idagent" <?php   if(isset($lidagent)) {echo 'value="'.$lidagent.'"';} ?> >
            
          <label for="datedepart">Date depart retraite</label>
              <input type="date" class="form-control" id="datedepart" name="datedepart"  placeholder="Depart" required="required" <?php   if(isset($lidenformation)) {echo 'value="'.$lidenformation.'"';} ?>>
              
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