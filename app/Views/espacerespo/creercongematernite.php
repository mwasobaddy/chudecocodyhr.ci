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
  <h1 class="h3 mb-2 text-primary">Configuration > Congé de maternité</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Congé de maternité.
   
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Congé de maternité</h6>
        </div>
        <div class="card-body">
         <?php
helper('form');
if(isset($lidcongematernite)) {
	echo form_open('espacerespo/editcongematernite/'.$lidcongematernite);
} else {
	echo form_open('espacerespo/creercongematernite');
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
				   $db = \Config\Database::connect();
				   $myid = $_SESSION['cnxid'];
				  	$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where agent.idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.'');
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
               <input type="date" class="form-control" onclick="" id="daterepriseeffective" name="daterepriseeffective" <?php   if(isset($lidcongematernite)) {echo 'value="'.$lidcongematernite->daterepriseeffective.'"';} ?>>
           </div>
          </div>
          
          
         <!--  <div class="form-row">
            <div class="form-group col-md-4">
               <label for="datedepart">Date depart</label>
              <input type="date" class="form-control" id="datedepart" name="datedepart" <?php   //if(isset($lidcongematernite)) {echo 'value="'.$congematernite->datedepart.'"';} ?> placeholder="datedemande" required="required">
            </div>
            <div class="form-group col-md-4">
               <label for="datereprise">Date reprise</label>
              <input type="date" class="form-control" id="datereprise" name="datereprise" <?php  // if(isset($lidcongematernite)) {echo 'value="'.$congematernite->datereprise.'"';} ?> placeholder="datereprise" required="required">
            </div>
             <div class="form-group col-md-4">
               <label for="duree">Durée</label>
              <input type="text" class="form-control" id="duree" name="duree" <?php  // if(isset($lidcongematernite)) {echo 'value="'.$congematernite->duree.'"';} ?> placeholder="duree">
            </div>
          </div> -->
          
          
          
          
          
          
          
           <div class="form-row">
            <div class="form-group col-md-3">
               <label for="justificatif1">justificatif 1</label>
    <input type="file" class="form-control-file" id="justificatif1" <?php   if(isset($lidcongematernite)) {echo 'value="'.$congematernite->justificatif1.'"';} ?> name="justificatif1" >
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
              <button type="submit" class="btn btn-primary">Valider formulaire</button>          </div>
          </div>
      
      
      
      
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->