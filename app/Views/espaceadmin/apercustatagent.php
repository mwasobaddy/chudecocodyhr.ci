
 <?php
				$db = \Config\Database::connect();
				//$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from genre where genre.IDgenre=agent.IDgenre) as llgenre, (select libelle from grade where grade.IDgrade=agent.IDgrade) as llgrade, (select libelle from lafonction where lafonction.IDlafonction=agent.IDlafonction) as llfonction, (select libelle from contrat where contrat.IDcontrat=agent.IDcontrat) as llcontrat,  (select libelle from civilite where civilite.IDcivilite=agent.IDcivilite) as llcivilite, (select libelle from direction where direction.IDdirection=agent.IDdirection) as lldirection, (select libelle from sousdirection where sousdirection.IDsousdirection=agent.IDsousdirection) as llsousdirection FROM agent where (agent.alaretraite is null or agent.alaretraite=0) and (agent.quitterchu is null or agent.quitterchu=0) order by nom asc');

			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from genre where genre.IDgenre=agent.IDgenre) as llgenre, (select libelle from grade where grade.IDgrade=agent.IDgrade) as llgrade, (select libelle from lafonction where lafonction.IDlafonction=agent.IDlafonction) as llfonction, (select libelle from contrat where contrat.IDcontrat=agent.IDcontrat) as llcontrat,  (select libelle from civilite where civilite.IDcivilite=agent.IDcivilite) as llcivilite, (select libelle from direction where direction.IDdirection=agent.IDdirection) as lldirection, (select libelle from sousdirection where sousdirection.IDsousdirection=agent.IDsousdirection) as llsousdirection FROM agent order by nom asc');
			$agent = $query->getResultArray();

			?>
<!-- Begin Page Content -->

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
										echo '<tr>

                                            <td>'.$info['nom'].'</td>
                                            <td>'.$info['datenais'].'</td>
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
