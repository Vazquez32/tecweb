<?php

class cabecera{
    private $titulo;
    private $colorfuente;
    private $colorfondo;
    private $ubicacion;

    public function __construct($title, $location='center', $cfont='#FFFFFF', $cback='#000000'){
        $this->titulo = $title;
        $this->ubicacion = $location;
        $this->colorfuente = $cfont;
        $this->colorfondo = $cback;
    }
    
    public function graficar(){
        $estilo = 'font-size: 40px text-align: center'.$this->ubicacion;
        $estilo .= '; color: '.$this->colorfuente;
        $estilo .= '; background-color: '.$this->colorfondo.';';
        echo '<div style="' . $estilo . '">';
        echo '<h4>'.$this->titulo.'</h4>';
        echo '</div>';
    }

}
?>