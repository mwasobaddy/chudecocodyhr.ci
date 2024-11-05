<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class AgentplanpermanenceModel extends Model{
		protected $table = 'agentplanpermanence';
		protected $primaryKey = 'idagentplanpermanence';
		protected $allowedFields = ['IDplanpermanence','IDequipe','IDjourplan','idagentplanpermanence','changement','justificatif'];
		
		public function recAgentplanpermanence()
		{
			return $this->findAll();
		}
		
	}
?>