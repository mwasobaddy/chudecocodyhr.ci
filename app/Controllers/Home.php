<?php

namespace App\Controllers;

use App\Models\AgentModel;
use App\Models\SuperModel;

use CodeIgniter\Controller;

//$session = session();
//$session = \Config\Services::session();
$this->session = \Config\Services::session();
//session_start();
class Home extends BaseController
{
	public function index()
	{
		return view('login');  //ddddd
	}

	/*public function login()
	{
		return view('login');
	}*/

	public function validation()
	{
		return view('validation');
	}

	public function validationsuper()
	{
		return view('validationsuper');
	}

	public function logout()
	{
		session_destroy();
		return view('login');
	}

	public function logoutsuper()
	{
		session_destroy();
		return view('loginsuper');
	}


	public function login()
	{
		helper('form');
		$model = new AgentModel();
		if (!$this->validate([
			'mobile' => 'required|min_length[10]|max_length[14]'
		])) {

			$data = [
				'toast' => 'Echec authentification !',
			];

			echo view('login', $data);
		} else {
			$db = \Config\Database::connect();
			$num = $this->request->getVar('mobile');
			//echo "SELECT * from agent where mobile = '$num'";350209E

			$query = $db->query("SELECT * from agent where matricule = '350209E'");

			$res = $query->getRow();

			$sdrh2 = (isset($res->idagent) ? $res->idagent : '');


			$query = $db->query("SELECT * from agent where mobile = '$num' and actif = 1");
			$results = $query->getResult();

			if (count($results) == 1) {

				$pwd = "";
				$firstc = 1;

				foreach ($results as $row) {

					if ($row->IDgenre == 2 || $row->IDcivilite == 2 || $row->IDcivilite == 3) {
						$genre = 1;
					} else {
						$genre = 0;
					}

					$authotp = '';
					// if(empty($row->pwd)) {
					// 	$firstc = 1;
					// 	$pwd = "";

					// 	$authotp = $this->testsms($num);
					// 	$authotpmd = md5($authotp);
					// 	$query = $db->query("UPDATE agent set pwd='$authotpmd' where mobile = '$num'");
					// 	$_SESSION['toast'] = 'Votre mot de passe par défaut a été envoyé sur votre cellulaire, vous êtes conseillé de le changer. Veuillez utiliser ce mot de passe chaque fois que vous souhaitez accéder au Portail RH.';

					// } else {
					// 	$firstc = 0;
					// 	$pwd = "";

					// 	//$authotp = $this->testsms($num);
					// 	$_SESSION['toast'] = 'Veuillez saisir votre mot de passe pour accéder au Portail RH.';
					// }
					$firstc = 0;
					$pwd = "";
					$_SESSION['toast'] = 'Veuillez saisir votre mot de passe pour accéder au Portail RH.';

					$data = [
						'idd' => $row->IDdroitaccess,
						'cnxname' => $row->nom,
						'cnxid' => $row->idagent,
						'avatar' => $row->matricule,
						'mat' => $row->matricule,
						'genre' => $genre,
						'sdrh2' => $sdrh2,
						'randd' => $authotp,
						'super' => 0,
						'firstc' => $firstc,
					];


					session()->set($data);
				}
			}

			if (count($results) == 1) {

				echo view('validation', $data);
			} else {
				$data = [
					'toast' => 'Votre numéro n\'est pas reconnu par le Portail, veuillez contacter les Ressources Humaines s\'il vous plaît!'
				];
				echo view('login', $data);
			}
		}
	}
	public function loginsuper()
	{
		helper('form');
		$model = new SuperModel();
		if (!$this->validate([
			'mobile' => 'required|min_length[10]|max_length[14]'
		])) {

			$data = [
				'toast' => 'Echec authentification !',
			];

			echo view('loginsuper', $data);
		} else {
			$db = \Config\Database::connect();
			$num = $this->request->getVar('mobile');
			// $query = $db->query("SELECT * from agent where mobile = '$num'");
			$query = $db->query("SELECT * from agent where matricule = '350209E'");
			$res = $query->getRow();
			// print_r($res);
			// exit;
			$sdrh2 = (isset($res->idagent) ? $res->idagent : '');

			//echo "SELECT * from agent where mobile = '$num'";
			$query = $db->query("SELECT * from superadm where mobile = '$num'");

			$results = $query->getResult();
			// print_r($results);

			// exit;

			if (count($results) == 1) {
				$pwd = "";
				$firstc = 1;

				foreach ($results as $row) {

					if ($row->IDgenre == 2 || $row->IDcivilite == 2 || $row->IDcivilite == 3) {
						$genre = 1;
					} else {
						$genre = 0;
					}


					$authotp = '';
					if (empty($row->pwd)) {
						$firstc = 1;
						$pwd = "";

						$authotp = $this->testsms($num);
						$authotpmd = md5($authotp);
						$query = $db->query("UPDATE superadm set pwd='$authotpmd' where mobile = '$num'");
						$_SESSION['toast'] = 'Votre mot de passe par défaut a été envoyé sur votre cellulaire, vous êtes conseillé de le changer. Veuillez utiliser ce mot de passe chaque fois que vous souhaitez accéder au Portail RH.';
					} else {
						$firstc = 0;
						$pwd = "";

						//$authotp = $this->testsms($num);
						$_SESSION['toast'] = 'Veuillez saisir votre mot de passe pour accéder au Portail RH.';
					}


					$data = [
						'idd' => $row->IDdroitaccess,
						'cnxname' => $row->nom,
						'cnxid' => $row->idagent,
						'avatar' => $row->Photo,
						'mat' => $row->matricule,
						'genre' => $genre,
						'sdrh2' => $sdrh2,
						'randd' => $authotp,
						'super' => 1,
					];
					session()->set($data);
				}
			}
			if (count($results) == 1) {

				echo view('validationsuper', $data);
			} else {
				$data = [
					'toast' => 'Votre numéro n\'est pas reconnu par le portail, veuillez contacter les Ressources Humaines s\'il vous plaît!'
				];

				echo view('loginsuper', $data);
			}
		}
	}





	public function checking()
	{
		helper('form');
		$model = new AgentModel();

		if (!$this->validate([
			'code' => 'required|min_length[4]|max_length[15]',
		])) {
			$data = [
				'iddd' => $this->request->getVar('iddd'),
				'toast' => 'Echec authentification !',
			];
			echo view('validation', $data);
		} else {

			$pp = $this->request->getVar('code');
			$pdp = md5($pp);

			$lid = $_SESSION['cnxid'];

			$db = \Config\Database::connect();
			$query = $db->query("SELECT * from agent where idagent = $lid and pwd='$pdp'");
			//echo "SELECT * from agent where idagent = $lid and pwd='$pdp'";
			$results = $query->getResult();
			//var_dump($pp);
			if (count($results) == 1) {
				/*$db = \Config\Database::connect();
				$num = $this->request->getVar('mobile');
				$query = $db->query("SELECT * from agent where mobile = '$num'");
				$results = $query->getResult();
				if(count($results)==1) {
					echo view('espaceadmin/index');
				} else {
					echo view('login');
				}*/


				switch ($this->request->getVar('iddd')) {
					case 1:
						return redirect()->to(base_url('//espaceagent/index'));
						break;
					case 2:
						return redirect()->to(base_url('//espacerespo/afficher/accueil'));
						break;
					case 3:
						return redirect()->to(base_url('//espaceadmin/afficher/accueil'));
						break;
					case 4:
						return redirect()->to(base_url('//espacesuperadmin/afficher/accueil'));
						break;
				}

				//echo view('espaceadmin');
				//header('Location: '.base_url('/espaceadmin/afficher/accueil'));
				//header(base_url('/espaceadmin/afficher/accueil'));
			} else {
				$data = [
					'iddd' => $this->request->getVar('iddd'),
					'toast' => 'Echec authentification !',
				];
				echo view('validation', $data);
			}
		}
	}


	public function checkingsuper()
	{
		//print_r($_SESSION);
		helper('form');
		$model = new SuperModel();
		if (!$this->validate([
			'code' => 'required|min_length[4]|max_length[15]',
		])) {
			$data = [
				'iddd' => $this->request->getVar('iddd'),
				'toast' => 'Echec authentification!',
			];

			echo view('validationsuper', $data);
		} else {

			$pp = $this->request->getVar('code');

			$num = $_SESSION['cnxid'];
			$pdp = md5($pp);
			$db = \Config\Database::connect();
			$query = $db->query("SELECT * from superadm where idagent = '$num' and pwd='$pdp'");
			//echo "SELECT * from agent where idagent = '$num' and pwd='$pp'";
			$results = $query->getResult();


			/*
			var_dump($results);
			var_dump($num);
			var_dump($pp);
			var_dump($pdp);
			exit;
			*/

			if (count($results) == 1) {
				/*$db = \Config\Database::connect();
				$num = $this->request->getVar('mobile');
				$query = $db->query("SELECT * from agent where mobile = '$num'");
				$results = $query->getResult();
				if(count($results)==1) {
					echo view('espaceadmin/index');
				} else {
					echo view('login');
				}*/
				return redirect()->to(base_url('//espaceadmin/afficher/accueil'));

				//echo view('espaceadmin');
				//header('Location: '.base_url('/espaceadmin/afficher/accueil'));
				//header(base_url('/espaceadmin/afficher/accueil'));
			} else {
				echo view('validationsuper');
			}
		}
	}



	public function testsms($num)
	{
		$mobileNumber = $num;

		// $OTP = random_int(100000, 99999999);
		$OTP = substr(strtoupper(uniqid()), 3, 7);
		$API_KEY = '3909AWt7Uff865d8b0ec1';
		$SENDER_ID = "PRHCHU";
		$ROUTE_NO = 4;
		$RESPONSE_TYPE = 'json';
		$isError = 0;
		$errorMessage = true;
		//Your message to send, Adding URL encoding.

		$message = urlencode("PRHCHU. Votre mot de passe par défaut pour accéder au Portail RH est : $OTP. Vous êtes conseillé de le changer plus tard.");
		//Preparing post parameters

		echo 'ici';
		$postData = array(
			'authkey' => $API_KEY,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $SENDER_ID,
			'route' => $ROUTE_NO,
			'response' => $RESPONSE_TYPE
		);
		$url = "http://world.msg91.com/api/sendhttp.php";
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
		));
		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//get response
		$output = curl_exec($ch);
		//return $output;   
		//Print error if any
		if (curl_errno($ch)) {
			$isError = true;
			$errorMessage = curl_error($ch);
		}

		curl_close($ch);

		return $OTP;
	}

	public function initpass()
	{
		$db = \Config\Database::connect();
		$lidd = $_SESSION['cnxid'];
		$query = $db->query("SELECT * from agent where idagent = '$lidd'");
		$row = $query->getRow();
		$num = $row->mobile;
		$authotp = $this->testsms($num);
		$authotpmd = md5($authotp);
		$query = $db->query("UPDATE agent set pwd='$authotpmd' where idagent = '$lidd'");
		$_SESSION['toast'] = 'Un nouveau mot de passe par défaut a été envoyé sur votre cellulaire, veuillez l\'utiliser pour accéder au portail RH.';
		echo view('login');
	}


	public function initpasssuper()
	{
		$db = \Config\Database::connect();
		$lidd = $_SESSION['cnxid'];
		$query = $db->query("SELECT * from superadm where idagent = '$lidd'");
		$row = $query->getRow();
		$num = $row->mobile;
		$authotp = $this->testsms($num);
		$authotpmd = md5($authotp);
		$query = $db->query("UPDATE superadm set pwd='$authotpmd' where idagent = '$lidd'");
		$_SESSION['toast'] = 'Un nouveau mot de passe par défaut a été envoyé sur votre cellulaire, veuillez l\'utiliser pour accéder au Portail RH.';
		echo view('login');
	}
}
