<?php
$db = \Config\Database::connect();
$myid = $_SESSION['cnxid'];


$query   = $db->query('SELECT * from congeannuel where etat!= \'REJET\' ORDER BY IDconge DESC');

// 
// print_r($myid);

$congeannuel = $query->getResultArray();

// print_r($congeannuel);
// exit;

?>




<!-- Begin Page Content -->

<div class="container-fluid">

  <!-- Page Heading 
  <h1 class="h3 mb-2 text-gray-800">Module employés -> liste des agents</h1>
  <p class="mb-4">Manipulez toutes les données relatives au fichier agent.</p>-->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <table style="width:100%">
        <tr>
          <td>
            <h6 class="m-0 font-weight-bold text-primary text-left">Liste des Congés annuels</h6>
          </td>

        </tr>
      </table>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th data-orderable="false"><input id="selectAll" type="checkbox"></th>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Service</th>
              <th>Planning congés</th>
              <th>Date départ</th>
              <th>Date reprise</th>

              <th>Etat</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th data-orderable="false"><input id="selectAll" type="checkbox"></th>
              <th>No.</th>
              <th>Matricule</th>
              <th>Nom et prénoms</th>
              <th>Service</th>
              <th>Planning congés</th>
              <th>Date départ</th>
              <th>Date reprise</th>

              <th>Etat</th>
              <th>Actions</th>

            </tr>
          </tfoot>
          <tbody>
            <?php
            $db = \Config\Database::connect();
            $i = 1;
            //print_r($congeannuel);
            if (!empty($congeannuel) && is_array($congeannuel)) :
            ?>
              <?php foreach ($congeannuel as $info) : ?>
                <?php
                echo '<tr>';
                echo '<td><input class="chk" type="checkbox" name="chk[]" value="' . $info['IDconge'] . '" /></td>';
                echo '<td>' . ($i++) . ' </td>';

                $query2 = $db->query('SELECT idagent, matricule, nom, IDservice, Responsablen1, Responsablen2 from agent where idagent=' . $info['Idagent']);
                $roww   = $query2->getRow();

                echo '<td>' . (isset($roww->matricule) ? $roww->matricule : '') . '</td>';
                echo '<td>' . (isset($roww->nom) ? $roww->nom : '') . '</td>';

              //Param Code Change Start
              // Assuming $roww->IDservice might also be null, checking its existence
$leservice = isset($roww->IDservice) ? $roww->IDservice : null;

// Check if $leservice is not null before querying
if ($leservice) {
    $query3 = $db->table('service')->select('libelle')->getWhere(['IDservice' => $leservice]);
    $rowq = $query3->getRow();
    echo '<td>' . (isset($rowq->libelle) ? $rowq->libelle : '') . '</td>';
} else {
    echo '<td></td>'; // Handle case where $leservice is null
}

// Check if $info['IDplancongeannuel'] exists and is valid before querying
$planCongeID = isset($info['IDplancongeannuel']) ? $info['IDplancongeannuel'] : null;

if ($planCongeID) {
    $query4 = $db->table('plancongeannuel')->select('libelle')->getWhere(['IDplancongeannuel' => $planCongeID]);
    $row1 = $query4->getRow();
    echo '<td>' . (isset($row1->libelle) ? $row1->libelle : '') . '</td>';
} else {
    echo '<td></td>'; // Handle case where $planCongeID is null
}

echo '<td>' . (isset($info['datedepart']) ? $info['datedepart'] : '') . '</td>';
echo '<td>' . (isset($info['datereprise']) ? $info['datereprise'] : '') . '</td>';
echo '<td>' . (isset($info['etat']) ? $info['etat'] : '') . '</td>';
echo '<td style="text-align:center;">';

$myid = $_SESSION['cnxid'];

              // Param Code End

                if ($roww && $myid == $roww->idagent && ($info['validationcs'] == 1 || $info['validationsd'] == 1)) {
                  echo 'Modification impossibble!';
                } else {
                  if ($roww && $myid == $roww->Responsablen1 && $info['validationcs'] == 1 && $info['validationsdrh'] != 1) {
                    echo 'Modification impossible!';
                  } else {
                    if ($roww && $myid == $roww->Responsablen2 && $info['validationsd'] == 1 && $info['validationsdrh'] != 1) {
                      echo 'Modification impossible!';
                    } else {
                      if ($info['validationcs'] == 1 && $info['validationsdrh'] == 1) {
                        echo 'Modification impossible!';
                      } else {
                        echo anchor('espaceadmin/validerca/' . $info['IDconge'], '<i class="fas fa-check-double" title="Valider"></i>') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . anchor('espaceadmin/rejetca/' . $info['IDconge'], '<i class="fas fa-times" title="Rejeter"></i>');
                      }
                    }
                  }
                }

                echo '</td></tr>';
                ?>
              <?php endforeach; ?>
            <?php else : ?>


            <?php endif ?>
          </tbody>

        </table>
        <button type="button" class="btn btn-primary" id="approve_all">Valider toutes les demandes</button> &nbsp;&nbsp; <button type="button" class="btn btn-danger" id="reject_all">Rejeter toutes les demandes</button>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#dataTable').DataTable({
              stateSave: true,
              dom: 'Bfrtip',
              buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
              ]
            });
            $("#selectAll").click(function() {
              $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            });

            $("input[type=checkbox]").click(function() {
              if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
              }
            });
            $("#approve_all").click(function() {
              var url = '<?= base_url("/espaceadmin/validercaall/"); ?>';
              var chkval = [];
              $('.chk:checked').each(function() {
                chkval.push($(this).val());
              });
              if (chkval.length > 0) {
                window.location.href = url + "/" + chkval;
              }
            });
            $("#reject_all").click(function() {
              var url = '<?= base_url("/espaceadmin/rejetcaall/"); ?>';
              var chkval = [];
              $('.chk:checked').each(function() {
                chkval.push($(this).val());
              });
              if (chkval.length > 0) {
                window.location.href = url + "/" + chkval;
              }
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->