<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class GenreModel extends Model{
		protected $table = 'genre';
		protected $primaryKey = 'IDgenre';
		protected $allowedFields = ['IDgenre','libelle'];
		
		public function recGenre()
		{
			return $this->findAll();
		}
		
	}
?>