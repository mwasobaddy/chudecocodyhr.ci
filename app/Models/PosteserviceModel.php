<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PosteserviceModel extends Model{
		protected $table = 'poste_service';
		protected $primaryKey = 'IDposteservice';
		protected $allowedFields = ['IDposteservice','IDservice','IDposte','disponible','total','Observations'];
		
		public function recPosteservice()
		{
			return $this->findAll();
		}
		
	}
?>