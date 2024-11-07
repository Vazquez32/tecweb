<?php
namespace Ejemplos\POO;

class cabecera{
    private $titulo;
    private $ubicacion;

    public function __construct($title, $location){
        $this->titulo = $title;
        $this->ubicacion = $location;
    }
    
    public function graficar(){
        $estilo = 'font-size: 40px text-align: center'.$this->ubicacion;
        echo '<div style="' . $estilo . '">';
        echo '<h4>'.$this->titulo.'</h4>';
        echo '</div>';
    }

}

class cabecera2{
    private $titulo;
    private $ubicacion;
    private $enlace;

    public function __construct($title, $location, $link){
        $this->titulo = $title;
        $this->ubicacion = $location;
        $this->enlace = $link;
    }
    
    public function graficar(){
        $estilo = 'font-size: 40px text-align: center'.$this->ubicacion;
        echo '<div style="' . $estilo . '">';
        echo '<h4>'.$this->titulo.'</h4>';
        echo '<a href="'.$this->enlace.'">'.$this->titulo.'</a>';
        echo '</div>';
    }

}

?>