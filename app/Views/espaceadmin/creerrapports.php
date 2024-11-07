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
  <h1 class="h3 mb-2 text-primary">Configuration > Congé de</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier Congé de.

  </p>
     <?php
echo view('toast');
 ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12">
      
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Fiche Congé de</h6>
        </div>
        <div class="card-body">
          
          <!---- <form> ----->
          <form action="<?php base_url('/espaceagent/rapports')?>" method="post">
            <div class="row">
              <div class="form-group col-md-3">
               <label for="dateterme">Date</label>
                <input type="date" class="form-control" id="dateterme" name="dateterme" placeholder="datedemande" required="required">
              </div>
              <div class="form-group col-md-3">
                <label for="datereprise">To Date</label>
               <input type="date" class="form-control"  id="datereprise" name="datereprise" required="required">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">
               <button  type="submit"  class="btn btn-primary" style="width:100%; height:100%">Search</button>          
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Begin Page Content -->

<div class="container-fluid"> 
  <!-- Page Heading 
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des Congés </h6></td>
          
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Date_départ</th>
              <th>Date_reprise</th>
              <th>Durée</th>
              <th>Etat</th>
              
            </tr>
          </thead>
          <tfoot>
            <tr>
               <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Date_départ</th>
              <th>Date_reprise</th>
              <th>Durée</th>
              <th>Etat</th>
             
            </tr>
          </tfoot>
          <tbody>
            <?php
            $i=1;
            foreach ($reports as  $info) {
                $query = $db->query('SELECT IDagent, matricule, nom from agent where IDagent='.$info->IDconge);
                $row   = $query->getRow();
                if(!empty($row)){             
                  echo '<tr>
                  <td>'.$i++.'</td>';
                  echo '<td>'.$row->matricule.'</td>';
                  echo '<td>'.$row->nom.'</td>';
                  echo '<td>'.$info->datedepart.'</td>
                        <td>'.$info->datereprise.'</td>
                        <td>'.$info->duree.'</td>
                        <td>'.$info->etat.'</td>
                      </tr>';
                }
            }
              
          ?>
          </tbody>
          
        </table>
        <script type="text/javascript">
          $(document).ready(function() {
          $('#dataTable').DataTable( {
            stateSave: true,
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          } );
        } );
  </script> 
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



  <script type="text/javascript">
  function findrec() {
    var Idagent =$("#Idagent").val();
    var dateterme =$("#dateterme").val();
    var datereprise =$("#datereprise").val();
    
    $.ajax({
          type:"POST",
          url: "<?php echo site_url('espaceadmin/recreporleave'); ?>",
          data: {
            'Idagent': Idagent,
            'dateterme': dateterme,
            'datereprise': datereprise,
          },
          dataType:"JSON",
          success: function(response){
           console.log(response);
          },
          error:function(error){
        console.log(error)
          }
      });
  }
</script>