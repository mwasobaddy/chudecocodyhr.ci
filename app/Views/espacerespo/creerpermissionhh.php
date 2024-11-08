<?php

	$db = \Config\Database::connect();
	if(isset($lidpermissionhh)) {
		$query = $db->query("SELECT * from permissionhh where IDpermission=$lidpermissionhh"); 
		$permissionhh = $query->getRow();
		//print_r($direction);
	}
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Permission heure à heure</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Permission heure à heure.

  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Permission heure à heure</h6>
        </div>
        <div class="card-body">
         <?php
helper('form');
if(isset($lidpermissionhh)) {
	echo form_open('espacerespo/editpermissionhh/'.$lidpermissionhh, 'enctype="multipart/form-data"');
} else {
	echo form_open('espacerespo/creerpermissionhh', 'enctype="multipart/form-data"');
}
?>
                <div class="form-row">
            <div class="form-group col-md-9">
            <input type="hidden" class="form-control" id="IDpermission" name="IDpermission"   <?php   if(isset($lidpermissionhh)) {echo 'value="'.$permissionhh->IDpermission.'"';} ?> >
            
             <label for="IDagent">Agent</label>
                <select id="Idagent" name="Idagent" class="form-control">
      
                  <?php 
				   
				   $myid = $_SESSION['cnxid'];
				  	$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'');
					$results = $query->getResult();

					foreach ($results as $row)
					{

		if(isset($lidpermissionhh)) {
	if($permissionhh->Idagent == $row->idagent) {
echo ' <option value="'.$row->idagent.'" selected>'.$row->matricule.' - '.$row->nom.'</option>';				
	} else { 
echo ' <option value="'.$row->idagent.'">'.$row->matricule.' - '.$row->nom.'</option>';		
		 }

} else {
			echo ' <option value="'.$row->idagent.'">'.$row->matricule.' - '.$row->nom.'</option>';						
}	
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-3">
              <label for="datesortie">Date de départ</label>
              <input type="date" class="form-control" id="datesortie" name="datesortie" required="required" placeholder="datesortie" <?php   if(isset($lidpermissionhh)) {echo 'value="'.$permissionhh->datesortie.'"';} ?>>
            </div>
           
          </div>
          
           <div class="form-row">
            <div class="form-group col-md-12">
               <label for="objetsortie">Objet de la permission</label>
              <input type="text" class="form-control" id="objetsortie" name="objetsortie" required="required" placeholder="objetsortie" <?php   if(isset($lidpermissionhh)) {echo 'value="'.$permissionhh->objetsortie.'"';} ?>>
            </div>
           
          </div>
          
            <div class="form-row">
           
           <div class="form-group col-md-3">
               <label for="lieu">Lieu</label>
              <input type="text" class="form-control" id="lieu" name="lieu" required="required" placeholder="lieu" <?php   if(isset($lidpermissionhh)) {echo 'value="'.$permissionhh->lieu.'"';} ?>>
            </div>
           
            <div class="form-group col-md-3">
               <label for="heuredepart">Heure depart</label>
              <input type="time" class="form-control" id="heuredepartt" name="heuredepart" required="required" placeholder="heuredepart" <?php   if(isset($lidpermissionhh)) {echo 'value="'.$permissionhh->heuredepart.'"';} ?>>
            </div>
            <div class="form-group col-md-3">
               <label for="heurearrivee">Heure reprise</label>
              <input type="time" class="form-control" id="heurearrivee" name="heurearrivee" required="required" placeholder="heurearrivee" <?php   if(isset($lidpermissionhh)) {echo 'value="'.$permissionhh->heurearrivee.'"';} ?>>
            </div>
            <div class="form-group col-md-3">
                <label for="heurearriveeeffective">Heure reprise effective</label>
                <input type="time" class="form-control" id="heurearriveeeffective" name="heurearriveeeffective" required="required" placeholder="heurearriveeeffective" <?php   if(isset($lidpermissionhh)) {echo 'value="'.$permissionhh->heurearriveeeffective.'"';} ?>>
            </div>
             
          </div>
          
          <div class="form-row">
         <div class="form-group col-md-4">
              <label for="justificatif">Justificatif</label>
              <input type="file" class="form-control-file" id="justificatif" name="justificatif" required="required">
            </div>
            <div class="form-group col-md-8">
              <button type="submit" class="btn btn-primary" style="width:100%; height:100%;">Valider formulaire</button>
            </div>
          </div>
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->