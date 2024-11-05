<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class DroitaccessModel extends Model{
		protected $table = 'droitaccess';
		protected $primaryKey = 'IDdroitaccess';
		protected $allowedFields = ['IDdroitaccess','libelle'];
		
		public function recDroitaccess()
		{
			return $this->findAll();
		}
		
	}
?>