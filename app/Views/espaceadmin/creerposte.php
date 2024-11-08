<!-- Begin Page Content -->
<?php
//print_r($_POST);
$db = \Config\Database::connect();
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Codification des postes > Postes</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Poste.
   
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
          <h6 class="m-0 font-weight-bold text-primary">Fiche Poste</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
echo form_open('espaceadmin/creerposte');
  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
             <label for="IDlafonction">Fonction</label>
                <select id="IDlafonction" name="IDlafonction" class="form-control">
                
                  <?php 
				   
				  	$query = $db->query('SELECT * from lafonction'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

			echo ' <option value="'.$row->IDlafonction.'">'.$row->libelle.'</option>';			
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-6">
              <label for="IDemploi">Emploi</label>
                <select id="IDemploi" name="IDemploi" class="form-control">
           
                  <?php 

				  	$query = $db->query('SELECT * from emploi'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

			echo ' <option value="'.$row->IDemploi.'">'.$row->libelle.'</option>';			
					}
					
					?>
            		
                </select>
              
            </div>
            
             
          </div>
          
          
          
           <div class="form-row">
            <div class="form-group col-md-4">
               <label for="Intitule">Intitulé du poste</label>
              <input type="text" class="form-control" id="Intitule" name="Intitule"  placeholder="Intitulé">
            </div>
            <div class="form-group col-md-8">
               <label for="details">Details</label>
              <input type="text" class="form-control" id="details" name="details"  placeholder="details">
            </div>
            
          </div>
          
          
          
            <div class="form-row">
          <!--  <div class="form-group col-md-3">
               <input class="form-check-input" type="checkbox" id="hp" name="hp">
                  <label class="form-check-label" for="hp"> Hors du pays ? </label>
            </div>
            <div class="form-group col-md-4">
              <label for="justificatif2">justificatif 2</label>
    <input type="file" class="form-control-file" id="justificatif2" name="justificatif2">
            </div> -->
             <div class="form-group col-md-12 d-flex justify-content-center">
              <button type="submit" name="go" value="go" class="btn btn-primary" style="height: 100%;">Valider formulaire</button>          </div>
          </div>
          
          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->