<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PlancongeannuelModel extends Model{
		protected $table = 'plancongeannuel';
		protected $primaryKey = 'IDplancongeannuel';
		protected $allowedFields = ['IDplancongeannuel','libelle','pdebut','pfin','publier','datecreation','creerpar'];
		
		public function recPlancongeannuel()
		{
			return $this->findAll();
		}
		
	}
?>