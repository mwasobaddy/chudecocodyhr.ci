<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	if(isset($lidpostedirection)) {
		$query = $db->query("SELECT * from poste_direction where IDpostedirection=$lidpostedirection"); 
		$postedirection = $query->getRow();
		//print_r($postedirection);
		
		//echo "SELECT * from postedirection where IDpostedirection=$lidpostedirection";
	}
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Codification des postes -> Poste<->Direction</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Poste_Direction.
   
  </p>
    <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Poste_Direction</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');


if(isset($lidpostedirection)) {
	echo form_open('espaceadmin/editpostedirection/'.$lidpostedirection);
} else {
	echo form_open('espaceadmin/postedirection');
}
  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
            <input type="hidden" class="form-control" id="IDpostedirection" name="IDpostedirection"   <?php   if(isset($lidpostedirection)) {echo 'value="'.$postedirection->IDpostedirection.'"';} ?> >
            
             <label for="IDdirection">Direction</label>
                <select id="IDdirection" name="IDdirection" class="form-control">
                
                  <?php 
				   
				  	$query = $db->query('SELECT * from direction'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{
			if(isset($lidpostedirection)) {
	if($postedirection->IDdirection == $row->IDdirection) {
echo ' <option value="'.$row->IDdirection.'" selected>'.$row->libelle.'</option>';	
				
	} else { 
echo ' <option value="'.$row->IDdirection.'">'.$row->libelle.'</option>';	
		 }

} else {
			echo ' <option value="'.$row->IDdirection.'">'.$row->libelle.'</option>';						
}
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-6">
              <label for="IDposte">Poste</label>
                <select id="IDposte" name="IDposte" class="form-control">
           
                  <?php 

				  	$query = $db->query('SELECT * from emploi'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

			if(isset($lidpostedirection)) {
	if($postedirection->IDposte == $row->IDemploi) {
echo ' <option value="'.$row->IDemploi.'" selected>'.$row->libelle.'</option>';					
	} else { 
echo ' <option value="'.$row->IDemploi.'">'.$row->libelle.'</option>';		
		 }

} else {
			echo ' <option value="'.$row->IDemploi.'">'.$row->libelle.'</option>';						
}
			
					
					}
					
					?>
            		
                </select>
              
            </div>
            
             
          </div>
          
          
          
           <div class="form-row">
            <div class="form-group col-md-4">
               <label for="total">Total</label>
              <input type="text" class="form-control" id="total" name="total"  placeholder="total" required="required" <?php   if(isset($lidpostedirection)) {echo 'value="'.$postedirection->total.'"';} ?>>
            </div>
            <div class="form-group col-md-8">
               <label for="Observations">Details</label>
              <input type="text" class="form-control" id="Observations" name="Observations"  placeholder="Details" <?php   if(isset($lidpostedirection)) {echo 'value="'.$postedirection->Observations.'"';} ?>>
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