<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Direction</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Direction.
    <?= \Config\Services::validation()->listErrors(); ?>
  </p>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Direction</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
echo form_open('espacerespo/creerdirection')

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-7">
              <label for="libelle">Nom de la Direction</label>
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom de la direction">
            </div>
            <div class="form-group col-md-5">
              <label for="Directeur">Directeur</label>
                <select id="Directeur" name="Directeur" class="form-control">
                  <option value="">Choisir...</option>
                  <?php 
				   $db = \Config\Database::connect();
				  	$query = $db->query("SELECT IDagent, matricule, nom from agent where IDlafonction in(select IDlafonction from lafonction where libelle like '%directeur%')"); 
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
            <div class="form-group col-md-12 d-flex justify-content-center">
              <button type="submit" class="btn btn-primary">Valider formulaire</button>
            </div>
          </div>
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->