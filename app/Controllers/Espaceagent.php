<?php

namespace App\Controllers;
use App\Models\AgentModel;
use App\Models\AllinoneModel;
use App\Models\ContratModel;
use App\Models\DirectionModel;
use App\Models\DroitaccessModel;
use App\Models\EmploiModel;
use App\Models\UniteModel;
use App\Models\FonctionModel;
use App\Models\GenreModel;
use App\Models\GradeModel;
use App\Models\RoleagentModel;
use App\Models\RoleModel;
use App\Models\ArrettravailModel;

use App\Models\ServiceModel;
use App\Models\AgentplanpermanenceModel;
use App\Models\PlanpermanenceModel;

use App\Models\SituationModel;
use App\Models\CiviliteModel;
use App\Models\SousdirectionModel;

use App\Models\CongeannuelModel;
use App\Models\CongematerniteModel;
use App\Models\PermissionddModel;
use App\Models\PermissionhhModel;

use App\Models\PlancongeannuelModel;

$this->session = \Config\Services::session();


use CodeIgniter\Controller;

class Espaceagent extends Controller {
	
	public function afficher($contenu = 'accueil')
	{
		if ( ! is_file(APPPATH.'/Views/espaceagent/'.$contenu.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
		}
		$data['titre'] = ucfirst($contenu);     // Capitalize the first letter
		$data['contenu'] = $contenu;
		
				
		echo view('templates/espaceagent/entete', $data);
		echo view('templates/espaceagent/sidebar', $data);
		echo view('templates/espaceagent/topbar', $data);
		//echo view('templates/espaceagent/pagecontent', $data);
		echo view('espaceagent/'.$contenu, $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	public function index()
	{
		
		
		
		$model = new AgentModel();

		
		
		
		
		
		///////////////////////////////////////////////////////////////////////////////////////
		//$model = new AgentModel();
		$data = [
			'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
		];
		echo view('templates/espaceagent/entete', $data);
		echo view('templates/espaceagent/sidebar', $data);
		echo view('templates/espaceagent/topbar', $data);
		
		//echo view('templates/espaceagent/entete', $data);
		
		echo view('espaceagent/accueil', $data);
		
		echo view('templates/espaceagent/pied', $data);
	
	}



	public function accueil()
	{
		
		$model = new AgentModel();

		///////////////////////////////////////////////////////////////////////////////////////
		//$model = new AgentModel();
		$data = [
			'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
		];
		echo view('templates/espaceagent/entete', $data);
		echo view('templates/espaceagent/sidebar', $data);
		echo view('templates/espaceagent/topbar', $data);
		
		//echo view('templates/espaceagent/entete', $data);
		
		echo view('espaceagent/accueil', $data);
		
		echo view('templates/espaceagent/pied', $data);
	
	}	
	
	public function listagent2()
	{
		$model = new AgentModel();
		$data = [
			'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
		];
		echo view('templates/espaceagent/entete', $data);
		echo view('templates/espaceagent/sidebar', $data);
		echo view('templates/espaceagent/topbar', $data);
		
		//echo view('templates/espaceagent/entete', $data);
		
		echo view('espaceagent/apercuagent', $data);
		
		echo view('templates/espaceagent/pied', $data);
	}
	
	public function monprofil()
	{
		
			
		//print_r($this);
		helper('form');
		
		$model = new AgentModel();
		
		if (! $this->validate([
			/*'name' => 'required|min_length[1]|max_length[150]',
			'matricule'	=> 'required|min_length[5]|max_length[10]',
			'datenais'	=> 'required',
			'mobile'	=> 'required|min_length[10]|max_length[14]',
			'email'	=> 'required|min_length[1]|max_length[100]',
			'psfp'	=> 'required',
			'pschu'	=> 'required'*/
		]))	{
				
			//echo view('espaceagent/'.$contenu, $data);
//print_r($this->request->getVar());


			echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		
			echo view('espaceagent/monprofil');
			echo view('templates/espaceagent/pied');
		}
		else
		{
			//print_r($this->request->getVar());
			
			$model->save([
				//'id' => 2,
				'matricule'	=> $this->request->getVar('matricule'),
				'nom'	=> $this->request->getVar('name'),
				'datenais'	=> $this->request->getVar('datenais'),
				'adresse'	=> $this->request->getVar('adresse'),
				'telephone'	=> $this->request->getVar('fixe'),
				'mobile'	=> $this->request->getVar('mobile'),
				'email'	=> $this->request->getVar('email'),
				'actif'	=> $this->request->getVar('actif'),	
				'psfp'	=> $this->request->getVar('psfp'),
				'pschu'	=> $this->request->getVar('pschu'),
				'Observations'	=> $this->request->getVar('observations'),
				'Photo'	=> $this->request->getVar('photo'),
				'SaisiPar'	=> '',
				'SaisiLe'	=> date('Y-m-d'),
				'ModifiePar'	=> '',
				'ModifieLe'	=> date("Y-m-d"),
				'IDcontrat'	=> $this->request->getVar('IDcontrat'),
				'IDemploi'	=> $this->request->getVar('IDemploi'),
				'IDlafonction'	=> $this->request->getVar('IDlafonction'),
				'IDgrade'	=> $this->request->getVar('IDgrade'),
				'IDdroitaccess'	=> $this->request->getVar('IDdroitaccess'),
				'Responsablen1'	=> $this->request->getVar('Responsablen1'),
				'Responsablen2'	=> $this->request->getVar('Responsablen2'),
				'Sousdrh'	=> $this->request->getVar('Sousdrh'),
				'Directeurgeneral'	=> $this->request->getVar('Directeurgeneral'),
				'IDdirection'	=> $this->request->getVar('IDdirection'),
				'IDsousdirection'	=> $this->request->getVar('IDsousdirection'),
				'IDservice'	=> $this->request->getVar('IDservice'),
				'IDgenre'	=> $this->request->getVar('IDgenre'),
				'IDcivilite'	=> $this->request->getVar('IDcivilite'),
				//'IDsituationmatrimoniale' => $this->request->getVar('IDsituationmatrimoniale'),
			]);
			
			
			
			/*echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');*/
		return redirect()->to(base_url('/espaceagent/listagent'));
			//echo view('espaceagent/listagent');
			//echo view('templates/espaceagent/pied');
		}
	}

	
	public function monprofil2()
	{
		 unset($data);
		$genremodel = new GenreModel();
			$data['lgenre'] = $genremodel->recGenre();
			
			$genremodel = new PlancongeannuelModel();
			$data['plancongeannuel'] = $genremodel->recPlancongeannuel();
			
			$AgentModel = new AgentModel();
			$data['lagent'] = $AgentModel->recAgent();
			
			$AllinoneModel = new AllinoneModel();
			$data['lallinone'] = $AllinoneModel->recAllinone();
			
			$ContratModel = new ContratModel();
			$data['lcontrat'] = $ContratModel->recContrat();
			
			$DirectionModel = new DirectionModel();
			$data['ldirection'] = $DirectionModel->recDirection();
			
			$DroitaccessModel = new DroitaccessModel();
			$data['ldroitaccess'] = $DroitaccessModel->recDroitaccess();
			
			$EmploiModel = new EmploiModel();
			$data['lemploi'] = $EmploiModel->recEmploi();
			
			$FonctionModel = new FonctionModel();
			$data['lfonction'] = $FonctionModel->recFonction();

			$GradeModel = new GradeModel();
			$data['lgrade'] = $GradeModel->recGrade();
			
			$RoleagentModel = new RoleagentModel();
			$data['lroleagent'] = $RoleagentModel->recRoleagent();
			
			$RoleModel = new RoleModel();
			$data['lrole'] = $RoleModel->recRole();
			
			$ServiceModel = new ServiceModel();
			$data['lservice'] = $ServiceModel->recService();
			
			$SituationModel = new SituationModel(); //ServiceModel
			$data['lsituation'] = $SituationModel->recSituation();
			
			$SousdirectionModel = new SousdirectionModel();
			$data['lsousdirection'] = $SousdirectionModel->recSousdirection();
			
		//print_r($this);
		helper('form');
		
		$model = new AgentModel();
		
		if (! $this->validate([
			/*'name' => 'required|min_length[1]|max_length[150]',
			'matricule'	=> 'required|min_length[5]|max_length[10]',
			'datenais'	=> 'required',
			'mobile'	=> 'required|min_length[10]|max_length[14]',
			'email'	=> 'required|min_length[1]|max_length[100]',
			'psfp'	=> 'required',
			'pschu'	=> 'required'*/
		]))	{
				
			//echo view('espaceagent/'.$contenu, $data);
//print_r($this->request->getVar());


			echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		
			echo view('espaceagent/monprofil', $data);
			echo view('templates/espaceagent/pied');
		}
		else
		{
			//print_r($this->request->getVar());
			
			$model->save([
				//'id' => 2,
				'matricule'	=> $this->request->getVar('matricule'),
				'nom'	=> $this->request->getVar('name'),
				'datenais'	=> $this->request->getVar('datenais'),
				'adresse'	=> $this->request->getVar('adresse'),
				'telephone'	=> $this->request->getVar('fixe'),
				'mobile'	=> $this->request->getVar('mobile'),
				'email'	=> $this->request->getVar('email'),
				'actif'	=> $this->request->getVar('actif'),	
				'psfp'	=> $this->request->getVar('psfp'),
				'pschu'	=> $this->request->getVar('pschu'),
				'Observations'	=> $this->request->getVar('observations'),
				'Photo'	=> $this->request->getVar('photo'),
				'SaisiPar'	=> '',
				'SaisiLe'	=> date('Y-m-d'),
				'ModifiePar'	=> '',
				'ModifieLe'	=> date("Y-m-d"),
				'IDcontrat'	=> $this->request->getVar('IDcontrat'),
				'IDemploi'	=> $this->request->getVar('IDemploi'),
				'IDlafonction'	=> $this->request->getVar('IDlafonction'),
				'IDgrade'	=> $this->request->getVar('IDgrade'),
				'IDdroitaccess'	=> $this->request->getVar('IDdroitaccess'),
				'Responsablen1'	=> $this->request->getVar('Responsablen1'),
				'Responsablen2'	=> $this->request->getVar('Responsablen2'),
				'Sousdrh'	=> $this->request->getVar('Sousdrh'),
				'Directeurgeneral'	=> $this->request->getVar('Directeurgeneral'),
				'IDdirection'	=> $this->request->getVar('IDdirection'),
				'IDsousdirection'	=> $this->request->getVar('IDsousdirection'),
				'IDservice'	=> $this->request->getVar('IDservice'),
				'IDgenre'	=> $this->request->getVar('IDgenre'),
				'IDcivilite'	=> $this->request->getVar('IDcivilite'),
				//'IDsituationmatrimoniale' => $this->request->getVar('IDsituationmatrimoniale'),
			]);
			
			
			
			/*echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');*/
		return redirect()->to(base_url('/espaceagent/listagent'));
			//echo view('espaceagent/listagent');
			//echo view('templates/espaceagent/pied');
		}
	}
	
	
	public function delagent($num)
	{
		$model = new AgentModel();
		//var_dump($model->delete($num));
		//$model->delete($num);
		//echo view('espaceagent/supprimeragent');
		$model->where('idagent', $num);
		$model->delete();
		
		$this->index();
		//echo view('espaceagent/listagent');
	}
	
	
	public function delagentplanpermanance($num)
	{
		$model = new AgentplanpermananceModel();
		$model->where('idagentplanpermanance', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creeragentplanpermanance'));
	}
	

	public function delcivilite($num)
	{
		$model = new CiviliteModel();
		$model->where('IDcivilite', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creercivilite'));
	}
	
	

	public function delcongeannuel($num)
	{
		$model = new CongeannuelModel();
		$model->where('IDconge', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creercongeannuel'));
		//$this->index();
	}
	

	public function delcongematernite($num)
	{
		$model = new CongematerniteModel();
		$model->where('IDconge', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creercongematernite'));
	}
	

	public function delcontrat($num)
	{
		$model = new ContratModel();
		$model->where('IDcontrat', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creercontrat'));
	}
	

	public function deldirection($num)
	{
		$model = new DirectionModel();
		$model->where('IDdirection', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerdirection'));
	}
	

	public function deldroitaccess($num)
	{
		$model = new DroitaccessModel();
		$model->where('IDdroitaccess', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerdroitaccess'));
	}
	

	public function delemploi($num)
	{
		$model = new EmploiModel();
		$model->where('IDemploi', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creeremploi'));
	}
	

	public function delgenre($num)
	{
		$model = new GenreModel();
		$model->where('IDgenre', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creergenre'));
	}
	

	public function delgrade($num)
	{
		$model = new GradeModel();
		$model->where('IDgrade', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creergrade'));
	}
	

	public function deljourplan($num)
	{
		$model = new JourplanModel();
		$model->where('IDjourplan', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerjourplan'));
	}
	

	public function dellafonction($num)
	{
		$model = new FonctionModel();
		$model->where('IDlafonction', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerfonction'));
	}
	

	public function delpermissiondd($num)
	{
		$model = new PermissionddModel();
		$model->where('IDpermission', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerpermissiondd'));
	}
	

	public function delpermissionhh($num)
	{
		$model = new PermissionhhModel();
		$model->where('IDpermission', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerpermissionhh'));
	}
	

	public function delplancongeannuel($num)
	{
		$model = new PlancongeannuelModel();
		$model->where('IDplancongeannuel', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerplancongeannuel'));
	}
	

	public function delplanpermanance($num)
	{
		$model = new PlanpermananceModel();
		$model->where('IDplanpermanance', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerplanpermanance'));
	}
	

	public function delrole($num)
	{
		$model = new RoleModel();
		$model->where('IDrole', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerrole'));
	}
	

	public function delroleagent($num)
	{
		$model = new RoleagentModel();
		$model->where('IDroleagent', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerroleagent'));
	}
	

	public function delservice($num)
	{
		$model = new ServiceModel();
		$model->where('IDservice', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creerservice'));
	}
	

	public function delsituationmatrimoniale($num)
	{
		$model = new SituationModel();
		$model->where('IDsituationmatrimoniale', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creersituationmatrimoniale'));
	}
	

	public function delsousdirection($num)
	{
		$model = new SousdirectionModel();
		$model->where('IDsousdirection', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceagent/creersousdirection'));
	}
	


	public function delunite($num)
	{
		$model = new UniteModel();
		$model->where('IDunite', $num);
		$model->delete();
		//return redirect()->to(base_url('/espaceagent/creeunite'));
		return redirect()->to(base_url('/espaceagent/creerunite'));
	}
	
	
	
	public function creation()
	{
		helper('form');
		$model = new AgentModel();
		if (! $this->validate([
			'matricule' => 'required|min_length[1]|max_length[30]'
		]))	{
			
			//$data='';
			echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		echo view('espaceagent/creation', ['titre' => 'Creation d\'un nouvel agent']);
		
		//echo view('espaceagent/apercuagent', $data);
		
		echo view('templates/espaceagent/pied');
		//echo view('espaceagent/creation', ['titre' => 'Creation d\'un nouvel agent']);
		
		}
		else
		{
			$model->save([
				//'id' => 2,
				'matricule'	=> $this->request->getVar('matricule'),
				'nom'	=> $this->request->getVar('nom'),
				'datenais'	=> $this->request->getVar('datenais'),
			]);
			

			echo view('espaceagent/reussite');
		}
	}






/////////////////////////////////////////////////////////////////////////////////////
///////////////////////// DONNEES DE BASE //////////////////////////////////////
	public function creerdirection()
	{
		helper('form');
		$model = new DirectionModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerdirection'));
			//echo view('espaceagent/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];
		echo view('espaceagent/apercudirection', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////
	public function creercontrat()
	{
		helper('form');
		$model = new ContratModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creercontrat', ['titre' => 'Creation d\'un nouvel agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creercontrat'));
			//echo view('espaceagent/creercontrat', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'contrat' => $model->recContrat(),
			'titre' => 'Liste des contrats',
		];
		echo view('espaceagent/apercucontrat', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	////////////////////////////////////////////////////////////////////////////
	public function creerdroitaccess()
	{
		helper('form');
		$model = new DroitaccessModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creerdroitaccess', ['titre' => 'Creation d\'un nouvel agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerdroitaccess'));
			//echo view('espaceagent/creerdroitaccess', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'droitaccess' => $model->recDroitaccess(),
			'titre' => 'Liste des droits d\'accès',
		];
		echo view('espaceagent/apercudroitaccess', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////
	public function creeremploi()
	{
		helper('form');
		$model = new EmploiModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creeremploi', ['titre' => 'Creation d\'un nouvel agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creeremploi'));
			//echo view('espaceagent/creeremploi', ['titre' => 'Creation d\'un nouvel emploi']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'emploi' => $model->recEmploi(),
			'titre' => 'Liste des emplois',
		];
		echo view('espaceagent/apercuemploi', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	////////////////////////////////////////////////////////////
	public function creergrade()
	{
		helper('form');
		$model = new GradeModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creergrade', ['titre' => 'Creation d\'un grade']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creergrade'));
			//echo view('espaceagent/creergrade', ['titre' => 'Creation d\'un grade']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'grade' => $model->recGrade(),
			'titre' => 'Liste des grades',
		];
		echo view('espaceagent/apercugrade', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	
	//////////////////////////////////////////////////////////////////
	public function creerfonction()
	{
		helper('form');
		$model = new FonctionModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creerfonction', ['titre' => 'Creation d\'une fonction']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerfonction'));
			//echo view('espaceagent/creerfonction', ['titre' => 'Creation d\'une fonction']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'fonction' => $model->recFonction(),
			'titre' => 'Liste des fonctions',
		];
		echo view('espaceagent/apercufonction', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////
	public function creerrole()
	{
		helper('form');
		$model = new RoleModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creerrole', ['titre' => 'Creation d\'un rôle']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerrole'));
			//echo view('espaceagent/creerrole', ['titre' => 'Creation d\'un rôle']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'role' => $model->recRole(),
			'titre' => 'Liste des rôles',
		];
		echo view('espaceagent/apercurole', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////
	
	public function creerplancongeannuel()
	{
		$genremodel = new PlancongeannuelModel();
		$data['plancongeannuel'] = $genremodel->recPlancongeannuel();
		helper('form');
		$model = new PlancongeannuelModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			
			echo view('espaceagent/creerplancongeannuel', $data);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'pfin'	=> $this->request->getVar('pfin'),
				'pdebut'	=> $this->request->getVar('pdebut'),
				'publier'	=> $this->request->getVar('publier'),
				'datecreation'	=> date('Y-m-d'),
				'creepar'	=> $_SESSION['cnxname'],
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerplancongeannuel'));
			//echo view('espaceagent/creerplancongeannuel', $data);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'plancongeannuel' => $model->recPlancongeannuel(),
			'titre' => 'Liste des plancongeannuel',
		];
		echo view('espaceagent/apercuplancongeannuel', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creersousdirection()
	{
		helper('form');
		$model = new SousdirectionModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creersousdirection', ['titre' => 'Creation d\'une Sous-Direction']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creersousdirection'));
			echo view('espaceagent/creersousdirection', ['titre' => 'Creation d\'une Sous-Direction']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'sousdirection' => $model->recSousdirection(),
			'titre' => 'Liste des Sous-Directions',
		];
		echo view('espaceagent/apercusousdirection', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerservice()
	{
		helper('form');
		$model = new ServiceModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creerservice', ['titre' => 'Creation d\'un service']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerservice'));
			echo view('espaceagent/creerservice', ['titre' => 'Creation d\'un service']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'service' => $model->recService(),
			'titre' => 'Liste des services',
		];
		echo view('espaceagent/apercuservice', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerroleagent()
	{
		helper('form');
		$model = new RoleagentModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creerroleagent', ['titre' => 'Creation d\'un role-agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerroleagent'));
			
			//echo view('espaceagent/creerroleagent', ['titre' => 'Creation d\'un role-agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'roleagent' => $model->recRoleagent(),
			'titre' => 'Liste des role-agent',
		];
	
		echo view('espaceagent/apercuroleagent', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	/////////////////////// FIN DONNEES DE BASE //////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////// DEBUT MODULE PERMISSION //////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
	public function fetchcongeannuel()
	{
		$id=$_POST['id'];
		$db = \Config\Database::connect();
		$query = $db->query('SELECT pdebut, pfin  from plancongeannuel where IDplancongeannuel='.$id);
		$results = $query->getResult();
		return json_encode($results[0]);
		
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creercongeannuel()
	{
	
		helper('form');
		$model = new CongeannuelModel();
		$IDplancong =$this->request->getVar('IDplancongeannuel');
		$db = \Config\Database::connect();
		$query = $db->query('SELECT pdebut, pfin  from plancongeannuel where IDplancongeannuel='.$IDplancong);
		$results = $query->getResult();

		// print_r($results);
		

		$datedepart = $this->request->getVar('datedepart');

		// print_r($datedepart);

		// exit;	
		if (! $this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'IDplancongeannuel' => 'required',
			//'datedepart' => 'required',
			//'datereprise' => 'required',
			'duree' => 'required',
			//'lieu' => 'required',
			//'adresse' => 'required',
			//'telephone' => 'required',
		]) || !($results[0]->pfin > $datedepart &&  $results[0]->pdebut < $datedepart))	{
			
			$data = [
				'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];

			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creercongeannuel', $data);
		}
		else
		{		
			

			$mask = '+ '.$this->request->getVar('duree').' days';
			$depa = $this->request->getVar('datedepart');
			$dd = date('Y-m-d', strtotime($depa. ''.$mask));
			$d1 = date('Y-m-d', strtotime($depa. '- 21 days'));
			$d2 = date('Y-m-d', strtotime($depa. '- 14 days'));
			$d3 = date('Y-m-d', strtotime($depa. '- 7 days'));
			$model->save([
				'Idagent' => $this->request->getVar('Idagent'),
				'IDplancongeannuel' => $this->request->getVar('IDplancongeannuel'),
				'datedemande' => date('Y-m-d'),
				'datevalidation' => $this->request->getVar('datevalidation'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $dd,
				'duree' => $this->request->getVar('duree'),
				'lieu' => $this->request->getVar('lieu'),
				'adresse' => $this->request->getVar('adresse'),
				'telephone' => $this->request->getVar('telephone'),
				'motifrejet' => $this->request->getVar('motifrejet'),
				'justificatif1' => date('Y-m-d'),
				'etat' => 'ATTENTE DE VALIDATION',
				'alert1' => $d1,
				'alert2' => $d2,
				'alert3' => $d3,
				'alert1ok' => '0',
				'alert2ok' => '0',
				'alert3ok' => '0',
				/*'validationcs' => $this->request->getVar('validationcs'),
				'validationsdrh' => $this->request->getVar('validationsdrh'),
				'validationdg' => $this->request->getVar('validationdg'),
				'validationsd' => $this->request->getVar('validationsd'),
				'datecs' => $this->request->getVar('datecs'),
				'datesd' => $this->request->getVar('datesd'),
				'datesdrh' => $this->request->getVar('datesdrh'),
				'datedg' => $this->request->getVar('datedg'),*/
				'horspays'	=> $this->request->getVar('hp'),
				//'justificatif2' => $this->request->getVar('justificatif2'),
				
			]);

			
			$_SESSION['toast'] = 'Opération réussie !';
			//$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creercongeannuel'));
			
			//echo view('espaceagent/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congeannuel' => $model->recCongeannuel(),
			'titre' => 'Liste des congés annuel',
		];

		
		// 			print_r($this->request->getVar('hp'));
		// exit;
		echo view('espaceagent/apercucongeannuel', $data);
		echo view('templates/espaceagent/pied', $data);
		
	}
	
	
	public function editcongeannuel($m)
	{
			helper('form');
		$model = new CongeannuelModel();
		if (! $this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'IDplancongeannuel' => 'required',
			//'datedepart' => 'required',
			//'datereprise' => 'required',
			'duree' => 'required',
			//'lieu' => 'required',
			//'adresse' => 'required',
			//'telephone' => 'required',
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			
			$data = [
			'lidcongeannuel' => $m,
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
			echo view('espaceagent/creercongeannuel', $data);
		}
		else
		{
			
		/*	
			$ladif = date_diff(date_create(date('Y-m-d')),date_create($this->request->getVar('datedepart')));
			$laduree = date_diff(date_create($this->request->getVar('datedepart')),date_create($this->request->getVar('datereprise')));
			$dd = $ladif->format("%a");
			$ddd = */
			
			//$d4 = ''.date('Y-m-d', strtotime(($dd-11).' days'));
			
			$mask = '+ '.$this->request->getVar('duree').' days';
			$depa = $this->request->getVar('datedepart');
	
			$dd = date('Y-m-d', strtotime($depa. ''.$mask));
			$d1 = date('Y-m-d', strtotime($depa. '- 21 days'));
			$d2 = date('Y-m-d', strtotime($depa. '- 14 days'));
			$d3 = date('Y-m-d', strtotime($depa. '- 7 days'));
			$model->update($this->request->getVar('IDconge'),[
				'Idagent' => $this->request->getVar('Idagent'),
				'IDplancongeannuel' => $this->request->getVar('IDplancongeannuel'),
				'validationagent' => 1,				
				'datevalidation' => date('Y-m-d'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $dd,
				'duree' => $this->request->getVar('duree'),
				'lieu' => $this->request->getVar('lieu'),
				'adresse' => $this->request->getVar('adresse'),
				'telephone' => $this->request->getVar('telephone'),
				'motifrejet' => $this->request->getVar('motifrejet'),
				'alert1' => $d1,
				'alert2' => $d2,
				'alert3' => $d3,
				//'alert1ok' => '0',
				//'alert2ok' => '0',
				//'alert3ok' => '0',
				'etat' => 'MODIFICATION ET VALIDATION AGENT',
				/*'validationcs' => $this->request->getVar('validationcs'),
				'validationsdrh' => $this->request->getVar('validationsdrh'),
				'validationdg' => $this->request->getVar('validationdg'),
				'validationsd' => $this->request->getVar('validationsd'),
				'datecs' => $this->request->getVar('datecs'),
				'datesd' => $this->request->getVar('datesd'),
				'datesdrh' => $this->request->getVar('datesdrh'),
				'datedg' => $this->request->getVar('datedg'),*/
				'horspays'	=> $this->request->getVar('hp'),
				//'justificatif2' => $this->request->getVar('justificatif2'),
				
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			
			return redirect()->to(base_url('/espaceagent/creercongeannuel'));
			
			//echo view('espaceagent/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			//'congeannuel' => $model->recCongeannuel(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espaceagent/apercucongeannuel', $data);
		echo view('templates/espaceagent/pied', $data);
		
	}
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creercongematernite()
	{
		helper('form');
		$model = new CongematerniteModel();
		
		$validation =  \Config\Services::validation();
		$rule = [
			'Idagent' => 'required',
			//'datedemande'
			//'datevalidation'
			//'datedepart' => 'required',
			//'datereprise' => 'required',
			//'duree' => 'required',
			'dateterme' => 'required',
			/*'etat'
			'validationcs'
			'validationsus'
			'motifrejet'
			'datecs'
			'datesus'*/
			/*'justificatif1' => 'required',
			'justificatif2' => 'required',
			'justificatif3' => 'required',*/
		];
		if (empty($_FILES['justificatif1']['name']))
		{
			$rule['justificatif1'] = 'required';
		}else{
			$rule['justificatif1'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif1]'
						                    . '|mime_in[justificatif1,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (empty($_FILES['justificatif2']['name']))
		{
			$rule['justificatif2'] = 'required';
		}else{
			$rule['justificatif2'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif2]'
						                    . '|mime_in[justificatif2,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (empty($_FILES['justificatif3']['name']))
		{
			$rule['justificatif3'] = 'required';
		}else{
			$rule['justificatif3'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif3]'
						                    . '|mime_in[justificatif3,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (! $this->validate($rule))	{
			$errors = $validation->listErrors();
			// print_r($errors);exit;
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			$data = [
				'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'.$errors
			];
			echo view('espaceagent/creercongematernite', $data);
		}
		else
		{
			
			$depa = $this->request->getVar('dateterme');
			$ddepart = date('Y-m-d', strtotime($depa. '- 42 days'));
			$dretour = date('Y-m-d', strtotime($depa. '+ 57 days'));
			


			$path = './agents/'.$_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			} 
			
			$path = './agents/'.$_SESSION['mat'].'/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/'.$_SESSION['mat'].'/4-CONGES';
					$file = $this->request->getFile('justificatif1');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName1 = date('YmdHis').'justificatif1'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName1);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}

			$file = $this->request->getFile('justificatif2');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName2 = date('YmdHis').'justificatif2'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName2);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}
			

			$file = $this->request->getFile('justificatif3');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName3 = date('YmdHis').'justificatif3'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName3);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}
			
			
			$model->save([
				//'IDconge'	=> $this->request->getVar('IDconge'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				'datedemande'	=> date('Y-m-d'),
				'datevalidation'	=> $this->request->getVar('datevalidation'),
				'datedepart'	=> $ddepart,
				'datereprise'	=> $dretour,
				'duree'	=> '98 jours',
				'dateterme'	=> $this->request->getVar('dateterme'),
				'etat'	=> 'ATTENTE DE VALIDATION',
				'validationcs'	=> $this->request->getVar('validationcs'),
				'validationsus'	=> $this->request->getVar('validationsus'),
				'motifrejet'	=> $this->request->getVar('motifrejet'),
				'datecs'	=> $this->request->getVar('datecs'),
				'datesus'	=> $this->request->getVar('datesus'),
				'justificatif1'	=> $newName1,
				'justificatif2'	=> $newName2,
				'justificatif3'	=> $newName3,
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creercongematernite'));
			//echo view('espaceagent/creercongematernite', ['titre' => 'Creation d\'un congé de maternité']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congematernite' => $model->recCongematernite(),
			'titre' => 'Liste des congés de maternité',
		];
		echo view('espaceagent/apercucongematernite', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	public function editcongematernite($m)
	{
		helper('form');
		$model = new CongematerniteModel();
		$rules = [
			'Idagent' => 'required',
			//'datedepart' => 'required',
			//'datereprise' => 'required',
			//'duree' => 'required',
			'dateterme' => 'required',
			
		];
		if (!empty($_FILES['justificatif1']['name']))
		{
			$rule['justificatif1'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif1]'
						                    . '|mime_in[justificatif1,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (!empty($_FILES['justificatif2']['name']))
		{
			$rule['justificatif2'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif2]'
						                    . '|mime_in[justificatif2,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (!empty($_FILES['justificatif3']['name']))
		{
			$rule['justificatif3'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif3]'
						                    . '|mime_in[justificatif3,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (! $this->validate($rules))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			$data = [
			'lidcongematernite' => $m,
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
			
			echo view('espaceagent/creercongematernite',$data);
		}
		else
		{
			
			$depa = $this->request->getVar('dateterme');
	$ddepart = date('Y-m-d', strtotime($depa. '- 42 days'));
	$dretour = date('Y-m-d', strtotime($depa. '+ 57 days'));
	


	$path = './agents/'.$_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			} 
			
			$path = './agents/'.$_SESSION['mat'].'/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/'.$_SESSION['mat'].'/4-CONGES';
					$file = $this->request->getFile('justificatif1');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName1 = date('YmdHis').'justificatif1'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName1);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}

			$file = $this->request->getFile('justificatif2');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName2 = date('YmdHis').'justificatif2'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName2);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}
			

			$file = $this->request->getFile('justificatif3');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName3 = date('YmdHis').'justificatif3'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName3);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}
			


			$model->update($this->request->getVar('IDconge'),[
				//'IDconge'	=> $this->request->getVar('IDconge'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				//'datedemande'	=> $this->request->getVar('datedemande'),
				//'datevalidation'	=> $this->request->getVar('datevalidation'),
				'datedepart'	=> $ddepart,
				'datereprise'	=> $dretour,
				'duree'	=> '98 jours',
				'dateterme'	=> $this->request->getVar('dateterme'),
				//'etat'	=> 'ATTENTE DE VALIDATION',
				'justificatif1'	=> $newName1,
				'justificatif2'	=> $newName2,
				'justificatif3'	=> $newName3,
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creercongematernite'));
			//echo view('espaceagent/creercongematernite', ['titre' => 'Creation d\'un congé de maternité']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congematernite' => $model->recCongematernite(),
			'titre' => 'Liste des congés de maternité',
		];
		echo view('espaceagent/apercucongematernite', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerpermissiondd()
	{
		helper('form');
		$model = new PermissionddModel();
		
		// If form is submitted
		if ($this->request->getMethod() === 'post') {
			// Validation rules
			$rules = [
				'Idagent'    => 'required',
				'motif'      => 'required',
				'datesortie' => 'required',
				'lieu'       => 'required',
				'jourdepart' => 'required',
				'jourarrivee'=> 'required'
			];
	
			// Add file validation if file is uploaded
			if (!empty($_FILES['justificatif']['name'])) {
				$rules['justificatif'] = [
					'label' => 'Justificatif',
					'rules' => 'uploaded[justificatif]|mime_in[justificatif,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]'
				];
			}
	
			if ($this->validate($rules)) {
				try {
					// Handle file upload
					$newName = '';
					if ($file = $this->request->getFile('justificatif')) {
						if ($file->isValid() && !$file->hasMoved()) {
							// Create directories if they don't exist
							$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
							if (!is_dir($path)) {
								mkdir($path, 0777, true);
							}
							
							$newName = date('YmdHis') . 'justificatif' . $_SESSION['mat'] . '.' . $file->getClientExtension();
							$file->move($path, $newName);
							
							// Log successful file upload
							echo "<script>console.log('File uploaded successfully: " . $newName . "');</script>";
						}
					}
	
					// Prepare data for database
					$data = [
						'Idagent'     => $this->request->getPost('Idagent'),
						'motif'       => $this->request->getPost('motif'),
						'datesortie'  => $this->request->getPost('datesortie'),
						'lieu'        => $this->request->getPost('lieu'),
						'jourdepart'  => $this->request->getPost('jourdepart'),
						'jourarrivee' => $this->request->getPost('jourarrivee'),
						'etat'        => 'ATTENTE DE VALIDATION',
						'justificatif'=> $newName
					];
	
					// Save to database
					if ($model->save($data)) {
						echo "<script>console.log('Permission request saved successfully');</script>";
						$_SESSION['toast'] = 'Opération réussie !';
						return redirect()->to(base_url('/espaceagent/creerpermissiondd'));
					} else {
						echo "<script>console.error('Database save failed:', " . json_encode($model->errors()) . ");</script>";
						throw new \RuntimeException('Failed to save permission request');
					}
	
				} catch (\Exception $e) {
					echo "<script>console.error('Error:', " . json_encode($e->getMessage()) . ");</script>";
					$_SESSION['toast'] = 'Une erreur est survenue';
				}
			} else {
				// Validation failed
				echo "<script>console.error('Validation errors:', " . json_encode($this->validator->getErrors()) . ");</script>";
			}
		}
	
		// Display form
		$data = [
			'permissiondd' => $model->recPermissiondd(),
			'titre' => 'Liste des permissions jour à jour',
			'validation' => $this->validator ?? null
		];
	
		echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		echo view('espaceagent/creerpermissiondd', $data);
		echo view('espaceagent/apercupermissiondd', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
		public function editpermissiondd($m)
	{
		helper('form');
		$model = new PermissionddModel();
		$rules = [
			'Idagent'  => 'required',
			'motif'  => 'required',
			'datesortie'  => 'required',
			'lieu'  => 'required',
			'jourdepart'  => 'required',
			'jourarrivee'  => 'required',
			//'etat'	=> 'ATTENTE DE VALIDATION',
			/*'validationcs'  => 'required',
			'datecs'  => 'required',
			'validationsus'  => 'required',
			'datesus'  => 'required',
			'validationsdrh'  => 'required',
			'datesdrh'  => 'required',
			'validationsd'  => 'required',
			'datesd'  => 'required',
			'validationdms'  => 'required',
			'datedms'  => 'required',*/
			//'justificatif'  => 'required',
		];
		if (!empty($_FILES['justificatif']['name'])) {
			$rule['justificatif'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif]'
						                    . '|mime_in[justificatif,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (! $this->validate($rules))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			$data = [
			'lidpermissiondd' => $m,
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
			echo view('espaceagent/creerpermissiondd', $data);
		}
		else
		{
			
			$path = './agents/'.$_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			} 
			$newName = '';
			$path = './agents/'.$_SESSION['mat'].'/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/'.$_SESSION['mat'].'/4-CONGES';
			//echo $lieu;
			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName = date('YmdHis').'justificatif'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					if($file->move($lieu, $newName)) {//throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
					echo 'YES = '.$lieu.'<br>'; var_dump($file);} else {echo 'NO';}
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}

			    if($model->update($this->request->getVar('IDpermission'),[
				//'IDpermission'	=> $this->request->getVar('IDpermission'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				'motif'	=> $this->request->getVar('motif'),
				'datesortie'	=> $this->request->getVar('datesortie'),
				'lieu'	=> $this->request->getVar('lieu'),
				'jourdepart'	=> $this->request->getVar('jourdepart'),
				'jourarrivee'	=> $this->request->getVar('jourarrivee'),
				'etat'	=> 'ATTENTE DE VALIDATION',
				/*'validationcs'	=> $this->request->getVar('validationcs'),
				'datecs'	=> $this->request->getVar('datecs'),
				'validationsus'	=> $this->request->getVar('validationsus'),
				'datesus'	=> $this->request->getVar('datesus'),
				'validationsdrh'	=> $this->request->getVar('validationsdrh'),
				'datesdrh'	=> $this->request->getVar('datesdrh'),
				'validationsd'	=> $this->request->getVar('validationsd'),
				'datesd'	=> $this->request->getVar('datesd'),
				'validationdms'	=> $this->request->getVar('validationdms'),
				'datedms'	=> $this->request->getVar('datedms'),*/
				'justificatif'	=> $newName,
				])) {return redirect()->to(base_url('/espaceagent/creerpermissiondd'));} else 
			{ print_r($model->errors()); }
			
			
		
			
			
			$_SESSION['toast'] = 'Opération réussie !';
			//return redirect()->to(base_url('/espaceagent/creerpermissiondd'));
			//echo view('espaceagent/creerpermissiondd', ['titre' => 'Creation d\'une permissiondd']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissiondd' => $model->recPermissiondd(),
			'titre' => 'Liste des permissiondd',
		];
		echo view('espaceagent/apercupermissiondd', $data);
		echo view('templates/espaceagent/pied', $data);
	}

	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerpermissionhh()
	{
		helper('form');
		$model = new PermissionhhModel();
	
		// If form is submitted
		if ($this->request->getMethod() === 'post') {
			// Validation rules
			$rules = [
				'Idagent'     => 'required',
				'objetsortie' => 'required',
				'datesortie'  => 'required',
				'lieu'        => 'required',
				'heuredepart' => 'required',
				'heurearrivee'=> 'required'
			];
	
			// Add file validation if file is uploaded
			if (!empty($_FILES['justificatif']['name'])) {
				$rules['justificatif'] = [
					'label' => 'Justificatif',
					'rules' => 'uploaded[justificatif]|mime_in[justificatif,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]'
				];
			}
	
			if ($this->validate($rules)) {
				try {
					// Handle file upload
					$newName = '';
					if ($file = $this->request->getFile('justificatif')) {
						if ($file->isValid() && !$file->hasMoved()) {
							// Create directories if they don't exist
							$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
							if (!is_dir($path)) {
								mkdir($path, 0777, true);
							}
							
							$newName = date('YmdHis') . 'justificatif' . $_SESSION['mat'] . '.' . $file->getClientExtension();
							$file->move($path, $newName);
							
							echo "<script>console.log('File uploaded successfully: " . $newName . "');</script>";
						}
					}
	
					// Prepare data for database
					$data = [
						'Idagent'     => $this->request->getPost('Idagent'),
						'objetsortie' => $this->request->getPost('objetsortie'),
						'datesortie'  => $this->request->getPost('datesortie'),
						'lieu'        => $this->request->getPost('lieu'),
						'heuredepart' => $this->request->getPost('heuredepart'),
						'heurearrivee'=> $this->request->getPost('heurearrivee'),
						'etat'        => 'ATTENTE DE VALIDATION',
						'justificatif'=> $newName
					];
	
					// Save to database
					if ($model->save($data)) {
						echo "<script>console.log('Permission request saved successfully');</script>";
						$_SESSION['toast'] = 'Opération réussie !';
						return redirect()->to(base_url('/espaceagent/creerpermissionhh'));
					} else {
						echo "<script>console.error('Database save failed:', " . json_encode($model->errors()) . ");</script>";
						throw new \RuntimeException('Failed to save permission request');
					}
	
				} catch (\Exception $e) {
					echo "<script>console.error('Error:', " . json_encode($e->getMessage()) . ");</script>";
					$_SESSION['toast'] = 'Une erreur est survenue';
				}
			} else {
				// Validation failed
				echo "<script>console.error('Validation errors:', " . json_encode($this->validator->getErrors()) . ");</script>";
			}
		}
	
		// Display form
		$data = [
			'permissionhh' => $model->recPermissionhh(),
			'titre' => 'Liste des permissions heure à heure',
			'validation' => $this->validator ?? null
		];
	
		echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		echo view('espaceagent/creerpermissionhh', $data);
		echo view('espaceagent/apercupermissionhh', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	public function editpermissionhh($m)
	{
		helper('form');
		$model = new PermissionhhModel();
		$rules = [
			'Idagent' => 'required',
			'objetsortie' => 'required',
			'datesortie' => 'required',
			'lieu' => 'required',
			'heuredepart' => 'required',
			'heurearrivee'	 => 'required',
		];
		if (!empty($_FILES['justificatif']['name'])) {
			$rule['justificatif'] = [
						                'label' => 'Justificatif',
						                'rules' => 'uploaded[justificatif]'
						                    . '|mime_in[justificatif,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
							        ];
		}
		if (! $this->validate($rules))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			$data = [
			'lidpermissionhh' => $m,
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
			echo view('espaceagent/creerpermissionhh', $data);
		}
		else
		{



			
			$path = './agents/'.$_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			} 
			
			$path = './agents/'.$_SESSION['mat'].'/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/'.$_SESSION['mat'].'/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/'.$_SESSION['mat'].'/4-CONGES';
			
			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if(empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName = date('YmdHis').'justificatif'.$_SESSION['mat'].'.'.$file->getClientExtension();
			//echo $newName;

			if (! $file->isValid())
			{ //echo 'ICI';
					throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			}

			$model->update($this->request->getVar('IDpermission'),[

				'Idagent' => $this->request->getVar('Idagent'),
				'objetsortie' => $this->request->getVar('objetsortie'),
				'datesortie' => $this->request->getVar('datesortie'),
				'lieu' => $this->request->getVar('lieu'),
				'heuredepart' => $this->request->getVar('heuredepart'),
				'heurearrivee'	=> $this->request->getVar('heurearrivee'),
				'etat'	=> 'ATTENTE DE VALIDATION',
				//'validationcs' => $this->request->getVar('validationcs'),
				//'datecs' => $this->request->getVar('datecs'),
				//'validationsus'	=> $this->request->getVar('validationsus'),
				//'datesus' => $this->request->getVar('datesus'),
				//'validationsdrh' => $this->request->getVar('validationsdrh'),
				//'datesdrh' => $this->request->getVar('datesdrh'),
				'justificatif' => $newName,
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceagent/creerpermissionhh'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissionhh' => $model->recPermissionhh(),
			'titre' => 'Liste des permissionhh',
		];
		echo view('espaceagent/apercupermissionhh', $data);
		echo view('templates/espaceagent/pied', $data);
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	/*public function creerdirection()
	{
		helper('form');
		$model = new DirectionModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[60]'
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			echo view('espaceagent/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			echo view('espaceagent/reussite');
		}
		//////////////////////////////////////////////////////////
		$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];
		echo view('espaceagent/apercudirection', $data);
		echo view('templates/espaceagent/pied', $data);
	}
*/

/////////////////////// FIN MODULE PERMISSION //////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
///////////////////VALIDATIONS/////////////////////

	public function validationagentcongeannuel($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');
$sql = "UPDATE `congeannuel` SET etat='VALIDÉ', `validationagent` = '1', `datevalidation` = '$dd' WHERE (`IDconge` = '$num')";
		echo $sql;
		$query   = $db->query($sql);
		return redirect()->to(base_url('/espaceagent/creercongeannuel'));	
	}


	public function pdfcongeagent($num)
	{
				$db = \Config\Database::connect();
		$sql = "select *, (select plancongeannuel.pdebut from plancongeannuel where plancongeannuel.IDplancongeannuel = congeannuel.IDplancongeannuel) as annee from congeannuel WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();
		
		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent='.$_SESSION['cnxid'];
	
		$query   = $db->query($sql);
		$agenta   = $query->getRow();
			
		$data = [
			'leconge' => $congea,
			'lagent' => $agenta ,
		];
			


		if($congea->horspays==1 || $congea->horspays=='1') {
			echo view('/espaceagent/pdfcongepayshp',$data);
		} else {
			echo view('/espaceagent/pdfcongepays',$data);
		}	

		
	}

	public function pdfcongecertificatagent($num)
	{
				$db = \Config\Database::connect();
		$sql = "select *, (select plancongeannuel.pdebut from plancongeannuel where plancongeannuel.IDplancongeannuel = congeannuel.IDplancongeannuel) as annee from congeannuel WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();
		
		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent='.$_SESSION['cnxid'];
	
		$query   = $db->query($sql);
		$agenta   = $query->getRow();
			
		$data = [
			'leconge' => $congea,
			'lagent' => $agenta ,
		];
			


		if($congea->horspays==1 || $congea->horspays=='1') {
			echo view('/espaceagent/pdfdecisioncongehorspaysagent',$data);
		} else {
		//	echo view('/espaceagent/pdfdecisioncongehorspaysagent',$data);
		}	

		
	}

	public function pdfcongecertificatrespo($num)
	{
				$db = \Config\Database::connect();
		$sql = "select *, (select plancongeannuel.pdebut from plancongeannuel where plancongeannuel.IDplancongeannuel = congeannuel.IDplancongeannuel) as annee from congeannuel WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();
		
		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent='.$congea->Idagent;
	
		$query   = $db->query($sql);
		$agenta   = $query->getRow();
			
		$data = [
			'leconge' => $congea,
			'lagent' => $agenta ,
		];
			
		if($agenta->idagent==$_SESSION['cnxid']) {

			if($congea->horspays==1 || $congea->horspays=='1') {
				echo view('/espaceagent/pdfdecisioncongehorspays',$data);
			} else {
				//echo view('/espaceagent/pdfdecisioncongehorspays',$data);
			}	
		} else {

			if($congea->horspays==1 || $congea->horspays=='1') {
				echo view('/espaceagent/pdfdecisioncongehorspaysagent',$data);
			} else {
				//echo view('/espaceagent/pdfdecisioncongehorspaysagent',$data);
			}	

			
		}
	}


	public function pdfrepriseconge($num)
	{
				$db = \Config\Database::connect();
		$sql = "select *, (select plancongeannuel.pdebut from plancongeannuel where plancongeannuel.IDplancongeannuel = congeannuel.IDplancongeannuel) as annee from congeannuel WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();
		
		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent='.$_SESSION['cnxid'];
	
		$query   = $db->query($sql);
		$agenta   = $query->getRow();
			
		$data = [
			'leconge' => $congea,
			'lagent' => $agenta ,
		];
			
		echo view('/espaceagent/pdfcertificatrepriseca',$data);
	}


		public function pdfcongemagentdecret($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from congematernite WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();
		
		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent='.$_SESSION['cnxid'];
	
		$query   = $db->query($sql);
		$agenta   = $query->getRow();
			
		$data = [
			'leconge' => $congea,
			'lagent' => $agenta ,
		];

		echo view('/espaceagent/pdfcongematernite',$data);
	}
	
	public function pdfcongemagentattestation($num)
	{
$db = \Config\Database::connect();
		$sql = "select * from congematernite WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();
		
		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent='.$_SESSION['cnxid'];
	
		$query   = $db->query($sql);
		$agenta   = $query->getRow();
			
		$data = [
			'leconge' => $congea,
			'lagent' => $agenta ,
		];

		echo view('/espaceagent/pdfdecisioncongematernite',$data);		
	}
	
	
	public function pdfpermissiondd($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from permissiondd WHERE `IDpermission` = '$num'";
		$query   = $db->query($sql);
		$row   = $query->getRow();
		echo view('/espaceagent/permissionddagent');		
		/*
		$dompdf = new \Dompdf\Dompdf(); 
		$dompdf->loadHtml(view('/espaceagent/permissionddagent'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();		
		return redirect()->to(base_url('/espaceagent/creerpermissiondd'));	*/
	}
	
		public function pdfpermissionhh($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from permissionhh WHERE `IDpermission` = '$num'";
		$query   = $db->query($sql);
		$row   = $query->getRow();
		echo view('/espaceagent/permissionhhagent');		
		/*
		$dompdf = new \Dompdf\Dompdf(); 
		$dompdf->loadHtml(view('/espaceagent/permissionhhagent'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();		
		return redirect()->to(base_url('/espaceagent/creerpermissionhh'));	*/
	}
	
		public function pdfretraiteagent($num)
	{
				$db = \Config\Database::connect();
		$sql = "select *, (select plancongeannuel.pdebut from plancongeannuel where plancongeannuel.IDplancongeannuel = congeannuel.IDplancongeannuel) as annee from congeannuel WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();
		
		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent='.$_SESSION['cnxid'];
	
		$query   = $db->query($sql);
		$agenta   = $query->getRow();
			
		$data = [
			'leconge' => $congea,
			'lagent' => $agenta ,
		];
			
		
			echo view('/espaceagent/pdfcertificatretraite',$data);
	
	}

	
	
	public function afficherplanpermanence()
	{
		echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		
		//echo view('templates/espaceagent/entete', $data);
		
		echo view('espaceagent/afficherplanpermanence');
		echo view('templates/espaceagent/pied');
	}
	
	public function modifierplanning()
	{
		echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		
		//echo view('templates/espaceagent/entete', $data);
		
		echo view('espaceagent/modifierplanning');
		echo view('templates/espaceagent/pied');
	}


public function editplanning($m)
	{
		
		helper('form');
		$model = new AgentplanpermanenceModel();
		if (! $this->validate([
			'justificatif' => 'required',
		]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			$data = [
			'lid' => $m,
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceagent/editplanning',$data);
		}
		else
		{
			//print_r($model->errors());
			$model->update($this->request->getVar('idagentplanpermanence'),[
				'changement'	=> 1,
				'justificatif'	=> $this->request->getVar('justificatif'),
			]);
			
			print_r($model->errors());
			
			return redirect()->to(base_url('/espaceagent/modifierplanning'));
			
		}
		//////////////////////////////////////////////////////////
		
		//echo view('espaceagent/apercuagentplanpermanence', $data);
		echo view('templates/espaceagent/pied');
	}
	
	public function editplanningn($m)
	{
		
		helper('form');
		$model = new AgentplanpermanenceModel();
		
			//print_r($model->errors());
			$model->update($m,[
				'changement'	=> 0,
				'justificatif'	=> '',
			]);
			
			//print_r($model->errors());
			
			return redirect()->to(base_url('/espaceagent/modifierplanning'));
			
		
		//////////////////////////////////////////////////////////
		
		//echo view('espaceagent/apercuagentplanpermanence', $data);
		echo view('templates/espaceagent/pied');
	}

		public function guideadmin()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		echo view('espaceagent/guideadmin');
		echo view('templates/espaceagent/pied');
	}
	
		public function guiderespo()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		echo view('espaceagent/guiderespo');
		echo view('templates/espaceagent/pied');
	}


	public function guideuser()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceagent/entete');
		echo view('templates/espaceagent/sidebar');
		echo view('templates/espaceagent/topbar');
		echo view('espaceagent/guideuser');
		echo view('templates/espaceagent/pied');
	}

//congeagentpays

	public function changepwd()
	{
			helper('form');
		$model = new AgentModel();
		if (! $this->validate([
				'oldp' => 'required',
				'newp' => 'required|min_length[7]|max_length[100]',
			]))	{
			echo view('templates/espaceagent/entete');
			echo view('templates/espaceagent/sidebar');
			echo view('templates/espaceagent/topbar');
			$data = [
				'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceagent/changepwd', $data);
			//echo view('templates/espaceagent/pied');
			// return redirect()->to(base_url('espaceagent/changepwd'));
		}
		else
		{
			$db = \Config\Database::connect();
			$lid = $this->request->getVar('idagent');
			$lpwd = md5($this->request->getVar('oldp'));
			
			$query = $db->query("SELECT * from agent where pwd = '$lpwd' and idagent=$lid"); 
			$ttt = $query->getResultArray();     
			$lpwd = md5($this->request->getVar('newp'));
			  
			if(count($ttt)==1){
				$model->update($this->request->getVar('idagent'),[
				'pwd' => $lpwd,
				]);
				//$query = $db->query("UPDATE agent set pwd='$lpwd' where idagent = '$lid'"); 
				$_SESSION['toast'] = 'Mot de passe mis à jour avec succès...!';
           		return redirect()->to(base_url('/espaceagent/changepwd'));
			} else {
				$data = [
					'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
				];
				echo view('templates/espaceagent/entete');
				echo view('templates/espaceagent/sidebar');
				echo view('templates/espaceagent/topbar');
				echo view('espaceagent/changepwd', $data);
			}
		}
		echo view('templates/espaceagent/pied', $data);
		
	}

}

