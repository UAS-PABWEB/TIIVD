<?php
 
 require_once("./vendor/dompdf/autoload.inc.php");
 
 use Dompdf\Dompdf;
class PdfGenerator
{
  public function generate($html,$filename)
  {

// instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }
}