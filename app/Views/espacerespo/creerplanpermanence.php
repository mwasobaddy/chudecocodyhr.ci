<!-- Begin Page Content -->


<?php

$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];
	$dd = date('Y');
	$query   = $db->query("SELECT * FROM lemois where libelle like '%$dd%'");
	$lmois = $query->getResultArray();


    $query   = $db->query('SELECT * FROM service WHERE IDservice=(select IDservice from agent where idagent='.$myid.')');
	$lservice = $query->getResultArray();
	
	if(isset($lidplanpermanence)) {
		$query = $db->query("SELECT * from planpermanence where IDplanpermanence=$lidplanpermanence"); 
		$planpermanence = $query->getRow();
		//print_r($direction);
	}


?>


<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Planning > Permanance</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier planning.
    
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche planning des permanences</h6> <i style="font-size:12px; color:#999">(*) Champs obligatoires</i>
        </div>
        <div class="card-body">
          <?php

helper('form');
if(isset($lidplanpermanence)) {
	echo form_open('espacerespo/editplanpermanence/'.$lidplanpermanence);
} else {
	echo form_open('espacerespo/creerplanpermanence');
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-8">
             <input type="hidden" class="form-control" id="IDplanpermanence" name="IDplanpermanence"   <?php   if(isset($lidplanpermanence)) {echo 'value="'.$planpermanence->IDplanpermanence.'"';} ?> >
            
             <label for="IDmois">Période (mois) *</label>
                <select id="IDmois" name="IDmois" class="form-control">
                  <option value="">Choisir...</option>
                    <?php if (! empty($lmois) && is_array($lmois)) {
            		foreach ($lmois as $info) {
						
            			
					
					if(isset($lidplanpermanence)) {
	if($planpermanence->IDmois == $info['IDmois']) {	
echo ' <option value="'.$info['IDmois'].'"  selected>'.$info['libelle'].'</option>';			
	} else { 
echo ' <option value="'.$info['IDmois'].'">'.$info['libelle'].'</option>';
		 }

} else {
			echo ' <option value="'.$info['IDmois'].'">'.$info['libelle'].'</option>';				
}
					
					}
                    
					} ?>
                </select>
            <!-- <label for="libelle">Nom du planning de permanence *</label> -->
              <input type="hidden" class="form-control" id="libelle" name="libelle"  placeholder="Nom du planning de permanence" <?php   if(isset($lidplanpermanence)) {echo 'value="'.$planpermanence->libelle.'"';} ?>>
            </div>
            
             <div class="form-group col-md-4">
          
             <label for="lit">Nombre de lit *</label>
              <input type="number" class="form-control" id="lit" name="lit"  placeholder="Nombre de lit" <?php   if(isset($lidplanpermanence)) {echo 'value="'.$planpermanence->lit.'"';} ?>>
            </div>
           
          </div>
          
          
          <div class="form-row">
            <div class="form-group col-md-8">
                 <label for="IDservice">Service *</label>
                <select id="IDservice" name="IDservice" class="form-control">
                  <option value="">Choisir...</option>
                    <?php 
					if (! empty($lservice) && is_array($lservice)) {
						
            		 foreach ($lservice as $info) {
						 
            		
					
					if(isset($lidplanpermanence)) {
	if($planpermanence->IDservice == $info['IDservice']) {	
echo ' <option value="'.$info['IDservice'].'" selected>'.$info['libelle'].'</option>';				
	} else { 
echo ' <option value="'.$info['IDservice'].'">'.$info['libelle'].'</option>';	
		 }

} else {
			echo ' <option value="'.$info['IDservice'].'">'.$info['libelle'].'</option>';			
}
					
									
					 }
					 
					} ?>
                </select>
            </div>
           
        <div class="form-group col-md-4">
            
              <label for="publier">Publier le planning</label>
                <select id="publier" name="publier" class="form-control">
                 <!--- <option value="">Choisir...</option> -->
                  <option value="1" <?php  echo ($planpermanence->publier==1)?('selected'):(''); ?>>Planning actif</option>
                  <option value="0" <?php  echo ($planpermanence->publier==0)?('selected'):(''); ?>>Planning inactif</option>
                   
                </select>
                  
            </div>
           
          </div>
          
          <div class="form-row">

            <div class="form-group col-md-12">
            Sélectionnez les signataires s'il vous plait
            <table style="width:100%">
            <tr><td><input name="validationcs" type="checkbox" <?php  echo ($planpermanence->validationcs==1)?('checked="checked"'):(''); ?>> Chef de service </td>
            <td><input name="validationsus" type="checkbox" <?php  echo ($planpermanence->validationsus==1)?('checked="checked"'):(''); ?>>SUS</td>
            <td><input name="validationsd" type="checkbox" <?php  echo ($planpermanence->validationsd==1)?('checked="checked"'):(''); ?>>Sous-Directeur</td>
            <td><input name="validationdsio" type="checkbox" <?php  echo ($planpermanence->validationdsio==1)?('checked="checked"'):(''); ?>>S/DSIO</td></tr>
            <tr><td><input name="validationcctos" type="checkbox" <?php  echo ($planpermanence->validationcctos==1)?('checked="checked"'):(''); ?>>Coordinateur CCTOS</td>
            <td><input name="validationdms" type="checkbox" <?php  echo ($planpermanence->validationdms==1)?('checked="checked"'):(''); ?>>DMS</td>
            <td><input name="validationdaf" type="checkbox" <?php  echo ($planpermanence->validationdaf==1)?('checked="checked"'):(''); ?>>DAF</td>
            <td><input name="validationdg" type="checkbox" <?php  echo ($planpermanence->validationdg==1)?('checked="checked"'):(''); ?>>Directeur Général</td></tr>
            </table>

            </div>
            
          </div>
          
                    <div class="form-row">

            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary" style="width:100%;height:100%">Valider formulaire</button>
            </div>
            
          </div>
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->