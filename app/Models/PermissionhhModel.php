<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PermissionhhModel extends Model{
		protected $table = 'permissionhh';
		protected $primaryKey = 'IDpermission';
		protected $allowedFields = ['IDpermission','Idagent','objetsortie','datesortie','lieu','heuredepart','heurearrivee','heurearriveeeffective','validationcs','datecs','validationsus','datesus','validationsdrh','datesdrh','justificatif','etat'];
		
		public function recPermissionhh()
		{
			return $this->findAll();
		}
		
	}
?>