<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Droit d'access</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Droit d'access.
    <?= \Config\Services::validation()->listErrors(); ?>
  </p>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Droit d'access</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
echo form_open('espacerespo/creerdroitaccess')

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-10">
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom du Droit d'access">
            </div>
            <div class="form-group col-md-2">
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