<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class RoleagentModel extends Model{
		protected $table = 'role_agent';
		protected $primaryKey = 'IDroleagent';
		protected $allowedFields = ['IDroleagent','Idagent','IDrole'];
		
		public function recRoleagent()
		{
			return $this->findAll();
		}
		
	}
?>