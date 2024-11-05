<?php

namespace App\Models;

use CodeIgniter\Model;

class CongeannuelModel extends Model
{
	protected $table = 'congeannuel';
	protected $primaryKey = 'IDconge';
	protected $allowedFields = ['IDconge', 'Idagent', 'validationagent', 'datevalidation', 'datedepart', 'datereprise', 'daterepriseeffective', 'duree', 'lieu', 'adresse', 'telephone', 'etat', 'validationcs', 'validationsdrh', 'validationdg', 'validationsd', 'motifrejet', 'datecs', 'datesd', 'datesdrh', 'datedg', 'justificatif1', 'justificatif2', 'IDplancongeannuel', 'horspays', 'alert1', 'alert2', 'alert3', 'alert1ok', 'alert2ok', 'alert3ok'];

	public function recCongeannuel()
	{
		return $this->orderBy('IDconge', 'DESC')->findAll();
	}

	public function print_insert_query($data)
	{
		$builder = $this->db->table($this->table);
		$builder->set($data);

		// Print the compiled insert query
		$query = $builder->getCompiledInsert();
		echo $query;
	}
}
