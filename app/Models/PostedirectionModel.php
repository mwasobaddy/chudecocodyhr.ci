<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PostedirectionModel extends Model{
		protected $table = 'poste_direction';
		protected $primaryKey = 'IDpostedirection';
		protected $allowedFields = ['IDpostedirection','IDdirection','IDposte','disponible','total','Observations'];
		
		public function recPostedirection()
		{
			return $this->findAll();
		}
		
	}
?>