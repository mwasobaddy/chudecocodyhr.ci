<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Service</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Service.
    <?= \Config\Services::validation()->listErrors(); ?>
  </p>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Service</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
echo form_open('espacerespo/creerservice')

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-12">
            <label for="libelle">Nom de la service</label>
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom du service">
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

			echo ' <option value="'.$row->IDsousdirection.'">'.$row->libelle.'</option>';			
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-6">
             <label for="chefservice">Chef du service</label>
                <select id="chefservice" name="chefservice" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
				   $db = \Config\Database::connect();
				  	$query = $db->query("SELECT IDagent, matricule, nom from agent where IDlafonction in(select IDlafonction from lafonction where libelle like '%directeur%' or libelle like '%chef%' or libelle like '%responsable%')"); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

			echo ' <option value="'.$row->IDagent.'">'.$row->matricule.' - '.$row->nom.'</option>';			
					}
					
					?>
            		
                </select>
            </div>
          </div>
          
          
           <div class="form-row">
           
            <div class="form-group col-md-12">
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