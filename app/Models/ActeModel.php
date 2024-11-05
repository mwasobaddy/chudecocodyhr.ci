<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	class ActeModel extends Model{
		protected $table = 'acte';
		protected $primaryKey = 'idacte';
		protected $allowedFields = ['idacte','titre','categorie','lien','basename','idagent'];
		public function recActe()
		{
			return $this->findAll();
		}
	}
?>
