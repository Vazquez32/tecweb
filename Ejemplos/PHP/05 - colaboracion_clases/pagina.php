<?php
require_once __DIR__ . '/cabecera.php';
require_once __DIR__ . '/cuerpo.php';
require_once __DIR__ . '/pie.php';


class pagina {
    private $cabecera;
    private $cuerpo;
    private $pie;

    public function __construct($text1, $text2) {
       $this->cabecera = new cabecera($text1);
        $this->cuerpo = new cuerpo();
       $this->pie = new pie($text2);
    }


    public function insertar_cuerpo($text) {
        $this->cuerpo->insertar_parrafo($text);
    }

    public function graficar() {
        $this->cabecera->graficar();
        $this->cuerpo->graficar();
        $this->pie->graficar();
    }


}

?>