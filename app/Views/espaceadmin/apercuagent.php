
 <?php
				$db = \Config\Database::connect();

			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) order by nom asc');
			$agent = $query->getResultArray();
			
			
			
			
			?>
<!-- Begin Page Content -->

<div class="container-fluid"> 
  
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
  <?php
if (isset($toast) && isset($_POST['go']) && !empty($_POST['go'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">  
	   '.$toast.' 
    </div>';
}
if (isset($_SESSION['toast']) && !empty($_SESSION['toast'])) {
   echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert" style="color: #0f6848; background-color: #d2f4e8; border-color: #bff0de;
">  
	   '.$_SESSION['toast'].' 
    </div>';
	unset($_SESSION['toast']);
} ?>
  <style type="text/css">
    input {
     padding: 20px;
     user-select: none;
     height: 50px;
     width: 400px;
     border-radius: 6px;
     border: none;
     border: 2px solid #8d0cf7;
     outline: none;
     font-size: 22px;
     }

    input::placeholder{
      font-size: 23px;
     }
     #button {
        font-family: sans-serif;
        font-size: 15px;
        margin-top: 40px;
        border: 2px solid #7100cf;
        width: 155px;
        height: 50px;
        text-align: center;
        background-color: #7100cf;
        display: flex;
        color: rgb(255, 255, 255);
        justify-content: center;
        align-items: center;
        cursor: pointer;
        border-radius: 5px;  
      }

       .btn2{
         margin-left: 85px
       }

      #button:hover {
        color: white;
        background-color: black;
      }
  </style>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <table style="width:100%">
        <tr>
          <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des agents</h6></td>
          <td><p class="text-right font-weight-bold text-primary"> <a href="<?php echo base_url('/espaceadmin/creeragent');?>" class="btn btn-primary btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Ajouter un nouvel agent</span> </a> </p></td>
        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataT" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Contact</th>
              <th>Emploi</th>
              <th>Service</th>
              <th style="width:65px;">Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Contact</th>
              <th>Emploi</th>
              <th>Service</th>
              <th style="width:65px;">Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (! empty($agent) && is_array($agent)) : ?>
            <?php foreach ($agent as $info): ?>
            <?php 
              echo '
                <tr>
                  <td>'.$info['matricule'].'</td>
                  <td>'.$info['nom'].'</td>
                  <td>'.$info['mobile'].'</td>
                  <td>'.$info['llemploi'].'</td>

                  <td>'.$info['llservice'].'</td>
                  <td style="text-align:center;">
                    '.anchor('espaceadmin/ficheagent/'.$info['idagent'],'<span class="btn btn-success mb-2"><i class="m-0 fas fa-eye" title="Voir fiche"></i></span>').'
                    '.anchor('espaceadmin/delagent/'.$info['idagent'],'<span class="btn btn-danger mb-2"><i class="m-0 fas fa-trash" title="Désactiver agent"></i></span>').'
                    '.'<a href="JavaScript:;" data-val="'.$info['idagent'].'" data-toggle="modal" data-target="#passwordModal"><span class="btn btn-primary"><i class="m-0 fas fa-key" title="Créer un mot de passe"></i></span></a>'.'
                  </td>
                </tr>
							';
            ?>
            <?php endforeach; ?>
            <?php else : ?>
          <h3>Rien à afficher</h3>
          <p>Pas de nouveaux agents à afficher.</p>
          <?php endif ?>
          </tbody>
          
        </table>
        <script type="text/javascript">
	

$(document).ready(function() {
	$('#dataT').DataTable( {
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

<!-- Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php
        helper('form');
        echo form_open('espaceadmin/savepassword');
      ?>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Créer un mot de passe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="agentid" id="agentid" />
          <input type="text" name="password" placeholder="Create password" id="password" required />
          <table>
             <th><div> <a href="Javascript:;" id="generatepassword" class="btn1"onclick="genPassword()">Generate</a></div></th>
             <th><a href="Javascript:;" id="copypassword" class="btn2" onclick="copyPassword()">Copy</a></th>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#passwordModal').on('show.bs.modal', function (event) {
    var myVal = $(event.relatedTarget).data('val');
    $(this).find("#agentid").val(myVal);
  });

  var password=document.getElementById("password");
  function genPassword() {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 8;
    var password = "";
    for (var i = 0; i <= passwordLength; i++) {
      var randomNumber = Math.floor(Math.random() * chars.length);
      password += chars.substring(randomNumber, randomNumber +1);
    }
    document.getElementById("password").value = password;
  }
  function copyPassword() {
    var copyText = document.getElementById("password");
    copyText.select();
    document.execCommand("copy"); 
  }
</script>