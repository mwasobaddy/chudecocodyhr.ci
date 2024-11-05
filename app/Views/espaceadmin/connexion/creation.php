<h2><?= esc($titre); ?></h2>
<?= \Config\Services::validation()->listErrors(); ?>
<?php
echo form_open('agent/creation');
//echo '<form action="agent/creation">';
?>
<label for="tache">Tâche</label>
<input type="input" name="tache" /><br />
<input type="date" name="deadline" /><br />
<input type="submit" name="submit" value="Creéer une nouvelle tâche" />
</form>