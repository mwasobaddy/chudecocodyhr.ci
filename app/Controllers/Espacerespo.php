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
use App\Models\CiviliteModel;
use App\Models\ServiceModel;
use App\Models\ArrettravailModel;

use App\Models\PlanpermanenceModel;
use App\Models\AgentplanpermanenceModel;

use App\Models\AgentequipeModel;

use App\Models\BesoinserviceModel;
use App\Models\EquipeModel;


use App\Models\SituationModel;
use App\Models\SousdirectionModel;

use App\Models\CongeannuelModel;
use App\Models\CongematerniteModel;
use App\Models\PermissionddModel;
use App\Models\PermissionhhModel;

use App\Models\PlancongeannuelModel;

$this->session = \Config\Services::session();


use CodeIgniter\Controller;

class Espacerespo extends Controller
{

	public function afficher($contenu = 'accueil')
	{
		if (!is_file(APPPATH . '/Views/espacerespo/' . $contenu . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
		}
		$data['titre'] = ucfirst($contenu); // Capitalize the first letter
		$data['contenu'] = $contenu;


		echo view('templates/espacerespo/entete', $data);
		echo view('templates/espacerespo/sidebar', $data);
		echo view('templates/espacerespo/topbar', $data);
		//echo view('templates/espacerespo/pagecontent', $data);
		echo view('espacerespo/' . $contenu, $data);
		echo view('templates/espacerespo/pied', $data);
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
		echo view('templates/espacerespo/entete', $data);
		echo view('templates/espacerespo/sidebar', $data);
		echo view('templates/espacerespo/topbar', $data);

		//echo view('templates/espacerespo/entete', $data);

		echo view('espacerespo/accueil', $data);

		echo view('templates/espacerespo/pied', $data);
	}


	public function listagent()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
		];
		echo view('templates/espacerespo/entete', $data);
		echo view('templates/espacerespo/sidebar', $data);
		echo view('templates/espacerespo/topbar', $data);

		//echo view('templates/espacerespo/entete', $data);

		echo view('espacerespo/apercuagent');

		echo view('templates/espacerespo/pied', $data);
	}

	public function creeragent()
	{
		//print_r($this);
		helper('form');

		$model = new AgentModel();

		if (!$this->validate([
			'name' => 'required|min_length[1]|max_length[150]',
			'matricule'	=> 'required|min_length[5]|max_length[10]',
			'datenais'	=> 'required',
			'mobile'	=> 'required|min_length[10]|max_length[14]',
			'email'	=> 'required|min_length[1]|max_length[100]',
			'psfp'	=> 'required',
			'pschu'	=> 'required'
		])) {

			//echo view('espacerespo/'.$contenu, $data);
			//print_r($this->request->getVar());


			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creeragent', $data);
			echo view('templates/espacerespo/pied');
		} else {
			//print_r($this->request->getVar());
			$lieu = './agents/' . $this->request->getVar('matricule');
			$file = $this->request->getFile('photo');
			$newName = 'PHOTO' . $this->request->getVar('matricule') . '.' . $file->getClientExtension();
			//echo $newName;

			if (!$file->isValid()) { //echo 'ICI';
				throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
			} else {
				//echo 'YES';
				if (!$file->hasMoved()) {
					$file->move($lieu, $newName);
					////$file->move(WRITEPATH . 'uploads');
				}
			}

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
				'Photo'	=> $newName,
				'position'	=> $this->request->getVar('position'),
				'SaisiPar'	=> $_SESSION['cnxname'],
				'SaisiLe'	=> date('Y-m-d'),
				'ModifiePar'	=> $_SESSION['cnxname'],
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

			$path = './agents/' . $this->request->getVar('matricule');
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $this->request->getVar('matricule') . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $this->request->getVar('matricule') . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}


			/*echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');*/
			return redirect()->to(base_url('/espacerespo/listagent'));
			//echo view('espacerespo/listagent');
			//echo view('templates/espacerespo/pied');
		}
	}


	public function delagent($num)
	{
		$model = new AgentModel();
		$model->where('idagent', $num);
		$model->delete();
		$this->index();
		//return redirect()->to(base_url('/espacerespo/creeunite'));
	}



	//agent_planpermanance
	public function delagentplanpermanence($num)
	{
		$db = \Config\Database::connect();
		$query = $db->query('SELECT * FROM agentplanpermanence where idagentplanpermanence =' . $num);
		$row   = $query->getRow();
		$a = $row->IDequipe;
		$b = $row->IDplanpermanence;

		$sql = "delete from agentplanpermanence where IDequipe = $a and IDplanpermanence =$b";
		$query   = $db->query($sql);




		return redirect()->to(base_url('/espacerespo/attribuerplanpermanence'));
	}


	public function delcivilite($num)
	{
		$model = new CiviliteModel();
		$model->where('IDcivilite', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creercivilite'));
	}



	public function delcongeannuel($num)
	{
		$model = new CongeannuelModel();
		$model->where('IDconge', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creercongeannuel'));
		//$this->index();
	}

	public function delequipe($num)
	{
		$model = new EquipeModel();
		$model->where('IDequipe', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerequipe'));
		//$this->index();
	}


	public function delcongematernite($num)
	{
		$model = new CongematerniteModel();
		$model->where('IDconge', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creercongematernite'));
	}


	public function delcontrat($num)
	{
		$model = new ContratModel();
		$model->where('IDcontrat', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creercontrat'));
	}
	public function delarrettravail($num)
	{
		$model = new ArrettravailModel();
		$model->where('IDarrettravail', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espacerespo/creerarrettravail'));
	}

	public function deldirection($num)
	{
		$model = new DirectionModel();
		$model->where('IDdirection', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerdirection'));
	}


	public function deldroitaccess($num)
	{
		$model = new DroitaccessModel();
		$model->where('IDdroitaccess', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerdroitaccess'));
	}


	public function delemploi($num)
	{
		$model = new EmploiModel();
		$model->where('IDemploi', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creeremploi'));
	}


	public function delgenre($num)
	{
		$model = new GenreModel();
		$model->where('IDgenre', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creergenre'));
	}


	public function delgrade($num)
	{
		$model = new GradeModel();
		$model->where('IDgrade', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creergrade'));
	}


	public function deljourplan($num)
	{
		$model = new JourplanModel();
		$model->where('IDjourplan', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerjourplan'));
	}


	public function dellafonction($num)
	{
		$model = new FonctionModel();
		$model->where('IDlafonction', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerfonction'));
	}


	public function delpermissiondd($num)
	{
		$model = new PermissionddModel();
		$model->where('IDpermission', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerpermissiondd'));
	}


	public function delpermissionhh($num)
	{
		$model = new PermissionhhModel();
		$model->where('IDpermission', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerpermissionhh'));
	}


	public function delplancongeannuel($num)
	{
		$model = new PlancongeannuelModel();
		$model->where('IDplancongeannuel', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerplancongeannuel'));
	}


	public function delplanpermanence($num)
	{
		$model = new PlanpermanenceModel();
		$model->where('IDplanpermanence', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerplanpermanence'));
	}


	public function delrole($num)
	{
		$model = new RoleModel();
		$model->where('IDrole', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerrole'));
	}


	public function delroleagent($num)
	{
		$model = new RoleagentModel();
		$model->where('IDroleagent', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerroleagent'));
	}


	public function delservice($num)
	{
		$model = new ServiceModel();
		$model->where('IDservice', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creerservice'));
	}


	public function delsituationmatrimoniale($num)
	{
		$model = new SituationModel();
		$model->where('IDsituationmatrimoniale', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creersituationmatrimoniale'));
	}


	public function delsousdirection($num)
	{
		$model = new SousdirectionModel();
		$model->where('IDsousdirection', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/creersousdirection'));
	}



	public function delunite($num)
	{
		$model = new UniteModel();
		$model->where('IDunite', $num);
		$model->delete();
		//return redirect()->to(base_url('/espacerespo/creeunite'));
		return redirect()->to(base_url('/espacerespo/creerunite'));
	}


	public function delgle($cle, $num, $table, $lavue)
	{
		$model = new ucfirst($table) . Model();
		$model->where($cle, $num);
		$model->delete();
		return redirect()->to(base_url($lavue));
		//return redirect()->to(base_url('/espacerespo/creeunite'));
	}

	public function mesagentsgle($myid)
	{
		//$db = \Config\Database::connect();
		$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent where agent.idagent=' . $myid . ' or agent.Responsablen1=' . $myid . ' or agent.Responsablen2=' . $myid . ' or agent.Sousdrh=' . $myid . '');

		return $query->getResultArray();
	}

	public function mesagentsgleid($myid)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT idagent FROM agent where agent.idagent=' . $myid . ' or agent.Responsablen1=' . $myid . ' or agent.Responsablen2=' . $myid . ' or agent.Sousdrh=' . $myid . '');

		return $query->getResult();
	}






	public function creation()
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'matricule' => 'required|min_length[1]|max_length[30]'
		])) {

			//$data='';
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creation', ['titre' => 'Creation d\'un nouvel agent']);

			//echo view('espacerespo/apercuagent', $data);

			echo view('templates/espacerespo/pied');
			//echo view('espacerespo/creation', ['titre' => 'Creation d\'un nouvel agent']);

		} else {
			$model->save([
				//'id' => 2,
				'matricule'	=> $this->request->getVar('matricule'),
				'nom'	=> $this->request->getVar('nom'),
				'datenais'	=> $this->request->getVar('datenais'),
			]);

			echo view('espacerespo/reussite');
		}
	}






	/////////////////////////////////////////////////////////////////////////////////////
	///////////////////////// DONNEES DE BASE //////////////////////////////////////
	public function creerdirection()
	{
		helper('form');
		$model = new DirectionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'Directeur'	=> $this->request->getVar('Directeur'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerdirection'));
			//echo view('espacerespo/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];
		echo view('espacerespo/apercudirection', $data);
		echo view('templates/espacerespo/pied', $data);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////
	public function creercontrat()
	{
		helper('form');
		$model = new ContratModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creercontrat', ['titre' => 'Creation d\'un nouvel agent']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creercontrat'));
			//echo view('espacerespo/creercontrat', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'contrat' => $model->recContrat(),
			'titre' => 'Liste des contrats',
		];
		echo view('espacerespo/apercucontrat', $data);
		echo view('templates/espacerespo/pied', $data);
	}

	////////////////////////////////////////////////////////////////////////////
	public function creerdroitaccess()
	{
		helper('form');
		$model = new DroitaccessModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creerdroitaccess', ['titre' => 'Creation d\'un nouvel agent']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerdroitaccess'));
			//echo view('espacerespo/creerdroitaccess', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'droitaccess' => $model->recDroitaccess(),
			'titre' => 'Liste des droits d\'accès',
		];
		echo view('espacerespo/apercudroitaccess', $data);
		echo view('templates/espacerespo/pied', $data);
	}



	//////////////////////////////////////////////////////////////////////////////////////
	public function creeremploi()
	{
		helper('form');
		$model = new EmploiModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creeremploi', ['titre' => 'Creation d\'un nouvel agent']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creeremploi'));
			//echo view('espacerespo/creeremploi', ['titre' => 'Creation d\'un nouvel emploi']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'emploi' => $model->recEmploi(),
			'titre' => 'Liste des emplois',
		];
		echo view('espacerespo/apercuemploi', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	////////////////////////////////////////////////////////////
	public function creergrade()
	{
		helper('form');
		$model = new GradeModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creergrade', ['titre' => 'Creation d\'un grade']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creergrade'));
			//echo view('espacerespo/creergrade', ['titre' => 'Creation d\'un grade']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'grade' => $model->recGrade(),
			'titre' => 'Liste des grades',
		];
		echo view('espacerespo/apercugrade', $data);
		echo view('templates/espacerespo/pied', $data);
	}

	public function creerequipe()
	{
		helper('form');
		$model = new EquipeModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]',
			'IDservice' => 'required'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerequipe', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'IDservice'	=> $this->request->getVar('IDservice'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerequipe'));
			//echo view('espacerespo/creergrade', ['titre' => 'Creation d\'un grade']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'equipe' => $model->recEquipe(),
			'titre' => 'Liste des grades',
		];
		echo view('espacerespo/apercuequipe', $data);
		echo view('templates/espacerespo/pied', $data);
	}




	public function editequipe($m)
	{
		helper('form');
		$model = new EquipeModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidequipe' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerequipe', $data);
		} else {
			$model->update($this->request->getVar('IDgrade'), [
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			return redirect()->to(base_url('/espacerespo/creerequipe'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'equipe' => $model->recEquipe(),
			'titre' => 'Liste des grades',
		];
		echo view('espacerespo/apercuequipe', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	public function addagentequipe($m)
	{
		helper('form');
		$model = new AgentequipeModel();
		if (!$this->validate([
			'IDequipe' => 'required',
			//'IDequipe' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidequipe' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creeragentequipe', $data);
		} else {
			foreach ($this->request->getVar('agent') as $ag) {

				$model->save([
					'IDequipe'	=> $this->request->getVar('IDequipe'),
					'Idagent'	=> $ag,
				]);
			}

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/addagentequipe/' . $m));
		}
		//////////////////////////////////////////////////////////
		$db = \Config\Database::connect();
		$query = $db->query("SELECT *, (select libelle from equipe where equipe.IDequipe=agent_equipe.IDequipe) as equipe, (select nom from agent where agent.idagent = agent_equipe.Idagent) as agent from agent_equipe where IDequipe=$m");
		$rr = $query->getResult();
		$data = [
			'agentequipe' => $rr,
		];
		echo view('espacerespo/apercuagentequipe', $data);
		echo view('templates/espacerespo/pied');
	}

	//////////////////////////////////////////////////////////////////
	public function creerfonction()
	{
		helper('form');
		$model = new FonctionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creerfonction', ['titre' => 'Creation d\'une fonction']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerfonction'));
			//echo view('espacerespo/creerfonction', ['titre' => 'Creation d\'une fonction']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'fonction' => $model->recFonction(),
			'titre' => 'Liste des fonctions',
		];
		echo view('espacerespo/apercufonction', $data);
		echo view('templates/espacerespo/pied', $data);
	}



	//////////////////////////////////////////////////////////////////////////////////////////////
	public function creerrole()
	{
		helper('form');
		$model = new RoleModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creerrole', ['titre' => 'Creation d\'un rôle']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerrole'));
			//echo view('espacerespo/creerrole', ['titre' => 'Creation d\'un rôle']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'role' => $model->recRole(),
			'titre' => 'Liste des rôles',
		];
		echo view('espacerespo/apercurole', $data);
		echo view('templates/espacerespo/pied', $data);
	}



	//////////////////////////////////////////////////////////////////////////////////////////////

	public function creerplancongeannuel()
	{

		helper('form');
		$model = new PlancongeannuelModel();
		/*if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		]))	{
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			echo view('espacerespo/creerplancongeannuel');
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
			return redirect()->to(base_url('/espacerespo/creerplancongeannuel'));
			//echo view('espacerespo/creerplancongeannuel', $data);
		}*/
		//////////////////////////////////////////////////////////
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		$data = [
			'plancongeannuel' => $model->recPlancongeannuel(),
			'titre' => 'Liste des plancongeannuel',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('espacerespo/apercuplancongeannuel', $data);
		echo view('templates/espacerespo/pied', $data);
	}



	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creersousdirection()
	{
		helper('form');
		$model = new SousdirectionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creersousdirection', ['titre' => 'Creation d\'une Sous-Direction']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'IDdirection'	=> $this->request->getVar('IDdirection'),
				'sousdirecteur'	=> $this->request->getVar('sousdirecteur'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creersousdirection'));
			//echo view('espacerespo/creersousdirection', ['titre' => 'Creation d\'une Sous-Direction']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'sousdirection' => $model->recSousdirection(),
			'titre' => 'Liste des Sous-Directions',
		];
		echo view('espacerespo/apercusousdirection', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerservice()
	{
		helper('form');
		$model = new ServiceModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creerservice', ['titre' => 'Creation d\'un service']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'IDsousdirection'	=> $this->request->getVar('IDsousdirection'),
				'chefservice'	=> $this->request->getVar('chefservice'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerservice'));
			//echo view('espacerespo/creerservice', ['titre' => 'Creation d\'un service']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'service' => $model->recService(),
			'titre' => 'Liste des services',
		];
		echo view('espacerespo/apercuservice', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerroleagent()
	{
		helper('form');
		$model = new RoleagentModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creerroleagent', ['titre' => 'Creation d\'un role-agent']);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			return redirect()->to(base_url('/espacerespo/creerroleagent'));
			$_SESSION['toast'] = 'Opération réussie !';

			//echo view('espacerespo/creerroleagent', ['titre' => 'Creation d\'un role-agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'roleagent' => $model->recRoleagent(),
			'titre' => 'Liste des role-agent',
		];

		echo view('espacerespo/apercuroleagent', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	/////////////////////// FIN DONNEES DE BASE //////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////


	/////////////////////// DEBUT MODULE PERMISSION //////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////

	public function moncongeannuel()
	{
		helper('form');
		$model = new CongeannuelModel();
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');

		//////////////////////////////////////////////////////////
		$data = [
			'congeannuel' => $model->recCongeannuel(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espacerespo/apercumoncongeannuel', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	public function pdfcongerespo($num)
	{
		$db = \Config\Database::connect();
		$sql = "select *, (select plancongeannuel.pdebut from plancongeannuel where plancongeannuel.IDplancongeannuel = congeannuel.IDplancongeannuel) as annee from congeannuel WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();

		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent=' . $congea->Idagent;

		$query   = $db->query($sql);
		$agenta   = $query->getRow();

		$data = [
			'leconge' => $congea,
			'lagent' => $agenta,
		];

		if ($agenta->idagent == $_SESSION['cnxid']) {

			if ($congea->horspays == 1 || $congea->horspays == '1') {
				echo view('/espaceagent/pdfcongecshp', $data);
			} else {
				echo view('/espaceagent/pdfcongecs', $data);
			}
		} else {

			if ($congea->horspays == 1 || $congea->horspays == '1') {
				echo view('/espaceagent/pdfcongepayshp', $data);
			} else {
				echo view('/espaceagent/pdfcongepays', $data);
			}
		}
	}

	public function pdfcongecertificatrespo($num)
	{
		$db = \Config\Database::connect();
		$sql = "select *, (select plancongeannuel.pdebut from plancongeannuel where plancongeannuel.IDplancongeannuel = congeannuel.IDplancongeannuel) as annee from congeannuel WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();

		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent=' . $congea->Idagent;

		$query   = $db->query($sql);
		$agenta   = $query->getRow();

		$data = [
			'leconge' => $congea,
			'lagent' => $agenta,
		];

		if ($agenta->idagent == $_SESSION['cnxid']) {

			if ($congea->horspays == 1 || $congea->horspays == '1') {
				echo view('/espaceagent/pdfdecisioncongehorspays', $data);
			} else {
				//echo view('/espaceagent/pdfdecisioncongehorspays',$data);
			}
		} else {

			if ($congea->horspays == 1 || $congea->horspays == '1') {
				echo view('/espaceagent/pdfdecisioncongehorspaysagent', $data);
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

		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent=' . $congea->Idagent;

		$query   = $db->query($sql);
		$agenta   = $query->getRow();

		$data = [
			'leconge' => $congea,
			'lagent' => $agenta,
		];
		//pdfcertificatrepriseca.php
		echo view('/espaceagent/pdfcertificatrepriseca', $data);
	}



	public function pdfcongemrespodecret($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from congematernite WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();

		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent=' . $congea->Idagent;

		$query   = $db->query($sql);
		$agenta   = $query->getRow();

		$data = [
			'leconge' => $congea,
			'lagent' => $agenta,
		];

		echo view('/espaceagent/pdfcongematernite', $data);
	}

	public function pdfcongemrespoattestation($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from congematernite WHERE `IDconge` = '$num'";
		$query   = $db->query($sql);
		$congea   = $query->getRow();

		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE Idagent=' . $congea->Idagent;

		$query   = $db->query($sql);
		$agenta   = $query->getRow();

		$data = [
			'leconge' => $congea,
			'lagent' => $agenta,
		];

		echo view('/espaceagent/pdfdecisioncongematernite', $data);
	}

	public function pdfpermissiondd($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from permissiondd WHERE `IDpermission` = '$num'";
		$query   = $db->query($sql);
		$row   = $query->getRow();
		echo view('/espacerespo/permissionddagent');
		/*
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view('/espacerespo/permissionddagent'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
		return redirect()->to(base_url('/espacerespo/creerpermissiondd'));	*/
	}

	public function pdfpermissionhh($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from permissionhh WHERE `IDpermission` = '$num'";
		$query   = $db->query($sql);
		$row   = $query->getRow();
		echo view('/espacerespo/permissionhhagent');
		/*
		$dompdf = new \Dompdf\Dompdf();
		$dompdf->loadHtml(view('/espacerespo/permissionhhagent'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
		return redirect()->to(base_url('/espacerespo/creerpermissionhh'));	*/
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creercongeannuel()
	{
		helper('form');
		$model = new CongeannuelModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'IDplancongeannuel' => 'required',
			//'datedepart' => 'required',
			//'datereprise' => 'required',
			'duree' => 'required',
			//'lieu' => 'required',
			//'adresse' => 'required',
			//'telephone' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creercongeannuel', $data);
		} else {
			$mask = '+ ' . $this->request->getVar('duree') . ' days';
			$depa = $this->request->getVar('datedepart');
			$dd = date('Y-m-d', strtotime($depa . '' . $mask));
			$d1 = date('Y-m-d', strtotime($depa . '- 21 days'));
			$d2 = date('Y-m-d', strtotime($depa . '- 14 days'));
			$d3 = date('Y-m-d', strtotime($depa . '- 7 days'));
			$model->save([
				'Idagent' => $this->request->getVar('Idagent'),
				'IDplancongeannuel' => $this->request->getVar('IDplancongeannuel'),
				'datedemande' => date('Y-m-d'),
				'datevalidation' => $this->request->getVar('datevalidation'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $dd,
				'daterepriseeffective'	=> $this->request->getVar('daterepriseeffective'),
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

			return redirect()->to(base_url('/espacerespo/creercongeannuel'));
			//echo view('espacerespo/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			//'congeannuel' => $model->recCongeannuel(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espacerespo/apercucongeannuel');
		echo view('templates/espacerespo/pied', $data);
	}


	public function editcongeannuel($m)
	{
		helper('form');
		$model = new CongeannuelModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'IDplancongeannuel' => 'required',
			//'datedepart' => 'required',
			//'datereprise' => 'required',
			'duree' => 'required',
			//'lieu' => 'required',
			//'adresse' => 'required',
			//'telephone' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			$data = [
				'lidcongeannuel' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creercongeannuel', $data);
		} else {

			$mask = '+ ' . $this->request->getVar('duree') . ' days';
			$depa = $this->request->getVar('datedepart');
			$dd = date('Y-m-d', strtotime($depa . '' . $mask));
			$d1 = date('Y-m-d', strtotime($depa . '- 21 days'));
			$d2 = date('Y-m-d', strtotime($depa . '- 14 days'));
			$d3 = date('Y-m-d', strtotime($depa . '- 7 days'));
			$model->update($this->request->getVar('IDconge'), [
				'Idagent' => $this->request->getVar('Idagent'),
				'IDplancongeannuel' => $this->request->getVar('IDplancongeannuel'),
				//'datedemande' => date('Y-m-d'),
				//'datevalidation' => $this->request->getVar('datevalidation'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $dd,
				'daterepriseeffective'	=> $this->request->getVar('daterepriseeffective'),
				'duree' => $this->request->getVar('duree'),
				'lieu' => $this->request->getVar('lieu'),
				'adresse' => $this->request->getVar('adresse'),
				'telephone' => $this->request->getVar('telephone'),
				'motifrejet' => $this->request->getVar('motifrejet'),
				'alert1' => $d1,
				'alert2' => $d2,
				'alert3' => $d3,
				'alert1ok' => '0',
				'alert2ok' => '0',
				'alert3ok' => '0',
				/*'etat' => 'ATTENTE DE VALIDATION',
				'validationcs' => $this->request->getVar('validationcs'),
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

			return redirect()->to(base_url('/espacerespo/creercongeannuel'));
			//echo view('espacerespo/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			//'congeannuel' => $model->recCongeannuel(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espacerespo/apercucongeannuel', $data);
		echo view('templates/espacerespo/pied', $data);
	}




	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creercongematernite()
	{
		helper('form');
		$model = new CongematerniteModel();
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
		if (empty($_FILES['justificatif1']['name'])) {
			$rule['justificatif1'] = 'required';
		} else {
			$rule['justificatif1'] = [
				'label' => 'Justificatif',
				'rules' => 'uploaded[justificatif1]'
					. '|mime_in[justificatif1,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
			];
		}
		if (empty($_FILES['justificatif2']['name'])) {
			$rule['justificatif2'] = 'required';
		} else {
			$rule['justificatif2'] = [
				'label' => 'Justificatif',
				'rules' => 'uploaded[justificatif2]'
					. '|mime_in[justificatif2,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
			];
		}
		if (empty($_FILES['justificatif3']['name'])) {
			$rule['justificatif3'] = 'required';
		} else {
			$rule['justificatif3'] = [
				'label' => 'Justificatif',
				'rules' => 'uploaded[justificatif3]'
					. '|mime_in[justificatif3,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
			];
		}
		if (!$this->validate($rule)) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creercongematernite', $data);
		} else {
			$depa = $this->request->getVar('dateterme');
			$ddepart = date('Y-m-d', strtotime($depa . '- 42 days'));
			$dretour = date('Y-m-d', strtotime($depa . '+ 57 days'));

			$path = './agents/' . $_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $_SESSION['mat'] . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			$file = $this->request->getFile('justificatif1');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName1 = date('YmdHis') . 'justificatif1' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName1);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}

			$file = $this->request->getFile('justificatif2');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName2 = date('YmdHis') . 'justificatif2' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName2);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}


			$file = $this->request->getFile('justificatif3');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName3 = date('YmdHis') . 'justificatif3' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
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
				'daterepriseeffective'	=> $this->request->getVar('daterepriseeffective'),
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
			return redirect()->to(base_url('/espacerespo/creercongematernite'));
			//echo view('espacerespo/creercongematernite', ['titre' => 'Creation d\'un congé de maternité']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congematernite' => $model->recCongematernite(),
			'titre' => 'Liste des congés de maternité',
		];
		echo view('espacerespo/apercucongematernite', $data);
		echo view('templates/espacerespo/pied', $data);
	}

	public function editcongematernite($m)
	{
		helper('form');
		$model = new CongematerniteModel();
		if (!$this->validate([
			'Idagent' => 'required',
			//'datedepart' => 'required',
			///'datereprise' => 'required',
			//'duree' => 'required',
			'dateterme' => 'required',

		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidcongematernite' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];

			echo view('espacerespo/creercongematernite', $data);
		} else {

			$depa = $this->request->getVar('dateterme');
			$ddepart = date('Y-m-d', strtotime($depa . '- 42 days'));
			$dretour = date('Y-m-d', strtotime($depa . '+ 57 days'));

			$path = './agents/' . $_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $_SESSION['mat'] . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			$file = $this->request->getFile('justificatif1');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName1 = date('YmdHis') . 'justificatif1' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName1);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}

			$file = $this->request->getFile('justificatif2');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName2 = date('YmdHis') . 'justificatif2' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName2);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}


			$file = $this->request->getFile('justificatif3');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName3 = date('YmdHis') . 'justificatif3' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName3);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}


			$model->update($this->request->getVar('IDconge'), [
				//'IDconge'	=> $this->request->getVar('IDconge'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				//'datedemande'	=> $this->request->getVar('datedemande'),
				//'datevalidation'	=> $this->request->getVar('datevalidation'),
				'datedepart'	=> $ddepart,
				'datereprise'	=> $dretour,
				'daterepriseeffective'	=> $this->request->getVar('daterepriseeffective'),
				'duree'	=> '98 jours',
				'dateterme'	=> $this->request->getVar('dateterme'),
				//'etat'	=> 'ATTENTE DE VALIDATION',
				'justificatif1'	=> $newName1,
				'justificatif2'	=> $newName2,
				'justificatif3'	=> $newName3,
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creercongematernite'));
			//echo view('espacerespo/creercongematernite', ['titre' => 'Creation d\'un congé de maternité']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congematernite' => $model->recCongematernite(),
			'titre' => 'Liste des congés de maternité',
		];
		echo view('espacerespo/apercucongematernite', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerpermissiondd()
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
		if (!$this->validate($rules)) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerpermissiondd', $data);
		} else {

			$path = './agents/' . $_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $_SESSION['mat'] . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName = date('YmdHis') . 'justificatif' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}


			$model->save([
				//'IDpermission'	=> $this->request->getVar('IDpermission'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				'motif'	=> $this->request->getVar('motif'),
				'datesortie'	=> $this->request->getVar('datesortie'),
				'lieu'	=> $this->request->getVar('lieu'),
				'jourdepart'	=> $this->request->getVar('jourdepart'),
				'jourarrivee'	=> $this->request->getVar('jourarrivee'),
				'daterepriseeffective'	=> $this->request->getVar('daterepriseeffective'),
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
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerpermissiondd'));
			//echo view('espacerespo/creerpermissiondd', ['titre' => 'Creation d\'une permissiondd']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissiondd' => $model->recPermissiondd(),
			'titre' => 'Liste des permissiondd',
		];
		echo view('espacerespo/apercupermissiondd', $data);
		echo view('templates/espacerespo/pied', $data);
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
		if (!$this->validate($rules)) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidpermissiondd' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerpermissiondd', $data);
		} else {
			$path = './agents/' . $_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $_SESSION['mat'] . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName = date('YmdHis') . 'justificatif' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}

			if ($model->update($this->request->getVar('IDpermission'), [
				//'IDpermission'	=> $this->request->getVar('IDpermission'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				'motif'	=> $this->request->getVar('motif'),
				'datesortie'	=> $this->request->getVar('datesortie'),
				'lieu'	=> $this->request->getVar('lieu'),
				'jourdepart'	=> $this->request->getVar('jourdepart'),
				'jourarrivee'	=> $this->request->getVar('jourarrivee'),
				'daterepriseeffective'	=> $this->request->getVar('daterepriseeffective'),
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
			])) {
				return redirect()->to(base_url('/espacerespo/creerpermissiondd'));
			} else {
				print_r($model->errors());
			}





			$_SESSION['toast'] = 'Opération réussie !';
			//return redirect()->to(base_url('/espacerespo/creerpermissiondd'));
			//echo view('espacerespo/creerpermissiondd', ['titre' => 'Creation d\'une permissiondd']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissiondd' => $model->recPermissiondd(),
			'titre' => 'Liste des permissiondd',
		];
		echo view('espacerespo/apercupermissiondd', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerpermissionhh()
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
		if (!$this->validate($rules)) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerpermissionhh', $data);
		} else {
			$path = './agents/' . $_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$newName = '';
			$path = './agents/' . $_SESSION['mat'] . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/' . $_SESSION['mat'] . '/4-CONGES';

			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if (empty($file) or empty($_FILES['justificatif']['name'])) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName = date('YmdHis') . 'justificatif' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}

			$model->save([

				'Idagent' => $this->request->getVar('Idagent'),
				'objetsortie' => $this->request->getVar('objetsortie'),
				'datesortie' => $this->request->getVar('datesortie'),
				'lieu' => $this->request->getVar('lieu'),
				'heuredepart' => $this->request->getVar('heuredepart'),
				'heurearrivee'	=> $this->request->getVar('heurearrivee'),
				'heurearriveeeffective'	=> $this->request->getVar('heurearriveeeffective'),
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
			return redirect()->to(base_url('/espacerespo/creerpermissionhh'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissionhh' => $model->recPermissionhh(),
			'titre' => 'Liste des permissionhh',
		];
		echo view('espacerespo/apercupermissionhh', $data);
		echo view('templates/espacerespo/pied', $data);
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
		if (!$this->validate($rules)) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidpermissionhh' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerpermissionhh', $data);
		} else {
			$path = './agents/' . $_SESSION['mat'];
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $_SESSION['mat'] . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $_SESSION['mat'] . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/' . $_SESSION['mat'] . '/4-CONGES';

			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName = date('YmdHis') . 'justificatif' . $_SESSION['mat'] . '.' . $file->getClientExtension();
				//echo $newName;

				if (!$file->isValid()) { //echo 'ICI';
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					//echo 'YES';
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);
						////$file->move(WRITEPATH . 'uploads');
					}
				}
			}

			$model->update($this->request->getVar('IDpermission'), [

				'Idagent' => $this->request->getVar('Idagent'),
				'objetsortie' => $this->request->getVar('objetsortie'),
				'datesortie' => $this->request->getVar('datesortie'),
				'lieu' => $this->request->getVar('lieu'),
				'heuredepart' => $this->request->getVar('heuredepart'),
				'heurearrivee'	=> $this->request->getVar('heurearrivee'),
				'heurearriveeeffective'	=> $this->request->getVar('heurearriveeeffective'),
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
			return redirect()->to(base_url('/espacerespo/creerpermissionhh'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissionhh' => $model->recPermissionhh(),
			'titre' => 'Liste des permissionhh',
		];
		echo view('espacerespo/apercupermissionhh', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	/////////////////////////////////////////////////////////////////////
	public function monprofil()
	{
		//print_r($this);
		helper('form');

		$model = new AgentModel();

		if (!$this->validate([
			/*'name' => 'required|min_length[1]|max_length[150]',
			'matricule'	=> 'required|min_length[5]|max_length[10]',
			'datenais'	=> 'required',
			'mobile'	=> 'required|min_length[10]|max_length[14]',
			'email'	=> 'required|min_length[1]|max_length[100]',
			'psfp'	=> 'required',
			'pschu'	=> 'required'*/])) {

			//echo view('espacerespo/'.$contenu, $data);
			//print_r($this->request->getVar());


			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			echo view('espacerespo/monprofil');
			echo view('templates/espacerespo/pied');
		} else {
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



			/*echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');*/
			return redirect()->to(base_url('/espacerespo/listagent'));
			//echo view('espacerespo/listagent');
			//echo view('templates/espacerespo/pied');
		}
	}

	public function ficheagent($num)
	{
		$db = \Config\Database::connect();
		

		$query   = $db->query('SELECT matricule,nom FROM agent where idagent=' . $num);
		$rep = $query->getRow();

		$pp = ($rep->matricule == '') ? ($rep->nom) : ($rep->matricule);

		$path = './agents/' . $pp;
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}

		$path = './agents/' . $pp . '/1-IDENTIFICATION';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/2-ENTREE';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/3-CORRESPONDANCES';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/4-CONGES';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/5-MALADIE';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/6-EVALUATION';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/7-MERITES';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/8-SANCTIONS';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $pp . '/9-SORTI-FIN';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}

		//print_r($this);
		helper('form');
		//print_r($this->request->getVar());
		$model = new AgentModel();

		if (!$this->validate([
			'name' => 'required|min_length[1]|max_length[150]',
			'matricule'	=> 'required|min_length[5]|max_length[10]',
			'datenais'	=> 'required',
			'mobile'	=> 'required|min_length[10]|max_length[14]',
			'email'	=> 'required|min_length[1]|max_length[100]',
			'psfp'	=> 'required',
			'pschu'	=> 'required',
			//'photo' => 'uploaded[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]|max_size[photo,4096]'
		])) {

			//echo view('espacerespo/'.$contenu, $data);
			//print_r($this->request->getVar());


			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			/*$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];*/

			$data = [
				'idag' => $num,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];

			echo view('espacerespo/ficheagent', $data);
			echo view('templates/espacerespo/pied');
		} else {
			$ll = ($this->request->getVar('matricule') == '') ? ($this->request->getVar('nom')) : ($this->request->getVar('matricule'));
			$lieu = './agents/' . $ll;
			$file = $this->request->getFile('photo');
			$newName = 'PHOTO' . $this->request->getVar('matricule') . '.' . $file->getClientExtension();
			//echo $newName;


			/*$tmp_name = $_FILES["photo"]["tmp_name"];
        // basename() peut empêcher les attaques de système de fichiers;
        // la validation/assainissement supplémentaire du nom de fichier peut être approprié
        $name = basename($_FILES["photo"]["name"]);
		echo $lieu.'/'.$name;
        if(move_uploaded_file($tmp_name, $lieu.'/'.$name)==true) {
			echo 'bien envoyé';
		} else {echo 'pas envoyé';  }*/


			if (!$file->isValid()) { //echo 'ICI';
				//throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if (!$file->hasMoved()) {
					$file->move($lieu, $newName);
					////$file->move(WRITEPATH . 'uploads');
				}
			}



			$donnees = [
				//'idagent'	=> $num,
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
				'Photo'	=> $newName,
				'position'	=> $this->request->getVar('position'),
				'motifdisponibilite'	=> $this->request->getVar('motifdisponibilite'),
				'SaisiPar'	=> '',
				//'SaisiLe'	=> date('Y-m-d'),
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
			];

			/*$path = './agents/'.$this->request->getVar('matricule');
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}

				$path = './agents/'.$this->request->getVar('matricule').'/1-IDENTIFICATION';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/2-ENTREE';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/3-CORRESPONDANCES';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/4-CONGES';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/5-MALADIE';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/6-EVALUATION';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/7-MERITES';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/8-SANCTIONS';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
				$path = './agents/'.$this->request->getVar('matricule').'/9-SORTI-FIN';
				if (!is_dir($path)) {
    				mkdir($path, 0777, true);
				}
*/
			//$model->save();

			if ($model->update($this->request->getVar('idagent'), $donnees)) {
				return redirect()->to(base_url('/espacerespo/listagent'));
			} else {
				print_r($model->errors());
			}
		}
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////
	/*public function creerdirection()
	{
		helper('form');
		$model = new DirectionModel();
		if (! $this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		]))	{
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			echo view('espacerespo/reussite');
		}
		//////////////////////////////////////////////////////////
		$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];
		echo view('espacerespo/apercudirection', $data);
		echo view('templates/espacerespo/pied', $data);
	}
*/

	/////////////////////// FIN MODULE PERMISSION //////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////VALIDATIONS //////////////////////////////////////////
	//////////////////////////////////////////////

	public function validercongeannuel()
	{
		helper('form');
		$model = new CongeannuelModel();
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/apercuca');
		echo view('templates/espacerespo/pied');
	}

	public function validercongematernite()
	{
		helper('form');
		$model = new CongematerniteModel();
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/apercucm');
		echo view('templates/espacerespo/pied');
	}

	public function validerpermissiondd()
	{
		helper('form');
		$model = new PermissionddModel();
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/apercupdd');
		echo view('templates/espacerespo/pied');
	}


	public function validerpermissionhh()
	{
		helper('form');
		$model = new PermissionddModel();
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/apercuphh');
		echo view('templates/espacerespo/pied');
	}

	public function validerca($num)
	{
		try {
			$db = \Config\Database::connect();
			$dd = date('Y-m-d');
			$myid = $_SESSION['cnxid'];
	
			// First get the leave request details
			$query = $db->query('SELECT * FROM congeannuel WHERE IDconge = ?', [$num]);
			$row = $query->getRow();
			
			if (!$row) {
				echo "<script>console.error('Leave request not found');</script>";
				$_SESSION['toast'] = 'Leave request not found';
				return redirect()->to(base_url('/espacerespo/validercongeannuel'));
			}
	
			// Get agent details 
			$query = $db->query('SELECT * FROM agent WHERE idagent = ?', [$row->Idagent]);
			$roww = $query->getRow();

			$valid = '';
			$updateFields = [];
	
			// Determine validation type based on user role
			if ($myid == $roww->Responsablen1) {
				// Chef de service validation
				$etat_text = ($row->validationsd == 1) ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+1';
				$updateFields = [
					'validationcs' => 1,
					'datecs' => $dd,
					'etat' => $etat_text
				];
				echo "<script>console.log('Processing Chef de service validation');</script>";
			}
			elseif ($myid == $roww->Responsablen2) {
				// Sous-directeur validation
				$etat_text = ($row->validationcs == 1) ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+2';
				$updateFields = [
					'validationsd' => 1, 
					'datesd' => $dd,
					'validationdg' => 1,
					'datedg' => $dd,
					'etat' => $etat_text
				];
				echo "<script>console.log('Processing Sous-directeur validation');</script>";
			}
			else{
	
				// If we have fields to update, perform the update
				if (!empty($updateFields)) {
					$builder = $db->table('congeannuel');
					$builder->where('IDconge', $num);
					$result = $builder->update($updateFields);
		
					if ($result) {
						echo "<script>console.log('Leave request updated successfully');</script>";
						$_SESSION['toast'] = 'Validation effectuée avec succès';
					} else {
						echo "<script>console.error('Failed to update leave request');</script>";
						$_SESSION['toast'] = 'Erreur lors de la validation';
					}
				} else {
					echo "<script>console.error('No validation permissions');</script>";
					$_SESSION['toast'] = 'Vous n\'avez pas les droits pour valider cette demande';
				}
		
				return redirect()->to(base_url('/espacerespo/validercongeannuel'));
			}
	
		} catch (\Exception $e) {
			echo "<script>console.error('Error: " . addslashes($e->getMessage()) . "');</script>";
			$_SESSION['toast'] = 'Une erreur est survenue';
			return redirect()->to(base_url('/espacerespo/validercongeannuel'));
		}
	}
	public function validercaall($numar_str)
	{
		if (!empty($numar_str)) {
			$numar = explode(',', $numar_str);
			$db = \Config\Database::connect();
			foreach ($numar as $num) {
				$dd = date('Y-m-d');

				$myid = $_SESSION['cnxid'];
				$query   = $db->query('SELECT * from congeannuel where IDconge=' . $num);
				$row   = $query->getRow();
				print_r($row);
				$query   = $db->query('SELECT * from agent where idagent=' . $row->Idagent);
				$roww   = $query->getRow();

				$valid = '';
				$myid = $_SESSION['cnxid'];

				//echo $myid.'<br/>'.'SELECT * from agent where idagent='.$row->Idagent.'<br/>';
				//print_r($roww);

				if ($myid == $roww->idagent) {
					$valid = $valid . "`validationagent` = '1', `etat` = 'VALIDATION AGENT'";
				}

				if ($myid == $roww->Responsablen1 || empty($roww->Responsablen1)) {
					if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} elseif ($row->etat == "VALIDATION RESPONSABLE N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} else {
						$etat_text = 'VALIDATION RESPONSABLE N+1';
					}
					if ($valid == '') {
						$valid = $valid . "`validationcs` = '1', `datecs` = '$dd', `etat` = '$etat_text'";
					} else {
						$valid = $valid . ",`validationcs` = '1', `datecs` = '$dd', `etat` = '$etat_text'";
					}
				}

				if ($myid == $roww->Responsablen2) {
					if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} elseif ($row->etat == "VALIDATION RESPONSABLE N+1") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} else {
						$etat_text = 'VALIDATION RESPONSABLE N+2';
					}
					if ($valid == '') {
						$valid = $valid . " `validationsd` = '1', `datesd` = '$dd', `validationdg` = '1', `datedg` = '$dd', `etat` = '$etat_text'";
					} else {
						$valid = $valid . " ,`validationsd` = '1', `datesd` = '$dd', `validationdg` = '1', `datedg` = '$dd', `etat` = '$etat_text'";
					}
				}

				if ($myid == $roww->Sousdrh || $myid == $_SESSION['sdrh2']) {
					if ($valid == '') {
						$valid = $valid . "`validationsdrh` = '1', `datesdrh` = '$dd', `etat` = 'VALIDÉ'";
					} else {
						$valid = $valid . ",`validationsdrh` = '1', `datesdrh` = '$dd', `etat` = 'VALIDÉ'";
					}
				}

				$sql = "UPDATE `congeannuel` SET $valid WHERE (`IDconge` = '$num')";

				//		echo "UPDATE `congeannuel` SET $valid WHERE (`IDconge` = '$num')";
				/*	if($num != $row->IDagent) {
					$sql = "UPDATE `congeannuel` SET `validationcs` = '1',`validationagent` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";
				} else {
					$sql = "UPDATE `congeannuel` SET `validationcs` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";
				}*/

				$query   = $db->query($sql);
			}
		}

		return redirect()->to(base_url('/espacerespo/validercongeannuel'));
	}


	public function validercm($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');

		$sql = "UPDATE `congematernite` SET `validationcs` = '1', `validationsus` = '1', `datecs` = '$dd', `datesus` = '$dd', `datevalidation` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";

		$query   = $db->query($sql);

		return redirect()->to(base_url('/espacerespo/validercongematernite'));
	}
	public function validercmall($numar_str)
	{
		if (!empty($numar_str)) {
			$numar = explode(',', $numar_str);
			$db = \Config\Database::connect();
			foreach ($numar as $num) {
				$dd = date('Y-m-d');

				$sql = "UPDATE `congematernite` SET `validationcs` = '1', `validationsus` = '1', `datecs` = '$dd', `datesus` = '$dd', `datevalidation` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";

				$query   = $db->query($sql);
			}
		}

		return redirect()->to(base_url('/espacerespo/validercongematernite'));
	}

	public function validerpdd($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');

		$myid = $_SESSION['cnxid'];
		$query   = $db->query('SELECT * from permissiondd where IDpermission=' . $num);
		$row   = $query->getRow();
		$query   = $db->query('SELECT * from agent where idagent=' . $row->Idagent);
		$roww   = $query->getRow();

		$valid = '';

		if ($myid == $roww->idagent) {
			$valid = $valid . "`validationagent` = '1', `etat` = 'VALIDATION AGENT'";
		}

		if ($myid == $roww->Responsablen1 || empty($roww->Responsablen1)) {
			if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} elseif ($row->etat == "VALIDATION RESPONSABLE N+2") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} else {
				$etat_text = 'VALIDATION RESPONSABLE N+1';
			}
			$valid .= "`validationcs` = '1', `datecs` = '$dd', `etat` = '$etat_text'";
		}

		if ($myid == $roww->Responsablen2) {
			if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} elseif ($row->etat == "VALIDATION RESPONSABLE N+1") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} else {
				$etat_text = 'VALIDATION RESPONSABLE N+2';
			}
			$valid .= " `validationsd` = '1', `datesd` = '$dd', `validationdg` = '1', `datedg` = '$dd', `etat` = '$etat_text'";
		}

		if ($myid == $roww->Sousdrh || $myid == $_SESSION['sdrh2']) {
			$valid .= "`validationsdrh` = '1', `datesdrh` = '$dd', `etat` = 'VALIDÉ'";
		}

		$sql = "UPDATE `permissiondd` SET $valid WHERE (`IDpermission` = '$num')";

		//$sql = "UPDATE `permissiondd` SET `validationcs` = '1', `validationsdrh` = '1', `validationsd` = '1', `validationdms` = '1', `validationsus` = '1',  `datecs` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datesus` = '$dd', `datedms` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDpermission` = '$num')";

		$query   = $db->query($sql);

		return redirect()->to(base_url('/espacerespo/validerpermissiondd'));
	}
	public function validerpddall($numar_str)
	{
		if (!empty($numar_str)) {
			$numar = explode(',', $numar_str);
			$db = \Config\Database::connect();
			foreach ($numar as $num) {
				$dd = date('Y-m-d');

				$myid = $_SESSION['cnxid'];
				$query   = $db->query('SELECT * from permissiondd where IDpermission=' . $num);
				$row   = $query->getRow();
				$query   = $db->query('SELECT * from agent where idagent=' . $row->Idagent);
				$roww   = $query->getRow();

				$valid = '';

				if ($myid == $roww->idagent) {
					$valid = $valid . "`validationagent` = '1', `etat` = 'VALIDATION AGENT'";
				}

				if ($myid == $roww->Responsablen1 || empty($roww->Responsablen1)) {
					if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} elseif ($row->etat == "VALIDATION RESPONSABLE N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} else {
						$etat_text = 'VALIDATION RESPONSABLE N+1';
					}
					$valid .= "`validationcs` = '1', `datecs` = '$dd', `etat` = '$etat_text'";
				}

				if ($myid == $roww->Responsablen2) {
					if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} elseif ($row->etat == "VALIDATION RESPONSABLE N+1") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} else {
						$etat_text = 'VALIDATION RESPONSABLE N+2';
					}
					$valid .= " `validationsd` = '1', `datesd` = '$dd', `validationdg` = '1', `datedg` = '$dd', `etat` = 'VALIDATION RESPONSABLE N+2'";
				}

				if ($myid == $roww->Sousdrh || $myid == $_SESSION['sdrh2']) {
					$valid .= "`validationsdrh` = '1', `datesdrh` = '$dd', `etat` = 'VALIDÉ'";
				}

				$sql = "UPDATE `permissiondd` SET $valid WHERE (`IDpermission` = '$num')";

				//$sql = "UPDATE `permissiondd` SET `validationcs` = '1', `validationsdrh` = '1', `validationsd` = '1', `validationdms` = '1', `validationsus` = '1',  `datecs` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datesus` = '$dd', `datedms` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDpermission` = '$num')";

				$query   = $db->query($sql);
			}
		}

		return redirect()->to(base_url('/espacerespo/validerpermissiondd'));
	}

	public function validerphh($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');
		$myid = $_SESSION['cnxid'];
		$query   = $db->query('SELECT * from permissionhh where IDpermission=' . $num);
		$row   = $query->getRow();
		$query   = $db->query('SELECT * from agent where idagent=' . $row->Idagent);
		$roww   = $query->getRow();

		$valid = '';

		if ($myid == $roww->idagent) {
			$valid = $valid . "`validationagent` = '1', `etat` = 'VALIDATION AGENT'";
		}

		if ($myid == $roww->Responsablen1) {
			if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} elseif ($row->etat == "VALIDATION RESPONSABLE N+2") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} else {
				$etat_text = 'VALIDATION RESPONSABLE N+1';
			}
			$valid .= "`validationcs` = '1', `datecs` = '$dd', `etat` = '$etat_text'";
		}

		if ($myid == $roww->Responsablen2) {
			if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} elseif ($row->etat == "VALIDATION RESPONSABLE N+1") {
				$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
			} else {
				$etat_text = 'VALIDATION RESPONSABLE N+2';
			}
			$valid .= "`validationsd` = '1', `datesd` = '$dd', `validationdg` = '1', `datedg` = '$dd', `etat` = '$etat_text'";
		}

		if ($myid == $roww->Sousdrh || $myid == $_SESSION['sdrh2']) {
			$valid = "`validationcs` = '1',`validationagent` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ'";
		} else {
			if ($myid == $roww->idagent) {
				$valid = "`validationcs` = '1',`validationagent` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datedg` = '$dd', `etat` = 'VALIDATION EN COURS'";
			}
		}

		// print_r($valid);
		

		$sql = "UPDATE `permissionhh` SET $valid WHERE (`IDpermission` = '$num')";
		// print_r($sql);
		// exit;
		//        $sql = "UPDATE `permissionhh` SET `validationcs` = '1', `validationsdrh` = '1', `validationsus` = '1',  `datecs` = '$dd', `datesus` = '$dd', `datesdrh` = '$dd', `etat` = 'VALIDÉ'  WHERE (`IDpermission` = '$num')";
		$query   = $db->query($sql);

		return redirect()->to(base_url('/espacerespo/validerpermissionhh'));
	}
	public function validerphhall($numar_str)
	{
		if (!empty($numar_str)) {
			$numar = explode(',', $numar_str);
			$db = \Config\Database::connect();
			foreach ($numar as $num) {
				$dd = date('Y-m-d');
				$myid = $_SESSION['cnxid'];
				$query   = $db->query('SELECT * from permissionhh where IDpermission=' . $num);
				$row   = $query->getRow();
				$query   = $db->query('SELECT * from agent where idagent=' . $row->Idagent);
				$roww   = $query->getRow();

				$valid = '';

				if ($myid == $roww->idagent) {
					$valid = $valid . "`validationagent` = '1', `etat` = 'VALIDATION AGENT'";
				}

				if ($myid == $roww->Responsablen1) {
					if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} elseif ($row->etat == "VALIDATION RESPONSABLE N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} else {
						$etat_text = 'VALIDATION RESPONSABLE N+1';
					}
					$valid .= ",`validationcs` = '1', `datecs` = '$dd', `etat` = '$etat_text'";
				}

				if ($myid == $roww->Responsablen2) {
					if ($row->etat == "VALIDATION RESPONSABLE N+1 ET N+2") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} elseif ($row->etat == "VALIDATION RESPONSABLE N+1") {
						$etat_text = 'VALIDATION RESPONSABLE N+1 ET N+2';
					} else {
						$etat_text = 'VALIDATION RESPONSABLE N+2';
					}
					$valid .= " `validationsd` = '1', `datesd` = '$dd', `validationdg` = '1', `datedg` = '$dd', `etat` = '$etat_text'";
				}

				if ($myid == $roww->Sousdrh || $myid == $_SESSION['sdrh2']) {
					$valid = "`validationcs` = '1',`validationagent` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ'";
				} else {
					if ($myid == $roww->idagent) {
						$valid = "`validationcs` = '1',`validationagent` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datedg` = '$dd', `etat` = 'VALIDATION EN COURS'";
					}
				}

				$sql = "UPDATE `permissionhh` SET $valid WHERE (`IDpermission` = '$num')";
				//        $sql = "UPDATE `permissionhh` SET `validationcs` = '1', `validationsdrh` = '1', `validationsus` = '1',  `datecs` = '$dd', `datesus` = '$dd', `datesdrh` = '$dd', `etat` = 'VALIDÉ'  WHERE (`IDpermission` = '$num')";
				$query   = $db->query($sql);
			}
		}

		return redirect()->to(base_url('/espacerespo/validerpermissionhh'));
	}


	public function rejetagent($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');

		$req = '';
		$query = $db->query('SELECT * from agent where idagent=' . $num);
		$row   = $query->getRow();

		if ($row->Responsablen1 == $_SESSION['cnxid']) {
			$req = $req . ' Responsablen1=0,';
		}
		if ($row->Responsablen2 == $_SESSION['cnxid']) {
			$req = $req . ' Responsablen2=0,';
		}
		if ($row->Sousdrh == $_SESSION['cnxid']) {
			$req = $req . ' Sousdrh=0,';
		}
		if ($row->Directeurgeneral == $_SESSION['cnxid']) {
			$req = $req . 'Directeurgeneral=0,';
		}


		$req = rtrim($req, ',');

		echo "UPDATE `agent` SET $req WHERE (`idagent` = '$num')";

		$sql = "UPDATE `agent` SET $req WHERE (`idagent` = '$num')";

		$query   = $db->query($sql);

		return redirect()->to(base_url('/espacerespo/listagent'));
	}


	public function rejetca($m)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidconge' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/rejetca', $data);
		} else {
			$db = \Config\Database::connect();

			$motif = $this->request->getVar('motifrejet');
			$sql = "UPDATE `congeannuel` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDconge` = '$m')";

			//echo $sql;

			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/validercongeannuel'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espacerespo/pied');
	}
	public function rejetcaall($numar_str)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidconge' => $numar_str,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/rejetcaall', $data);
		} else {
			$db = \Config\Database::connect();
			if (!empty($numar_str)) {
				$numar = explode(',', $numar_str);
				$motif = $this->request->getVar('motifrejet');
				foreach ($numar as $m) {
					$sql = "UPDATE `congeannuel` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDconge` = '$m')";
					$query   = $db->query($sql);
				}
			}

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/validercongeannuel'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espacerespo/pied');
	}

	public function rejetpdd($m)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidpdd' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/rejetpdd', $data);
		} else {
			$db = \Config\Database::connect();
			$motif = $this->request->getVar('motifrejet');
			$sql = "UPDATE `permissiondd` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDpermission` = '$m')";
			$query = $db->query($sql);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/validerpermissiondd'));
		}
		echo view('templates/espacerespo/pied');
	}
	public function rejetpddall($numar_str)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidpdd' => $numar_str,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/rejetpddall', $data);
		} else {
			if (!empty($numar_str)) {
				$numar = explode(',', $numar_str);
				$db = \Config\Database::connect();
				$motif = $this->request->getVar('motifrejet');
				foreach ($numar as $m) {
					$sql = "UPDATE `permissiondd` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDpermission` = '$m')";
					$query = $db->query($sql);
				}
			}
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/validerpermissiondd'));
		}
		echo view('templates/espacerespo/pied');
	}


	public function rejetphh($m)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidphh' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/rejetphh', $data);
		} else {
			$db = \Config\Database::connect();
			$motif = $this->request->getVar('motifrejet');
			$sql = "UPDATE `permissionhh` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDpermission` = '$m')";
			$query = $db->query($sql);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/validerpermissionhh'));
		}
		echo view('templates/espacerespo/pied');
	}
	public function rejetphhall($numar_str)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidphh' => $numar_str,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/rejetphhall', $data);
		} else {
			if (!empty($numar_str)) {
				$numar = explode(',', $numar_str);
				$db = \Config\Database::connect();
				$motif = $this->request->getVar('motifrejet');
				foreach ($numar as $m) {
					$sql = "UPDATE `permissionhh` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDpermission` = '$m')";
					$query = $db->query($sql);
				}
			}
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/validerpermissionhh'));
		}
		echo view('templates/espacerespo/pied');
	}





	public function creerplanpermanence()
	{

		helper('form');
		$model = new PlanpermanenceModel();
		if (!$this->validate([
			//'libelle' => 'required|min_length[1]|max_length[200]',
			'IDservice' => 'required',
			'IDmois' => 'required'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerplanpermanence', $data);
		} else {
			$db = \Config\Database::connect();
			$query   = $db->query('SELECT libelle FROM lemois where IDmois =' . $this->request->getVar('IDmois'));
			$lmois = $query->getRow();

			if ($this->request->getVar('validationcs') == 'on') {
				$validationcs = 1;
			} else {
				$validationcs = 0;
			}
			if ($this->request->getVar('validationdg') == 'on') {
				$validationdg = 1;
			} else {
				$validationdg = 0;
			}
			if ($this->request->getVar('validationdsio') == 'on') {
				$validationdsio = 1;
			} else {
				$validationdsio = 0;
			}
			if ($this->request->getVar('validationsus') == 'on') {
				$validationsus = 1;
			} else {
				$validationsus = 0;
			}
			if ($this->request->getVar('validationsd') == 'on') {
				$validationsd = 1;
			} else {
				$validationsd = 0;
			}
			if ($this->request->getVar('validationcctos') == 'on') {
				$validationcctos = 1;
			} else {
				$validationcctos = 0;
			}
			if ($this->request->getVar('validationdms') == 'on') {
				$validationdms = 1;
			} else {
				$validationdms = 0;
			}
			if ($this->request->getVar('validationdaf') == 'on') {
				$validationdaf = 1;
			} else {
				$validationdaf = 0;
			}

			$model->save([
				'libelle'	=> 'PLANNING ' . $lmois->libelle,
				'IDservice'	=> $this->request->getVar('IDservice'),
				'IDmois'	=> $this->request->getVar('IDmois'),
				'publier'	=> $this->request->getVar('publier'),
				'lit'	=> $this->request->getVar('lit'),
				'creele'	=> date('Y-m-d'),
				'creepar'	=> $_SESSION['cnxname'],
				'validationcs'	=> $validationcs,
				'validationdg'	=> $validationdg,
				'validationdsio'	=> $validationdsio,
				'validationsus'	=> $validationsus,
				'validationsd'	=> $validationsd,
				'validationcctos'	=> $validationcctos,
				'validationdms'	=> $validationdms,
				'validationdaf'	=> $validationdaf,
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerplanpermanence'));
			//echo view('espacerespo/creerplancongeannuel', $data);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'planpermanence' => $model->recPlanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espacerespo/apercuplanpermanence', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	public function editplanpermanence($m)
	{

		helper('form');
		$model = new PlanpermanenceModel();
		if (!$this->validate([
			//'libelle' => 'required|min_length[1]|max_length[200]',
			'IDservice' => 'required',
			'IDmois' => 'required'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidplanpermanence' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerplanpermanence', $data);
		} else {
			$db = \Config\Database::connect();
			$query   = $db->query('SELECT libelle FROM lemois where IDmois =' . $this->request->getVar('IDmois'));
			$lmois = $query->getRow();

			if ($this->request->getVar('validationcs') == 'on') {
				$validationcs = 1;
			} else {
				$validationcs = 0;
			}
			if ($this->request->getVar('validationdg') == 'on') {
				$validationdg = 1;
			} else {
				$validationdg = 0;
			}
			if ($this->request->getVar('validationdsio') == 'on') {
				$validationdsio = 1;
			} else {
				$validationdsio = 0;
			}
			if ($this->request->getVar('validationsus') == 'on') {
				$validationsus = 1;
			} else {
				$validationsus = 0;
			}
			if ($this->request->getVar('validationsd') == 'on') {
				$validationsd = 1;
			} else {
				$validationsd = 0;
			}
			if ($this->request->getVar('validationcctos') == 'on') {
				$validationcctos = 1;
			} else {
				$validationcctos = 0;
			}
			if ($this->request->getVar('validationdms') == 'on') {
				$validationdms = 1;
			} else {
				$validationdms = 0;
			}
			if ($this->request->getVar('validationdaf') == 'on') {
				$validationdaf = 1;
			} else {
				$validationdaf = 0;
			}

			$model->update($this->request->getVar('IDplanpermanence'), [
				'libelle'	=> 'PLANNING ' . $lmois->libelle,
				'IDservice'	=> $this->request->getVar('IDservice'),
				'IDmois'	=> $this->request->getVar('IDmois'),
				'publier'	=> $this->request->getVar('publier'),
				'lit'	=> $this->request->getVar('lit'),
				'creele'	=> date('Y-m-d'),
				'creepar'	=> $_SESSION['cnxname'],

				'validationcs'	=> $validationcs,
				'validationdg'	=> $validationdg,
				'validationdsio'	=> $validationdsio,
				'validationsus'	=> $validationsus,
				'validationsd'	=> $validationsd,
				'validationcctos'	=> $validationcctos,
				'validationdms'	=> $validationdms,
				'validationdaf'	=> $validationdaf,

			]);
			//print_r($this->request->getVar());
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerplanpermanence'));
			//echo view('espacerespo/creerplancongeannuel', $data);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'planpermanence' => $model->recPlanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espacerespo/apercuplanpermanence', $data);
		echo view('templates/espacerespo/pied', $data);
	}



	public function selectplan()
	{

		helper('form');
		$model = new AgentplanpermanenceModel();
		if (!$this->validate([
			//'IDequipe' => 'required',
			//'IDjourplan' => 'required',
			'IDplanpermanence' => 'required'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			echo view('espacerespo/selectplan');
		} else {

			$_SESSION['leplan'] = $this->request->getVar('IDplanpermanence');
			//print_r($this->request->getVar());
			return redirect()->to(base_url('/espacerespo/attribuerplanpermanence'));
		}
		echo view('templates/espacerespo/pied');
	}

	public function attribuerplanpermanence()
	{

		helper('form');
		$model = new AgentplanpermanenceModel();
		if (!$this->validate([
			'IDequipe' => 'required',
			//'IDjourplan' => 'required',
			'IDplanpermanence' => 'required'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			echo view('espacerespo/creeragentplanpermanence');
		} else {
			/*$model->save([
				'IDplanpermanence'	=> $this->request->getVar('IDplanpermanence'),
				'IDequipe'	=> $this->request->getVar('IDequipe'),
				'IDjourplan'	=> $this->request->getVar('IDjourplan'),
				'changement'	=> $this->request->getVar('changement'),
				'justificatif'	=> $this->request->getVar('justificatif'),
			]);*/
			echo $this->request->getVar('IDequipe');
			//print_r($this->request->getVar('jour'));

			foreach ($this->request->getVar('jour') as $jj) {
				//echo $jj.'<br/>';

				$model->save([
					'IDplanpermanence'	=> $this->request->getVar('IDplanpermanence'),
					'IDequipe'	=> $this->request->getVar('IDequipe'),
					'IDjourplan'	=> $jj,
					'changement'	=> 0,
					'justificatif'	=> '',
				]);
			}
			return redirect()->to(base_url('/espacerespo/attribuerplanpermanence'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'agentplanpermanence' => $model->recAgentplanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espacerespo/apercuagentplanpermanence', $data);
		echo view('templates/espacerespo/pied', $data);
	}



	public function editagentplanpermanence($m)
	{

		helper('form');
		$model = new AgentplanpermanenceModel();
		if (!$this->validate([
			'Idagent' => 'required',
			'IDjourplan' => 'required',
			'IDplanpermanence' => 'required'
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidagentplanpermanence' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creeragentplanpermanence', $data);
		} else {
			$model->update($this->request->getVar('idagentplanpermanence'), [
				'IDplanpermanence'	=> $this->request->getVar('IDplanpermanence'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				'IDjourplan'	=> $this->request->getVar('IDjourplan'),
				'changement'	=> $this->request->getVar('changement'),
				'justificatif'	=> $this->request->getVar('justificatif'),
			]);

			//print_r($model->errors());

			return redirect()->to(base_url('/espacerespo/attribuerplanpermanence'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'agentplanpermanence' => $model->recAgentplanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espacerespo/apercuagentplanpermanence', $data);
		echo view('templates/espacerespo/pied', $data);
	}




	public function afficherplanpermanence()
	{
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');

		//echo view('templates/espacerespo/entete', $data);

		echo view('espacerespo/afficherplanpermanence');
		echo view('templates/espacerespo/pied');
	}


	public function afficherplanpermanencerespo()
	{
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');

		//echo view('templates/espacerespo/entete', $data);

		echo view('espacerespo/afficherplanpermanencerespo');
		echo view('templates/espacerespo/pied');
	}

	public function validerchangep()
	{
		helper('form');
		$model = new AgentplanpermanenceModel();
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/validercp');
		echo view('templates/espacerespo/pied');
	}


	public function refusercp($m)
	{
		helper('form');
		$model = new AgentplanpermanenceModel();
		$model->update($m, [
			'changement'	=> 0,
			'justificatif'	=> 'REFUSEE',
		]);
		return redirect()->to(base_url('/espacerespo/validerchangep'));
	}

	public function acceptercp($m)
	{
		helper('form');
		$model = new AgentplanpermanenceModel();
		$model->update($m, [
			'changement'	=> 0,
			'justificatif'	=> 'ACCEPTEE',
		]);
		return redirect()->to(base_url('/espacerespo/validerchangep'));
	}

	public function besoinservice()
	{
		helper('form');
		$model = new BesoinserviceModel();
		if (!$this->validate([
			'IDservice' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
			'justificatif' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			echo view('espacerespo/besoinservice');
		} else {
			$model->save([
				'IDservice' => $this->request->getVar('IDservice'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'justificatif' => $this->request->getVar('justificatif'),
				'datedemande' => date('Y-m-d'),
				'etat' => 'ATTENTE DE REPONSE',
			]);
			return redirect()->to(base_url('/espacerespo/besoinservice'));
		}
		//////////////////////////////////////////////////////////
		echo view('espacerespo/apercubesoinservice');
		echo view('templates/espacerespo/pied');
	}



	public function editbesoinservice($m)
	{
		helper('form');
		$model = new BesoinserviceModel();
		if (!$this->validate([
			'IDservice' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
			'justificatif' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'lidbesoinservice' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/besoinservice', $data);
		} else {
			$model->update($this->request->getVar('IDbesoinservice'), [
				'IDservice' => $this->request->getVar('IDservice'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'justificatif' => $this->request->getVar('justificatif'),
				'datedemande' => date('Y-m-d'),
				'etat' => 'BESOIN EN ATTENTE',
			]);
			return redirect()->to(base_url('/espacerespo/besoinservice'));
		}
		//////////////////////////////////////////////////////////
		echo view('espacerespo/apercubesoinservice');
		echo view('templates/espacerespo/pied');
	}

	public function delbesoinservice($num)
	{
		$model = new BesoinserviceModel();
		$model->where('IDbesoinservice', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/besoinservice'));
	}


	public function delagentequipe($num)
	{
		$model = new AgentequipeModel();
		$model->where('IDagentequipe', $num);
		$model->delete();
		return redirect()->to(base_url('/espacerespo/addagentequipe/' . $_SESSION['lastid']));
	}

	public function guideadmin()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/guideadmin');
		echo view('templates/espacerespo/pied');
	}

	public function guiderespo()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/guiderespo');
		echo view('templates/espacerespo/pied');
	}


	public function guideuser()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/guideuser');
		echo view('templates/espacerespo/pied');
	}


	public function editarrettravail($m)
	{
		helper('form');
		$model = new ArrettravailModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'datedepart' => 'required',
			'datereprise' => 'required',
			'motif' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			$data = [
				'lidarrettravail' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerarrettravail', $data);
		} else {
			$newName = '';

			$agent = $this->creerAgentFolder($this->request->getVar('Idagent'));
			if (!$agent) {
				$_SESSION['toast'] = 'Une erreur est survenue !';
				return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			}
			$newName = '';
			$lieu = './agents/' . $agent['matricule'] . '/5-MALADIE';
			$file = $this->request->getFile('justificatif1');
			if (!empty($file)) {
				$arretTravail = $model->find($this->request->getVar('IDarrettravail'));
				if ($arretTravail && $arretTravail['justificatif1']) {
					$old_file = $lieu . '/' . $arretTravail['justificatif1'];
					unlink($old_file);
				}
				$newName = date('YmdHis') . 'justificatif' . $agent['matricule'] . '.' . $file->getClientExtension();
				if (!$file->isValid()) {
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);
					}
				}
			}

			$laduree = date_diff(date_create($this->request->getVar('datedepart')), date_create($this->request->getVar('datereprise')));


			$model->update($this->request->getVar('IDarrettravail'), [
				'Idagent' => $this->request->getVar('Idagent'),
				'datedemande' => date('Y-m-d'),
				'motif' => $this->request->getVar('motif'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $this->request->getVar('datereprise'),
				'justificatif1' => $newName,
				'duree' => $laduree->format("%a jours"),
				'details' => $this->request->getVar('details'),
				'motifrejet' => $this->request->getVar('motifrejet'),
				//'etat' => 'EN COURS',
			]);
			$_SESSION['toast'] = 'Opération réussie !';

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerarrettravail'));
			//echo view('espacerespo/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espacerespo/apercuarrettravail', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	public function prorogerarrettravail($m)
	{
		helper('form');
		$model = new ArrettravailModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'datedepart' => 'required',
			'datereprise' => 'required',
			'motif' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			$data = [
				'lidarrettravail' => $m,
				'lidarrettravailp' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerarrettravail', $data);
		} else {
			$agent = $this->creerAgentFolder($this->request->getVar('Idagent'));
			if (!$agent) {
				$_SESSION['toast'] = 'Une erreur est survenue !';
				return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			}
			$newName = '';
			$lieu = './agents/' . $agent['matricule'] . '/5-MALADIE';
			$file = $this->request->getFile('justificatif1');
			if (!empty($file)) {
				$arretTravail = $model->find($this->request->getVar('IDarrettravail'));
				if ($arretTravail && $arretTravail['justificatif1']) {
					$old_file = $lieu . '/' . $arretTravail['justificatif1'];
					unlink($old_file);
				}
				$newName = date('YmdHis') . 'justificatif' . $agent['matricule'] . '.' . $file->getClientExtension();
				if (!$file->isValid()) {
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);
					}
				}
			}

			$laduree = date_diff(date_create($this->request->getVar('datedepart')), date_create($this->request->getVar('datereprise')));


			$model->update($this->request->getVar('IDarrettravail'), [
				'Idagent' => $this->request->getVar('Idagent'),
				'datedemande' => date('Y-m-d'),
				'motif' => $this->request->getVar('motif'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $this->request->getVar('datereprise'),
				'justificatif1' => $newName,
				'duree' => $laduree->format("%a jours"),
				'details' => $this->request->getVar('details'),
				//'motifrejet' => $this->request->getVar('motifrejet'),
				'etat' => 'PROROGATION',
			]);
			$_SESSION['toast'] = 'Opération réussie !';

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerarrettravail'));
			//echo view('espacerespo/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espacerespo/apercuarrettravail', $data);
		echo view('templates/espacerespo/pied', $data);
	}

	public function retourarrettravail($m)
	{
		helper('form');
		$model = new ArrettravailModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'datedepart' => 'required',
			'datereprise' => 'required',
			'motif' => 'required',
			'duree' => 'required',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			$data = [
				'lidarrettravail' => $m,
				'lidarrettravailr' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerarrettravail', $data);
		} else {
			$newName = '';

			/*
			$lieu = './agents/'.$_SESSION['mat'].'/5-MALADIE';
			$file = $this->request->getFile('justificatif1');
			$newName = date('Y-m-d_hi').'JUSTIFICATIF-'.$_SESSION['mat'].'.'.$file->getClientExtension();
			if (! $file->isValid())
			{ //echo 'ICI';
					//throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if(!$file->hasMoved()) {
					$file->move($lieu, $newName);
					////$file->move(WRITEPATH . 'uploads');
				}
			}
			*/

			$laduree = date_diff(date_create($this->request->getVar('datedepart')), date_create($this->request->getVar('datereprise')));


			$model->update($this->request->getVar('IDarrettravail'), [
				//'Idagent' => $this->request->getVar('Idagent'),
				//'datedemande' => date('Y-m-d'),
				//'motif' => $this->request->getVar('motif'),
				//'datedepart' => $this->request->getVar('datedepart'),
				//'datereprise' => $this->request->getVar('datereprise'),
				//'justificatif1' => $newName,
				//'duree' => $laduree->format("%a jours"),
				//'details' => $this->request->getVar('details'),
				'motifrejet' => $this->request->getVar('duree'),
				'etat' => 'TERMINE',
			]);
			$_SESSION['toast'] = 'Opération réussie !';

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espacerespo/creerarrettravail'));
			//echo view('espacerespo/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espacerespo/apercuarrettravail', $data);
		echo view('templates/espacerespo/pied', $data);
	}


	public function creerarrettravail()
	{
		helper('form');
		$model = new ArrettravailModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'Idagent' => 'required',
			'datedepart' => 'required',
			'datereprise' => 'required',
			'motif' => 'required',
			//'justificatif1' => 'uploaded[justificatif1]|mime_in[justificatif1,image/jpg,image/jpeg,image/gif,image/png]|max_size[justificatif1,4096]'

		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/creerarrettravail', $data);
		} else {

			$agent = $this->creerAgentFolder($this->request->getVar('Idagent'));
			if (!$agent) {
				$_SESSION['toast'] = 'Une erreur est survenue !';
				return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			}
			$newName = '';
			$lieu = './agents/' . $agent['matricule'] . '/5-MALADIE';
			$file = $this->request->getFile('justificatif1');
			if (!empty($file)) {
				$newName = date('YmdHis') . 'justificatif' . $agent['matricule'] . '.' . $file->getClientExtension();
				if (!$file->isValid()) {
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);
					}
				}
			}


			$laduree = date_diff(date_create($this->request->getVar('datedepart')), date_create($this->request->getVar('datereprise')));

			$model->save([
				'Idagent' => $this->request->getVar('Idagent'),
				'datedemande' => date('Y-m-d'),
				'motif' => $this->request->getVar('motif'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $this->request->getVar('datereprise'),
				'duree' => $laduree->format("%a jours"),
				'details' => $this->request->getVar('details'),
				//'motifrejet' => $this->request->getVar('motifrejet'),
				'justificatif1' => $newName,
				'etat' => 'EN COURS',

			]);
			$_SESSION['toast'] = 'Opération réussie !';
			//echo $this->request->getVar('datedepart');
			//print_r($model->errors());
			$_SESSION['toast'] = 'Opération réussie !' . $model->errors();
			return redirect()->to(base_url('/espacerespo/creerarrettravail'));
			//echo view('espacerespo/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espacerespo/apercuarrettravail');
		echo view('templates/espacerespo/pied');
	}



	/////////////////////////////////////////////////////////////////////////////////////
	///////////////////////// GESTION DES ACTES /////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////

	public function ajouteracte()
	{
		helper('form');
		$model = new DirectionModel();

		echo view('templates/espacerespo/entete');
		echo view('templates/espacerespo/sidebar');
		echo view('templates/espacerespo/topbar');
		echo view('espacerespo/ficheagent', ['titre' => 'Creation d\'un nouvel agent']);

		echo view('templates/espacerespo/pied', $data);
	}


	public function changepwd()
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'oldp' => 'required',
			'newp' => 'required|min_length[7]|max_length[100]',
		])) {
			echo view('templates/espacerespo/entete');
			echo view('templates/espacerespo/sidebar');
			echo view('templates/espacerespo/topbar');

			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espacerespo/changepwd', $data);
			//echo view('templates/espacerespo/pied');
			// return redirect()->to(base_url('espacerespo/changepwd'));
		} else {
			$db = \Config\Database::connect();
			$lid = $this->request->getVar('idagent');
			$lpwd = md5($this->request->getVar('oldp'));

			$query = $db->query("SELECT * from agent where pwd = '$lpwd' and idagent=$lid");
			$ttt = $query->getResultArray();
			$lpwd = md5($this->request->getVar('newp'));

			if (count($ttt) == 1) {
				$model->update($this->request->getVar('idagent'), [
					'pwd' => $lpwd,

				]);
				//$query = $db->query("UPDATE agent set pwd='$lpwd' where idagent = '$lid'"); 
				$_SESSION['toast'] = 'Mot de passe mis à jour avec succès...!';
				return redirect()->to(base_url('/espacerespo/changepwd'));
			} else {
				$data = [
					'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
				];

				echo view('templates/espacerespo/entete');
				echo view('templates/espacerespo/sidebar');
				echo view('templates/espacerespo/topbar');
				echo view('espacerespo/changepwd', $data);
			}
		}
		echo view('templates/espacerespo/pied', $data);
	}
}
