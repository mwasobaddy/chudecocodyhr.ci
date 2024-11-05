<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	if(isset($lidservice)) {
		$query = $db->query("SELECT * from service where IDservice=$lidservice"); 
		$servin = $query->getRow();
		//print_r($servin);
	}
   $query   = $db->query('SELECT * FROM agent');
    $lagent = $query->getResultArray();
?>

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Configuration -> Service</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Service.
    
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
          <h6 class="m-0 font-weight-bold text-primary">Fiche Service</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
if(isset($lidservice)) {
	echo form_open('espaceadmin/editservice/'.$lidservice);
} else {
	echo form_open('espaceadmin/creerservice');
}

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-12">
            <input type="hidden" class="form-control" id="IDservice" name="IDservice"   <?php   if(isset($lidservice)) {echo 'value="'.$servin->IDservice.'"';} ?> >
            <label for="libelle">Nom du service *</label>
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom du service" required="required" <?php   if(isset($lidservice)) {echo 'value="'.$servin->libelle.'"';} ?> >
            </div>
            
          </div>
          
          
                    <div class="form-row">
            <div class="form-group col-md-6">
            <label for="IDsousdirection">Sous-Direction associée</label>
                <select id="IDsousdirection" name="IDsousdirection" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
				   $db = \Config\Database::connect();
				  	$query = $db->query("SELECT * from sousdirection"); 
					$results = $query->getResult();


					foreach ($results as $row)
					{

if(isset($lidservice)) {
	if($servin->IDsousdirection == $row->IDsousdirection) {
		echo ' <option value="'.$row->IDsousdirection.'" selected>'.$row->libelle.'</option>';
	} else { echo ' <option value="'.$row->IDsousdirection.'">'.$row->libelle.'</option>'; }
} else {
echo ' <option value="'.$row->IDsousdirection.'">'.$row->libelle.'</option>';			
}
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-3">
             <label for="chefservice">Chef du service</label>
                <select id="chefservice" name="chefservice" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
          				   $db = \Config\Database::connect();
          				  	$query = $db->query("SELECT IDagent, matricule, nom from agent where idagent IN(select idagent from agent where IDdroitaccess = 2 or IDdroitaccess=3) or IDlafonction in(select IDlafonction from lafonction where libelle like '%directeur%' or libelle like '%chef%' or libelle like '%responsable%') or idagent IN(select Responsablen1 from agent) or idagent IN(select Responsablen2 from agent)"); 
          					$results = $query->getResult();

          					foreach ($results as $row)
          					{
                      if(isset($lidservice)) {
                      	if($servin->IDagent == $row->IDagent) {
                      		echo ' <option value="'.$row->IDagent.'" selected>'.$row->matricule.' - '.$row->nom.'</option>';	
                      	} else { echo ' <option value="'.$row->IDagent.'">'.$row->matricule.' - '.$row->nom.'</option>';	}
                      } else {
                      echo ' <option value="'.$row->IDagent.'">'.$row->matricule.' - '.$row->nom.'</option>';			
                      }
        					  }
        					?>
                </select>
            </div>
             
            <div class="form-group col-md-3">
              <label for="sus">SUS</label>
              <select id="sus" name="sus" class="form-control">
                  <option value="">Choisir...</option>
                   <?php if (! empty($lagent) && is_array($lagent)) : ?>
                    <?php foreach ($lagent as $info): ?>
                      <?php echo ' <option value="'.$info['idagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>       
                    <?php endforeach; ?>
                  <?php endif ?>
                </select>
            </div>
          </div>
           
          <div class="form-row">
           
            <div class="form-group col-md-12">
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