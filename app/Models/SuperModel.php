<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class SuperModel extends Model{
		protected $table = 'superadm';
		protected $primaryKey = 'idagent';
		protected $allowedFields = ['idagent','matricule','nom','datenais','adresse','telephone','mobile','email','actif','psfp','pschu','Observations','Photo','SaisiPar','SaisiLe','ModifiePar','ModifieLe','IDcontrat','IDemploi','IDlafonction','IDgrade','IDdroitaccess','Responsablen1','Responsablen2','Sousdrh','Directeurgeneral','IDdirection','IDsousdirection','IDservice','IDgenre','IDsituationmatrimoniale','IDcivilite','pwd'];
		
		public function recSuper()
		{
			return $this->findAll();
		}
		
	}
?>