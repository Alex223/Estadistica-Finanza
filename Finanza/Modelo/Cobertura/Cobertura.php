<?php

 
class Cobertura {
    
    var $idCobertura;
    var $FECHAFLUJOCO;
    var $ID_REMESAS_ADUANA;
    var $ID_FORMA_PAGO;
    var $ID_BANCO;
    var $ID_TIPO_ESTADO_C;
    var $ID_TIPO_ESTADO_BODEGA;
    var $ID_TRANSACCION ;
    
    function __construct() {
        
    }
    
    public function getID_TIPO_ESTADO_C() {
        return $this->ID_TIPO_ESTADO_C;
    }

    public function setID_TIPO_ESTADO_C($ID_TIPO_ESTADO_C) {
        $this->ID_TIPO_ESTADO_C = $ID_TIPO_ESTADO_C;
    }

        public function getIdCobertura() {
        return $this->idCobertura;
    }

    public function setIdCobertura($idCobertura) {
        $this->idCobertura = $idCobertura;
    }

    public function getFECHAFLUJOCO() {
        return $this->FECHAFLUJOCO;
    }

    public function setFECHAFLUJOCO($FECHAFLUJOCO) {
        $this->FECHAFLUJOCO = $FECHAFLUJOCO;
    }

    public function getID_REMESAS_ADUANA() {
        return $this->ID_REMESAS_ADUANA;
    }

    public function setID_REMESAS_ADUANA($ID_REMESAS_ADUANA) {
        $this->ID_REMESAS_ADUANA = $ID_REMESAS_ADUANA;
    }

    public function getID_FORMA_PAGO() {
        return $this->ID_FORMA_PAGO;
    }

    public function setID_FORMA_PAGO($ID_FORMA_PAGO) {
        $this->ID_FORMA_PAGO = $ID_FORMA_PAGO;
    }

    public function getID_BANCO() {
        return $this->ID_BANCO;
    }

    public function setID_BANCO($ID_BANCO) {
        $this->ID_BANCO = $ID_BANCO;
    }

    

    public function getID_TIPO_ESTADO_BODEGA() {
        return $this->ID_TIPO_ESTADO_BODEGA;
    }

    public function setID_TIPO_ESTADO_BODEGA($ID_TIPO_ESTADO_BODEGA) {
        $this->ID_TIPO_ESTADO_BODEGA = $ID_TIPO_ESTADO_BODEGA;
    }


    public function getID_TRANSACCION() {
        return $this->ID_TRANSACCION;
    }

    public function setID_TRANSACCION($ID_TRANSACCION) {
        $this->ID_TRANSACCION = $ID_TRANSACCION;
    }


    
}

?>
