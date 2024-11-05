<h2>
  <?= $titre ?>
</h2>
<?php if (! empty($taches) && is_array($taches)) : ?>
<ul>
 <?php foreach ($taches as $tache): ?>
	<li>
		<?php echo $tache['id'].". ".$tache['tache']."".anchor('agent/suppression/'.$tache['id'],'[supp]');?>
	</li>
<?php endforeach; ?>
</ul>
<?php else : ?>
<h3>Rien à faire</h3>
<p>Pas de nouvelle tâche à réaliser.</p>
<?php endif ?>

<?php /*
$array = array('id' => '1');
$this->db->where($array);
$query = $this->db->get('taches');
$result = $query->result_array();
//var_dump($result);*/
?>
