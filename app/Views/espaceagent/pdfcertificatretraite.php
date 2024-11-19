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
            N<sup>o</sup>___________/CHU/C/DAF/S/DRH/TI </h4>
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
        <h1>CERTIFICAT DE CESSATION DE SERVICE</h1>
      </div>
      <div class="field">
        <h3>Nous soussingné(e)s,</h3>
        <div class="field">
          <h3>M/Mme: <?php echo $lagent->h2; ?></h3>
        </div>
        <div class="field">
          <h3>Chef du Service de: <?php echo $lagent->service; ?></h3>
        </div>
        <div class="field">
          <h3>Et M/Mme: <?php echo $lagent->h1; ?></h3>
        </div>
        <div class="field">
          <h3>Surveillant(e) d'Unité de Soins de : <?php echo $lagent->service; ?></h3>
        </div>
        <div class="field">
          <h3>Certifions que M/Mme <?php echo $lagent->nom; ?>.</h3>
        </div>
        <div class="field">
          <h3>Matricule : <?php echo $lagent->matricule; ?></h3>
        </div>
        <div class="field">
          <h3>Fonction : <?php echo $lagent->fonction; ?></h3>
        </div>
        <div class="field">
          <h3>Admis(e) à faire valoir ses droits à la retraite à la date du <?php 
		 //(2,3,4,5)
		
		$nais = $lagent->datenais;
		
		if($lagent->IDgrade = 2 || $lagent->IDgrade = 3 || $lagent->IDgrade = 4 ) {
			$r = 65;
		} else {
			$r = 60;
		}
		
		
         $naiss = date('Y') - $nais; 
        if (date('md') < date('md', strtotime($nais))) { 
           $age =  $naiss - 1; 
        } else {
			$age = $naiss;
		}
		echo (date('Y') + ($r - $age)).'-12-31'; ?>
      
		  
		  	
		  </h3>
        </div>
      </div>
      <div class="field">
        <h3>Cessera effectivement service le <?php echo (date('Y') + ($r - $age)).'-12-31'; ?></h3>
      </div>
      <div class="field line-height">
        <h3> En foi de quoi, le présent certificat lui est délivré pour servir et valoir ce que de droit. </h3>
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
        <p> NB : Imprimé à transmettre à la Sous-Direction des Ressources Humaines de la Structure en
          vue de l'établissement du certificat définitif de cessation de service dûment signé du Directeur Cénéral. </p>
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