<?php


class Cheque {
   
    var $id;
    var $numeroCheque;
    
    function __construct() {
        
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNumeroCheque() {
        return $this->numeroCheque;
    }

    public function setNumeroCheque($numeroCheque) {
        $this->numeroCheque = $numeroCheque;
    }


    
    
}

?>
