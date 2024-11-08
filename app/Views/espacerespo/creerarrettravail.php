<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	$myid = $_SESSION['cnxid'];
	if(isset($lidarrettravail)) {
		$query = $db->query("SELECT * from arrettravail where IDarrettravail=$lidarrettravail"); 
		$arrettravail = $query->getRow();
		//print_r($direction);
	}
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Module employés &gt; Arrêt de travail</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Arrêt de travail.
   
  </p>
  <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche arrêt de travail</h6>
        </div>
        <div class="card-body">
         <?php
helper('form');
if(isset($lidarrettravail) && !isset($lidarrettravailp) && !isset($lidarrettravailr)) {
	echo form_open_multipart('espacerespo/editarrettravail/'.$lidarrettravail);
} else {
	if(isset($lidarrettravail) && isset($lidarrettravailp)) {
		echo form_open_multipart('espacerespo/prorogerarrettravail/'.$lidarrettravail);
	} else {
		if(isset($lidarrettravail) && isset($lidarrettravailr)) {
			echo form_open_multipart('espacerespo/retourarrettravail/'.$lidarrettravail);
		} else {
			echo form_open_multipart('espacerespo/creerarrettravail');
		}
	}
}
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
             <input type="hidden" class="form-control" id="IDarrettravail" name="IDarrettravail"   <?php   if(isset($lidarrettravail)) {echo 'value="'.$arrettravail->IDarrettravail.'"';} ?> >
             
             <label for="Idagent">Agent</label>
                <select id="Idagent" name="Idagent" class="form-control" <?php   if(isset($lidarrettravailr)) {echo 'readonly="readonly"';} ?>>
                  <option value="">Choisir...</option>
                  <?php 
				 
				  	$query = $db->query('SELECT idagent, matricule, nom from agent where agent.idagent IN(SELECT idagent FROM agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.')'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{
			
			if(isset($lidarrettravail)) {
	if($arrettravail->Idagent == $row->idagent) {
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
            <div class="form-group col-md-6">
        <?php   if(!isset($lidarrettravailr)) {echo '<label for="justificatif1">Pièce justificative</label>';} ?>
    <input  <?php   if(isset($lidarrettravailr)) {echo 'type="hidden"';} else { echo 'type="file"'; } ?> class="form-control-file" id="justificatif1" <?php   if(isset($lidarrettravail)) {echo 'value="'.$arrettravail->justificatif1.'"';} ?> <?php   if(isset($lidarrettravailr)) {echo 'readonly="readonly"';} ?> name="justificatif1">
            </div>
            
             
          </div>
          
          
          
           <div class="form-row">
            <div class="form-group col-md-4">
               <label for="datedepart">Date depart</label>
              <input type="date" class="form-control" id="datedepart" name="datedepart"  placeholder="datedemande" <?php   if(isset($lidarrettravailr)) {echo 'readonly="readonly"';} ?> <?php   if(isset($lidarrettravail)) {echo 'value="'.$arrettravail->datedepart.'"';} ?>>
            </div>
            <div class="form-group col-md-4">
               <label for="datereprise">Date reprise</label>
              <input type="date" class="form-control" id="datereprise" name="datereprise" <?php   if(isset($lidarrettravailr)) {echo 'readonly="readonly"';} ?> placeholder="datereprise" <?php   if(isset($lidarrettravail)) {echo 'value="'.$arrettravail->datereprise.'"';} ?> onselect="dateDiff('2021-04-01', '2021-01-05')">
            </div>
             <div class="form-group col-md-4">
               <label for="duree">Date reprise effective</label>
              <input type="date" class="form-control" onclick="" id="duree" name="duree" <?php   if(isset($lidarrettravail)) {echo 'value="'.$arrettravail->motifrejet.'"';} ?> <?php   if(!isset($lidarrettravailr)) {echo 'readonly="readonly"';} ?>>
            </div>
          </div>
          
        
            <div class="form-row">
          <div class="form-group col-md-4">
              <label for="motif">Motif Arrêt</label>
              <input list="lmotif" class="form-control" id="motif" name="motif" <?php   if(isset($lidarrettravailr)) {echo 'readonly="readonly"';} ?> autocomplete="off" required="required" placeholder="Ex : Accident de travail" <?php   if(isset($lidarrettravail)) {echo 'value="'.$arrettravail->motif.'"';} ?>/>
<datalist id="lmotif">
  <option value="Accident de la circulation">
  <option value="Accident de travail">

  <option value="Repos maladie">
</datalist>
              
            </div>
           
          
            <div class="form-group col-md-8">
               <label for="details">Détails</label>
              <input type="text" class="form-control" id="details" <?php   if(isset($lidarrettravailr)) {echo 'readonly="readonly"';} ?> name="details" placeholder="Ex: nom clinique, descriptif du mal/problème, etc." <?php   if(isset($lidarrettravail)) {echo 'value="'.$arrettravail->details.'"';} ?>>
            </div>
            </div>
            <div class="form-row">
           
            
            <!-- <div class="form-group col-md-4">
              <label for="justificatif2">justificatif 2</label>
    <input type="file" class="form-control-file" id="justificatif2" name="justificatif2">
            </div> -->
            
             <div class="form-group col-md-12 d-flex justify-content-center">
               <button type="submit" name="go" value="go" class="btn btn-primary" style="height: 100%;">Valider formulaire</button>          </div>
          </div>
          
          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->