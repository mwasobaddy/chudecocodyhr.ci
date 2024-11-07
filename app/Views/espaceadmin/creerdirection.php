
<?php

	$db = \Config\Database::connect();
	if(isset($liddirection)) {
		$query = $db->query("SELECT * from direction where IDdirection=$liddirection"); 
		$direction = $query->getRow();
		//print_r($direction);
	}
?>
<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Direction</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Direction.
   
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Direction</h6>
        </div>
        <div class="card-body">
          <?php


helper('form');
if(isset($liddirection)) {
	echo form_open('espaceadmin/editdirection/'.$liddirection);
} else {
	echo form_open('espaceadmin/creerdirection');
}




?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-7">
             <input type="hidden" class="form-control" id="IDdirection" name="IDdirection"   <?php   if(isset($liddirection)) {echo 'value="'.$direction->IDdirection.'"';} ?> >
            
              <label for="libelle">Nom de la Direction *</label>
              <input type="text" class="form-control" id="libelle" name="libelle"  placeholder="Nom de la direction" required="required" <?php   if(isset($liddirection)) {echo 'value="'.$direction->libelle.'"';} ?>>
            </div>
            <div class="form-group col-md-5">

            
 
      <label for="Directeur">Directeur</label>
                <select id="Directeur" name="Directeur" class="form-control">
                 
                  <?php 
				
				  	$query = $db->query("SELECT idagent, matricule, nom from agent where idagent IN(select idagent from agent where IDdroitaccess = 2 or IDdroitaccess=3) or IDlafonction in(select IDlafonction from lafonction where libelle like '%directeur%') or idagent IN(select Responsablen1 from agent) or idagent IN(select Responsablen2 from agent)"); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

					
			
if(isset($liddirection)) {
	if($direction->Directeur == $row->idagent) {
	
		
		echo ' <option value="'.$row->idagent.'"  selected">'.$row->matricule.' - '.$row->nom.'</option>';	
		
	} else { echo ' <option value="'.$row->idagent.'">'.$row->matricule.' - '.$row->nom.'</option>';	 }

} else {
echo ' <option value="'.$row->idagent.'">'.$row->matricule.' - '.$row->nom.'</option>';				
}
			
					}
					
					?>
            		
                </select>
                
            </div>
          </div>
          
           <div class="form-row">
            <div class="form-group col-md-12">
              <button type="submit" name="go" value="go" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>
            </div>
          </div>
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->