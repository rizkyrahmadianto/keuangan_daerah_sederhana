<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('assets/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class MyPDF
{
  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }

  public function generate($view, $data = array(), $filename = 'Report', $paper = 'A4', $orientation = 'portrait')
  {
    $html = $this->ci->load->view($view, $data, TRUE);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper($paper, $orientation);

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));
  }
}

/* End of file MyPDF.php */
