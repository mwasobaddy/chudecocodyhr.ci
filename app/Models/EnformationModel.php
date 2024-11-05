<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class EnformationModel extends Model{
		protected $table = 'enformation';
		protected $primaryKey = 'IDenformation';
		protected $allowedFields = ['IDenformation','Intitule','datedepart','datereprise','daterepriseeffective','details','Idagent'];
		
		public function recEnformation()
		{
			return $this->findAll();
		}
		
	}
?>