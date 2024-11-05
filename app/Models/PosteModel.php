<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PosteModel extends Model{
		protected $table = 'poste';
		protected $primaryKey = 'IDposte';
		protected $allowedFields = ['IDposte','Intitule','IDemploi','IDlafonction','details'];
		
		public function recPoste()
		{
			return $this->findAll();
		}
		
	}
?>