<?php

namespace App\Controllers;
use App\Models\TachesModel;
use CodeIgniter\Controller;

class Agent extends Controller {
	
	public function afficher($contenu = 'accueil')
	{
		if ( ! is_file(APPPATH.'/Views/connexion/'.$contenu.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
		}
		$data['titre'] = ucfirst($contenu); // Capitalize the first letter
		$data['contenu'] = $contenu;
		echo view('templates/connexion/entete', $data);
		echo view('connexion/'.$contenu, $data);
		echo view('templates/connexion/pied', $data);
	}
	
	public function index()
	{
		$model = new TachesModel();
		//echo '123456';
		
		$data = [
			'taches' => $model->recTaches(),
			'titre' => 'Liste de tâches',
		];
		echo view('templates/agent/entete', $data);
		//print_r($data);
		echo view('agent/apercu', $data);
		echo view('templates/agent/pied', $data);
		
	}
	
	
	public function creation()
	{
		helper('form');
		$model = new TachesModel();
		if (! $this->validate([
			'tache' => 'required|min_length[3]|max_length[30]'
		]))	{
			echo 'invalide';
			echo view('agent/creation', ['titre' => 'Creation de nouvelle tache']);
		}
		else
		{
			echo 'valide<br/>';
			//print_r($this->request->getVar('tache'));
			
			$model->save([
				//'id' => 2,
				'tache' => $this->request->getVar('tache'),
				'deadline' => $this->request->getVar('deadline'),
			]);
			
			echo view('agent/reussite');
			
		}
	}
	
	public function suppression($num)
	{
		$model = new TachesModel();
		$model->delete($num);
		echo view('agent/suppression');
	}
	

}