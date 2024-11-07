<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	if(isset($lidagent)) {
		$query = $db->query("SELECT * from agent where IDagent=$lidagent"); 
		$agent = $query->getRow();
		
	}
	
	if(isset($lidenformation) || isset($lidprolonger)) {
//		$query = $db->query("SELECT * from enformation where Idagent=$lidagent and (datereprise is null or datereprise='0000-00-00')");
		$query = $db->query("SELECT * from enformation where Idagent=$lidagent and (daterepriseeffective is null or daterepriseeffective='0000-00-00')");
		//echo "SELECT * from enformation where Idagent=$lidagent and (datereprise is null or datereprise='0000-00-00')";
		//$enformation = $query->getRow();
		$resu = $query->getResultArray();
		$enformation = array();
        foreach ($resu as $enformatio)
        {
           $enformation = $enformatio;
        }

	}
	//echo '<br/>ida = '.$lidagent;
	//echo '<br/>idf = '.$lidenformation;
	
	
	//print_r($enformation);
	//
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Employé > Formation</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Formation.
   
  </p>
    <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Formation</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');


if(isset($lidenformation)) {
	echo form_open('espaceadmin/retourformation/'.$agent->idagent);
} elseif(isset($lidprolonger)) {
	echo form_open('espaceadmin/prolongerformation/'.$agent->idagent);
} else {
	echo form_open('espaceadmin/enformation/'.$agent->idagent);
}

  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
            <input type="hidden" class="form-control" id="IDenformation" name="IDenformation"   <?php   if(isset($lidenformation) || isset($lidprolonger)) {echo 'value="'.$enformation['IDenformation'].'"';} ?> >
            
             <label for="Idagent">Agent</label>
                <select id="Idagent" name="Idagent" class="form-control">
                
                  <?php 
				   
				   if(isset($lidenformation) || isset($lidprolonger)) {
				  	$query = $db->query('SELECT idagent, matricule, nom from agent where idagent='.$enformation['Idagent']); }
					
					 if(isset($lidagent)) {
				  	$query = $db->query('SELECT idagent, matricule, nom from agent where idagent='.$agent->idagent); }
					
					$results = $query->getResult();

					foreach ($results as $row)
					{
echo ' <option value="'.$row->idagent.'">'.$row->matricule.' - '.$row->nom.'</option>';		
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-6">
            <?php 
            if (isset($enformation['Intitule'])) {
              echo $enformation['Intitule'];
            }
            ?>

              <label for="total">Intitulé de la formation</label>
              <input type="text" class="form-control" id="Intitule" name="Intitule"  placeholder="Intitule formation" required="required" <?php  if(isset($enformation)) { echo 'value="'.$enformation['Intitule'].'"';} ?> <?php  if(isset($lidprolonger)) { echo 'readonly="readonly"';} ?> >
            </div>
            
             
          </div>
          
          
          
           <div class="form-row">
                <div class="form-group col-md-4">
                   <label for="datedepart">Date depart</label>
                  <input type="date" class="form-control" id="datedepart" name="datedepart"  placeholder="Depart" required="required" <?php   if(isset($lidenformation)) {echo 'value="'.$enformation['datedepart'].'"';} ?>  <?php  if(isset($lidprolonger)) { echo 'value="'.$enformation['datedepart'].'" '; echo 'readonly="readonly"';} ?>>
                </div>
                 <div class="form-group col-md-4">
                   <label for="datereprise">Date reprise</label>
                  <input type="date" class="form-control" id="datereprise"  name="datereprise"  placeholder="datereprise" <?php   if(isset($lidenformation) || isset($lidprolonger)) {echo 'value="'.$enformation['datereprise'].'" ';} else {echo 'readonly="readonly"'; } ?>>
                </div>
                <div class="form-group col-md-4">
                   <label for="daterepriseeffective">Date reprise effective</label>
                   <input type="date" class="form-control" onclick="" id="daterepriseeffective" name="daterepriseeffective" <?php   if(isset($lidenformation)) {echo 'value="'.$enformation['daterepriseeffective'].'"';} else {echo 'readonly="readonly"';} ?> <?php  if(isset($lidprolonger)) { echo 'readonly="readonly"';} ?>>
                </div>
            
          </div>

           <div class="form-row">
            <div class="form-group col-md-6">
               <label for="details">Détails</label>
              <input type="text" class="form-control" id="details" name="details"  placeholder="Details" <?php   if(isset($lidenformation)) {echo 'value="'.$enformation['details'].'"';} ?>  <?php  if(isset($lidprolonger)) {echo 'value="'.$enformation['details'].'" '; echo 'readonly="readonly"';} ?> >
            </div>

          </div>
          
          
          
            <div class="form-row">
          <!--  <div class="form-group col-md-3">
               <input class="form-check-input" type="checkbox" id="hp" name="hp">
                  <label class="form-check-label" for="hp"> Hors du pays ? </label>
            </div>
            <div class="form-group col-md-4">
              <label for="justificatif2">justificatif 2</label>
    <input type="file" class="form-control-file" id="justificatif2" name="justificatif2">
            </div> -->
             <div class="form-group col-md-12">
               <button type="submit" name="go" value="go" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>          </div>
          </div>
          
          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->