<?php

	$db = \Config\Database::connect();
	if(isset($lidequipe)) {
		$query = $db->query("SELECT * from equipe where IDequipe=$lidequipe"); 
		$equipe = $query->getRow();
	}
	$myid = $_SESSION['cnxid'];
	
	$_SESSION['lastid'] = $lidequipe;

?>

<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Planification -> Equipe</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Equipe.
  
  </p>
    <?php
echo view('toast');
 ?>
  
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Equipe</h6>
        </div>
        <div class="card-body">

 <?php
helper('form');

	echo form_open('espacerespo/addagentequipe/'.$lidequipe);

?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-12">
               <input type="hidden" class="form-control" id="IDequipe" name="IDequipe"   <?php   if(isset($lidequipe)) {echo 'value="'.$equipe->IDequipe.'"';} ?> >
           
           
           
            <label for="IDequipe">Equipe </label>
                <select id="IDequipe" name="IDequipe" class="form-control">
                
                  <?php 
				  
				  /* if(isset($lidequipe)) {
					   $query = $db->query('SELECT * from service where service.IDservice='.$equipe->IDservice); 
				   } else {*/
					   $query = $db->query('SELECT * from equipe where equipe.IDequipe='.$equipe->IDequipe); 
				  // }
				  	
					$results = $query->getResult();

					foreach ($results as $row)
					{
			if(isset($lidequipe)) {
	if($equipe->IDequipe == $row->IDequipe) {
echo ' <option value="'.$row->IDequipe.'" selected>'.$row->libelle.'</option>';				
	} else { 
echo ' <option value="'.$row->IDequipe.'">'.$row->libelle.'</option>';	
		 }

} else {
			echo ' <option value="'.$row->IDequipe.'">'.$row->libelle.'</option>';					
}
					}
					
					?>
            		
                </select>
             
              
            </div>
            
            
   
            
            
          </div>
          
          
           <div class="form-row">
           
            <div class="form-group col-md-12">
            <p>Veuillez selectionner les agents à ajouter à l'équipe</p>
            <table border="1" style="width:100%; border:thin">
            
            
            <?php
			
			 $query = $db->query('SELECT * from agent where idagent='.$myid.' or agent.Responsablen1='.$myid.' or agent.Responsablen2='.$myid.' or agent.Sousdrh='.$myid.' order by nom'); 
				  // }
	

			$results = $query->getResult();
			$cpt = 0;
					foreach ($results as $row)
					{
						$cpt++;
						if(($cpt%3)==1) {echo '<tr>'; $cpp = 0;}
						//echo '<td> <input name="agent[]" type="checkbox"  value="'.$row->idagent.'"> '.$row->matricule.' - '.$row->nom.'</td>';
						
						echo '<td> <input name="agent[]" type="checkbox"  value="'.$row->idagent.'"> '.$row->nom.'</td>';
						$cpp ++;
						if(($cpt%3)==0) {echo '</tr>';}
					}
					if($cpp==1) {
						echo '<td> </td><td> </td></tr>';
					}
					if($cpp==2) {
						echo '<td> </td></tr>';
					}
			
			?>
            </table>
            <br/>
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