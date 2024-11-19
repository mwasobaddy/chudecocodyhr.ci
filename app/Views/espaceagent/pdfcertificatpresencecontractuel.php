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
					$dd = preg_replace('/January/', 'janvier', $dd);
					$dd = preg_replace('/February/', 'février', $dd);
					$dd = preg_replace('/March/', 'mars', $dd);
					$dd = preg_replace('/April/', 'avril', $dd);
					$dd = preg_replace('/May/', 'mai', $dd);
					$dd = preg_replace('/June/', 'juin', $dd);
					$dd = preg_replace('/July/', 'juillet', $dd);
					$dd = preg_replace('/August/', 'août', $dd);
					$dd = preg_replace('/September/', 'septembre', $dd);
					$dd = preg_replace('/October/', 'octobre', $dd);
					$dd = preg_replace('/November/', 'novembre', $dd);
					$dd = preg_replace('/December/', 'décembre', $dd);
					//jour
					$dd = preg_replace('/Monday/', 'lundi', $dd);
					$dd = preg_replace('/Tuesday/', 'mardi', $dd);
					$dd = preg_replace('/Wednesday/', 'mercredi', $dd);
					$dd = preg_replace('/Thursday/', 'jeudi', $dd);
					$dd = preg_replace('/Friday/', 'vendredi', $dd);
					$dd = preg_replace('/Saturday/', 'samedi', $dd);
					$dd = preg_replace('/Sunday/', 'dimanche', $dd);
					return $dd;
					}
//var_dump($leconge);
//var_dump($lagent);
?>

<form action="#" method="post">

          <div class="form-row">
 Note de service MINISTERE DE LA SANTE, DE L'HYGIENE PUBLIQUE ET DE LA COUVERTURE MALADIE UNIVERSELLE<br/>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="numb" name="numb"  placeholder="Numéro">
            </div>
            <div class="form-group col-md-6">
              <input type="date" class="form-control" id="dateb" name="dateb" >
            </div>
          </div>
         
           <div class="form-row">
            <div class="form-group col-md-12 d-flex justify-content-center">
              <button type="submit" class="btn btn-primary">Valider formulaire</button>
            </div>
          </div>

</form>
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
            N<sup>o</sup>972 /CHU/C/DAF/S/DRH/TI</h4>
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
        <h1>CERTIFICAT DE PRESENCE - CONTRACTUEL</h1>
      </div>
      <div class="field">
        <h3>Nous soussigné(e)s,</h3>
        <div class="field">
          <h3>Chef du Service de:  <?php echo $lagent->service; ?></h3>
        </div>
        <div class="field">
          <h3>Et Monsieur/Madame: <?php echo $lagent->h2; ?></h3>
        </div>
        <div class="field">
          <h3>Surveillant(e) d'Unité de Soins de: <?php echo $lagent->service; ?></h3>
        </div>
        <div class="field">
          <h3>Certifions que Monsieur/Madame: <?php echo $lagent->nom; ?></h3>
        </div>
        <div class="field">
          <h3>Matricule : <?php echo $lagent->matricule; ?></h3>
        </div>
        <div class="field">
          <h3>Fonction:  <?php echo $lagent->fonction; ?></h3>
        </div>
        <div class="field">
          <h3>Recruté(e) sous contrat : CAFOR /___/ ou ANEHCI-LMO /___/</h3>
        </div>
        <div class="field">
          <h3>et affect(é) par Note de Service N<sup>◦</sup> <?php if(isset($_POST['numb'])) { echo htmlentities(addslashes($_POST['numb'])); } ?> en date du <?php if(isset($_POST['dateb'])) { echo htmlentities(addslashes($_POST['dateb'])); } ?></h3>
        </div>
        <div class="field">
          <h3>de Monsieur le Directeur Général du CHU de Cocody</h3>
        </div>
        <div class="field line-height">
          <h3> Est effectivement présent(e) depuis le <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($lagent->pschu)))); ?><br>
            <br>
            En foi de quoi, le présent certificat lui est délivré pour servir et valoir ce que de droit. </h3>
        </div>
        <div class="row pttop2">
          <div class="col-md-6">
            <div class="vsdu text-center">
              <h3><u>Visa du Surveillant d'Unité de Soins</u></h3>
            </div>
          </div>
          <div class="col-md-6">
            <div class="vsdu text-center">
              <h3><u>Visa du Chef de Service</u></h3>
            </div>
          </div>
        </div>
        <div class="nbnote">
          <p> NB : Imprimé à transmettre à la Sous Direction des Ressources Humaines.
            Cellule de Gestion des Actes. Porte 18 en vue de l'établissement du certificat de prise de
            service.</p>
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