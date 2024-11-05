<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PostesousdirectionModel extends Model{
		protected $table = 'poste_sousdirection';
		protected $primaryKey = 'IDpostesousdirection';
		protected $allowedFields = ['IDpostesousdirection','IDsousdirection','IDposte','disponible','total','Observations'];
		
		public function recPostesousdirection()
		{
			return $this->findAll();
		}
		
	}
?>