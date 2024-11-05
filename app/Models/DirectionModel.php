<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class DirectionModel extends Model{
		protected $table = 'direction';
		protected $primaryKey = 'IDdirection';
		protected $allowedFields = ['IDdirection','libelle','Directeur'];
		
		public function recDirection()
		{
			return $this->findAll();
		}
		
	}
?>