<!-- Begin Page Content -->
<?php

$db = \Config\Database::connect();
if (isset($lidpdd)) {
    /*$query = $db->query("SELECT * from permissiondd where IDpermission=$lidpdd");
    $item = $query->getRow();*/
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary">Permissions > Permission jour à jour</h1>
    <p class="mb-4">Rejeter une permission jour à jour
    </p>
    <?php
    echo view('toast');
    ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Fiche Permission jour à jour</h6>
                </div>
                <div class="card-body">
                    <?php
                    helper('form');
                    echo form_open('espaceadmin/rejetpddall/' . $lidpdd);
                    ?>
                    <!---- <form> ----->
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input type="hidden" class="form-control" id="IDpermission"
                                   name="IDpermission"  >
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