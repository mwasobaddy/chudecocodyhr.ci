<!-- Begin Page Content -->
                <?php
				
				//echo $this->router->fetch_method();
				//print_r($this->view);
				//print_r($this);
				?>
                
                 <?php 
				   $db = \Config\Database::connect();
				  	$query = $db->query('SELECT * from agent where idagent='.$idag); 
					$row   = $query->getRow();
					
          // print_r($row);
          // exit;

					$query   = $db->query('SELECT * FROM genre');
					$lgenre = $query->getResultArray();
					

			$query   = $db->query('SELECT * FROM agent');
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

      //  print_r($lfonction);
      //  echo "<pre>".print_r($lfonction,true)."</pre>";
          // exit;
					
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
  <h1 class="h3 mb-2 text-primary">Fiche agent</h1>
  <p class="mb-4">Visualisez toutes les données relatives à votre fiche agent.</p>
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
            <!--   <a class="dropdown-item" href="#">Valider</a> <a class="dropdown-item" href="#">Annuler</a>  --></div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body"> 
          
          <!---- ///////////////////////////////////////////////// ----->
         
  <?php

helper('form');
//echo 'espacerespo/ficheagent/'.$idag;
echo form_open('espacerespo/ficheagent/'.$idag, 'enctype="multipart/form-data"')

//echo '<form action="espacerespo/ficheagent/'.$idag.'" method="post" enctype="multipart/form-data">';


?>
         <!---- <form> ----->
            <div class="form-row">
              <div class="form-group col-md-2"> 
               <input type="hidden" class="form-control" id="idagent" name="idagent" value="<?php echo $row->idagent;  ?>" readonly>
               
                <label for="matricule">Matricule *</label>
                <input type="text" class="form-control" id="matricule" name="matricule" value="<?php echo $row->matricule;  ?>" readonly placeholder="Matricule" required="required">
              </div>
 
              
              <div class="form-group col-md-6">
                <label for="name">Nom et prénoms *</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row->nom;  ?>"  placeholder="Nom et prenoms" required="required">
              </div>
              <div class="form-group col-md-2">
                <label for="datenais">Date de naissance *</label>
                <input type="date" class="form-control" id="datenais" name="datenais" value="<?php echo $row->datenais;  ?>"  placeholder="Date de naissance">
              </div>
              
              <div class="form-group col-md-2" style="text-align:center">
               <img class="img-profile rounded-circle" style="width:100px; height:100px"
                                    src="<?php 
									
									if(isset($row->Photo) && file_exists('./agents/'.$row->matricule.'/'.$row->Photo)){
										echo base_url('agents/'.$row->matricule.'/'.$row->Photo);
									} else {
									echo base_url('img/undraw_profile.svg');	
									}
									?>">
              </div>
       
              
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-3">
              <?php //echo $row->IDgenre; //echo 'genre ='; print_r($lgenre);  ?>
              <label for="IDgenre">Genre</label>
                <select id="IDgenre" name="IDgenre"   class="form-control">
                <option value="">Choisir...</option>
     			<?php if (! empty($lgenre) && is_array($lgenre)) : ?>
            		<?php foreach ($lgenre as $info): ?>
                   <?php 
                    if($info['IDgenre']==$row->IDgenre) {
                     echo ' <option value="'.$info['IDgenre'].'" selected="selected">'.$info['libelle'].'</option>';				
                    } else {
            		 echo ' <option value="'.$info['IDgenre'].'">'.$info['libelle'].'</option>';						}?>
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                 <label for="IDcivilite">Civilité</label>
                <select id="IDcivilite"  name="IDcivilite" class="form-control">
                  <option value="">Choisir...</option>
                  <?php if (! empty($lcivilite) && is_array($lcivilite)) : ?>
            		<?php foreach ($lcivilite as $info): ?>
            		<?php 
					
					if($info['IDcivilite']==$row->IDcivilite) {
					echo ' <option value="'.$info['IDcivilite'].'" selected="selected">'.$info['libelle'].'</option>'; } else {
						echo ' <option value="'.$info['IDcivilite'].'">'.$info['libelle'].'</option>'; 
					}
					
					?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $row->adresse;  ?>"  placeholder="Adresse postale ou Comune / quartier">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="mobile">Mobile *</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $row->mobile;  ?>"  placeholder="+225070501070501" required="required">
              </div>
              <div class="form-group col-md-4">
                <label for="fixe">Fixe</label>
                <input type="fixe" class="form-control" id="fixe" name="fixe" value="<?php echo isset($row->fixe);  ?>" placeholder="+225270501070501">
              </div>
              <div class="form-group col-md-4">
                <label for="email">Courriel</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row->email;  ?>" placeholder="Courriel / E-mail">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="psfp">Prise de service Fonction Publique *</label>
                <input type="date" class="form-control" id="psfp" name="psfp" value="<?php echo $row->psfp;  ?>" placeholder="" required="required">
              </div>
              <div class="form-group col-md-4">
                <label for="pschu">Prise de service CHU de COCODY *</label>
                <input type="date" class="form-control" id="pschu" name="pschu" value="<?php echo $row->pschu;  ?>" placeholder="" required="required">
              </div>
              <div class="form-group col-md-4">
                <label for="IDcontrat">Nature du contrat</label>
                <select id="IDcontrat" name="IDcontrat" class="form-control">
                  <option value="">Choisir...</option>
                  <?php if (! empty($lcontrat) && is_array($lcontrat)) : ?>
            		<?php foreach ($lcontrat as $info): ?>
            		<?php 
					if($info['IDcontrat']==$row->IDcontrat) {
					echo ' <option value="'.$info['IDcontrat'].'" selected="selected">'.$info['libelle'].'</option>';
					
					} else {
						
						echo ' <option value="'.$info['IDcontrat'].'">'.$info['libelle'].'</option>';
					
					}
					
					?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="IDemploi">Emploi</label>
                <select id="IDemploi" name="IDemploi"  class="form-control">
                  <option value="">Choisir...</option>
                  <?php if (! empty($lemploi) && is_array($lemploi)) : ?>
            		<?php foreach ($lemploi as $info): ?>
            		<?php 
					if($info['IDemploi']==$row->IDemploi) {
					echo ' <option value="'.$info['IDemploi'].'" selected="selected">'.$info['libelle'].'</option>';
					} else {
						echo ' <option value="'.$info['IDemploi'].'">'.$info['libelle'].'</option>';
					}
					
					?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="IDlafonction">Fonction</label>
                <select id="IDlafonction" name="IDlafonction" class="form-control">
                  <option value="">Choisir...</option>
                    <?php if (!empty($lfonction) && is_array($lfonction)) : ?>
            		<?php foreach ($lfonction as $info): ?>
            		<?php 
					if($info['IDlafonction']==$row->IDlafonction) {
					echo ' <option value="'.$info['IDlafonction'].'" selected="selected">'.$info['libelle'].'</option>';
					} else {
						echo ' <option value="'.$info['IDlafonction'].'">'.$info['libelle'].'</option>';
					}
					?>						
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
            		<?php 
					
					if($info['IDgrade']==$row->IDgrade) {
					echo ' <option value="'.$info['IDgrade'].'" selected="selected">'.$info['libelle'].'</option>';
					} else {
					echo ' <option value="'.$info['IDgrade'].'">'.$info['libelle'].'</option>';	
					}
					
					?>						
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
            		<?php 
					
					if($info['IDdirection']==$row->IDdirection) {
					echo ' <option value="'.$info['IDdirection'].'" selected="selected">'.$info['libelle'].'</option>';
					} else {
					
					echo ' <option value="'.$info['IDdirection'].'">'.$info['libelle'].'</option>';
					
					}
					
					?>						
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
            		<?php 
					
					if($info['IDsousdirection']==$row->IDsousdirection) {
					echo ' <option value="'.$info['IDsousdirection'].'" selected="selected">'.$info['libelle'].'</option>';
					} else {
						
						echo ' <option value="'.$info['IDsousdirection'].'">'.$info['libelle'].'</option>';
					}
					
					
					?>						
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
            		<?php 
					
					if($info['IDservice']==$row->IDservice) {
					echo ' <option value="'.$info['IDservice'].'" selected="selected">'.$info['libelle'].'</option>';
					} else {
						
						echo ' <option value="'.$info['IDservice'].'">'.$info['libelle'].'</option>';
				
					}
					
					?>						
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
            		<?php 
					if($info['IDdroitaccess']==$row->IDdroitaccess) {
					echo ' <option value="'.$info['IDdroitaccess'].'" selected="selected">'.$info['libelle'].'</option>';
					} else {
						
						echo ' <option value="'.$info['IDdroitaccess'].'">'.$info['libelle'].'</option>';
					}
					
					
					?>						
            		<?php endforeach; ?>
          		<?php endif ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Responsablen1">Responsable hiérarchique N+1</label>
                <select id="Responsablen1" name="Responsablen1" class="form-control">
                  <option value="">Choisir...</option>
                  <?php
				  echo selectagent('sup',$row->Responsablen1); 
				  ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Responsablen2">Responsable hiérarchique N+2</label>
                <select id="Responsablen2" name="Responsablen2" class="form-control">
                  <option value="">Choisir...</option>
                    <?php
				  echo selectagent('sup',$row->Responsablen2); 
				  ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="Sousdrh">Sous-DRH</label>
                <select id="Sousdrh" name="Sousdrh" class="form-control">
                  
                    <?php
				  echo selectagent('sousdirecteurrh',''); 
				  ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="Directeurgeneral">Directeur Général</label>
                <select id="Directeurgeneral" name="Directeurgeneral" class="form-control">
                 
                   <?php
				  echo selectagent('dg',''); 
				  ?>
                </select>

              </div>
                   
                     <div class="form-group col-md-4">
               <label for="photo">Photo (avatar)</label>
    <input type="file" id="photo" name="photo" style="width:100%; height:100%">
              </div>        
              
            </div>
            
             <div class="form-row">
              <div class="form-group col-md-12">
                
               <label for="Observations">Observations</label>
    <textarea class="form-control" id="Observations" name="Observations" rows="2" value="<?php echo $row->Observations;  ?>" style="width:100%"></textarea>
              </div>
              
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-4">
              
                                  
                   <label for="actif">Statut agent</label>
                <select id="actif" name="actif" class="form-control">
                 <!--- <option value="">Choisir...</option> -->
                  <option value="1" <?php echo ($row->actif==1)?('selected'):('');  ?>>Agent actif</option>
                  <option value="0" <?php echo ($row->actif==0)?('selected'):('');  ?>>Agent inactif</option>
                   
                </select>
              
              </div>
             <div class="form-group col-md-4"> 
               
                <label for="position">Position</label>
                
                <select id="position" name="position" class="form-control">
                <option <?php echo ($row->position=='EN ACTIVITE')?('selected'):('');  ?>>EN ACTIVITE</option>

                <option <?php echo ($row->position=='DETACHEMENT')?('selected'):('');  ?>>DETACHEMENT</option>
                  	<option <?php echo ($row->position=='MISE EN DISPONIBILITE')?('selected'):('');  ?>>MISE EN DISPONIBILITE</option>
    <option <?php echo ($row->position=='SOUS LES DRAPEAUX')?('selected'):('');  ?>>SOUS LES DRAPEAUX</option>  
               
                </select>
               
    </div>
              
              <div class="form-group col-md-4">
               <label for="motifdisponibilite">Motif position</label>
                <input type="text" class="form-control" id="motifdisponibilite" name="motifdisponibilite" value="<?php echo $row->motifdisponibilite;  ?>" placeholder="Motif position">
              </div>
            </div>
            
            
             <div class="form-row">

              <div class="form-group col-md-12 d-flex justify-content-center">
               <button type="submit" name="go" value="go" class="btn btn-primary" style="height: 100%;">Valider formulaire</button>
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
          <h6 class="m-0 font-weight-bold text-primary">Liste des documents</h6>
        </div>
        <div class="card-body"> 
        
             
          <?php
            $dir    = 'agents/'.$row->matricule.'/';
            //echo $dir;
            $files1 = scandir($dir);

            $opt = "";

            foreach ($files1 as $value) {
              if($value!='.' && $value!='..'){
                if(is_dir($dir.$value)){
                  $opt = $opt.'<option value="'.$dir.$value.'">'.$value.'</option>';
                  
                }
              }
            }
                  
                  

            //print_r($files1);
            echo '
              <table style="width:100%" border="1">
                <tr>
                  <td colspan="3" style="text-align:center; font-size:24px; color: blue;">CONTENU DU DOSSIER</td>
                </tr>
            ';

            $db = \Config\Database::connect();
            $query = $db->query('SELECT * from acte where idagent='.$idag.' order by categorie'); 
            $acte   = $query->getResultArray();
            $lastcat ="";
            foreach ($acte as $info) {
              
              $atts = array(
                'target' => '_new'              
              );
              
              if($lastcat == $info['categorie']) {
                echo '
                  <tr>
                    <td colspan="2">'.$info['titre'].'</td>
                    <td style="text-align:center">
                      '.anchor(base_url($info['lien']),'<span class="btn btn-success mb-2"><i class="m-0 fas fa-eye" title="Visualiser"></i></span>',$atts).'
                    </td>
                  </tr>
                ';
              } else {
                
                $lastcat = $info['categorie'];
                echo '
                  <tr>
                    <td colspan="3" style="text-align:left; font-size:18px; color: red;">'.$info['categorie'].'</td>
                  </tr>
                  <tr>
                    <td colspan="2">'.$info['titre'].'</td>
                    <td style="text-align:center">
                      '.anchor(base_url($info['lien']),'<span class="btn btn-success mb-2"><i class="m-0 fas fa-eye" title="Visualiser"></i></span>',$atts).'
                    </td>
                  </tr>
                ';
                
              }
              
              
            }
                      

            echo '</table>';
          ?>

        </div>
      </div>
    </div>
   
  </div>
  
  <!-- /.container-fluid --> 
</div>
</div>
<!-- End of Main Content --> 
