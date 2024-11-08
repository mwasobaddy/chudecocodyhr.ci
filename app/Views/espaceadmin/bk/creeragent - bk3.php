<!-- Begin Page Content -->
                
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Module employés > Création d'agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
 
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      <div class="card shadow mb-4"> 
        <!-- Dropdown Card Example --> 
        
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Fiche agent</h6>
          <div class="dropdown no-arrow"> <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Actions possibles: </div>
              <a class="dropdown-item" href="#">Valider</a> <a class="dropdown-item" href="#">Annuler</a> </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body"> 
          
          <!---- ///////////////////////////////////////////////// ----->
           <?= \Config\Services::validation()->listErrors(); ?>
  <?php
//echo form_open('espaceadmin/creeragent');
helper('form');
echo form_open('espaceadmin/afficher/creeragent')
//echo '<form action="espaceadmin/afficher/creeragent" name="form">';
//echo $_post['matricule'];
?>
         <!---- <form> ----->
            <div class="form-row">
              <div class="form-group col-md-3"> <?php echo $_post['matricule'];
?>
                <label for="matricule">Matricule</label>
                <input type="text" class="form-control" id="matricule" placeholder="Matricule">
              </div>
              <div class="form-group col-md-6">
                <label for="nom">Nom et prénoms</label>
                <input type="text" class="form-control" id="nom" placeholder="Nom et prénoms">
              </div>
              <div class="form-group col-md-3">
                <label for="datenais">Date de naissance</label>
                <input type="date" class="form-control" id="datenais" placeholder="Date de naissance">
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-3">
              <label for="IDgenre">Genre</label>
                <select id="IDgenre" class="form-control">
                <option selected value="">Choisir...</option>
     			<?php if (! empty($lgenre) && is_array($lgenre)) : ?>
            		<?php foreach ($lgenre as $info): ?>
            		<?php echo ' <option value="'.$info['IDgenre'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="IDsituationmatrimoniale">Situation matrimoniale</label>
                <select id="IDsituationmatrimoniale" class="form-control">
                  <option selected value="">Choisir...</option>
                  <?php if (! empty($lsituation) && is_array($lsituation)) : ?>
            		<?php foreach ($lsituation as $info): ?>
            		<?php echo ' <option value="'.$info['IDsituationmatrimoniale'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" placeholder="Adresse postale ou Comune / quartier">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" placeholder="+225070501070501">
              </div>
              <div class="form-group col-md-4">
                <label for="fixe">Fixe</label>
                <input type="fixe" class="form-control" id="fixe" placeholder="+225270501070501">
              </div>
              <div class="form-group col-md-4">
                <label for="email">Courriel</label>
                <input type="email" class="form-control" id="email" placeholder="Courriel / E-mail">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="psfp">Prise de service Fonction Publique</label>
                <input type="date" class="form-control" id="psfp" placeholder="">
              </div>
              <div class="form-group col-md-4">
                <label for="pschu">Prise de service CHU de COCODY</label>
                <input type="date" class="form-control" id="pschu" placeholder="">
              </div>
              <div class="form-group col-md-4">
                <label for="IDcontrat">Nature du contrat</label>
                <select id="IDcontrat" class="form-control">
                  <option selected>Choisir...</option>
                  <?php if (! empty($lcontrat) && is_array($lcontrat)) : ?>
            		<?php foreach ($lcontrat as $info): ?>
            		<?php echo ' <option value="'.$info['IDcontrat'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="IDemploi">Emploi</label>
                <select id="IDemploi" class="form-control">
                  <option selected>Choisir...</option>
                  <?php if (! empty($lemploi) && is_array($lemploi)) : ?>
            		<?php foreach ($lemploi as $info): ?>
            		<?php echo ' <option value="'.$info['IDemploi'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDlafonction">Fonction</label>
                <select id="IDlafonction" class="form-control">
                  <option selected>Choisir...</option>
                    <?php if (! empty($lfonction) && is_array($lfonction)) : ?>
            		<?php foreach ($lfonction as $info): ?>
            		<?php echo ' <option value="'.$info['IDfonction'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDgrade">Grade</label>
                <select id="IDgrade" class="form-control">
                  <option selected>Choisir...</option>
                    <?php if (! empty($lgrade) && is_array($lgrade)) : ?>
            		<?php foreach ($lgrade as $info): ?>
            		<?php echo ' <option value="'.$info['IDgrade'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="IDdirection">Direction</label>
                <select id="IDdirection" class="form-control">
                  <option selected value="">Choisir...</option>
                   <?php if (! empty($ldirection) && is_array($ldirection)) : ?>
            		<?php foreach ($ldirection as $info): ?>
            		<?php echo ' <option value="'.$info['IDdirection'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDsousdirection">Sous-Direction</label>
                <select id="IDsousdirection" class="form-control">
                  <option selected value="">Choisir...</option>
                    <?php if (! empty($lsousdirection) && is_array($lsousdirection)) : ?>
            		<?php foreach ($lsousdirection as $info): ?>
            		<?php echo ' <option value="'.$info['IDsousdirection'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDservice">Service</label>
                <select id="IDservice" class="form-control">
                  <option selected value="">Choisir...</option>
                    <?php if (! empty($lservice) && is_array($lservice)) : ?>
            		<?php foreach ($lservice as $info): ?>
            		<?php echo ' <option value="'.$info['IDservice'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="IDdroitaccess">Droit d'accès</label>
                <select id="IDdroitaccess" class="form-control">
                  <option selected value="">Choisir...</option>
                    <?php if (! empty($ldroitaccess) && is_array($ldroitaccess)) : ?>
            		<?php foreach ($ldroitaccess as $info): ?>
            		<?php echo ' <option value="'.$info['IDdroitaccess'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Responsablen1">Responsable hiérarchique N+1</label>
                <select id="Responsablen1" class="form-control">
                  <option selected value="">Choisir...</option>
                   <?php if (! empty($lagent) && is_array($lagent)) : ?>
            		<?php foreach ($lagent as $info): ?>
            		<?php echo ' <option value="'.$info['IDagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Responsablen2">Responsable hiérarchique N+2</label>
                <select id="Responsablen2" class="form-control">
                  <option selected value="">Choisir...</option>
                   <?php if (! empty($lagent) && is_array($lagent)) : ?>
            		<?php foreach ($lagent as $info): ?>
            		<?php echo ' <option value="'.$info['IDagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Sousdrh">Sous-DRH</label>
                <select id="Sousdrh" class="form-control">
                  <option selected value="">Choisir...</option>
                    <?php if (! empty($lagent) && is_array($lagent)) : ?>
            		<?php foreach ($lagent as $info): ?>
            		<?php echo ' <option value="'.$info['IDagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Directeurgeneral">Directeur Général</label>
                <select id="Directeurgeneral" class="form-control">
                  <option selected value="">Choisir...</option>
                    <?php if (! empty($lagent) && is_array($lagent)) : ?>
            		<?php foreach ($lagent as $info): ?>
            		<?php echo ' <option value="'.$info['IDagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">Rôle</label>
                <select id="inputState" class="form-control">
                  <option selected value="">Choisir...</option>
                    <?php if (! empty($lrole) && is_array($lrole)) : ?>
            		<?php foreach ($lrole as $info): ?>
            		<?php echo ' <option value="'.$info['IDrole'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              
              
            </div>
            
             <div class="form-row">
              <div class="form-group col-md-12">
                
               <label for="observations">Observations</label>
    <textarea class="form-control" id="observations" rows="2" style="width:100%"></textarea>
              </div>
              
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="actif">
                  <label class="form-check-label" for="actif"> Activer / Desactiver agent </label>
                </div>
              </div>
              <div class="form-group col-md-4"> </div>
              <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary">Valider formulaire</button>
              </div>
            </div>
          </form>
          
          <!---- ///////////////////////////////////////////////// -----> 
          
        </div>
        <!---  card body ---> 
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-sm-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Liste des documents et photo</h6>
        </div>
        <div class="card-body"> 
        
    <!--    <form>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" class="form-control-file" id="photo">
  </div>
</form> -->
        
        
        
        
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Liste des rôles</h6>
        </div>
        <div class="card-body"> 
        
        
        </div>
      </div>
    </div>
  </div>
  
  <!-- /.container-fluid --> 
</div>
</div>
<!-- End of Main Content --> 

<!--  
<div class="row">
    <div class="col-xs-6 col-sm-6">
      <div class="col-sm-4">.col-sm-4</div>
    </div>
    <div class="col-xs-6 col-sm-6">
      <div class="col-sm-8">.col-sm-8</div>
    </div>
  </div>
  
  -->