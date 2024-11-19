<!DOCTYPE html>
<html lang="fr">
<head>
<title>Document name here</title>
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

//var_dump($leconge);
//var_dump($lagent);
?>
<div class="table-responsive" id="dataT">
  <div class="wrapper">
    <div class="innerwrapper">
      <div class="main_class">
        <div class="main_left">
          <h3>MINISTERE DE LA SANTE,DE L'HYGIENE PUBLIQUE ET DE LA COUVERTURE MALADIE UNIVERSELLE<br>
            </h3>
          <a href="#"><img src="<?php echo base_url('/img/CHU-logo.png');?>"></a>
          <h3>CENTRE HOSPITALIER ET<br>
            UNIVERSITAIRE DE COCODY </h3>
          <h4> BP V 13 Abidjan Fax:27 22 44 13 79<br>
            Tél:27 22 48 10 00<br>
            <br>
            N<sup>o</sup>972 /C.H.U/C/DAF/S-DRTVTI </h4>
        </div>
        <div class="main_right">
          <h3> REPUBLIQUE DE COTE D'IVOIRE </h3>
          <h4 class="brddotted"> Union - Discipline - Travail </h4>
          <h5>Abidjan, le 
		  <?php 
		  //setlocale(LC_TIME, "fr_FR", "French");
		  setlocale(LC_CTYPE, 'French');

		 setlocale(LC_TIME,'fr_FR','French','French_France.1252','fr_FR.ISO8859-1','fra');
echo datefr(strftime("%d %B %G", strtotime(date("j F Y")))); ?>
</h5>
        </div>
      </div>
      <div class="heading3">
        <h1>ATTESTATION DE CESSATION DE SERVICE<br>
        </h1>
      </div>
      <div class="field">
        <div class="field">
          <h3>Vu la demande de l'intéressé (e)en date du <?php echo strftime("%d %B %G", strtotime($leconge->justificatif1)); ?>,<br>
            Avec l'avis favorable de son Supérieur Hiérarchique, le Sous-Directeur des<br>
            Ressources Humaines du C.H.U de Cocody atteste que : </h3>
        </div>
        <div class="field">
          <h3 style="line-height: 45px;"> <?php echo $lagent->civilite; ?> : <?php echo $lagent->nom; ?><br>
            Matricule :<?php echo $lagent->matricule; ?><br>
            Emploi : <?php echo $lagent->emploi; ?><br>
            Fonction : <?php echo $lagent->fonction; ?><br>
            Service : <?php echo $lagent->service; ?><br>
            Bénéficiaire d'un congé annuel de <?php echo $leconge->duree; ?> jours, 
            au titre de l'année <?php echo substr($leconge->annee,0,4); ?> conformément au planning du service,
            cessera le service le <?php echo strftime("%d %B %G", strtotime($leconge->datedepart)); ?>.<br>
            A l'issue de son congé, l'intéressé (e) reprendra fonction dans son ancien service le<br>
             <?php echo strftime("%d %B %G", strtotime($leconge->datereprise)); ?>.<br>
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
                Intéressé (e)<br>
                Dossier/Archive<br>
                <br>
                DATE EFFECTIVE DE LA REPRISE<br>
                DE SERVICE: <?php echo strftime("%d %B %G", strtotime($leconge->datereprise)); ?>.<br></p>
            </div>
            <div class="col-md-7 text-center">
            <h3 class="text-decoration">Le Directeur Général</h3>
            <h3 class="pttop2 text-decoration">M. KOFFI Asséré Kouamé</h3>
            <h4>Administrateur Principal des Services Financiers</h4>
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