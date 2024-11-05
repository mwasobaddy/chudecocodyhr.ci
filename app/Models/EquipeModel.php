<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class EquipeModel extends Model{
		protected $table = 'equipe';
		protected $primaryKey = 'IDequipe';
		protected $allowedFields = ['IDequipe','libelle','IDservice'];
		
		public function recEquipe()
		{
			return $this->findAll();
		}
		
	}
?>