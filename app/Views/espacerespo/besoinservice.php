<!-- Begin Page Content -->
<?php

	$db = \Config\Database::connect();
	if(isset($lidbesoinservice)) {
		$query = $db->query("SELECT * from besoinservice where IDbesoinservice=$lidbesoinservice"); 
		$besoinservice = $query->getRow();
	   //	print_r($besoinservice);
	}
?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Employés > Besoins en agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier des besoins.
   
  </p>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Besoins agents</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');


if(isset($lidbesoinservice)) {
	echo form_open('espacerespo/editbesoinservice/'.$lidbesoinservice);
} else {
	echo form_open('espacerespo/besoinservice');
}
  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-4">
            <input type="hidden" class="form-control" id="IDbesoinservice" name="IDbesoinservice"   <?php   if(isset($lidbesoinservice)) {echo 'value="'.$besoinservice->IDbesoinservice.'"';} ?> >
            
             <label for="IDservice">Service</label>
                <select id="IDservice" name="IDservice" class="form-control">
                
                  <?php 
				   
				  	$query = $db->query('SELECT * from service where chefservice='.$_SESSION['cnxid']); 
					$results = $query->getResult();

					foreach ($results as $row)
					{
			if(isset($lidbesoinservice)) {
	if($besoinservice->IDservice == $row->IDservice) {
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
            <div class="form-group col-md-4">
              <label for="IDposte">Poste</label>
                <select id="IDposte" name="IDposte" class="form-control">
           
                  <?php 

				  	$query = $db->query('SELECT *  from lafonction'); 
					$results = $query->getResult();

					foreach ($results as $row)
					{

				
			
			if(isset($lidbesoinservice)) {
	if($besoinservice->IDposte == $row->IDlafonction) {

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
            <div class="form-group col-md-4">
               <label for="total">Besoin</label>
              <input type="numeric" class="form-control" id="total" name="total"  placeholder="total" required="required" <?php   if(isset($lidbesoinservice)) {echo 'value="'.$besoinservice->total.'"';} ?>>
            </div>
             
          </div>
          
          
          
           <div class="form-row">
            
            <div class="form-group col-md-12">
               <label for="justificatif">Justificatif</label>
               <textarea rows="2" class="form-control" id="justificatif" name="justificatif"  placeholder="Justifiez votre besoin ici" > <?php   if(isset($lidbesoinservice)) {echo $besoinservice->justificatif;} ?></textarea>
             
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
              <button type="submit" class="btn btn-primary" style="width:100%">Valider formulaire</button>          </div>
          </div>
          
          
          
          
          
          
        </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->