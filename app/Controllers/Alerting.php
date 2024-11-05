<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class Alerting extends Controller
{

    public function index() 
	{
       // return view('/PdfController/pdf_view');
	   return view('/pdfcontroller/pdf_view');
	  // echo "ici";
    }
	
	 public function pdf_view() 
	{
       return view('/Alerting/pdf_view');
	   //echo "ici";
    }
	
	public function afficher($contenu)
	{
		if ( ! is_file(APPPATH.'/Views/pdfcontroller/'.$contenu.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
		}
		$data['titre'] = ucfirst($contenu);     // Capitalize the first letter
		$data['contenu'] = $contenu;
		//echo view('templates/espaceagent/pagecontent', $data);
		echo view('/Alerting/'.$contenu, $data);

	}
	

    public function alertesms($num, $msg, $sender)
	{
		$model = new AlertModel();
		$model->where('idagent', $num);
		$model->delete();
		return redirect()->to(base_url('espaceadmin/listagent'));
	}
	
	
	 public function alertemail($destmail, $msg, $srcmail)
	{
		$model = new AlertModel();
		$model->where('idagent', $num);
		$model->delete();
		return redirect()->to(base_url('espaceadmin/listagent'));
	}
	
	 public function alertecongeannuel()
	{
		$model = new AlertModel();
		$model->where('idagent', $num);
		$model->delete();
		return redirect()->to(base_url('espaceadmin/listagent'));
	}
	
	

}