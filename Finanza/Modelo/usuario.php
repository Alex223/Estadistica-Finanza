<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author nio
 */
class usuario {

    var $RUT;
    var $RUT_DV;
    var $NOMBRE_1;
    var $NOMBRE_2;
    var $AP_PA;
    var $AP_MA;
    var $USER_LOGIN;
    var $PASSWORD;
    var $id_USER;
    VAR $ESTADO;

    function __construct() {
        
    }

    public function getRUT() {
        return $this->RUT;
    }

    public function setRUT($RUT) {
        $this->RUT = $RUT;
    }

    public function getRUT_DV() {
        return $this->RUT_DV;
    }

    public function setRUT_DV($RUT_DV) {
        $this->RUT_DV = $RUT_DV;
    }

    public function getNOMBRE_1() {
        return $this->NOMBRE_1;
    }

    public function setNOMBRE_1($NOMBRE_1) {
        $this->NOMBRE_1 = $NOMBRE_1;
    }

    public function getNOMBRE_2() {
        return $this->NOMBRE_2;
    }

    public function setNOMBRE_2($NOMBRE_2) {
        $this->NOMBRE_2 = $NOMBRE_2;
    }

    public function getAP_PA() {
        return $this->AP_PA;
    }

    public function setAP_PA($AP_PA) {
        $this->AP_PA = $AP_PA;
    }

    public function getAP_MA() {
        return $this->AP_MA;
    }

    public function setAP_MA($AP_MA) {
        $this->AP_MA = $AP_MA;
    }

    public function getUSER_LOGIN() {
        return $this->USER_LOGIN;
    }

    public function setUSER_LOGIN($USER_LOGIN) {
        $this->USER_LOGIN = $USER_LOGIN;
    }

    public function getPASSWORD() {
        return $this->PASSWORD;
    }

    public function setPASSWORD($PASSWORD) {
        $this->PASSWORD = $PASSWORD;
    }

   

    public function getESTADO() {
        return $this->ESTADO;
    }

    public function setESTADO($ESTADO) {
        $this->ESTADO = $ESTADO;
    }
    public function getId_USER() {
        return $this->id_USER;
    }

    public function setId_USER($id_USER) {
        $this->id_USER = $id_USER;
    }



    
}

?>
