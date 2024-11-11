<?php

	$db = \Config\Database::connect();
		$query = $db->query("SELECT * from unite where IDunite=1"); 
		$unite = $query->getRow();

?> 

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-primary">Veuillez cliquer sur le lien ci-dessous</h1>
<br/><br/>
<div style="text-align:center; width:100%; font-weight:bold; font-size:36px">
<a href="<?php echo $unite->lienuser; ?>" target="new"><?php echo $unite->titreuser; ?></a>

<?php
if(isset($_SESSION['super']) && $_SESSION['super']==1) {
?>
<br/><br/><br/>

<a href="<?php echo base_url('/espaceadmin/creerlien/1');?>" >Modifier</a>

<?php
}
?>   
</div>
     </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->