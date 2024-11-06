<?php 

if(!isset($_SESSION['cnxid'])) {
	redirect()->to(base_url('/home/logout'));
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="<?php echo base_url('favicon.png');?>" type="image/x-icon" />
    <title>Portail RH CHU de Cocody</title>

    <!-- Custom fonts for this template-->
   
    <link href="<?php echo base_url('vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('css/sb-admin-2.css');?>" rel="stylesheet">

    <link href="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">
    
   <script src="<?php echo base_url('export/jquery351.js');?>"></script>
     
<script type="text/javascript" language="javascript" src="<?php echo base_url('export/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('export/dataTables.buttons.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('export/jszip.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('export/pdfmake.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('export/vfs_fonts.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('export/buttons.html5.min.js');?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url('export/buttons.print.min.js');?>"></script>
<script>
function imprimer(divName) {
      var printContents = document.getElementById(divName).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
</script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    









