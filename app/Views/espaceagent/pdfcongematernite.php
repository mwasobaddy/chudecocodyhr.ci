<!DOCTYPE html>
<html>
<head>
<title>IMPRIMER ACTE</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="<?php echo base_url('/pdf/style.css');?>">
<link rel="stylesheet" href="<?php echo base_url('/pdf/bootstrap.min.css');?>">
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
<body>
<?php 
function datefr($dd) {
					$dd = preg_replace('/January/', 'Janvier', $dd);
					$dd = preg_replace('/February/', 'Fevrier', $dd);
					$dd = preg_replace('/March/', 'Mars', $dd);
					$dd = preg_replace('/April/', 'Avril', $dd);
					$dd = preg_replace('/May/', 'Mai', $dd);
					$dd = preg_replace('/June/', 'Juin', $dd);
					$dd = preg_replace('/July/', 'Juillet', $dd);
					$dd = preg_replace('/August/', 'Août', $dd);
					$dd = preg_replace('/September/', 'Septembre', $dd);
					$dd = preg_replace('/October/', 'Octobre', $dd);
					$dd = preg_replace('/November/', 'Novembre', $dd);
					$dd = preg_replace('/December/', 'Décembre', $dd);
					//jour
					$dd = preg_replace('/Monday/', 'Lundi', $dd);
					$dd = preg_replace('/Tuesday/', 'Mardi', $dd);
					$dd = preg_replace('/Wednesday/', 'Mercredi', $dd);
					$dd = preg_replace('/Thursday/', 'Jeudi', $dd);
					$dd = preg_replace('/Friday/', 'Vendredi', $dd);
					$dd = preg_replace('/Saturday/', 'Samedi', $dd);
					$dd = preg_replace('/Sunday/', 'Dimanche', $dd);
					return $dd;
					}
//var_dump($leconge);
//var_dump($lagent);
?>

<div class="table-responsive" id="dataT">
  <div class="wrapper">
    <div class="innerwrapper">
      <div class="main_class">
        <div class="main_left">
          <h3>MINISTERE DE LA SANTE,
DE L'HYGIENE PUBLIQUE ET DE LA COUVERTURE MALADIE UNIVERSELLE<br>
            </h3>
          <a href="#"><img src="<?php echo base_url('/img/CHU-logo.png');?>"></a>
          <h3>CENTRE HOSPITALIER ET<br>
            UNIVERSITAIRE DE COCODY </h3>
          <h4>BP V 13 Abidjan Fax:27 22 44 13 79<br>
            Tél:27 22 48 10 00<br>
            <br>
            N<sup>o</sup>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /C.H.U/C/DAF/S-DRTVTI </h4>
        </div>
        <div class="text-center">
          <h3> REPUBLIQUE DE COTE D'IVOIRE<br>
          Union - Discipline - Travail </h3>
          <h5>Abidjan, le
            <?php setlocale(LC_TIME, "fr_FR", "French");
echo datefr(utf8_encode(strftime("%d %B %G", strtotime(date("j F Y"))))); ?>
          </h5>
        </div>
      </div>
      <div class="heading4">
        <h1>ATTESTATION DE CESSATION DE SERVICE</h1>
      </div>
      <div class="field">
        <h3> Je soussigné,M. KOFFI Asséré Kouamé, Directeur Général du Centre Hospitalier et Universitaire de Cocody, atteste que<br>
          <br>
          <?php echo $lagent->civilite; ?> : <?php echo $lagent->nom; ?><br>
          Matricule :<?php echo $lagent->matricule; ?><br>
          Emploi :<?php echo $lagent->emploi; ?><br>
          Service :<?php echo $lagent->service; ?><br>
          A cessé effectivement ses fonctions le <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datedepart)))); ?><br>
          <br>
          <b>Motif</b> : Bénéficiaire d'un congé de maternité de 14 semaines valable
          du <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datedepart)))); ?><br>
          au <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datereprise)))); ?> inclus. </h3>
      </div>
      <div class="field pttop">
        <div class="row">
          <div class="col-md-5">
            <h3 style="text-decoration: underline;"> AMPLIATIONS :<br>
              <br>
            </h3>
            <p>MFP/DG/DGPACE/DGI<br>
              MEF/Solde<br>
              MSHP/CAB/DRH<br>
              Directeur Général CHU/C<br>
              Contrôleur Budgétaire<br>
              Agent Comptable<br>
              DAF<br>
              DMS<br>
              SACE<br>
              S/DRH<br>
              S/DSIO<br>
              Chef de service<br>
              Surveillante Générale<br>
              SUS<br>
              Service solde<br>
              Intéressée<br>
              Dossier/Chrono </p>
          </div>
          <div class="col-md-7 text-center">
            <h3 class="text-decoration"> </h3>
            <h3 class="pttop3 text-decoration">M. KOFFI Asséré Kouamé</h3>
            <h4>Administrateur Principal des Services Financiers</h4>
          </div>
        </div>
      </div>
      <div class="field pttop">
        <div class="row">
          <div class="col-md-5">
            <h4 style="text-decoration: underline;"> VISA SUS</h4>
          </div>
          <div class="col-md-7 text-center">
            <h4 style="text-decoration: underline;">VISA CHEF DE SERVICE</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br/>
<br/>
<button onClick="imprimer('dataT')" style="width:100%; height:10%; font-size:36px; border:0px; color:#FFF; background-color:#00F">Imprimer</button>
<script type="text/javascript">
	</script>
</body>
</html>