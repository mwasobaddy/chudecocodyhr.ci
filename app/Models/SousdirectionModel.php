<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class SousdirectionModel extends Model{
		protected $table = 'sousdirection';
		protected $primaryKey = 'IDsousdirection';
		protected $allowedFields = ['IDsousdirection','libelle','IDdirection','sousdirecteur'];
		
		public function recSousdirection()
		{
			return $this->findAll();
		}
		
	}
?>