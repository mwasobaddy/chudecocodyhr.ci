<?php 

if(!isset($_SESSION['cnxid'])) {
	redirect()->to(base_url('/home/logout'));
}


function selectagent($m, $cmp)
	{
		
		$db = \Config\Database::connect();
		
		if($m == '') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent");	
		}
		
		if($m == 'respo') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where idagent IN(select Directeur from direction) OR idagent IN(select sousdirecteur from sousdirection) OR idagent IN(select chefservice from service)");	
		}
		
			if($m == 'sup') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where idagent IN(select idagent from agent where IDdroitaccess = 2 or IDdroitaccess=3)");	
		}
		
		if($m == 'directeur') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where idagent IN(select Directeur from direction)");	
		}
		
		
		if($m == 'sousdirecteur') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where idagent IN(select sousdirecteur from sousdirection)");	
		}
		
		if($m == 'chefservice') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where  idagent IN(select chefservice from service)");	
		}
		
		if($m == 'sousdirecteurrh') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where  idagent IN(select sousdirecteur from sousdirection where libelle like '%Ressources Humaines%')");	
		}
		
		if($m == 'dg') {
			$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where  idagent IN(select Directeur from direction where libelle like '%Direction Générale%' or libelle like '%Direction Generale%')");	
		}
		
				
		$agent = $query->getResultArray();       
         
		 if (! empty($agent) && is_array($agent)){
            foreach ($agent as $info) {
				if($info['idagent']==$cmp) {

					 echo ' <option value="'.$info['idagent'].'" selected="selected">'.$info['matricule'].'-'.$info['nom'].'</option>';
                    } else {
            		echo ' <option value="'.$info['idagent'].'">'.$info['matricule'].'-'.$info['nom'].'</option>';						}
            	      		}
		 } else echo '<option value="">Rien à afficher</option>';
		 
		 
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
    









