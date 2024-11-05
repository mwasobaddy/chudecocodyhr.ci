<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class AgentModel extends Model{
		protected $table = 'agent';
		protected $primaryKey = 'idagent';
		protected $allowedFields = ['idagent','matricule','nom','datenais','adresse','telephone','mobile','email','actif','psfp','pschu','Observations','Photo','SaisiPar','SaisiLe','ModifiePar','ModifieLe','IDcontrat','IDemploi','IDlafonction','IDgrade','IDdroitaccess','Responsablen1','Responsablen2','Sousdrh','Directeurgeneral','IDdirection','IDsousdirection','IDservice','IDgenre','IDsituationmatrimoniale','IDcivilite','enformation','dateformation','quitterchu','datequitterchu','alaretraite','dateretraite','motifquitterchu','position','datedisponibilite','motifdisponibilite','pwd'];
		
		protected $useTimestamps = false;
    	protected $createdField  = 'SaisiLe';
    	protected $updatedField  = 'ModifieLe';
    	//protected $deletedField  = 'deleted_at';
		
		public function recAgent()
		{
			return $this->findAll();
		}
		
	}
?>