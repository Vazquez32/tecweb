<?php
class operacion{
    protected $valor1;
    protected $valor2;
    protected $resultado;

    public function __construct($v1=0, $v2=0){
        $this->valor1 = $v1;
        $this->valor2 = $v2;
        $this->resultado = 0;
    }

    public function setvalor1($v1){
        $this->valor1 = $v1;
    }

    public function setvalor2($v2){
        $this->valor2 = $v2;
    }

    public function getresultado(){
        return $this->resultado;
    }
}

    class suma extends operacion {
        public function operar() {
            $this->resultado = $this->valor1 + $this->valor2;
        }
    }

    class resta extends operacion{
        public function operar(){
            $this->resultado = $this->valor1 - $this->valor2;
        }
    }



?>