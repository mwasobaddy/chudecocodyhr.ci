<!DOCTYPE html>
<html>
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
          <h4> BP V 13 Abidjan Fax: 27 22 44 13 79<br>
            Tél: 27 22 48 10 00<br>
            <br>
            N<sup>o</sup>___________/CHU/C </h4>
        </div>
        <div class="text-center">
          <h3> REPUBLIQUE DE COTE D'IVOIRE<br>
          Union - Discipline - Travail </h3>
          <h5>Abidjan, le <?php setlocale(LC_TIME, "fr_FR", "French");
echo datefr(utf8_encode(strftime("%d %B %G", strtotime(date("j F Y"))))); ?> </h5>
        </div>
      </div>
      <div class="heading3">
        <h1>CERTIFICAT DE REPRISE DE SERVICE AU TERME D'UN STAGE (FONCTIONNAIRE) </h1>
      </div>
      <div class="field">
        <h3>Nous soussingné (e)s,</h3>
        <div class="field">
          <h3>Monsieur/Madame: <?php echo $lagent->nom; ?></h3>
        </div>
        <div class="field">
          <h3>Chef du Service de:......................................................................</h3>
        </div>
        <div class="field pt-4">
          <h3>et Monsieur/Madame:....................................................................</h3>
        </div>
        <div class="field">
          <h3>Surveillant(e) d'Unité de Soins de:.........................................................................................</h3>
        </div>
        <div class="field">
          <h3>Certifions que Monsieur/Madame:.........................................................</h3>
        </div>
        <div class="field">
          <h3>Matricule:.............................................................................</h3>
        </div>
        <div class="field">
          <h3>Emploi:.................................................................................</h3>
        </div>
        <div class="field">
          <h3>Fonction: <?php echo $lagent->fonction; ?></h3>
        </div>
        <div class="field">
          <h3>Bénéficiaire d'un stage de spécialisation ou de perfectionnement en.......................................</h3>
        </div>
        <div class="field">
          <h3>....................................................................................................................................................</h3>
        </div>
        <div class="field line-height">
          <h4> Du................................. au ..........................
            inclus&nbsp;</h4>
          <h4>Lieu:.........................................................<br>
            <br>
            A effectivement repris le serivce le ...........................<br>
            <br>
            En foi de quoi, le présent certificat lui est délivré pour servir et valoir ce que de droit. </h4>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="vsdu text-left text-underline">
              <h3><u>Visa du Surveillant d'Unité de Soins </u></h3>
            </div>
          </div>
          <div class="col-md-6">
            <div class="vsdu">
              <h3><u>Visa du Chef du Service</u></h3>
            </div>
          </div>
        </div>
        <div class="nbnote">
          <p> NB :  Imprimé à transmettre à la Sous-Direction des Ressources Humaines, Cellule de Gestion des Actes, Porte 18 en vue de l'établissement du certificat de reprise de service et signé du Directeur Général.<br>
            <b> Mémoire ou Rapport de stage à déposer obligatoirement à la Direction Générale.</b> </p>
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