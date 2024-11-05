<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	
	class AllinoneModel extends Model{
		protected $table = '*';
		protected $allowedFields = ['*'];
		
		public function recAllinone()
		{
			return $this->findAll();
		}
	}
?>