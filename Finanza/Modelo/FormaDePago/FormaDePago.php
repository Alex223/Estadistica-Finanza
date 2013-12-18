<?php


class FormaDePago {
   
    var $idFormaDePago;
    var $FormaDePago;
    
    function __construct() {
        
    }
    public function getIdFormaDePago() {
        return $this->idFormaDePago;
    }

    public function setIdFormaDePago($idFormaDePago) {
        $this->idFormaDePago = $idFormaDePago;
    }

    public function getFormaDePago() {
        return $this->FormaDePago;
    }

    public function setFormaDePago($FormaDePago) {
        $this->FormaDePago = $FormaDePago;
    }


}

?>
