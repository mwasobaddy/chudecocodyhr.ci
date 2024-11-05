<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class ContratModel extends Model{
		protected $table = 'contrat';
		protected $primaryKey = 'IDcontrat';
		protected $allowedFields = ['IDcontrat','libelle'];
		
		public function recContrat()
		{
			return $this->findAll();
		}
		
	}
?>