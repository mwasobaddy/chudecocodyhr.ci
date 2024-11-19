<!DOCTYPE html>
<html lang="fr">
<head>
<title>IMPRIMER ACTE</title>
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
            N<sup>o</sup>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /CHU-C/DAF/S/DRH/LLC</h4>
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
      <div class="heading3">
        <h1>ATTESTATION DE CESSATION DE SERVICE<br>
        </h1>
      </div>
      <div class="field">
        <div class="field">
          <h3>Vu la demande de l'intéressé (e)en date du <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->justificatif1)))); ?>,<br>
            Avec l'avis favorable de son Supérieur Hiérarchique, le Sous-Directeur des<br>
            Ressources Humaines du CHU de Cocody atteste que : </h3>
        </div>
        <div class="field">
          <h3 style="line-height: 45px;"> <?php echo ($lagent->civilite); ?> : <?php echo ($lagent->nom); ?><br>
            Matricule :<?php echo $lagent->matricule; ?><br>
            Emploi : <?php echo $lagent->emploi; ?><br>
            Fonction : <?php echo $lagent->fonction; ?><br>
            Service : <?php echo $lagent->service; ?><br>
            Bénéficiaire d'un congé annuel de <?php echo $leconge->duree; ?> jours, en <?php echo utf8_encode($leconge->lieu); ?><br>
            au titre de l'année <?php echo substr($leconge->annee,0,4); ?> conformément au planning du service,
            cessera le service le <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datedepart)))); ?>.<br>
            A l'issue de son congé, l'intéressé (e) reprendra fonction dans son ancien service le<br>
             <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datereprise)))); ?>.<br>
            <br>
            En foi de quoi, la présente attestation est établie pour servir et valoir ce que de droit. </h3>
        </div>
        <div class="field">
          <div class="row">
            <div class="col-md-5">
              <h3 style="text-decoration: underline;"> AMPLIATIONS :</h3>
              <p>DG<br>
                DAF<br>
                DMS<br>
                SACE<br>
                S/DRH<br>
                S/DSIO<br>
                Chef de Service<br>
                SUS<br>
                Intéressé(e)<br>
                Dossier/Archive<br>
                <br>
                DATE EFFECTIVE DE LA REPRISE<br>
                DE SERVICE: </p>
            </div>
            <div class="col-md-7 text-center">
              <h3 style="text-decoration: underline;">Le Sous-Directeur des Ressources Humaines</h3>
              <h2 class="pttop3 text-decoration">M. NIAMPI Jean Marc</h2>
              <h4>Attaché Administratif des Services Financiers option Santé</h4>
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
</div>
<br/>
<br/>

<button onClick="imprimer('dataT')" style="width:100%; height:10%; font-size:36px; border:0px; color:#FFF; background-color:#00F">Imprimer</button>
<script type="text/javascript">
	</script>
</body>
</html>