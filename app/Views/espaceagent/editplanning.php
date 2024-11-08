<!-- Begin Page Content -->
<?php
//print_r($_POST);
$db = \Config\Database::connect();


$myid = $_SESSION['cnxid'];
$query   = $db->query('SELECT *, (select libelle from planpermanence where planpermanence.IDplanpermanence=agentplanpermanence.IDplanpermanence) as plan, (select libelle from jourplan where jourplan.IDjourplan=agentplanpermanence.IDjourplan) as jour from agentplanpermanence where IDagent ='.$myid.' and idagentplanpermanence='.$lid);
$leplan   = $query->getRow();


?>
<div class="container-fluid"> 
  
  <!-- Page Heading -->
   <h1 class="h3 mb-2 text-primary">Planification > Planning agent</h1>
  <p class="mb-4">Manipulez toutes les données relatives au Planning agent.
   
  </p>
   <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3 border-left-warning">
          <h6 class="m-0 font-weight-bold text-primary">Modifier planning agent</h6>
        </div>
        <div class="card-body">
          <?php

helper('form');
echo form_open('espaceagent/editplanning/'.$lid);
  
?>
          <!---- <form> ----->
          <div class="form-row">
            <div class="form-group col-md-4">
            <input type="hidden" class="form-control" id="idagentplanpermanence" name="idagentplanpermanence"  value="<?php echo $lid;  ?>">
            
             <label for="IDagent">Agent</label>
                <select id="Idagent" name="Idagent" class="form-control">
                  
                  <?php 
				   
				   $myid = $_SESSION['cnxid'];
				  $query   = $db->query('SELECT idagent, matricule, nom FROM agent where agent.idagent='.$myid.'');
					$results = $query->getRow();

			echo ' <option value="'.$results->idagent.'">'.$results->matricule.' - '.$results->nom.'</option>';			
			
					
					?>
            		
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="IDplanpermanence">Plan permanence</label>
                <select id="IDplanpermanence" name="IDplanpermanence" class="form-control">
                
                  <?php 
				  
	$query   = $db->query('SELECT * FROM planpermanence WHERE IDplanpermanence='.$leplan->IDplanpermanence.'');
	$results = $query->getRow();
				

			echo ' <option value="'.$results->IDplanpermanence.'">'.$results->libelle.'</option>';		
					
					?>
            		
                </select>
              
            </div>
            
            
            <div class="form-group col-md-4">
             <label for="IDjourplan">Jour plan</label>
                <select id="IDjourplan" name="IDjourplan" class="form-control">
                  
                  <?php 
				//   $db = \Config\Database::connect();
				   
				  
	$query   = $db->query('SELECT * FROM jourplan WHERE IDjourplan='.$leplan->IDjourplan);
	
	$results = $query->getResult();
					foreach ($results as $row)
					{
						if($row->jour < 10)
						$jjj = '0'.$row->jour;
						else
						$jjj = $row->jour;

			echo ' <option value="'.$row->IDjourplan.'">'.$jjj.' / '.$row->mois.' / '.$row->annee.' ('.$row->libelle.')</option>';			
					}
					
					?>
            		
                </select>
              <?php // echo "SELECT * FROM jourplan WHERE datejourplan like '%$ddd%'"; ?>
              
              </div>
            
             
          </div>
          
          
          
         
          
        
          
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="justificatif">Jour souhaité et justificatif *</label>
                <input type="text" class="form-control" id="justificatif" name="justificatif"  placeholder="le 04/04/2021 car retour de maladie" required>
              </div>
  
              <div class="form-group col-md-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="width:100%; height:100%">Valider formulaire</button>          </div>
              </div>
            </div>
      </div>
      
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->