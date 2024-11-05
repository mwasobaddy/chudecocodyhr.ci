<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class ArrettravailModel extends Model{
		protected $table = 'arrettravail';
		protected $primaryKey = 'IDarrettravail';
		protected $allowedFields = ['IDarrettravail','Idagent','datedepart','datereprise','duree','etat','validationcs','motifrejet','datecs','justificatif1','motif','details','datevalidation','validationsdrh','datesdrh'];
		public function RecArrettravail()
		{
			return $this->findAll();
		}
		
	}
?>