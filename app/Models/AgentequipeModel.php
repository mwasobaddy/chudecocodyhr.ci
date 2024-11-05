<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class AgentequipeModel extends Model{
		protected $table = 'agent_equipe';
		protected $primaryKey = 'idagentequipe';
		protected $allowedFields = ['idagentequipe','Idagent','IDequipe'];
		
		public function recAgentequipe()
		{
			return $this->findAll();
		}
		
	}
?>