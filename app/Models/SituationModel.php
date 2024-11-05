<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class SituationModel extends Model{
		protected $table = 'situationmatrimoniale';
		protected $primaryKey = 'IDsituationmatrimoniale';
		protected $allowedFields = ['IDsituationmatrimoniale','libelle'];
		
		public function recSituation()
		{
			return $this->findAll();
		}
		
	}
?>