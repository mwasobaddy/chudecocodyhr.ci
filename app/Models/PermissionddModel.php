<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class PermissionddModel extends Model{
		protected $table = 'permissiondd';
		protected $primaryKey = 'IDpermission';
		protected $allowedFields = ['IDpermission','Idagent','motif','datesortie','lieu','jourdepart','jourarrivee','daterepriseeffective','validationcs','datecs','validationsus','datesus','validationsdrh','datesdrh','validationsd','datesd','validationdms','datedms','justificatif','etat'];
		
		public function recPermissiondd()
		{
			return $this->findAll();
		}
		
	}
?>