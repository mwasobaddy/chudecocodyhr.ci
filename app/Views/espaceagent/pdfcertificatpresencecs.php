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

<form action="#" method="post">
 <div class="form-row">
 Note de service MINISTERE DE LA SANTE, DE L'HYGIENE PUBLIQUE ET DE LA COUVERTURE MALADIE UNIVERSELLE<br/>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="numa" name="numa"  placeholder="Numéro">
            </div>
            <div class="form-group col-md-6">
              <input type="date" class="form-control" id="datea" name="datea" >
            </div>
          </div>
          <div class="form-row">
 Note de service CHU Cocody<br/>
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
            N<sup>o</sup>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /CHU/C/DAF/S-DRTVTI </h4>
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
        <h1>CERTIFICAT DE PRESENCE DES CHEFS DE SERVICE </h1>
      </div>
      <div class="field">
        <h3>Nous soussignés</h3>
        <div class="field">
          <h3>M. KOFFI Asséré Kouamé</h3>
        </div>
        <div class="field pt-4">
          <h3>Directeur Général du CHU de Cocody</h3>
        </div>
        <div class="field">
          <h3>et Dr. MOH Elloh Nicolas</h3>
        </div>
        <div class="field">
          <h3>
          Directeur Médical et Scientifique </div>
        <div class="field">
          <h3>Certifions que Monsieur/Madame: <?php echo $lagent->nom; ?></h3>
        </div>
        <div class="field">
          <h3>Matricule : <?php echo $lagent->matricule; ?></h3>
        </div>
        <div class="field">
          <h3>Emploi : <?php echo $lagent->emploi; ?></h3>
        </div>
        <div class="field">
          <h3>Fonction: <?php echo $lagent->fonction; ?></h3>
        </div>
        <div class="field line-height">
          <h4>Mise à la disposition du CHU de Cocody par Note de Service N<sup>◦</sup> <?php if(isset($_POST['numa'])) { echo htmlentities(addslashes($_POST['numa'])); } ?>du <?php if(isset($_POST['datea'])) { echo htmlentities(addslashes($_POST['datea'])); } ?> du Ministre de la Santé, de l'Hygiène Publique et de la Couverture Maladie Universelle et affecté(e) par Note de Service N<sup>◦</sup> <?php if(isset($_POST['numb'])) { echo htmlentities(addslashes($_POST['numb'])); } ?> en date du <?php if(isset($_POST['dateb'])) { echo htmlentities(addslashes($_POST['dateb'])); } ?>. de Monsieur le Directeur du CHU de Cocody. <br>
            <br>
            Est effectivement présent(e) depuis le <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datereprise)))); ?> <br>
            <br>
            En foi de quoi, le présent certificat lui est délivré pour servir et valoir ce que de droit. </h4>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="vsdu text-center">
              <h4>Visa du DMS</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="vsdu text-center">
              <h4>Visa du Directeur Général</h4>
            </div>
          </div
            >
        </div>
        <div class="field">
          <div class="row">
            <div class="col-md-6">
              <div class="vsdu text-center">
                <h3><u>MOH Ello Nicolas</u></h3>
                <h4>Maître de Conférences Agrégé</h4>
              </div>
            </div>
            <div class="col-md-6">
              <div class="vsdu text-center">
                <h3><u>M. KOFFI Asséré Kouamé</u></h3>
                <h4>Administrateur Principal des Services Financiers</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="nbnote">
          <p> NB: Imprimé à transmettre à la Sous-Direction des ressources humaines
            en vue de l'établissement du certificat définitif de prise de service dûment signé par le Directeur Général. </p>
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