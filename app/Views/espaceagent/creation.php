<h2><?= esc($titre); ?></h2>
<?= \Config\Services::validation()->listErrors(); ?>
<?php
helper('form');
//echo view('templates/espaceadmin/entete', $data);
echo form_open('espaceadmin/creation');
//echo '<form action="agent/creation">';
?>

<label for="matricule">Matricule</label><br />
<input type="text" name="matricule" /><br /><br />

<label for="nom">Nom</label><br />
<input type="text" name="nom" /><br /><br />

<label for="pschu">Prise de service au CHU</label><br />
<input type="date" name="pschu" /><br /><br /><br />

 <button type="submit" class="btn btn-primary" style="width:100%">Valider formulaire</button>
</form>


<?php

$db = \Config\Database::connect();
$query = $db->query('SELECT * from agent');
$results = $query->getResult();

foreach ($results as $row)
{
    echo $row->matricule;
    echo $row->nom;
    echo $row->email;
	echo '<br/>';
}

echo 'Total Results: ' . count($results);

?>



