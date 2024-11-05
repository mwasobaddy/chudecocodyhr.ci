<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class EmploiModel extends Model{
		protected $table = 'emploi';
		protected $primaryKey = 'IDemploi';
		protected $allowedFields = ['IDemploi','libelle'];
		
		public function recEmploi()
		{
			return $this->findAll();
		}
		
	}
?>