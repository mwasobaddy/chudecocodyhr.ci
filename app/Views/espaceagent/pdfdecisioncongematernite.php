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
       DE L'HYGIENE PUBLIQUE ET DE LA COUVERTURE MALADIE UNIVERSELLE <br>
          </h3>
          <a href="#"><img src="<?php echo base_url('/img/CHU-logo.png');?>"></a>
          <h3>CENTRE HOSPITALIER ET<br>
            UNIVERSITAIRE DE COCODY </h3>
          <h4> BP V 13 Abidjan Fax: 27 22 44 13 79<br>
            Tél:27 22 48 10 00<br>
            <br>
          </h4>
          <h5> DECISION No<sup>o</sup>______________/CHU-C/DAF/S/DRH/TI<br>
            PORTANT CONGE DE MATERNITE.</h5>
        </div>
        <div class="text-center">
          <h3> REPUBLIQUE DE COTE D'IVOIRE<br>
          Union - Discipline - Travail </h3>
          <h5>Abidjan, le <?php setlocale(LC_TIME, "fr_FR", "French");
echo datefr(utf8_encode(strftime("%d %B %G", strtotime(date("j F Y"))))); ?></h5>
        </div>
      </div>
      <div class="heading4">
        <h1>LE DIRECTEUR</h1>
      </div>
      <div class="field">
        <h3> Vu la Loi No 92-57A du 11 septembre 1992, portant Statut Général de la Fonction
          Publique en son article 71 ;<br>
          <br>
          Vu le Décret No<sup>o</sup> 84 - 762 du 06 juin 1984, érigeant le CHU de Cocody en<br>
          Etablissement Public à caractère Industriel et Commercial et portant organisation de<br>
          cet Etablissement ;<br>
          <br>
          Vu le Décret No<sup>o</sup> 93-607 du 02 juillet 1993, portant modalités communes
          d'application du statut général de la Fonction Publique en ses articles 74 à76;<br>
          <br>
          Vu le Décret N<sup>o</sup> 2001-650 du 19 octobre 2001, portant attributions, organisation et<br>
          fonctionnement des Centres Hospitaliers et Universitaires de Cocody, de Treichville,<br>
          de Yopougon et de Bouaké et abrogeant les décrets n"98-380,98-381,98-382 et 98-<br>
          383 du 30 juin 1998 ;<br>
          <br>
          Vu le Décret No<sup>o</sup>2016-631 du 03 août 2016, portant nomination du Directeur Général<br>
          du Centre Hospitalier et Universitaire de Cocody ;<br>
          <br>
          Vu la demande de congé de maternité en date du <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datedepart)))); ?> formulée par<br>
          l'intéressée ;<br>
          <br>
          Vu le Certificat de grossesse en date du ......................., délivré par le Docteur,<br>
          .................................. Gynecologue-Obstetricien au CHU de Cocody. </h3>
      </div>
      <div class="heading4">
        <h1>DECIDE</h1>
      </div>
      <div class="decide">
        <div class="decideleft">
          <h3>Article 1:</h3>
        </div>
        <div class="decideright">
          <h4>Un congé de maternité de quartorze (14) semaines à solde de présence
            pour en jouir à ses frais, est accordé à <?php echo $lagent->civilite; ?> <?php echo ($lagent->nom); ?>, matricule <?php echo $lagent->matricule; ?> emploi <?php echo $lagent->emploi; ?>, en <?php echo $lagent->service; ?> du CHU de Cocody à compter du <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datedepart)))); ?></h4>
        </div>
      </div>
      <div class="decide">
        <div class="decideleft">
          <h3>Article 2:</h3>
        </div>
        <div class="decideright">
          <h4>A l'issue de son congé dont l'étalement est ainsi fixé :<br>
            - Six (6) semaines avant l'accouchement<br>
            - Huit (8) semaines après 1'accouchement<br>
            <br>
          </h4>
        </div>
      </div>
      <h4 style="margin-top: 30px;">L'intéressée reprendra service à son ancien poste, le <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datereprise)))); ?>.</h4>
      <div class="decide">
        <div class="decideleft">
          <h3>Article 3:</h3>
        </div>
        <div class="decideright">
          <h4>La présente décision qui a pris effet le <?php echo datefr(utf8_encode(strftime("%d %B %G", strtotime($leconge->datedepart)))); ?>, sera
            enregistrée, publiée et communiquée partout où besoin sera.</h4>
        </div>
      </div>
      <div class="field pttop">
        <div class="row">
          <div class="col-md-5">
            <h3 style="text-decoration: underline;"> Ampliations :</h3>
            <p> MFP/DGAPCE<br>
              MSFIP/DRH<br>
              MEF/Solde<br>
              Directeur Général CHU<br>
              Contrôleur Budgétaire<br>
              Agent Comptable<br>
              DAF<br>
              DMS<br>
              SACE<br>
              S/DRH<br>
              SIDSIO<br>
              Chef de Service<br>
              Surveillante Générale<br>
              SUS<br>
              Service Solde<br>
              Intéressée<br>
              Chrono/Dossier </p>
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
<br/>
<br/>
<button onClick="imprimer('dataT')" style="width:100%; height:10%; font-size:36px; border:0px; color:#FFF; background-color:#00F">Imprimer</button>
<script type="text/javascript">
	</script>
</body>
</html>