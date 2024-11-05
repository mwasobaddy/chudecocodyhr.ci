<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class PdfController extends Controller
{

    public function index() 
	{
       // return view('/PdfController/pdf_view');
	   return view('/pdfcontroller/pdf_view');
	  // echo "ici";
    }
	
	 public function pdf_view() 
	{
       return view('/pdfcontroller/pdf_view');
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
		echo view('/pdfcontroller/'.$contenu, $data);

	}
	




    function htmlToPDF(){
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('/pdfcontroller/pdf_view'));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }

}