<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class GradeModel extends Model{
		protected $table = 'grade';
		protected $primaryKey = 'IDgrade';
		protected $allowedFields = ['IDgrade','libelle'];
		
		public function recGrade()
		{
			return $this->findAll();
		}
		
	}
?>