<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class CiviliteModel extends Model{
		protected $table = 'civilite';
		protected $primaryKey = 'IDcivilite';
		protected $allowedFields = ['IDcivilite','libelle'];
		
		public function recCivilite()
		{
			return $this->findAll();
		}
		
	}
?>