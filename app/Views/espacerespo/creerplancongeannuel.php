<!-- Begin Page Content -->


<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Planning Congés annuel</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier planning Congés annuel.
   
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche planning Congés annuel</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
echo form_open('espacerespo/creerplancongeannuel')

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-12">
             <label for="matricule">Nom du planning congés annuel</label>
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom du planning congés annuel">
            </div>
           
          </div>
          
          
          <div class="form-row">
            <div class="form-group col-md-6">
               <label for="matricule">Date debut</label>
              <input type="date" class="form-control" id="pdebut" name="pdebut"  placeholder="debut">
            </div>
           
           <div class="form-group col-md-6">
              <label for="pfin">Date fin</label>
                <input type="date" class="form-control" id="pfin" name="pfin" placeholder="Matricule">
            </div>
           
          </div>
          
          <div class="form-row">
          
            <div class="form-group col-md-6">
            
             <label for="publier">Publier le planning</label>
                <select id="publier" name="publier" class="form-control">
                 <!--- <option value="">Choisir...</option> -->
                  <option value="1">Agent actif</option>
                  <option value="0">Agent inactif</option>
                   
                </select>
            
             
            </div>
            
            <div class="form-group col-md-6">
              <button type="submit" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>
            </div>
            
          </div>
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->