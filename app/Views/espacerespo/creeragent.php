<!-- Begin Page Content -->
                <?php
				$db = \Config\Database::connect();
				//echo $this->router->fetch_method();
				//print_r($this->view);
				//print_r($this);
				
				
				$query   = $db->query('SELECT * FROM genre');
					$lgenre = $query->getResultArray();
				
			$myid = $_SESSION['cnxid'];
			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'');
			$lagent = $query->getResultArray();
			
			$query   = $db->query('SELECT * FROM contrat');
			$lcontrat = $query->getResultArray();
					
			
			$query   = $db->query('SELECT * FROM direction');
			$ldirection = $query->getResultArray();
			
			$query   = $db->query('SELECT * FROM droitaccess');
			$ldroitaccess = $query->getResultArray();
		
			$query   = $db->query('SELECT * FROM emploi');
			$lemploi = $query->getResultArray();
			
			$query   = $db->query('SELECT * FROM lafonction');
			$lfonction = $query->getResultArray();
					
			$query   = $db->query('SELECT * FROM grade');
			$lgrade = $query->getResultArray();
					
			$query   = $db->query('SELECT * FROM role_agent');
			$lroleagent = $query->getResultArray();
					
			$query   = $db->query('SELECT * FROM role');
			$lrole = $query->getResultArray();
					
			$query   = $db->query('SELECT * FROM service');
			$lservice = $query->getResultArray();
					
			$query   = $db->query('SELECT * FROM civilite');
			$lcivilite= $query->getResultArray();
			
			$query   = $db->query('SELECT * FROM sousdirection');
			$lsousdirection = $query->getResultArray();
		
					
				?>
              
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Module employés -> Création d'agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
  <?php
echo view('toast');
 ?>
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
          
  <?php

helper('form');
echo form_open('espacerespo/creeragent')

?>
         <!---- <form> ----->
            <div class="form-row">
              <div class="form-group col-md-3"> 
                <label for="matricule">Matricule *</label>
                <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Matricule" required="required">
              </div>
 
              
              <div class="form-group col-md-6">
                <label for="name">Nom et prénoms *</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom et prénoms" required="required">
              </div>
              <div class="form-group col-md-3">
                <label for="datenais">Date de naissance *</label>
                <input type="date" class="form-control" id="datenais" name="datenais" placeholder="Date de naissance" required="required">
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-3">
              <label for="IDgenre">Genre</label>
                <select id="IDgenre" name="IDgenre"  class="form-control">
                <option value="">Choisir...</option>
     			<?php if (! empty($lgenre) && is_array($lgenre)) : ?>
            		<?php foreach ($lgenre as $info): ?>
            		<?php echo ' <option value="'.$info['IDgenre'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="IDcivilite">Civilité</label>
                <select id="IDcivilite" name="IDcivilite" class="form-control">
                  <option value="">Choisir...</option>
                  <?php if (! empty($lcivilite) && is_array($lcivilite)) : ?>
            		<?php foreach ($lcivilite as $info): ?>
            		<?php echo ' <option value="'.$info['IDcivilite'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse postale ou Comune / quartier">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="mobile">Mobile *</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="+225070501070501" required="required">
              </div>
              <div class="form-group col-md-4">
                <label for="fixe">Fixe</label>
                <input type="fixe" class="form-control" id="fixe" name="fixe" placeholder="+225270501070501">
              </div>
              <div class="form-group col-md-4">
                <label for="email">Courriel</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Courriel / E-mail">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="psfp">Prise de service Fonction Publique *</label>
                <input type="date" class="form-control" id="psfp" name="psfp" placeholder="" required="required">
              </div>
              <div class="form-group col-md-4">
                <label for="pschu">Prise de service CHU de COCODY *</label>
                <input type="date" class="form-control" id="pschu" name="pschu" placeholder="" required="required">
              </div>
              <div class="form-group col-md-4">
                <label for="IDcontrat">Nature du contrat</label>
                <select id="IDcontrat" name="IDcontrat" class="form-control">
                  <option value="">Choisir...</option>
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
                <select id="IDemploi" name="IDemploi" class="form-control">
                  <option value="">Choisir...</option>
                  <?php if (! empty($lemploi) && is_array($lemploi)) : ?>
            		<?php foreach ($lemploi as $info): ?>
            		<?php echo ' <option value="'.$info['IDemploi'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDlafonction">Fonction</label>
                <select id="IDlafonction" name="IDlafonction" class="form-control">
                  <option value="">Choisir...</option>
                    <?php if (! empty($lfonction) && is_array($lfonction)) : ?>
            		<?php foreach ($lfonction as $info): ?>
            		<?php echo ' <option value="'.$info['IDlafonction'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDgrade">Grade</label>
                <select id="IDgrade" name="IDgrade" class="form-control">
                  <option value="">Choisir...</option>
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
                <select id="IDdirection" name="IDdirection" class="form-control">
                  <option value="">Choisir...</option>
                   <?php if (! empty($ldirection) && is_array($ldirection)) : ?>
            		<?php foreach ($ldirection as $info): ?>
            		<?php echo ' <option value="'.$info['IDdirection'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDsousdirection">Sous-Direction</label>
                <select id="IDsousdirection" name="IDsousdirection" class="form-control">
                  <option value="">Choisir...</option>
                    <?php if (! empty($lsousdirection) && is_array($lsousdirection)) : ?>
            		<?php foreach ($lsousdirection as $info): ?>
            		<?php echo ' <option value="'.$info['IDsousdirection'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDservice">Service</label>
                <select id="IDservice" name="IDservice" class="form-control">
                  <option value="">Choisir...</option>
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
                <select id="IDdroitaccess" name="IDdroitaccess" class="form-control">
                  <option value="">Choisir...</option>
                    <?php if (! empty($ldroitaccess) && is_array($ldroitaccess)) : ?>
            		<?php foreach ($ldroitaccess as $info): ?>
            		<?php echo ' <option value="'.$info['IDdroitaccess'].'">'.$info['libelle'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Responsablen1">Responsable hiérarchique N+1</label>
                <select id="Responsablen1" name="Responsablen1" class="form-control">
                  <option value="">Choisir...</option>
                   <?php if (! empty($lagent) && is_array($lagent)) : ?>
            		<?php foreach ($lagent as $info): ?>
            		<?php echo ' <option value="'.$info['idagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Responsablen2">Responsable hiérarchique N+2</label>
                <select id="Responsablen2" name="Responsablen2" class="form-control">
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
              <div class="form-group col-md-4">
                <label for="Sousdrh">Sous-DRH</label>
                <select id="Sousdrh" name="Sousdrh" class="form-control">
                 
                  <?php
				  
				  $myid = $_SESSION['cnxid'];
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where matricule='357986U'");			$sdrh = $query->getResultArray();
				  
				  ?>
                  
                    <?php if (! empty($sdrh) && is_array($sdrh)) : ?>
            		<?php foreach ($sdrh as $info): ?>
            		<?php echo ' <option value="'.$info['idagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4"> <?php //print_r($lagent); ?>
                <label for="Directeurgeneral">Directeur Général</label>
                <select id="Directeurgeneral" name="Directeurgeneral" class="form-control">
                  
                   <?php
				  
				  $myid = $_SESSION['cnxid'];
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where matricule='305855D'");			$dg = $query->getResultArray();
				  
				  ?>
                  
                    <?php  if (! empty($dg) && is_array($dg)) : ?>
            		<?php foreach ($dg as $info): ?>
            		<?php echo ' <option value="'.$info['idagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">Rôle</label>
                <select id="inputState" name="inputState" class="form-control">
                  <option value="">Choisir...</option>
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
    <textarea class="form-control" id="observations" name="observations" rows="2" style="width:100%"></textarea>
              </div>
              
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                               
                   <label for="actif">Statut agent</label>
                <select id="actif" name="actif" class="form-control">
                 <!--- <option value="">Choisir...</option> -->
                  <option value="1" <?php echo ($row->actif==1)?('selected'):('');  ?>>Agent actif</option>
                  <option value="0" <?php echo ($row->actif==0)?('selected'):('');  ?>>Agent inactif</option>
                   
                </select>
              </div>
               <!-- <div class="form-group col-md-4"> </div> --> 
              <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>
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
    <div class="col-xs-12 col-sm-12">
      <div class="card shadow mb-12">
        <div class="card-header py-12">
          <h6 class="m-0 font-weight-bold text-primary">Liste des documents et photo</h6>
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
