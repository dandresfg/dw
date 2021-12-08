<?php

require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf {
    public function __construct(){
        parent::__construct();
    }
}

?>