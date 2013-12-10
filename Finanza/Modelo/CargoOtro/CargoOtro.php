<?php

class CargoOtro {
   
    var $idCargoOtro;
    var $margen;
    var $otro;
    
    function __construct() {
        
    }

    public function getIdCargoOtro() {
        return $this->idCargoOtro;
    }

    public function setIdCargoOtro($idCargoOtro) {
        $this->idCargoOtro = $idCargoOtro;
    }

    public function getMargen() {
        return $this->margen;
    }

    public function setMargen($margen) {
        $this->margen = $margen;
    }

    public function getOtro() {
        return $this->otro;
    }

    public function setOtro($otro) {
        $this->otro = $otro;
    }


}

?>
