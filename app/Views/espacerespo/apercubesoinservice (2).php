<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	if(isset($lidposteservice)) {
		$query = $db->query("SELECT * from poste_service where IDposteservice=$lidposteservice"); 
		$posteservice = $query->getRow();
		print_r($posteservice);
	}
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Codification des postes > Poste > Service</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Poste_service.
   
  </p>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Poste_service</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');


if(isset($lidposteservice)) {
	echo form_open('espacerespo/editposteservice/'.$lidposteservice);
} else {
	echo form_open('espacerespo/posteservice');
}
  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-6">
            <input type="hidden" class="form-control" id="IDposteservice" name="IDposteservice"   <?php   if(isset($lidposteservice)) {echo 'value="'.$posteservice->IDposteservice.'"';} ?> >
            
             <label for="IDservice">Service</label>
                <select id="IDservice" name="IDservice" class="form-control">
                
                  <?php 
				   
				  	$query = $db->query('SELECT * from service'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{
			if(isset($lidposteservice)) {
	if($posteservice->IDservice == $row->IDservice) {
echo ' <option value="'.$row->IDservice.'" selected>'.$row->libelle.'</option>';				
	} else { 
echo ' <option value="'.$row->IDservice.'">'.$row->libelle.'</option>';	
		 }

} else {
			echo ' <option value="'.$row->IDservice.'">'.$row->libelle.'</option>';					
}
					}
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-6">
              <label for="IDposte">Poste</label>
                <select id="IDposte" name="IDposte" class="form-control">
           
                  <?php 

				  	$query = $db->query('SELECT *  from lafonction'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

				
			
			if(isset($lidposteservice)) {
	if($posteservice->IDposte == $row->IDlafonction) {

echo ' <option value="'.$row->IDlafonction.'" selected>'.$row->libelle.'</option>';				
	} else { 
echo ' <option value="'.$row->IDlafonction.'">'.$row->libelle.'</option>';		
		 }

} else {
			echo ' <option value="'.$row->IDlafonction.'">'.$row->libelle.'</option>';	
}
				
					}
					
					?>
            		
                </select>
              
            </div>
            
             
          </div>
          
          
          
           <div class="form-row">
            <div class="form-group col-md-4">
               <label for="total">Total</label>
              <input type="text" class="form-control" id="total" name="total"  placeholder="total" required="required" <?php   if(isset($lidposteservice)) {echo 'value="'.$posteservice->total.'"';} ?>>
            </div>
            <div class="form-group col-md-8">
               <label for="Observations">Details</label>
              <input type="text" class="form-control" id="Observations" name="Observations"  placeholder="Details" <?php   if(isset($lidposteservice)) {echo 'value="'.$posteservice->Observations.'"';} ?>>
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
              <button type="submit" class="btn btn-primary">Valider formulaire</button>          </div>
          </div>
          
          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->