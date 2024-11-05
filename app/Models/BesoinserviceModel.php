<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class BesoinserviceModel extends Model{
		protected $table = 'besoinservice';
		protected $primaryKey = 'IDbesoinservice';
		protected $allowedFields = ['IDbesoinservice','justificatif','IDposte','total','datedemande','etat','IDservice'];
		
		public function recBesoinservice()
		{
			return $this->findAll();
		}
		
	}
?>