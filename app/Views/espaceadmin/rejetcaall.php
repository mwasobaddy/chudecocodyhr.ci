<!-- Begin Page Content -->
<?php

$db = \Config\Database::connect();
if (isset($lidconge)) {
    /*$query = $db->query("SELECT * from congeannuel where IDconge=$lidconge");
    //echo "SELECT * from conges where IDconge=$lidconge";
    $conge = $query->getRow();*/
    //print_r($conge);
    //print_r($posteservice);
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Congés -> Congé annuel</h1>
    <p class="mb-4">Rejeter un congé annuel
    </p>
    <?php
    echo view('toast');
    ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Fiche Congé annuel</h6>
                </div>
                <div class="card-body">
                    <?php
                    helper('form');
                    echo form_open('espaceadmin/rejetcaall/' . $lidconge);
                    ?>
                    <!---- <form> ----->
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            
                            <label for="datedepart">Motif du rejet</label>
                            <input type="text" class="form-control" id="motifrejet" name="motifrejet"
                                   placeholder="motif rejet" required="required" >
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" name="go" value="go" class="btn btn-primary"
                                    style="width:100%; height:100%">Valider formulaire
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->