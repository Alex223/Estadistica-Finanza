<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cargo
 *
 * @author nio
 */
class Cargo {
    var $id;
    var $Cargo;
    var $Descripcion;
    function __construct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCargo() {
        return $this->Cargo;
    }

    public function setCargo($Cargo) {
        $this->Cargo = $Cargo;
    }
    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

            

}

?>
