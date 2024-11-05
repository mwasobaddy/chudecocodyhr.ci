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
use App\Models\ActeModel;

use App\Models\PlanpermanenceModel;
use App\Models\AgentplanpermanenceModel;

use App\Models\BesoinserviceModel;
use App\Models\EnformationModel;

use App\Models\AgentequipeModel;
use App\Models\EquipeModel;

use App\Models\SituationModel;
use App\Models\SousdirectionModel;

use App\Models\CongeannuelModel;
use App\Models\CongematerniteModel;
use App\Models\PermissionddModel;
use App\Models\PermissionhhModel;

use App\Models\PlancongeannuelModel;

use App\Models\PosteModel;
use App\Models\PosteserviceModel;
use App\Models\PostedirectionModel;
use App\Models\PostesousdirectionModel;


$this->session = \Config\Services::session();


use CodeIgniter\Controller;

class Espaceadmin extends Controller
{

	public function afficher($contenu = 'accueil')
	{
		if (!is_file(APPPATH . '/Views/espaceadmin/' . $contenu . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
		}
		$data['titre'] = ucfirst($contenu); // Capitalize the first letter
		$data['contenu'] = $contenu;


		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);
		//echo view('templates/espaceadmin/pagecontent', $data);
		echo view('espaceadmin/' . $contenu, $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	public function index()
	{

		$model = new AgentModel();

		///////////////////////////////////////////////////////////////////////////////////////
		//$model = new AgentModel();
		$data = [
			'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/accueil', $data);

		echo view('templates/espaceadmin/pied', $data);
	}


	public function listagent()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/apercuagent');

		echo view('templates/espaceadmin/pied', $data);
	}

	public function savepassword()
	{
		helper('form');
		$model = new AgentModel();

		if (!$this->validate([
			'agentid' => 'required',
			'password'	=> 'required|min_length[8]|max_length[12]',
		])) {
			$_SESSION['toast'] = 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !';
		} else {
			$db = \Config\Database::connect();
			$authotp = $this->request->getVar('password');
			$authotpmd = md5($authotp);
			$idagent = $this->request->getVar('agentid');
			$query = $db->query("UPDATE agent set pwd='$authotpmd' where idagent = '$idagent'");
			$_SESSION['toast'] = 'Mot de passe mis à jour avec succès...!';
		}
		return redirect()->to(base_url('/espaceadmin/listagent'));
	}

	public function statagent()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			//'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/apercustatagent');

		echo view('templates/espaceadmin/pied', $data);
	}



	public function statagentr()
	{
		$model = new AgentModel();
		$db = \Config\Database::connect();
		////////////////////////////////
		if (!$this->validate([
			'deb' => 'required',
		])) {

			$query   = $db->query('SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from genre where genre.IDgenre=agent.IDgenre) as llgenre, (select libelle from grade where grade.IDgrade=agent.IDgrade) as llgrade, (select libelle from lafonction where lafonction.IDlafonction=agent.IDlafonction) as llfonction, (select libelle from contrat where contrat.IDcontrat=agent.IDcontrat) as llcontrat,  (select libelle from civilite where civilite.IDcivilite=agent.IDcivilite) as llcivilite, (select libelle from direction where direction.IDdirection=agent.IDdirection) as lldirection, (select libelle from sousdirection where sousdirection.IDsousdirection=agent.IDsousdirection) as llsousdirection FROM agent order by nom asc');
			$agent = $query->getResultArray();

			$data = [
				'agent' => $agent,
				'titre' => 'Liste des agents',
				//'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			echo view('espaceadmin/apercustatagentr', $data);
			echo view('templates/espaceadmin/pied');
		} else {

			if ($this->request->getVar('fin') != '') {
				$debut = $this->request->getVar('deb');
				$fin = $this->request->getVar('fin');
				$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from genre where genre.IDgenre=agent.IDgenre) as llgenre, (select libelle from grade where grade.IDgrade=agent.IDgrade) as llgrade, (select libelle from lafonction where lafonction.IDlafonction=agent.IDlafonction) as llfonction, (select libelle from contrat where contrat.IDcontrat=agent.IDcontrat) as llcontrat,  (select libelle from civilite where civilite.IDcivilite=agent.IDcivilite) as llcivilite, (select libelle from direction where direction.IDdirection=agent.IDdirection) as lldirection, (select libelle from sousdirection where sousdirection.IDsousdirection=agent.IDsousdirection) as llsousdirection FROM agent where (
				((((DATE_FORMAT(FROM_DAYS(TO_DAYS('$fin-12-31')-TO_DAYS(`datenais`)), '%Y')+0)) between 60 AND (60+(ABS(YEAR('$debut-12-31') - YEAR('$fin-12-31')))))
				  AND 
				 IDgrade not in(2,3,4,5)) 
				 || 
				 ((((DATE_FORMAT(FROM_DAYS(TO_DAYS('$fin-12-31')-TO_DAYS(`datenais`)), '%Y')+0)) BETWEEN 65 AND (65+(ABS(YEAR('$debut-12-31') - YEAR('$fin-12-31'))))) AND 
				  IDgrade in(2,3,4,5))
				) order by nom asc");
			} else {
				$debut = $this->request->getVar('deb');
				$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from genre where genre.IDgenre=agent.IDgenre) as llgenre, (select libelle from grade where grade.IDgrade=agent.IDgrade) as llgrade, (select libelle from lafonction where lafonction.IDlafonction=agent.IDlafonction) as llfonction, (select libelle from contrat where contrat.IDcontrat=agent.IDcontrat) as llcontrat,  (select libelle from civilite where civilite.IDcivilite=agent.IDcivilite) as llcivilite, (select libelle from direction where direction.IDdirection=agent.IDdirection) as lldirection, (select libelle from sousdirection where sousdirection.IDsousdirection=agent.IDsousdirection) as llsousdirection, (DATE_FORMAT(FROM_DAYS(TO_DAYS('$debut-12-31')-TO_DAYS(`datenais`)), '%Y')+0) AS age FROM agent where ((((DATE_FORMAT(FROM_DAYS(TO_DAYS('$debut-12-31')-TO_DAYS(`datenais`)), '%Y')+0))=60 AND IDgrade not in(2,3,4,5)) || (((DATE_FORMAT(FROM_DAYS(TO_DAYS('$debut-12-31')-TO_DAYS(`datenais`)), '%Y')+0))=65 AND IDgrade in(2,3,4,5))) order by nom asc");

				//echo "SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from service where service.IDservice=agent.IDservice) as llservice, (select libelle from genre where genre.IDgenre=agent.IDgenre) as llgenre, (select libelle from grade where grade.IDgrade=agent.IDgrade) as llgrade, (select libelle from lafonction where lafonction.IDlafonction=agent.IDlafonction) as llfonction, (select libelle from contrat where contrat.IDcontrat=agent.IDcontrat) as llcontrat,  (select libelle from civilite where civilite.IDcivilite=agent.IDcivilite) as llcivilite, (select libelle from direction where direction.IDdirection=agent.IDdirection) as lldirection, (select libelle from sousdirection where sousdirection.IDsousdirection=agent.IDsousdirection) as llsousdirection, (DATE_FORMAT(FROM_DAYS(TO_DAYS('$debut-12-31')-TO_DAYS(`datenais`)), '%Y')+0) AS age FROM agent where ((((DATE_FORMAT(FROM_DAYS(TO_DAYS('$debut-12-31')-TO_DAYS(`datenais`)), '%Y')+0))=60 AND IDgrade not in(2,3,4,5)) || (((DATE_FORMAT(FROM_DAYS(TO_DAYS('$debut-12-31')-TO_DAYS(`datenais`)), '%Y')+0))=65 AND IDgrade in(2,3,4,5))) order by nom asc";
			}

			$agent = $query->getResultArray();
			$data = [
				'agent' => $agent,
				'titre' => 'Liste des agents',
				//'toast' =>'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			echo view('espaceadmin/apercustatagentr', $data);
			echo view('templates/espaceadmin/pied');
		}




		///////////////////////////////////////////

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
			//'email'	=> 'required|min_length[1]|max_length[100]',
			'psfp'	=> 'required',
			'pschu'	=> 'required',
			// 'photo' => 'uploaded[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]|max_size[photo,4096]'
		])) {

			//echo view('espaceadmin/'.$contenu, $data);
			//print_r($this->request->getVar());

			$data = [
				'titre' => 'Liste des agents',
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('templates/espaceadmin/entete', $data);
			echo view('templates/espaceadmin/sidebar', $data);
			echo view('templates/espaceadmin/topbar', $data);
			echo view('espaceadmin/creeragent', $data);
			echo view('templates/espaceadmin/pied');
		} else {
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




			$lieu = './agents/' . $this->request->getVar('matricule');
			$file = $this->request->getFile('photo');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
				$newName = "";
			} else {
				//echo " non vide";
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
			}

			/*
			
		
			*/

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
				'motifdisponibilite'	=> $this->request->getVar('motifdisponibilite'),
				'position'	=> $this->request->getVar('position'),
				//'IDsituationmatrimoniale' => $this->request->getVar('IDsituationmatrimoniale'),
			]);




			/*echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');*/


			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagent'));


			//echo view('espaceadmin/listagent');
			//echo view('templates/espaceadmin/pied');
		}
	}


	public function delagent($num)
	{
		$model = new AgentModel();
		//var_dump($model->delete($num));
		//$model->delete($num);
		//echo view('espaceadmin/supprimeragent');
		$model->where('idagent', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/listagent'));
		//$this->index();
		//echo view('espaceadmin/listagent');
	}




	//agent_planpermanance
	public function delagentplanpermanance($num)
	{
		$model = new AgentplanpermananceModel();
		$model->where('idagentplanpermanance', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creeragentplanpermanance'));
	}


	public function delcivilite($num)
	{
		$model = new CiviliteModel();
		$model->where('IDcivilite', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creercivilite'));
	}



	public function delcongeannuel($num)
	{
		$model = new CongeannuelModel();
		$model->where('IDconge', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creercongeannuel'));
		//$this->index();
	}



	public function delposte($num)
	{
		$model = new PosteModel();
		$model->where('IDposte', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerposte'));
		//$this->index();
	}

	public function delposteservice($num)
	{
		$model = new PosteserviceModel();
		$model->where('IDposteservice', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/posteservice'));
		//$this->index();
	}

	public function delpostedirection($num)
	{
		$model = new PostedirectionModel();
		$model->where('IDpostedirection', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/postedirection'));
		//$this->index();
	}


	public function delpostesousdirection($num)
	{
		$model = new PostesousdirectionModel();
		$model->where('IDpostesousdirection', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/postesousdirection'));
	}


	public function delcontrat($num)
	{
		$model = new ContratModel();
		$model->where('IDcontrat', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creercontrat'));
	}


	public function deldirection($num)
	{
		$model = new DirectionModel();
		$model->where('IDdirection', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerdirection'));
	}

	public function delarrettravail($num)
	{
		$model = new ArrettravailModel();
		$model->where('IDarrettravail', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerarrettravail'));
	}


	public function deldroitaccess($num)
	{
		$model = new DroitaccessModel();
		$model->where('IDdroitaccess', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerdroitaccess'));
	}


	public function delemploi($num)
	{
		$model = new EmploiModel();
		$model->where('IDemploi', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creeremploi'));
	}


	public function delgenre($num)
	{
		$model = new GenreModel();
		$model->where('IDgenre', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creergenre'));
	}


	public function delgrade($num)
	{
		$model = new GradeModel();
		$model->where('IDgrade', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creergrade'));
	}


	public function deljourplan($num)
	{
		$model = new JourplanModel();
		$model->where('IDjourplan', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerjourplan'));
	}


	public function dellafonction($num)
	{
		$model = new FonctionModel();
		$model->where('IDlafonction', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerfonction'));
	}


	public function delpermissiondd($num)
	{
		$model = new PermissionddModel();
		$model->where('IDpermission', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
	}


	public function delpermissionhh($num)
	{
		$model = new PermissionhhModel();
		$model->where('IDpermission', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerpermissionhh'));
	}


	public function delplancongeannuel($num)
	{
		$model = new PlancongeannuelModel();
		$model->where('IDplancongeannuel', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerplancongeannuel'));
	}


	public function delplanpermanance($num)
	{
		$model = new PlanpermananceModel();
		$model->where('IDplanpermanance', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerplanpermanance'));
	}


	public function delrole($num)
	{
		$model = new RoleModel();
		$model->where('IDrole', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerrole'));
	}


	public function delroleagent($num)
	{
		$model = new RoleagentModel();
		$model->where('IDroleagent', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerroleagent'));
	}


	public function delservice($num)
	{
		$model = new ServiceModel();
		$model->where('IDservice', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerservice'));
	}


	public function delsituationmatrimoniale($num)
	{
		$model = new SituationModel();
		$model->where('IDsituationmatrimoniale', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creersituationmatrimoniale'));
	}


	public function delsousdirection($num)
	{
		$model = new SousdirectionModel();
		$model->where('IDsousdirection', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creersousdirection'));
	}



	public function delunite($num)
	{
		$model = new UniteModel();
		$model->where('IDunite', $num);
		$model->delete();
		//return redirect()->to(base_url('/espaceadmin/creeunite'));
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerunite'));
	}



	public function creation()
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'matricule' => 'required|min_length[1]|max_length[30]'
		])) {

			//$data='';
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creation', $data);

			//echo view('espaceadmin/apercuagent', $data);

			echo view('templates/espaceadmin/pied');
			//echo view('espaceadmin/creation', ['titre' => 'Creation d\'un nouvel agent']);

		} else {
			$model->save([
				//'id' => 2,
				'matricule'	=> $this->request->getVar('matricule'),
				'nom'	=> $this->request->getVar('nom'),
				'datenais'	=> $this->request->getVar('datenais'),
			]);

			echo view('espaceadmin/reussite');
		}
	}






	/////////////////////////////////////////////////////////////////////////////////////
	///////////////////////// DONNEES DE BASE //////////////////////////////////////
	public function editdirection($m)
	{
		helper('form');
		$model = new DirectionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'liddirection' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !',
			];

			echo view('espaceadmin/creerdirection', $data);
		} else {
			//print_r($this->request->getVar());
			$model->update($this->request->getVar('IDdirection'), [
				'libelle'	=> $this->request->getVar('libelle'),
				'Directeur'	=> $this->request->getVar('Directeur'),
			]);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerdirection'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];
		echo view('espaceadmin/apercudirection', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	public function creerlien($m)
	{
		$m = 1;
		helper('form');
		$model = new UniteModel();
		if (!$this->validate([
			'titreadm' => 'required'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			//print_r($model->errors());
			$data = [
				'lidunite' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !',
			];

			echo view('espaceadmin/creerlien', $data);
		} else {
			$model->update($this->request->getVar('IDunite'), [
				'titreadm'	=> $this->request->getVar('titreadm'),
				'lienadm'	=> $this->request->getVar('lienadm'),
				'titrerespo'	=> $this->request->getVar('titrerespo'),
				'lienrespo'	=> $this->request->getVar('lienrespo'),
				'titreuser'	=> $this->request->getVar('titreuser'),
				'lienuser'	=> $this->request->getVar('lienuser'),
			]);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerlien/1'));
			//print_r($model->errors());	
		}
		//////////////////////////////////////////////////////////
		echo view('templates/espaceadmin/pied', $data);
	}



	public function creerdirection()
	{
		helper('form');
		$model = new DirectionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[3]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerdirection', $data);
		} else {

			//print_r($this->request->getVar());
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'Directeur'	=> $this->request->getVar('Directeur'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerdirection'));
			//echo view('espaceadmin/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];
		echo view('espaceadmin/apercudirection', $data);
		echo view('templates/espaceadmin/pied', $data);
	}



	//////////////////////////////////////////////////////////////////////////////////////////////
	public function creercontrat()
	{
		helper('form');
		$model = new ContratModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creercontrat', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creercontrat'));
			//echo view('espaceadmin/creercontrat', ['titre' => 'Creation d\'un nouvel agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'contrat' => $model->recContrat(),
			'titre' => 'Liste des contrats',
		];
		echo view('espaceadmin/apercucontrat', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	////////////////////////////////////////////////////////////////////////////
	public function creerdroitaccess()
	{
		helper('form');
		$model = new DroitaccessModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerdroitaccess', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerdroitaccess'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'droitaccess' => $model->recDroitaccess(),
			'titre' => 'Liste des droits d\'accès',
		];
		echo view('espaceadmin/apercudroitaccess', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	public function editdroitaccess($m)
	{
		helper('form');
		$model = new DroitaccessModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'liddroit' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !',
			];

			echo view('espaceadmin/creerdroitaccess', $data);
		} else {
			$model->update($this->request->getVar('IDdroitaccess'), [
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerdroitaccess'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'droitaccess' => $model->recDroitaccess(),
			'titre' => 'Liste des droits d\'accès',
		];
		echo view('espaceadmin/apercudroitaccess', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	//////////////////////////////////////////////////////////////////////////////////////
	public function creeremploi()
	{
		helper('form');
		$model = new EmploiModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creeremploi', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creeremploi'));
			//echo view('espaceadmin/creeremploi', ['titre' => 'Creation d\'un nouvel emploi']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'emploi' => $model->recEmploi(),
			'titre' => 'Liste des emplois',
		];
		echo view('espaceadmin/apercuemploi', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	public function editemploi($m)
	{
		helper('form');
		$model = new EmploiModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidemploi' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !',
			];
			echo view('espaceadmin/creeremploi', $data);
		} else {
			$model->update($this->request->getVar('IDemploi'), [
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creeremploi'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'emploi' => $model->recEmploi(),
			'titre' => 'Liste des emplois',
		];
		echo view('espaceadmin/apercuemploi', $data);
		echo view('templates/espaceadmin/pied', $data);
	}






	////////////////////////////////////////////////////////////
	public function creergrade()
	{
		helper('form');
		$model = new GradeModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creergrade', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creergrade'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'grade' => $model->recGrade(),
			'titre' => 'Liste des grades',
		];
		echo view('espaceadmin/apercugrade', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	public function editgrade($m)
	{
		helper('form');
		$model = new GradeModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidgrade' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !',
			];
			echo view('espaceadmin/creergrade', $data);
		} else {
			$model->update($this->request->getVar('IDgrade'), [
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creergrade'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'grade' => $model->recGrade(),
			'titre' => 'Liste des grades',
		];
		echo view('espaceadmin/apercugrade', $data);
		echo view('templates/espaceadmin/pied', $data);
	}



	//////////////////////////////////////////////////////////////////
	public function creerfonction()
	{
		helper('form');
		$model = new FonctionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerfonction', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerfonction'));
			//echo view('espaceadmin/creerfonction', ['titre' => 'Creation d\'une fonction']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'fonction' => $model->recFonction(),
			'titre' => 'Liste des fonctions',
		];
		echo view('espaceadmin/apercufonction', $data);
		echo view('templates/espaceadmin/pied', $data);
	}



	public function editfonction($m)
	{
		helper('form');
		$model = new FonctionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidfonction' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !',
			];
			echo view('espaceadmin/creerfonction', $data);
		} else {
			$model->update($this->request->getVar('IDfonction'), [
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerfonction'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'fonction' => $model->recFonction(),
			'titre' => 'Liste des fonctions',
		];
		echo view('espaceadmin/apercufonction', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	//////////////////////////////////////////////////////////////////////////////
	public function editrole($m)
	{
		helper('form');
		$model = new RoleModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidrole' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !',
			];
			echo view('espaceadmin/creerrole', $data);
		} else {
			$model->update($this->request->getVar('IDrole'), [
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerrole'));
			//echo view('espaceadmin/creerrole', ['titre' => 'Creation d\'un rôle']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'role' => $model->recRole(),
			'titre' => 'Liste des rôles',
		];
		echo view('espaceadmin/apercurole', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	public function creerrole()
	{
		helper('form');
		$model = new RoleModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerrole', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerrole'));
			//echo view('espaceadmin/creerrole', ['titre' => 'Creation d\'un rôle']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'role' => $model->recRole(),
			'titre' => 'Liste des rôles',
		];
		echo view('espaceadmin/apercurole', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	//////////////////////////////////////////////////////////////////////////////////////////////

	public function creerplancongeannuel()
	{
		$genremodel = new PlancongeannuelModel();
		//$data['plancongeannuel'] = $genremodel->recPlancongeannuel();
		helper('form');
		$model = new PlancongeannuelModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'plancongeannuel' => $genremodel->recPlancongeannuel(),
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerplancongeannuel', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'pfin'	=> $this->request->getVar('pfin'),
				'pdebut'	=> $this->request->getVar('pdebut'),
				'publier'	=> $this->request->getVar('publier'),
				'datecreation'	=> date('Y-m-d'),
				'creepar'	=> $_SESSION['cnxname'],
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerplancongeannuel'));
			//echo view('espaceadmin/creerplancongeannuel', $data);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'plancongeannuel' => $model->recPlancongeannuel(),
			'titre' => 'Liste des plancongeannuel',
		];
		echo view('espaceadmin/apercuplancongeannuel', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	public function editplancongeannuel($m)
	{

		helper('form');
		$model = new PlancongeannuelModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidplanca' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'

			];
			echo view('espaceadmin/creerplancongeannuel', $data);
		} else {
			$model->update($this->request->getVar('IDplancongeannuel'), [
				'libelle'	=> $this->request->getVar('libelle'),
				'pfin'	=> $this->request->getVar('pfin'),
				'pdebut'	=> $this->request->getVar('pdebut'),
				'publier'	=> $this->request->getVar('publier'),
				'datecreation'	=> date('Y-m-d'),
				'creepar'	=> $_SESSION['cnxname'],
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerplancongeannuel'));
			//echo view('espaceadmin/creerplancongeannuel', $data);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'plancongeannuel' => $model->recPlancongeannuel(),
			'titre' => 'Liste des plancongeannuel',
		];
		echo view('espaceadmin/apercuplancongeannuel', $data);
		echo view('templates/espaceadmin/pied', $data);
	}



	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function editsousdirection($m)
	{
		helper('form');
		$model = new SousdirectionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'lidsd' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];

			echo view('espaceadmin/creersousdirection', $data);
		} else {
			$model->update($this->request->getVar('IDsousdirection'), [
				'libelle'	=> $this->request->getVar('libelle'),
				'IDdirection'	=> $this->request->getVar('IDdirection'),
				'sousdirecteur'	=> $this->request->getVar('sousdirecteur'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creersousdirection'));
			//echo view('espaceadmin/creersousdirection', ['titre' => 'Creation d\'une Sous-Direction']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'sousdirection' => $model->recSousdirection(),
			'titre' => 'Liste des Sous-Directions',
		];
		echo view('espaceadmin/apercusousdirection', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	public function creersousdirection()
	{
		helper('form');
		$model = new SousdirectionModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creersousdirection', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'IDdirection'	=> $this->request->getVar('IDdirection'),
				'sousdirecteur'	=> $this->request->getVar('sousdirecteur'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creersousdirection'));
			//echo view('espaceadmin/creersousdirection', ['titre' => 'Creation d\'une Sous-Direction']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'sousdirection' => $model->recSousdirection(),
			'titre' => 'Liste des Sous-Directions',
		];
		echo view('espaceadmin/apercusousdirection', $data);
		echo view('templates/espaceadmin/pied', $data);
	}



	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function editservice($m)
	{
		helper('form');
		$model = new ServiceModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'lidservice' => $m,
				'titre' => 'Creation d\'un service',
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];

			echo view('espaceadmin/creerservice', $data);
		} else {
			$model->update($this->request->getVar('IDservice'), [
				//'IDservice'	=> $this->request->getVar('IDservice'),
				'libelle'	=> $this->request->getVar('libelle'),
				'IDsousdirection'	=> $this->request->getVar('IDsousdirection'),
				'chefservice'	=> $this->request->getVar('chefservice'),
				'sus'	=> $this->request->getVar('sus'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerservice'));
			//echo view('espaceadmin/creerservice', ['titre' => 'Creation d\'un service']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'service' => $model->recService(),
			'titre' => 'Liste des services',
		];
		echo view('espaceadmin/apercuservice', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	public function creerservice()
	{

		helper('form');
		$model = new ServiceModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[150]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerservice', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'IDsousdirection'	=> $this->request->getVar('IDsousdirection'),
				'chefservice'	=> $this->request->getVar('chefservice'),
				'sus'	=> $this->request->getVar('sus'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerservice'));
			//echo view('espaceadmin/creerservice', ['titre' => 'Creation d\'un service']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'service' => $model->recService(),
			'titre' => 'Liste des services',
		];
		echo view('espaceadmin/apercuservice', $data);
		echo view('templates/espaceadmin/pied', $data);
	}




	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function creerroleagent()
	{
		helper('form');
		$model = new RoleagentModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerroleagent', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerroleagent'));
			//echo view('espaceadmin/reussite');

			//echo view('espaceadmin/creerroleagent', ['titre' => 'Creation d\'un role-agent']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'roleagent' => $model->recRoleagent(),
			'titre' => 'Liste des role-agent',
		];

		echo view('espaceadmin/apercuroleagent', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	/////////////////////// FIN DONNEES DE BASE //////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////


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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'lidarrettravail' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerarrettravail', $data);
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
				'motifrejet' => $this->request->getVar('motifrejet'),
				//'etat' => 'EN COURS',
			]);
			//echo view('espaceadmin/reussite');

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerarrettravail'));
			//echo view('espaceadmin/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espaceadmin/apercuarrettravail', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'lidarrettravail' => $m,
				'lidarrettravailp' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerarrettravail', $data);
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
			//echo view('espaceadmin/reussite');

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerarrettravail'));
			//echo view('espaceadmin/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espaceadmin/apercuarrettravail', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'lidarrettravail' => $m,
				'lidarrettravailr' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerarrettravail', $data);
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
			//echo view('espaceadmin/reussite');

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerarrettravail'));
			//echo view('espaceadmin/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espaceadmin/apercuarrettravail', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerarrettravail', $data);
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
			//echo view('espaceadmin/reussite');
			//echo $this->request->getVar('datedepart');
			//print_r($model->errors());
			$_SESSION['toast'] = 'Opération réussie !' . $model->errors();
			return redirect()->to(base_url('/espaceadmin/creerarrettravail'));
			//echo view('espaceadmin/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'arrettravail' => $model->recArrettravail(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espaceadmin/apercuarrettravail', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	/////////////////////// DEBUT MODULE PERMISSION //////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////


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

			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');


			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creercongeannuel', $data);
		} else {

			$mask = '+ ' . $this->request->getVar('duree') . ' days';
			$depa = $this->request->getVar('datedepart');
			$dd = date('Y-m-d', strtotime($depa . '' . $mask));
			$d1 = date('Y-m-d', strtotime($depa . '- 21 days'));
			$d2 = date('Y-m-d', strtotime($depa . '- 14 days'));
			$d3 = date('Y-m-d', strtotime($depa . '- 7 days'));

			$data = [
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
				'horspays'	=> $this->request->getVar('hp'),
			];

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
				'horspays'	=> $this->request->getVar('hp'),
			]);



			echo view('espaceadmin/reussite');
			echo $this->request->getVar('datedepart');
			//print_r($model->errors());
			$_SESSION['toast'] = 'Opération réussie ! ';
			return redirect()->to(base_url('/espaceadmin/creercongeannuel'));
			//echo view('espaceadmin/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congeannuel' => $model->recCongeannuel(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espaceadmin/apercucongeannuel', $data);

		echo view('templates/espaceadmin/pied', $data);
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

			if ($agenta->IDdroitaccess == 3) {


				if ($congea->horspays == 1 || $congea->horspays == '1') {
					echo view('/espaceagent/pdfcongecssdhp', $data);
				} else {
					echo view('/espaceagent/pdfcongecssd', $data);
				}
			} else {
				if ($congea->horspays == 1 || $congea->horspays == '1') {
					echo view('/espaceagent/pdfcongecshp', $data);
				} else {
					echo view('/espaceagent/pdfcongecs', $data);
				}
			}
		} else {
			if ($congea->horspays == 1 || $congea->horspays == '1') {
				echo view('/espaceagent/pdfcongepayshp', $data);
			} else {
				echo view('/espaceagent/pdfcongepays', $data);
			}
		}

		/*
		$dompdf = new \Dompdf\Dompdf(); 
		if($row->horspays==0) {
			$dompdf->loadHtml(view('/espaceagent/congeagenthorspays'));
		} else {
			$dompdf->loadHtml(view('/espaceagent/congeagentpays'));
		}
        
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
		
		return redirect()->to(base_url('/espaceagent/creercongeannuel'));	*/
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

			if ($agenta->IDdroitaccess == 3) {


				if ($congea->horspays == 1 || $congea->horspays == '1') {
					echo view('/espaceagent/pdfdecisioncongehorspays', $data);
				} else {
					//echo view('/espaceagent/pdfdecisioncongehorspays',$data);
				}
			} else {
				if ($congea->horspays == 1 || $congea->horspays == '1') {
					echo view('/espaceagent/pdfdecisioncongehorspays', $data);
				} else {
					//	echo view('/espaceagent/pdfdecisioncongehorspays',$data);
				}
			}
		} else {
			if ($congea->horspays == 1 || $congea->horspays == '1') {
				echo view('/espaceagent/pdfdecisioncongehorspaysagent', $data);
			} else {
				//	echo view('/espaceagent/pdfdecisioncongehorspays',$data);
			}
		}

		/*
		$dompdf = new \Dompdf\Dompdf(); 
		if($row->horspays==0) {
			$dompdf->loadHtml(view('/espaceagent/congeagenthorspays'));
		} else {
			$dompdf->loadHtml(view('/espaceagent/congeagentpays'));
		}
        
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
		
		return redirect()->to(base_url('/espaceagent/creercongeannuel'));	*/
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
		echo view('/espaceadmin/permissionddagent');
		/*
		$dompdf = new \Dompdf\Dompdf(); 
		$dompdf->loadHtml(view('/espaceadmin/permissionddagent'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();		
		return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));	*/
	}

	public function pdfpermissionhh($num)
	{
		$db = \Config\Database::connect();
		$sql = "select * from permissionhh WHERE `IDpermission` = '$num'";
		$query   = $db->query($sql);
		$row   = $query->getRow();
		echo view('/espaceadmin/permissionhhagent');
		/*
		$dompdf = new \Dompdf\Dompdf(); 
		$dompdf->loadHtml(view('/espaceadmin/permissionhhagent'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();		
		return redirect()->to(base_url('/espaceadmin/creerpermissionhh'));	*/
	}


	public function pdfretraiteagent($num)
	{
		$db = \Config\Database::connect();


		$sql = 'select *, (select civilite.libelle from civilite where civilite.IDcivilite = agent.IDcivilite) as civilite, (select nom from agent where idagent = agent.Responsablen1) as n1, (select nom from agent where idagent = agent.Responsablen2) as n2, (select emploi.libelle from emploi where emploi.IDemploi = agent.IDemploi) as emploi, (select lafonction.libelle from lafonction where lafonction.IDlafonction = agent.IDlafonction) as fonction, (select service.libelle from service where service.IDservice = agent.IDservice) as service, (select sousdirection.libelle from sousdirection where sousdirection.IDsousdirection = agent.IDsousdirection) as sd from agent WHERE idagent=' . $num;

		$query   = $db->query($sql);
		$agenta   = $query->getRow();

		$data = [
			'leconge' => $congea,
			'lagent' => $agenta,
		];

		echo view('/espaceagent/pdfcertificatretraite', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'lidcongeannuel' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creercongeannuel', $data);
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
				//'etat' => 'ATTENTE DE VALIDATION',
				'alert1' => $d1,
				'alert2' => $d2,
				'alert3' => $d3,
				//'alert1ok' => '0',
				//'alert2ok' => '0',
				//'alert3ok' => '0',
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

			//print_r($model->errors());
			// exit;
			//echo view('espaceadmin/reussite');

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creercongeannuel'));
			//echo view('espaceadmin/creercongeannuel', ['titre' => 'Creation d\'un congé annuel']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congeannuel' => $model->recCongeannuel(),
			'titre' => 'Liste des congés annuel',
		];
		echo view('espaceadmin/apercucongeannuel', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	public function creerposte()
	{
		helper('form');
		$model = new PosteModel();
		if (!$this->validate([
			'IDlafonction' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerposte', $data);
		} else {

			// print_r($model->errors());
			$model->save([
				'IDlafonction' => $this->request->getVar('IDlafonction'),
				'IDemploi' => $this->request->getVar('IDemploi'),
				'Intitule' => $this->request->getVar('Intitule'),
				'details' => $this->request->getVar('details'),
			]);

			// print_r($model->errors());
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerposte'));
		}
		//////////////////////////////////////////////////////////


		echo view('espaceadmin/apercuposte');
		echo view('templates/espaceadmin/pied');
	}

	public function posteservice()
	{
		helper('form');
		$model = new PosteserviceModel();
		if (!$this->validate([
			'IDservice' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/posteservice', $data);
		} else {
			$model->save([
				'IDservice' => $this->request->getVar('IDservice'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'Observations' => $this->request->getVar('Observations'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/posteservice'));
		}
		//////////////////////////////////////////////////////////
		echo view('espaceadmin/apercuposteservice');
		echo view('templates/espaceadmin/pied');
	}



	public function editposteservice($m)
	{
		helper('form');
		$model = new PosteserviceModel();
		if (!$this->validate([
			'IDservice' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidposteservice' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/posteservice', $data);
		} else {
			$model->update($this->request->getVar('IDposteservice'), [
				'IDservice' => $this->request->getVar('IDservice'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'Observations' => $this->request->getVar('Observations'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/posteservice'));
		}
		//////////////////////////////////////////////////////////
		echo view('espaceadmin/apercuposteservice');
		echo view('templates/espaceadmin/pied');
	}

	public function postedirection()
	{
		helper('form');
		$model = new PostedirectionModel();
		if (!$this->validate([
			'IDdirection' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/postedirection', $data);
		} else {
			$model->save([
				'IDdirection' => $this->request->getVar('IDdirection'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'Observations' => $this->request->getVar('Observations'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/postedirection'));
		}
		//////////////////////////////////////////////////////////
		echo view('espaceadmin/apercupostedirection');
		echo view('templates/espaceadmin/pied');
	}


	public function editpostedirection($m)
	{
		helper('form');
		$model = new PostedirectionModel();
		if (!$this->validate([
			'IDdirection' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidpostedirection' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/postedirection', $data);
		} else {
			$model->update($this->request->getVar('IDpostedirection'), [
				'IDdirection' => $this->request->getVar('IDdirection'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'Observations' => $this->request->getVar('Observations'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/postedirection'));
		}
		//////////////////////////////////////////////////////////
		echo view('espaceadmin/apercupostedirection');
		echo view('templates/espaceadmin/pied');
	}



	public function postesousdirection()
	{
		helper('form');
		$model = new PostesousdirectionModel();
		if (!$this->validate([
			'IDsousdirection' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/postesousdirection', $data);
		} else {
			$model->save([
				'IDsousdirection' => $this->request->getVar('IDsousdirection'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'Observations' => $this->request->getVar('Observations'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/postesousdirection'));
		}
		//////////////////////////////////////////////////////////
		echo view('espaceadmin/apercupostesousdirection');
		echo view('templates/espaceadmin/pied');
	}



	public function editpostesousdirection($m)
	{
		helper('form');
		$model = new PostesousdirectionModel();
		if (!$this->validate([
			'IDsousdirection' => 'required',
			'IDposte' => 'required',
			'total' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidpostesousdirection' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/postesousdirection', $data);
		} else {
			$model->update($this->request->getVar('IDpostesousdirection'), [
				'IDsousdirection' => $this->request->getVar('IDsousdirection'),
				'IDposte' => $this->request->getVar('IDposte'),
				'total' => $this->request->getVar('total'),
				'Observations' => $this->request->getVar('Observations'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/postesousdirection'));
		}
		//////////////////////////////////////////////////////////
		echo view('espaceadmin/apercupostesousdirection');
		echo view('templates/espaceadmin/pied');
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creercongematernite', $data);
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
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creercongematernite'));
			//echo view('espaceadmin/creercongematernite', ['titre' => 'Creation d\'un congé de maternité']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congematernite' => $model->recCongematernite(),
			'titre' => 'Liste des congés de maternité',
		];
		echo view('espaceadmin/apercucongematernite', $data);
		echo view('templates/espaceadmin/pied', $data);
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
		if (!empty($_FILES['justificatif1']['name'])) {
			$rule['justificatif1'] = [
				'label' => 'Justificatif',
				'rules' => 'uploaded[justificatif1]'
					. '|mime_in[justificatif1,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
			];
		}
		if (!empty($_FILES['justificatif2']['name'])) {
			$rule['justificatif2'] = [
				'label' => 'Justificatif',
				'rules' => 'uploaded[justificatif2]'
					. '|mime_in[justificatif2,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
			];
		}
		if (!empty($_FILES['justificatif3']['name'])) {
			$rule['justificatif3'] = [
				'label' => 'Justificatif',
				'rules' => 'uploaded[justificatif3]'
					. '|mime_in[justificatif3,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
			];
		}
		if (!$this->validate($rules)) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidcongematernite' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];

			echo view('espaceadmin/creercongematernite', $data);
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
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creercongematernite'));
			//echo view('espaceadmin/creercongematernite', ['titre' => 'Creation d\'un congé de maternité']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'congematernite' => $model->recCongematernite(),
			'titre' => 'Liste des congés de maternité',
		];
		echo view('espaceadmin/apercucongematernite', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	public function delcongematernite($num)
	{
		$model = new CongematerniteModel();
		$model->where('IDconge', $num);
		$model->delete();
		return redirect()->to(base_url('/espaceadmin/creercongematernite'));
	}

	private function creerAgentFolder($agentid)
	{
		$agent_model = new AgentModel();
		$agent = $agent_model->find($agentid);
		//        $db = \Config\Database::connect();
		//        $query = $db->query("SELECT * from agent where IDagent=".$this->request->getVar('Idagent'));
		//        $agent = $query->getRow();
		if (!$agent) {
			return false;
		}
		$path = './agents/' . $agent['matricule'];
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}

		$path = './agents/' . $agent['matricule'] . '/1-IDENTIFICATION';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/2-ENTREE';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/3-CORRESPONDANCES';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/4-CONGES';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/5-MALADIE';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/6-EVALUATION';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/7-MERITES';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/8-SANCTIONS';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		$path = './agents/' . $agent['matricule'] . '/9-SORTI-FIN';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		return $agent;
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
			'justificatif'  => 'required',
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerpermissiondd', $data);
		} else {
			$db = \Config\Database::connect();
			$query = $db->query("SELECT * from agent where IDagent=" . $this->request->getVar('Idagent'));
			$agent = $query->getRow();
			if (!$agent) {
				$_SESSION['toast'] = 'Une erreur est survenue !';
				return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			}
			$path = './agents/' . $agent->matricule;
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $agent->matricule . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$lieu = './agents/' . $agent->matricule . '/4-CONGES';
			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {
				//echo " non vide";
				$newName = date('YmdHis') . 'justificatif' . $agent->matricule . '.' . $file->getClientExtension();
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
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			//echo view('espaceadmin/creerpermissiondd', ['titre' => 'Creation d\'une permissiondd']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissiondd' => $model->recPermissiondd(),
			'titre' => 'Liste des permissiondd',
		];
		echo view('espaceadmin/apercupermissiondd', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidpermissiondd' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerpermissiondd', $data);
		} else {
			$db = \Config\Database::connect();
			$query = $db->query("SELECT * from agent where IDagent=" . $this->request->getVar('Idagent'));
			$agent = $query->getRow();
			if (!$agent) {
				$_SESSION['toast'] = 'Une erreur est survenue !';
				return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			}
			$path = './agents/' . $agent->matricule;
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$path = './agents/' . $agent->matricule . '/1-IDENTIFICATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/2-ENTREE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/3-CORRESPONDANCES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/4-CONGES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/5-MALADIE';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/6-EVALUATION';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/7-MERITES';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/8-SANCTIONS';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$path = './agents/' . $agent->matricule . '/9-SORTI-FIN';
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}



			$lieu = './agents/' . $agent->matricule . '/4-CONGES';
			$file = $this->request->getFile('justificatif');
			//var_dump($file);
			if (empty($file)) {
				//echo "vide";
			} else {

				$permission = $model->find($this->request->getVar('IDpermission'));
				if ($permission && $permission['justificatif']) {
					$old_file = $lieu . '/' . $permission['justificatif'];
					unlink($old_file);
				}
				$newName = date('YmdHis') . 'justificatif' . $agent->matricule . '.' . $file->getClientExtension();
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
				$_SESSION['toast'] = 'Opération réussie !';
				return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			} else {
				print_r($model->errors());
			}





			//echo view('espaceadmin/reussite');
			//$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerpermissiondd'));
			//echo view('espaceadmin/creerpermissiondd', ['titre' => 'Creation d\'une permissiondd']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissiondd' => $model->recPermissiondd(),
			'titre' => 'Liste des permissiondd',
		];
		echo view('espaceadmin/apercupermissiondd', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			// 'justificatif'	 => 'required',
		];

		// if (!empty($_FILES['justificatif']['name'])) {
		// 	$rule['justificatif'] = [
		// 				                'label' => 'Justificatif',
		// 				                'rules' => 'uploaded[justificatif]'
		// 			                    . '|mime_in[justificatif,image/jpg,image/jpeg,image/png,application/pdf,application/vnd.openxmlformats,application/msword]',
		// 					        ];
		// }
		if (!$this->validate($rules)) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerpermissionhh', $data);
		} else {
			$newName = '';
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

			// $file = $this->request->getFile('justificatif');

			// if(empty($file) or empty($_FILES['justificatif']['name'])) {
			// 	//echo "vide";
			// } else {
			// 	//echo " non vide";
			// 	$newName = date('YmdHis').'justificatif'.$_SESSION['mat'].'.'.$file->getClientExtension();
			// 	//echo $newName;

			// 	if (! $file->isValid())
			// 	{ //echo 'ICI';
			// 			throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			// 	} else {
			// 		//echo 'YES';
			// 		if(!$file->hasMoved()) {
			// 			$file->move($lieu, $newName);
			// 			////$file->move(WRITEPATH . 'uploads');
			// 		}
			// 	}
			// }

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
				// 'justificatif' => $newName,
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerpermissionhh'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissionhh' => $model->recPermissionhh(),
			'titre' => 'Liste des permissionhh',
		];
		echo view('espaceadmin/apercupermissionhh', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidpermissionhh' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerpermissionhh', $data);
		} else {
			$newName = '';
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
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerpermissionhh'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'permissionhh' => $model->recPermissionhh(),
			'titre' => 'Liste des permissionhh',
		];
		echo view('espaceadmin/apercupermissionhh', $data);
		echo view('templates/espaceadmin/pied', $data);
	}


	////////////////////////////////////////////////////////////


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

			//echo view('espaceadmin/'.$contenu, $data);
			//print_r($this->request->getVar());


			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/monprofil', $data);
			echo view('templates/espaceadmin/pied');
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



			/*echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');*/
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagent'));
			//echo view('espaceadmin/listagent');
			//echo view('templates/espaceadmin/pied');
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			echo view('espaceadmin/creerdirection', ['titre' => 'Creation d\'un nouvel agent']);
		}
		else
		{
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			echo view('espaceadmin/reussite');
		}
		//////////////////////////////////////////////////////////
		$data = [
			'direction' => $model->recDirection(),
			'titre' => 'Liste des directions',
		];
		echo view('espaceadmin/apercudirection', $data);
		echo view('templates/espaceadmin/pied', $data);
	}
*/

	/////////////////////// FIN MODULE PERMISSION //////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////


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

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/listagent'));
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


		helper('form');
		$model = new AgentModel();

		if (!$this->validate([
			'name' => 'required|min_length[1]|max_length[150]',
			'matricule'	=> 'required|min_length[5]|max_length[10]',
			'datenais'	=> 'required',
			'mobile'	=> 'required|min_length[10]|max_length[14]',
			'psfp'	=> 'required',
			'pschu'	=> 'required'
			//'photo' => 'uploaded[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]|max_size[photo,4096]'
		])) {

			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'idag' => $num,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/ficheagent', $data);
			echo view('templates/espaceadmin/pied');
		} else {
			$ll = ($this->request->getVar('matricule') == '') ? ($this->request->getVar('nom')) : ($this->request->getVar('matricule'));
			$lieu = './agents/' . $ll;
			$file = $this->request->getFile('photo');
			$newName = 'PHOTO' . $this->request->getVar('matricule') . '.' . $file->getClientExtension();


			if (!$file->isValid()) { //echo 'ICI';
				//throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
			} else {
				//echo 'YES';
				if (!$file->hasMoved()) {
					$file->move($lieu, $newName);
					////$file->move(WRITEPATH . 'uploads');
				}
			}

			//print_r($this->request->getVar());
			if ($model->update($this->request->getVar('idagent'), [
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
				'position'	=> $this->request->getVar('position'),
				'motifdisponibilite'	=> $this->request->getVar('motifdisponibilite'),
				//'SaisiPar'	=> '',
				//'SaisiLe'	=> date('Y-m-d'),
				//'ModifiePar'	=> '',
				//'ModifieLe'	=> date("Y-m-d"),
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
				'Photo'	=> $newName,
				//'IDsituationmatrimoniale' => $this->request->getVar('IDsituationmatrimoniale'),
			])) {

				/*
				$path = './agents/'.$this->request->getVar('matricule');
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
				$_SESSION['toast'] = 'Opération réussie !';
				//print_r($model->errors());

				return redirect()->to(base_url('/espaceadmin/listagent'));
			}




			/*echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');*/

			//echo view('espaceadmin/listagent');
			//echo view('templates/espaceadmin/pied');
		}
	}



	public function afficherplanpermanence()
	{
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/afficherplanpermanence');
		echo view('templates/espaceadmin/pied');
	}

	public function afficherplanpermanencerespo()
	{
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/afficherplanpermanencerespo');
		echo view('templates/espaceadmin/pied');
	}

	public function validerchangep()
	{
		helper('form');
		$model = new AgentplanpermanenceModel();
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		$data = [
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('espaceadmin/validercp', $data);
		echo view('templates/espaceadmin/pied');
	}


	public function refusercp($m)
	{
		helper('form');
		$model = new AgentplanpermanenceModel();
		$model->update($m, [
			'changement'	=> 0,
			'justificatif'	=> 'REFUSEE',
		]);
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validerchangep'));
	}

	public function acceptercp($m)
	{
		helper('form');
		$model = new AgentplanpermanenceModel();
		$model->update($m, [
			'changement'	=> 0,
			'justificatif'	=> 'ACCEPTEE',
		]);
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validerchangep'));
	}


	public function validercongeannuel()
	{
		helper('form');
		$model = new CongeannuelModel();
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		$data = [
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('espaceadmin/apercuca', $data);
		echo view('templates/espaceadmin/pied');
	}

	public function validercongematernite()
	{
		helper('form');
		$model = new CongematerniteModel();
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		$data = [
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('espaceadmin/apercucm', $data);
		echo view('templates/espaceadmin/pied');
	}

	public function validerpermissiondd()
	{
		helper('form');
		$model = new PermissionddModel();
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		$data = [
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('espaceadmin/apercupdd', $data);
		echo view('templates/espaceadmin/pied');
	}


	public function validerpermissionhh()
	{
		helper('form');
		$model = new PermissionddModel();
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		$data = [
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('espaceadmin/apercuphh', $data);
		echo view('templates/espaceadmin/pied');
	}

	public function validerca($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');
		$myid = $_SESSION['cnxid'];

		// Fetch congeannuel row
		$congeQuery = $db->table('congeannuel')->getWhere(['IDconge' => $num]);
		$congeRow = $congeQuery->getRow();

		// Fetch agent row
		$agentQuery = $db->table('agent')->getWhere(['idagent' => $congeRow->Idagent]);
		$agentRow = $agentQuery->getRow();

		// Initialize update data
		$updateData = [];

		// Conditions for validation
		if ($myid == $agentRow->idagent) {
			$updateData['validationagent'] = '1';
			$updateData['etat'] = 'VALIDATION AGENT';
		}

		if ($myid == $agentRow->Responsablen1) {
			$etatText = ($congeRow->etat == 'VALIDATION RESPONSABLE N+1 ET N+2') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : (($congeRow->etat == 'VALIDATION RESPONSABLE N+2') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+1');

			$updateData['validationcs'] = '1';
			$updateData['datecs'] = $dd;
			$updateData['etat'] = $etatText;
		}

		if ($myid == $agentRow->Responsablen2) {
			$etatText = ($congeRow->etat == 'VALIDATION RESPONSABLE N+1 ET N+2') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : (($congeRow->etat == 'VALIDATION RESPONSABLE N+1') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+2');

			$updateData['validationsd'] = '1';
			$updateData['datesd'] = $dd;
			$updateData['validationdg'] = '1';
			$updateData['datedg'] = $dd;
			$updateData['etat'] = $etatText;
		}

		if ($myid == $agentRow->Sousdrh || $myid == $_SESSION['sdrh2']) {
			$updateData = [
				'validationcs' => '1',
				'validationagent' => '1',
				'validationsdrh' => '1',
				'validationdg' => '1',
				'validationsd' => '1',
				'datecs' => $dd,
				'datevalidation' => $dd,
				'datesd' => $dd,
				'datesdrh' => $dd,
				'datedg' => $dd,
				'etat' => 'VALIDÉ'
			];
		}

		
		/* echo 'agentRow';
		print_r($agentRow);
		echo 'MY ID';
		print_r($myid);
		echo 'updateData';
		print_r($updateData);
		exit; */
		
	
		// Perform the update only if there's something to update
		if (!empty($updateData)) {
			$builder = $db->table('congeannuel');
			$builder->where('IDconge', $num);
			$builder->update($updateData);
			// Set session and redirect
			$_SESSION['toast'] = 'Opération réussie !';
		} else {
			// Set session and redirect
			$_SESSION['toast'] = "Vous n'y avez pas accès. !";
		}

		
		return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
	}

	/*
	
	public function validerca($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');

		$myid = $_SESSION['cnxid'];
		$query   = $db->query('SELECT * from congeannuel where IDconge=' . $num);
		$row   = $query->getRow();

		$query   = $db->query('SELECT * from agent where idagent=' . $row->Idagent);
		$roww   = $query->getRow();

		$valid = '';
		$myid = $_SESSION['cnxid'];

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
			$valid = "`validationcs` = '1',`validationagent` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ'";
		} else {
			if ($myid == $roww->idagent) {
				//$valid = $valid."`validationagent` = '1', `etat` = 'VALIDATION EN COURS'";
				$valid = "`validationcs` = '1',`validationagent` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datedg` = '$dd', `etat` = 'VALIDATION EN COURS'";
			}
		}

		$sql = "UPDATE `congeannuel` SET $valid WHERE (`IDconge` = '$num')";

        print_r($sql);
		exit;

		if($num != $row->IDagent) {
			$sql = "UPDATE `congeannuel` SET `validationcs` = '1',`validationagent` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";
		} else {
			$sql = "UPDATE `congeannuel` SET `validationcs` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";
		}   

		$query   = $db->query($sql);

		//print_r($sql);
		//exit;

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
	}
	*/

	/*
	
public function validerca($num)
{
    $db = \Config\Database::connect();
    $dd = date('Y-m-d');
    $myid = $_SESSION['cnxid'];

    // Fetch congeannuel row
    $congeQuery = $db->table('congeannuel')->getWhere(['IDconge' => $num]);
    $congeRow = $congeQuery->getRow();

    // Fetch agent row
    $agentQuery = $db->table('agent')->getWhere(['idagent' => $congeRow->Idagent]);
    $agentRow = $agentQuery->getRow();

    // Initialize update data
    $updateData = [];

    // Conditions for validation
    if ($myid == $agentRow->idagent) {
        $updateData['validationagent'] = '1';
        $updateData['etat'] = 'VALIDATION AGENT';
    }

    if ($myid == $agentRow->Responsablen1) {
        $etatText = ($congeRow->etat == 'VALIDATION RESPONSABLE N+1 ET N+2') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 
                    (($congeRow->etat == 'VALIDATION RESPONSABLE N+2') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+1');

        $updateData['validationcs'] = '1';
        $updateData['datecs'] = $dd;
        $updateData['etat'] = $etatText;
    }

    if ($myid == $agentRow->Responsablen2) {
        $etatText = ($congeRow->etat == 'VALIDATION RESPONSABLE N+1 ET N+2') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 
                    (($congeRow->etat == 'VALIDATION RESPONSABLE N+1') ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+2');

        $updateData['validationsd'] = '1';
        $updateData['datesd'] = $dd;
        $updateData['validationdg'] = '1';
        $updateData['datedg'] = $dd;
        $updateData['etat'] = $etatText;
    }

    if ($myid == $agentRow->Sousdrh || $myid == $_SESSION['sdrh2']) {
        $updateData = [
            'validationcs' => '1',
            'validationagent' => '1',
            'validationsdrh' => '1',
            'validationdg' => '1',
            'validationsd' => '1',
            'datecs' => $dd,
            'datevalidation' => $dd,
            'datesd' => $dd,
            'datesdrh' => $dd,
            'datedg' => $dd,
            'etat' => 'VALIDÉ'
        ];
    }

    // Perform the update only if there's something to update
    if (!empty($updateData)) {
        $builder = $db->table('congeannuel');
        $builder->where('IDconge', $num);
        $builder->update($updateData);
    }

    // Set session and redirect
    $_SESSION['toast'] = 'Opération réussie !';
    return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
} */

	/* public function validerca($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');
		$myid = $_SESSION['cnxid'];

		// Fetch congeannuel record
		$congeQuery = $db->table('congeannuel')->where('IDconge', $num)->get();
		$conge = $congeQuery->getRow();

		if (!$conge) {
			$_SESSION['toast'] = 'Congé introuvable';
			return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
		}

		// Fetch agent record
		$agentQuery = $db->table('agent')->where('idagent', $conge->Idagent)->get();
		$agent = $agentQuery->getRow();

		if (!$agent) {
			$_SESSION['toast'] = 'Agent introuvable';
			return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
		}

		$valid = [];
		$etat_text = $conge->etat;

		// Validation logic
		if ($myid == $agent->idagent) {
			$valid['validationagent'] = '1';
			$etat_text = 'VALIDATION AGENT';
		}

		if ($myid == $agent->Responsablen1) {
			$etat_text = $conge->etat == 'VALIDATION RESPONSABLE N+2' ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+1';
			$valid = array_merge($valid, ['validationcs' => '1', 'datecs' => $dd, 'etat' => $etat_text]);
		}

		if ($myid == $agent->Responsablen2) {
			$etat_text = $conge->etat == 'VALIDATION RESPONSABLE N+1' ? 'VALIDATION RESPONSABLE N+1 ET N+2' : 'VALIDATION RESPONSABLE N+2';
			$valid = array_merge($valid, [
				'validationsd' => '1',
				'datesd' => $dd,
				'validationdg' => '1',
				'datedg' => $dd,
				'etat' => $etat_text
			]);
		}

		if ($myid == $agent->Sousdrh || $myid == $_SESSION['sdrh2']) {
			$valid = [
				'validationcs' => '1',
				'validationagent' => '1',
				'validationsdrh' => '1',
				'validationdg' => '1',
				'validationsd' => '1',
				'datecs' => $dd,
				'datevalidation' => $dd,
				'datesd' => $dd,
				'datesdrh' => $dd,
				'datedg' => $dd,
				'etat' => 'VALIDÉ'
			];
		}

		// Update only if there are changes
		if (!empty($valid)) {
			try {
				$db->table('congeannuel')->where('IDconge', $num)->update($valid);
				$_SESSION['toast'] = 'Opération réussie !';
			} catch (\Exception $e) {
				$_SESSION['toast'] = 'Erreur de mise à jour : ' . $e->getMessage();
			}
		} else {
			$_SESSION['toast'] = 'Aucune modification à effectuer.';
		}

		return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
	} */
	public function validercaall($numar_str)
	{
		if (!empty($numar_str)) {
			$numar = explode(',', $numar_str);
			$db = \Config\Database::connect();
			foreach ($numar as $num) {
				// code...
				$dd = date('Y-m-d');

				$myid = $_SESSION['cnxid'];
				$query   = $db->query('SELECT * from congeannuel where IDconge=' . $num);
				$row   = $query->getRow();

				$query   = $db->query('SELECT * from agent where idagent=' . $row->Idagent);
				$roww   = $query->getRow();

				$valid = '';
				$myid = $_SESSION['cnxid'];

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
					$valid = "`validationcs` = '1',`validationagent` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ'";
					/*if($valid=='') {$valid = $valid."`validationsdrh` = '1', `datesdrh` = '$dd', `etat` = 'VALIDÉ'";
						} else {$valid = $valid.",`validationsdrh` = '1', `datesdrh` = '$dd', `etat` = 'VALIDÉ'";
							}*/
				} else {
					if ($myid == $roww->idagent) {
						//$valid = $valid."`validationagent` = '1', `etat` = 'VALIDATION EN COURS'";
						$valid = "`validationcs` = '1',`validationagent` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datedg` = '$dd', `etat` = 'VALIDATION EN COURS'";
					}
				}

				$sql = "UPDATE `congeannuel` SET $valid WHERE (`IDconge` = '$num')";


				/*if($num != $row->IDagent) {
					$sql = "UPDATE `congeannuel` SET `validationcs` = '1',`validationagent` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datevalidation` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";
				} else {
					$sql = "UPDATE `congeannuel` SET `validationcs` = '1', `validationsdrh` = '1', `validationdg` = '1', `validationsd` = '1', `datecs` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datedg` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";
				}*/

				$query   = $db->query($sql);
			}
		}


		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
	}


	public function validercm($num)
	{
		$db = \Config\Database::connect();
		$dd = date('Y-m-d');

		$sql = "UPDATE `congematernite` SET `validationcs` = '1', `validationsus` = '1', `datecs` = '$dd', `datesus` = '$dd', `datevalidation` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDconge` = '$num')";

		$query   = $db->query($sql);

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validercongematernite'));
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

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validercongematernite'));
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

		$sql = "UPDATE `permissiondd` SET $valid WHERE (`IDpermission` = '$num')";
		//        $sql = "UPDATE `permissiondd` SET `validationcs` = '1', `validationsdrh` = '1', `validationsd` = '1', `validationdms` = '1', `validationsus` = '1',  `datecs` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datesus` = '$dd', `datedms` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDpermission` = '$num')";
		$query   = $db->query($sql);

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validerpermissiondd'));
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

				$sql = "UPDATE `permissiondd` SET $valid WHERE (`IDpermission` = '$num')";
				//        $sql = "UPDATE `permissiondd` SET `validationcs` = '1', `validationsdrh` = '1', `validationsd` = '1', `validationdms` = '1', `validationsus` = '1',  `datecs` = '$dd', `datesd` = '$dd', `datesdrh` = '$dd', `datesus` = '$dd', `datedms` = '$dd', `etat` = 'VALIDÉ' WHERE (`IDpermission` = '$num')";
				$query   = $db->query($sql);
			}
		}

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validerpermissiondd'));
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

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validerpermissionhh'));
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

		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/validerpermissionhh'));
	}



	public function rapportcodiposte()
	{

		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/rapportcodiposte');

		echo view('templates/espaceadmin/pied');
	}


	public function apercubesoinservice()
	{
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		echo view('espaceadmin/apercubesoinservice');
		echo view('templates/espaceadmin/pied');
	}
	public function validerbesoinservice($m)
	{
		helper('form');
		$model = new BesoinserviceModel();
		$model->update($m, [
			'etat'	=> 'ACCEPTEE',
			//'justificatif'	=> 'ACCEPTEE',
		]);
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/apercubesoinservice'));
	}

	public function invaliderbesoinservice($m)
	{
		helper('form');
		$model = new BesoinserviceModel();
		$model->update($m, [
			'etat'	=> 'REFUSEE',
			//'justificatif'	=> 'REFUSEE',
		]);
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/apercubesoinservice'));
	}


	public function listagentformation()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/apercuagentformation');

		echo view('templates/espaceadmin/pied', $data);
	}

	public function enformation($m)
	{
		helper('form');
		$model = new EnformationModel();
		if (!$this->validate([
			'datedepart' => 'required',
			//'datereprise' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/enformation', $data);
		} else {
			$model->save([
				'Intitule' => $this->request->getVar('Intitule'),
				'datedepart' => $this->request->getVar('datedepart'),
				//'datereprise' => $this->request->getVar('datereprise'),
				'details' => $this->request->getVar('details'),
				'Idagent' => $this->request->getVar('Idagent'),
			]);


			$db = \Config\Database::connect();
			$dd = $this->request->getVar('datedepart');
			$sql = "UPDATE `agent` SET `enformation` = '1', `dateformation` = '$dd' WHERE (`idagent` = '$m')";
			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentformation'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}


	public function retourformation($m)
	{
		helper('form');
		$model = new EnformationModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'datereprise' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'lidenformation' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/enformation', $data);
		} else {
			$model->update($this->request->getVar('IDenformation'), [
				'Intitule' => $this->request->getVar('Intitule'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $this->request->getVar('datereprise'),
				'daterepriseeffective' => $this->request->getVar('daterepriseeffective'),
				'details' => $this->request->getVar('details'),
				'Idagent' => $this->request->getVar('Idagent'),
			]);

			$db = \Config\Database::connect();
			$dd = $this->request->getVar('datereprise');
			$mm = $this->request->getVar('Idagent');
			$sql = "UPDATE `agent` SET `enformation` = '0', `dateformation` = '$dd' WHERE (`idagent` = '$mm')";
			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentformation'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}


	public function prolongerformation($m)
	{
		helper('form');
		$model = new EnformationModel();
		if (!$this->validate([
			//			'datedepart' => 'required',
			'datereprise' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'lidprolonger' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/enformation', $data);
		} else {
			$model->update($this->request->getVar('IDenformation'), [
				'Intitule' => $this->request->getVar('Intitule'),
				'datedepart' => $this->request->getVar('datedepart'),
				'datereprise' => $this->request->getVar('datereprise'),
				//				'daterepriseeffective' => $this->request->getVar('daterepriseeffective'),
				'details' => $this->request->getVar('details'),
				'Idagent' => $this->request->getVar('Idagent'),
			]);

			//			$db = \Config\Database::connect();
			//		$dd = $this->request->getVar('datereprise');
			//		$mm =$this->request->getVar('Idagent');
			//			$sql = "UPDATE `agent` SET `enformation` = '0', `dateformation` = '$dd' WHERE (`idagent` = '$mm')";
			//		$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentformation'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}



	public function listagentdepartchu()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/apercuagentdepartchu');

		echo view('templates/espaceadmin/pied', $data);
	}



	public function rejetca($m)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidconge' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/rejetca', $data);
		} else {
			$db = \Config\Database::connect();

			$motif = $this->request->getVar('motifrejet');
			$sql = "UPDATE `congeannuel` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDconge` = '$m')";

			//echo $sql;

			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}
	public function rejetcaall($numar_str)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidconge' => $numar_str,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/rejetcaall', $data);
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
			return redirect()->to(base_url('/espaceadmin/validercongeannuel'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}

	public function rejetpdd($m)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidpdd' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/rejetpdd', $data);
		} else {
			$db = \Config\Database::connect();
			$motif = $this->request->getVar('motifrejet');
			$sql = "UPDATE `permissiondd` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDpermission` = '$m')";
			$query = $db->query($sql);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/validerpermissiondd'));
		}
		echo view('templates/espaceadmin/pied');
	}
	public function rejetpddall($numar_str)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidpdd' => $numar_str,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/rejetpddall', $data);
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
			return redirect()->to(base_url('/espaceadmin/validerpermissiondd'));
		}
		echo view('templates/espaceadmin/pied');
	}


	public function rejetphh($m)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidphh' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/rejetphh', $data);
		} else {
			$db = \Config\Database::connect();
			$motif = $this->request->getVar('motifrejet');
			$sql = "UPDATE `permissionhh` SET `etat` = 'REJET', `motifrejet` = '$motif' WHERE (`IDpermission` = '$m')";
			$query = $db->query($sql);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/validerpermissionhh'));
		}
		echo view('templates/espaceadmin/pied');
	}
	public function rejetphhall($numar_str)
	{
		helper('form');
		if (!$this->validate([
			'motifrejet' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidphh' => $numar_str,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/rejetphhall', $data);
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
			return redirect()->to(base_url('/espaceadmin/validerpermissionhh'));
		}
		echo view('templates/espaceadmin/pied');
	}




	public function departchu($m)
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'motif' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'liddepart' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/departchu', $data);
		} else {
			$db = \Config\Database::connect();
			$dd = $this->request->getVar('datedepart');
			$motif = $this->request->getVar('motif');
			$sql = "UPDATE `agent` SET `quitterchu` = '1', `datequitterchu` = '$dd', `motifquitterchu` = '$motif' WHERE (`idagent` = '$m')";
			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentdepartchu'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}

	public function retourchu($m)
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'datedepart' => 'required',
			//'datereprise' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'lidretourchu' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/departchu', $data);
		} else {




			$db = \Config\Database::connect();
			$dd = $this->request->getVar('datedepart');
			$motif = $this->request->getVar('motif');
			$sql = "UPDATE `agent` SET `quitterchu` = '0', `datequitterchu` = '$dd', `motifquitterchu` = '$motif' WHERE (`idagent` = '$m')";
			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentdepartchu'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}


	public function listagentdepartdisponibilite()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);
		//echo view('templates/espaceadmin/entete', $data);
		echo view('espaceadmin/apercuagentdepartdisponibilite');
		echo view('templates/espaceadmin/pied', $data);
	}


	public function departdisponibilite($m)
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'datedepart' => 'required',
			'motif' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'liddepart' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/departdisponibilite', $data);
		} else {
			$db = \Config\Database::connect();
			$dd = $this->request->getVar('datedepart');
			$motif = $this->request->getVar('motif');
			$sql = "UPDATE `agent` SET `disponibilite` = '1', `datedisponibilite` = '$dd', `motifdisponibilite` = '$motif' WHERE (`idagent` = '$m')";
			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentdepartdisponibilite'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}

	public function retourdisponibilite($m)
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'datedepart' => 'required',
			//'datereprise' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'lidretourchu' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/departdisponibilite', $data);
		} else {
			$db = \Config\Database::connect();
			$dd = $this->request->getVar('datedepart');
			$sql = "UPDATE `agent` SET `disponibilite` = '0', `datedisponibilite` = '$dd' WHERE (`idagent` = '$m')";
			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentdepartdisponibilite'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}



	public function listagentdepartretraite()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/apercuagentdepartretraite');

		echo view('templates/espaceadmin/pied', $data);
	}

	public function listagentretraite()
	{
		$model = new AgentModel();
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete', $data);
		echo view('templates/espaceadmin/sidebar', $data);
		echo view('templates/espaceadmin/topbar', $data);

		//echo view('templates/espaceadmin/entete', $data);

		echo view('espaceadmin/apercuagentretraite');

		echo view('templates/espaceadmin/pied', $data);
	}

	public function retourretraite($m)
	{
		$model = new AgentModel();

		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');

		//echo view('templates/espaceadmin/entete', $data);
		$db = \Config\Database::connect();
		$dd = ''; //$this->request->getVar('datedepart');
		$sql = "UPDATE `agent` SET `alaretraite` = '0', `dateretraite` = '$dd' WHERE (`idagent` = '$m')";
		$query   = $db->query($sql);

		$_SESSION['toast'] = 'Opération réussie !';

		echo view('espaceadmin/apercuagentretraite');

		echo view('templates/espaceadmin/pied');
	}



	public function departretraite($m)
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'datedepart' => 'required',
			//'datereprise' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagent' => $m,
				'liddepart' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/departretraite', $data);
		} else {
			$db = \Config\Database::connect();
			$dd = $this->request->getVar('datedepart');
			$sql = "UPDATE `agent` SET `alaretraite` = '1', `dateretraite` = '$dd' WHERE (`idagent` = '$m')";
			$query   = $db->query($sql);

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/listagentdepartretraite'));
		}
		//////////////////////////////////////////////////////////
		//echo view('espaceadmin/apercuenformation');
		echo view('templates/espaceadmin/pied');
	}


	public function addagentequipe($m)
	{
		helper('form');
		$model = new AgentequipeModel();
		if (!$this->validate([
			'IDequipe' => 'required',
			//'IDequipe' => 'required',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidequipe' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creeragentequipe', $data);
		} else {
			foreach ($this->request->getVar('agent') as $ag) {

				$model->save([
					'IDequipe'	=> $this->request->getVar('IDequipe'),
					'Idagent'	=> $ag,
				]);
			}

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/addagentequipe/' . $m));
		}
		//////////////////////////////////////////////////////////

		$db = \Config\Database::connect();
		$query = $db->query("SELECT *, (select libelle from equipe where equipe.IDequipe=agent_equipe.IDequipe) as equipe, (select nom from agent where agent.idagent = agent_equipe.Idagent) as agent from agent_equipe where IDequipe=$m");


		$rr = $query->getResult();

		///print_r($rr);	
		$data = [
			'agentequipe' => $rr,
		];
		echo view('espaceadmin/apercuagentequipe', $data);
		echo view('templates/espaceadmin/pied');
	}

	public function editequipe($m)
	{
		helper('form');
		$model = new EquipeModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidequipe' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerequipe', $data);
		} else {
			$model->update($this->request->getVar('IDgrade'), [
				'libelle'	=> $this->request->getVar('libelle'),
			]);
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerequipe'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'equipe' => $model->recEquipe(),
			'titre' => 'Liste des grades',
		];
		echo view('espaceadmin/apercuequipe', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	public function delequipe($num)
	{
		$model = new EquipeModel();
		$model->where('IDequipe', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/creerequipe'));
		//$this->index();
	}

	public function delagentequipe($num)
	{
		$model = new AgentequipeModel();
		$model->where('IDagentequipe', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		return redirect()->to(base_url('/espaceadmin/addagentequipe/' . $_SESSION['lastid']));
	}

	public function creerequipe()
	{
		helper('form');
		$model = new EquipeModel();
		if (!$this->validate([
			'libelle' => 'required|min_length[1]|max_length[200]',
			'IDservice' => 'required'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerequipe', $data);
		} else {
			$model->save([
				'libelle'	=> $this->request->getVar('libelle'),
				'IDservice'	=> $this->request->getVar('IDservice'),
			]);
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerequipe'));
			//echo view('espaceadmin/creergrade', ['titre' => 'Creation d\'un grade']);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'equipe' => $model->recEquipe(),
			'titre' => 'Liste des grades',
		];
		echo view('espaceadmin/apercuequipe', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidagentplanpermanence' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creeragentplanpermanence', $data);
		} else {
			$model->update($this->request->getVar('idagentplanpermanence'), [
				'IDplanpermanence'	=> $this->request->getVar('IDplanpermanence'),
				'Idagent'	=> $this->request->getVar('Idagent'),
				'IDjourplan'	=> $this->request->getVar('IDjourplan'),
				'changement'	=> $this->request->getVar('changement'),
				'justificatif'	=> $this->request->getVar('justificatif'),
			]);

			//print_r($model->errors());

			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/attribuerplanpermanence'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'agentplanpermanence' => $model->recAgentplanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espaceadmin/apercuagentplanpermanence', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			echo view('espaceadmin/selectplan');
		} else {

			$_SESSION['leplan'] = $this->request->getVar('IDplanpermanence');
			//print_r($this->request->getVar());
			return redirect()->to(base_url('/espaceadmin/attribuerplanpermanence'));
		}
		echo view('templates/espaceadmin/pied');
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creeragentplanpermanence', $data);
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
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/attribuerplanpermanence'));
		}
		//////////////////////////////////////////////////////////
		$data = [
			'agentplanpermanence' => $model->recAgentplanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espaceadmin/apercuagentplanpermanence', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerplanpermanence', $data);
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
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerplanpermanence'));
			//echo view('espaceadmin/creerplancongeannuel', $data);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'planpermanence' => $model->recPlanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espaceadmin/apercuplanpermanence', $data);
		echo view('templates/espaceadmin/pied', $data);
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
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'lidplanpermanence' => $m,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/creerplanpermanence', $data);
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
				'lit'	=> $this->request->getVar('lit'),
				'publier'	=> $this->request->getVar('publier'),
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
			//echo view('espaceadmin/reussite');
			$_SESSION['toast'] = 'Opération réussie !';
			return redirect()->to(base_url('/espaceadmin/creerplanpermanence'));
			//echo view('espaceadmin/creerplancongeannuel', $data);
		}
		//////////////////////////////////////////////////////////
		$data = [
			'planpermanence' => $model->recPlanpermanence(),
			'titre' => 'Liste des planpermanence',
		];
		echo view('espaceadmin/apercuplanpermanence', $data);
		echo view('templates/espaceadmin/pied', $data);
	}

	public function guideadmin()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		echo view('espaceadmin/guideadmin');
		echo view('templates/espaceadmin/pied');
	}

	public function guiderespo()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		echo view('espaceadmin/guiderespo');
		echo view('templates/espaceadmin/pied');
	}


	public function guideuser()
	{
		$data = [
			//'agent' => $model->recAgent(),
			'titre' => 'Liste des agents',
			'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
		];
		echo view('templates/espaceadmin/entete');
		echo view('templates/espaceadmin/sidebar');
		echo view('templates/espaceadmin/topbar');
		echo view('espaceadmin/guideuser');
		echo view('templates/espaceadmin/pied');
	}



	public function selectagent()
	{
		$db = \Config\Database::connect();
		$query   = $db->query("SELECT *, (select libelle from emploi where emploi.IDemploi=agent.IDemploi) as llemploi, (select libelle from service where service.IDservice=agent.IDservice) as llservice FROM agent");
		$agent = $query->getResultArray();


		if (!empty($agent) && is_array($agent)) {
			foreach ($agent as $info) {
				echo ' <option value="' . $info['idagent'] . '">' . $info['matricule'] . '-' . $info['nom'] . '</option>';
			}
		}
	}


	/////////////////////////////////////////////////////////////////////////////////////
	///////////////////////// GESTION DES ACTES /////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////

	public function ajouteracte($num)
	{
		$_SESSION['current'] = $num;
		helper('form');
		$model = new ActeModel();

		if (!$this->validate([
			'titre' => 'required|min_length[1]|max_length[200]'
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');
			$data = [
				'idag' => $num,
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/ficheagent', $data);
		} else {

			$lieu = $this->request->getVar('repertoire');

			if (!empty($lieu)) {
				$lieu = $this->request->getVar('repertoire') . '/';
				$file = $this->request->getFile('acte');
				$newName = $file->getRandomName();
				if (!$file->isValid()) {
					throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
				} else {
					if (!$file->hasMoved()) {
						$file->move($lieu, $newName);

						$cat = explode("/", $this->request->getVar('repertoire'));

						$model->save([
							'titre'	=> $this->request->getVar('titre'),
							'categorie'	=> $cat[2],
							'lien'	=> $lieu . $newName,
							'basename'	=> $newName,
							'idagent'	=> $this->request->getVar('idagent'),
						]);
					}
				}
			}


			return redirect()->to(base_url('/espaceadmin/ficheagent/' . $num));
		}
		echo view('templates/espaceadmin/pied');
	}


	public function delacte($num)
	{
		$db = \Config\Database::connect();
		$query = $db->query('SELECT * from acte where idacte=' . $num);
		$row   = $query->getRow();

		unlink($row->lien);


		$model = new ActeModel();
		$model->where('idacte', $num);
		$model->delete();
		$_SESSION['toast'] = 'Opération réussie !';
		$num = $_SESSION['current'];
		return redirect()->to(base_url('/espaceadmin/ficheagent/' . $num));
	}

	public function changepwd()
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'oldp' => 'required',
			'newp' => 'required|min_length[7]|max_length[100]',
		])) {
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			$data = [
				'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
			];
			echo view('espaceadmin/changepwd', $data);
			//echo view('templates/espaceadmin/pied');
			// return redirect()->to(base_url('espaceadmin/changepwd'));
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
				return redirect()->to(base_url('/espaceadmin/changepwd'));
			} else {
				$data = [
					'toast' => 'Veuillez vérifier les informations que vous éssayez de valider s\'il vous plait !'
				];

				echo view('templates/espaceadmin/entete');
				echo view('templates/espaceadmin/sidebar');
				echo view('templates/espaceadmin/topbar');
				echo view('espaceadmin/changepwd', $data);
			}
		}
		echo view('templates/espaceadmin/pied', $data);
	}

	public function rapports()
	{
		if (isset($_POST['datereprise']) && isset($_POST['datereprise'])) {
			$datereprise = $_POST['datereprise'];
			$dateterme = $_POST['dateterme'];

			$db = \Config\Database::connect();
			$query   = $db->query("SELECT IDconge,Idagent,datevalidation,datedepart,datereprise,daterepriseeffective,duree,etat  FROM congeannuel WHERE datedepart BETWEEN '$dateterme' AND '$datereprise' UNION 
	        	SELECT IDconge,Idagent,datevalidation,datedepart,datereprise,daterepriseeffective,duree,etat FROM congematernite 
	          WHERE datedepart BETWEEN '$dateterme' AND '$datereprise'");

			$reports = $query->getResult();
			$data = ['reports' => $reports,];

			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			echo view('espaceadmin/creerrapports', $data);
			echo view('templates/espaceadmin/pied');
		} else {

			$db = \Config\Database::connect();
			$query   = $db->query("SELECT IDconge,Idagent,datevalidation,datedepart,datereprise,daterepriseeffective,duree,etat  FROM congeannuel WHERE datedepart BETWEEN current_date - interval 30 day AND current_date UNION 
	        	SELECT IDconge,Idagent,datevalidation,datedepart,datereprise,daterepriseeffective,duree,etat FROM congematernite 
	          WHERE datedepart BETWEEN current_date - interval 30 day AND current_date");

			$reports = $query->getResult();

			$data = ['reports' => $reports,];
			echo view('templates/espaceadmin/entete');
			echo view('templates/espaceadmin/sidebar');
			echo view('templates/espaceadmin/topbar');

			echo view('espaceadmin/creerrapports', $data);
			echo view('templates/espaceadmin/pied');
		}
	}
}
