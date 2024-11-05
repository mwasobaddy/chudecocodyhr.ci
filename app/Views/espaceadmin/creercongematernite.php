<?php

	$db = \Config\Database::connect();
	if(isset($lidcongematernite)) {
		$query = $db->query("SELECT * from congematernite where IDconge=$lidcongematernite"); 
		$congematernite = $query->getRow();
		//print_r($direction);
	}
?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Configuration -> Congé de maternité</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Congé de maternité.

  </p>
     <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Congé de maternité</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
if(isset($lidcongematernite)) {
	echo form_open('espaceadmin/editcongematernite/'.$lidcongematernite);
} else {
	echo form_open('espaceadmin/creercongematernite');
}
?>


          <!---- <form> ----->
      
       <div class="form-row">
            <div class="form-group col-md-6">
            <input type="hidden" class="form-control" id="IDconge" name="IDconge"   <?php   if(isset($lidcongematernite)) {echo 'value="'.$congematernite->IDconge.'"';} ?> >
            
             <label for="IDagent">Agent</label>
                <select id="Idagent" name="Idagent" class="form-control" required="required">
                  <option value="">Choisir...</option>
                  <?php 
				   
				  	$query = $db->query('SELECT idagent, matricule, nom from agent'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

			
			
			if(isset($lidcongematernite)) {
	if($congematernite->Idagent == $row->idagent) {	
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
             <label for="dateterme">Terme théorique</label>
              <input type="date" class="form-control" id="dateterme" name="dateterme" <?php   if(isset($lidcongematernite)) {echo 'value="'.$congematernite->dateterme.'"';} ?> placeholder="datedemande" required="required">
              
            </div>
           <div class="form-group col-md-3">
               <label for="daterepriseeffective">Date reprise effective</label>
               <input type="date" class="form-control" onclick="" id="daterepriseeffective" name="daterepriseeffective" <?php   if(isset($lidcongematernite)) {echo 'value="'.$lidcongematernite->daterepriseeffective.'"';} else {echo 'readonly="readonly"';} ?>>
           </div>
          </div>
          
          
                
          
          
          
          
           <div class="form-row">
            <div class="form-group col-md-3">
               <label for="justificatif1">justificatif 1</label>
    <input type="file" class="form-control-file" id="justificatif1" <?php   if(isset($lidcongematernite)) {echo 'value="'.$congematernite->justificatif1.'"';} ?> name="justificatif1">
            </div>
            <div class="form-group col-md-3">
              <label for="justificatif2">justificatif 2</label>
    <input type="file" class="form-control-file" id="justificatif2" name="justificatif2" <?php   if(isset($lidcongematernite)) {echo 'value="'.$congematernite->justificatif2.'"';} ?>>
            </div>
             <div class="form-group col-md-3">
              <label for="justificatif3">justificatif 3</label>
    <input type="file" class="form-control-file" id="justificatif3" name="justificatif3" <?php   if(isset($lidcongematernite)) {echo 'value="'.$congematernite->justificatif3.'"';} ?>>
            </div>
             <div class="form-group col-md-3">
               <button type="submit" name="go" value="go" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>          </div>
          </div>
      
      
      
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->