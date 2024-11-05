<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class RoleModel extends Model{
		protected $table = 'role';
		protected $primaryKey = 'IDrole';
		protected $allowedFields = ['IDrole','libelle'];
		
		public function recRole()
		{
			return $this->findAll();
		}
		
	}
?>