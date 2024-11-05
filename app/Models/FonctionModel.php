<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class FonctionModel extends Model{
		protected $table = 'lafonction';
		protected $primaryKey = 'IDlafonction';
		protected $allowedFields = ['IDlafonction','libelle'];
		
		public function recfonction()
		{
			return $this->findAll();
		}
		
	}
?>