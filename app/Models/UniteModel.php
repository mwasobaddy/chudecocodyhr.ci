<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class UniteModel extends Model{
		protected $table = 'unite';
		protected $primaryKey = 'IDunite';
		protected $allowedFields = ['IDunite','libelle','titreadm','lienadm','titrerespo','lienrespo','titreuser','lienuser'];
		public function recUnite()
		{
			return $this->findAll();
		}
		
	}
?>