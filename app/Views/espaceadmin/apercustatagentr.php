
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-primary">Module employés > liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>
    <?php
      echo view('toast');
    ?>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-left-warning">
      <?php

        helper('form');

        echo form_open('espaceadmin/statagentr');


      ?>
    <div class="form-row">
      <div class="form-group col-md-4">Année de départ : 
        <select name="deb">
          <?php
            $ann = date('Y');
            for($i=-2; $i<=10; $i++) {
              echo '<option>'.($ann+$i).'</option>';
            }
          ?>
        </select>
      </div>
      <div class="form-group col-md-4">Année de fin : 
        <select name="fin">
          <?php
            $ann = date('Y');
            for($i=-2; $i<=10; $i++) {
              echo '<option>'.($ann+$i).'</option>';
            }
            
            
          ?>
        </select>
        </form>
      </div>
      <div class="form-group col-md-4">
        <button type="submit" name="go" value="go" class="btn btn-primary" style="width:100%; height:100%">Valider</button>
      </div>
    </div>
    <table style="width:100%">
      <tr>
        <td><h6 class="m-0 font-weight-bold text-primary text-left">Liste des agents</h6></td>
        <td></td>
      </tr>
    </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataT" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th>Nom et prénoms</th>
              <th>Date naissance</th>
              <th>L'Age</th>
              <th>Genre</th>
              <th>Emploi</th>
              <th>Grade</th>
              <th>Fonction</th>
              <th>PS CHU</th>
              <th>PS FP</th>
              <th>Contrat</th>
              <th>Direction</th>
              <th>Sous-Direction</th>
              <th>Service</th>
              <th>Formation</th>
              <th>Départ CHU</th>
              <th>Position</th>
              <th>Retraité</th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nom et prénoms</th>
              <th>Date naissance</th>
              <th>L'Age</th>
              <th>Genre</th>
              <th>Emploi</th>
              <th>Grade</th>
              <th>Fonction</th>
              <th>PS CHU</th>
              <th>PS FP</th>
              <th>Contrat</th>
              <th>Direction</th>
              <th>Sous-Direction</th>
              <th>Service</th>
              <th>Formation</th>
              <th>Départ CHU</th>
               <th>Position</th>
              <th>Retraité</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (! empty($agent) && is_array($agent)) : ?>
            <?php foreach ($agent as $info): ?>
            <?php
              $ff = ($info['enformation'])?('OUI'):('NON');
              $dd = ($info['quitterchu'])?('OUI'):('NON');
              $rr = ($info['alaretraite'])?('OUI'):('NON');
              //$dis = ($info['disponibilite'])?('OUI'):('NON');
              
              // Assuming $info['datenais'] is in 'Y-m-d' format
              $dob = new DateTime($info['datenais']);
              $now = new DateTime();
              $age = $now->diff($dob)->y;
              
              echo '
                <tr>
                  <td>'.$info['nom'].'</td>
                  <td>'.$info['datenais'].'</td>
                  <td>'.$age.'</td>
                  <td style="width:10px;">'.$info['llgenre'].'</td>
                  <td>'.$info['llemploi'].'</td>
                  <td>'.$info['llgrade'].'</td>
                  <td>'.$info['llfonction'].'</td>
                  <td>'.$info['pschu'].'</td>
                  <td>'.$info['psfp'].'</td>
                  <td>'.$info['llcontrat'].'</td>
                  <td>'.$info['lldirection'].'</td>
                  <td>'.$info['llsousdirection'].'</td>
                  <td>'.$info['llservice'].'</td>
                  <td>'.$ff.'</td>
                  <td>'.$dd.'</td>
                  <td>'.$info['position'].'</td>
                  <td>'.$rr.'</td>
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

	$('#dataT tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Filtrer" />' );
    } );

	$('#dataT').DataTable( {
initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        },
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]


    });

} );

	</script>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
