<?php

	$db = \Config\Database::connect();
	if(isset($lidpermissiondd)) {
		$query = $db->query("SELECT * from permissiondd where IDpermission=$lidpermissiondd"); 
		$permissiondd = $query->getRow();
		//print_r($direction);
	}
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Permission jour à jour</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Permission jour à jour.
  
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Permission jour à jour</h6>
        </div>
        <div class="card-body">
         <?php
            helper('form');
            if(isset($lidpermissiondd)) {
              echo form_open_multipart('espacerespo/editpermissiondd/'.$lidpermissiondd, 'enctype="multipart/form-data"');
            } else {
              echo form_open_multipart('espacerespo/creerpermissiondd', 'enctype="multipart/form-data"');
            }
          ?>
         
                   <!---- <form> ----->
      
       <div class="form-row">
            <div class="form-group col-md-9">
            <input type="text" class="form-control" id="IDpermission" name="IDpermission"   <?php   if(isset($lidpermissiondd)) {echo 'value="'.$permissiondd->IDpermission.'"';} ?> >
            
             <label for="Idagent">Agent</label>
                <select id="Idagent" name="Idagent" class="form-control">
                 
                  <?php 
				 
				   $myid = $_SESSION['cnxid'];
				  	$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'');
					$results = $query->getResult();

					foreach ($results as $row)
					{

			if(isset($lidpermissiondd)) {
	if($permissiondd->Idagent == $row->idagent) {
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
             <label for="datesortie">Date demande</label>
              <input type="date" class="form-control" id="datesortie" name="datesortie" required="required" placeholder="datesortie" <?php   if(isset($lidpermissiondd)) {echo 'value="'.$permissiondd->datesortie.'"';} ?>>
            </div>
           
          </div>
         
         
    <div class="form-row">
            <div class="form-group col-md-12">
               <label for="motif">Motif permission</label>
              <input type="text" class="form-control" id="motif" name="motif" required="required" placeholder="motif" <?php   if(isset($lidpermissiondd)) {echo 'value="'.$permissiondd->motif.'"';} ?>>
            </div>
           
          </div>
          
          
           <div class="form-row">
           
           <div class="form-group col-md-4">
               <label for="lieu">Lieu</label>
              <input type="text" class="form-control" id="lieu" name="lieu" required="required" placeholder="lieu" <?php   if(isset($lidpermissiondd)) {echo 'value="'.$permissiondd->lieu.'"';} ?>>
            </div>
           
            <div class="form-group col-md-4">
               <label for="jourdepart">Jour depart</label>
              <input type="date" class="form-control" id="jourdepart" name="jourdepart" required="required" placeholder="datedemande" <?php   if(isset($lidpermissiondd)) {echo 'value="'.$permissiondd->jourdepart.'"';} ?>>
            </div>
            <div class="form-group col-md-4">
               <label for="jourarrivee">Jour reprise</label>
              <input type="date" class="form-control" id="jourarrivee" name="jourarrivee" required="required" placeholder="jourarrivee" <?php   if(isset($lidpermissiondd)) {echo 'value="'.$permissiondd->jourarrivee.'"';} ?>>
            </div>
               <div class="form-group col-md-3">
                   <label for="daterepriseeffective">Jour reprise effective</label>
                   <input type="date" class="form-control" onclick="" id="daterepriseeffective" name="daterepriseeffective" <?php   if(isset($lidpermissiondd)) {echo 'value="'.$permissiondd->daterepriseeffective.'"';} ?>>
               </div>
             
          </div>
          
          
            
          <!---- <form> ----->
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