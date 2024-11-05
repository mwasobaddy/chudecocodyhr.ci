<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PlanpermanenceModel extends Model{
		protected $table = 'planpermanence';
		protected $primaryKey = 'IDplanpermanence';
		protected $allowedFields = ['IDplanpermanence','libelle','creepar','creele','IDservice','validationcs','validationdaf','validationdg','validationdms','validationdsio','validationcctos','validationsus','validationsd','publier','IDmois','lit'];


		public function recPlanpermanence()
		{
			return $this->findAll();
		}
		
	}
?>