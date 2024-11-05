<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class TachesModel extends Model{
		protected $table = 'taches';
		protected $allowedFields = ['tache','deadline'];
		
		public function recTaches()
		{
			return $this->findAll();
		}
	}
?>