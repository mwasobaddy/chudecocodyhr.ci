<!-- Begin Page Content -->
<?php
	$db = \Config\Database::connect();
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Employés > Mot de passe</h1>
  <p class="mb-4">Modifier votre mot de passe
   
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
          <h6 class="m-0 font-weight-bold text-primary">Changement de mot de passe</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');

	echo form_open('espacerespo/changepwd');


  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-4">
            <input type="hidden" class="form-control" id="idagent" name="idagent"   <?php echo 'value="'.$_SESSION['cnxid'].'"'; ?> >
            
          <label for="datedepart">Ancien mot de passe</label>
              <input type="password" class="form-control" id="oldp" name="oldp"  placeholder="Ancien mot de passe" required >
              
            </div>
            
            <div class="form-group col-md-5">
        
          <label for="datedepart">Nouveau mot de passe (7 caractères minimum)</label>
              <input type="password" class="form-control" id="newp" name="newp"  placeholder="Nouveau mot de passe" required >
              
            </div>
            <div class="form-group col-md-3">
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