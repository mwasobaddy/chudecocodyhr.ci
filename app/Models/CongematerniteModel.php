<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class CongematerniteModel extends Model{
		protected $table = 'congematernite';
		protected $primaryKey = 'IDconge';
		protected $allowedFields = ['IDconge','Idagent','datedemande','datevalidation','datedepart','datereprise','duree','dateterme','etat','validationcs','validationsus','motifrejet','datecs','datesus','justificatif1','justificatif2','justificatif3'];
		
		public function recCongematernite()
		{
			return $this->findAll();
		}
		
	}
?>