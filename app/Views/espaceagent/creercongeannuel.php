<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	if(isset($lidcongeannuel)) {
		$query = $db->query("SELECT * from congeannuel where IDconge=$lidcongeannuel"); 
		$congeannuel = $query->getRow();
		//print_r($direction);
	}
		$ddeb = "";
	$dfin = "";
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Configuration > Congé annuel</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Congé annuel.
   
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Congé annuel</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
if(isset($lidcongeannuel)) {
	echo form_open('espaceagent/editcongeannuel/'.$lidcongeannuel);
} else {
	echo form_open('espaceagent/creercongeannuel');
}



?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
            
               <input type="hidden" class="form-control" id="IDconge" name="IDconge"   <?php   if(isset($lidcongeannuel)) {echo 'value="'.$congeannuel->IDconge.'"';} ?> >
            
             <label for="IDagent">Agent *</label>
                <select id="Idagent" name="Idagent" class="form-control">
                 
                  <?php 
				   $db = \Config\Database::connect();
				  	$query = $db->query('SELECT idagent, matricule, nom from agent where idagent='.$_SESSION['cnxid']); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

			if(isset($lidcongeannuel)) {
	if($congeannuel->Idagent == $row->idagent) {
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
              <label for="IDplancongeannuel">Plan congés annuels *</label>
                <select id="IDplancongeannuel" name="IDplancongeannuel" class="form-control" onchange="plancongeannuel();">
                 
                  <?php 
				   $db = \Config\Database::connect();
				  	$query = $db->query('SELECT * from plancongeannuel'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{
						$ddeb = $row->pdebut;
	$dfin = $row->pfin;

				if(isset($lidcongeannuel)) {
	if($congeannuel->IDplancongeannuel == $row->IDplancongeannuel) {	
echo ' <option value="'.$row->IDplancongeannuel.'" selected>'.$row->libelle.'</option>';		
			
	} else { 
echo ' <option value="'.$row->IDplancongeannuel.'">'.$row->libelle.'</option>';		
		 }

} else {
			echo ' <option value="'.$row->IDplancongeannuel.'">'.$row->libelle.'</option>';							
}			
					}
					
					?>
            		
                </select>
              
            </div>
            
             
          </div>
          
          
          
          <div class="form-row">
            <div class="form-group col-md-6">
               <label for="datedepart">Date de départ souhaitée </label>
               <!-- <input type="date" id="datedepart" name="datedepart"   min="2022-07-16" max='2022-07-19'> -->
              <input type="date" class="form-control" id="datedepart" name="datedepart"  min="<?php //echo $ddeb; ?>" max="<?php //echo $dfin; ?>" <?php   if(isset($lidcongeannuel)) {echo 'value="'.$congeannuel->datedepart.'"';} ?>>
            </div>
          <!--  <div class="form-group col-md-4">
               <label for="datereprise">Date reprise</label>
              <input type="date" class="form-control" id="datereprise" name="datereprise"  placeholder="datereprise" <?php   //if(isset($lidcongeannuel)) {echo 'value="'.$congeannuel->datereprise.'"';} ?>>
            </div>
             <div class="form-group col-md-4">
               <label for="duree">Durée</label>
              <input type="text" class="form-control" id="duree" name="duree"  placeholder="duree" <?php   //if(isset($lidcongeannuel)) {echo 'value="'.$congeannuel->duree.'"';} ?>>
            </div>  -->
            
             <div class="form-group col-md-6">
               <label for="duree">Nombre de jours</label>
                   <select id="duree" name="duree" class="form-control">
					   <?php
                       for($i=1; $i<=30; $i++) {
                           if(isset($lidcongeannuel)) {
                               if($congeannuel->duree == $i) {
                                   echo ' <option value="'.$i.'" selected="selected">'.$i.' JOURS</option>';
                               } else {
                                   echo ' <option value="'.$i.'">'.$i.' JOURS</option>';
                               }
    
                             } else echo ' <option value="'.$i.'">'.$i.' JOURS</option>'; 
                       }				   
                       ?>
                   </select>
            </div> 
            
            
          </div>
          
          
           <div class="form-row">
            <div class="form-group col-md-4">
              <label for="lieu">Lieu</label>
              <input type="text" class="form-control" id="lieu" name="lieu"  placeholder="lieu" <?php   if(isset($lidcongeannuel)) {echo 'value="'.$congeannuel->lieu.'"';} ?>>
            </div>
            <div class="form-group col-md-4">
              <label for="adresse">Adresse</label>
              <input type="text" class="form-control" id="adresse" name="adresse"  placeholder="adresse" <?php   if(isset($lidcongeannuel)) {echo 'value="'.$congeannuel->adresse.'"';} ?>>
            </div>
             <div class="form-group col-md-4">
               <label for="telephone">Contacts</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="+225070501070501" <?php   if(isset($lidcongeannuel)) {echo 'value="'.$congeannuel->telephone.'"';} ?>>
            </div>
          </div>
          
            <div class="form-row">
            <div class="form-group col-md-3">
               <label for="hp">Hors du pays ?</label>
                <select id="hp" name="hp" class="form-control">
                  <option value="1" <?php  echo ($congeannuel->horspays==1)?('selected'):(''); ?>>OUI</option>
                  <option value="0" <?php  echo ($congeannuel->horspays==0)?('selected'):(''); ?>>NON</option>
                </select>
            </div>
            <!--<div class="form-group col-md-4">
              <label for="justificatif2">justificatif 2</label>
    <input type="file" class="form-control-file" id="justificatif2" name="justificatif2">
            </div> -->
             <div class="form-group col-md-9">
              <button type="submit" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>          </div>
          </div>
          
          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">
  function plancongeannuel() {
    var id=$('#IDplancongeannuel'.val();
    $.ajax({
          type:"POST",
          url: "<?php echo site_url('espaceagent/fetchcongeannuel'); ?>",
          data: {"id":id},
          dataType:"JSON",
          success: function(response){
            $("#datedepart".attr("min", response.pdebut);
            $("#datedepart".attr("max", response.pfin);
          },
          error:function(error){
        console.log(error)
          }
      });
  }
</script>