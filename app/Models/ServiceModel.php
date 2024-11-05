<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class ServiceModel extends Model{
		protected $table = 'service';
		protected $primaryKey = 'IDservice';
		
		protected $allowedFields = ['IDservice','libelle','IDsousdirection','chefservice','sus'];
		
		public function recService()
		{
			return $this->findAll();
		}
		
	}
?>