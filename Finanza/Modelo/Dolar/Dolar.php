<?php


class Dolar {

     var $idDolar;
     var $valor;
     var $idTipoDolar;
     var $fecha;
     function __construct() {
         
     }
     public function getIdDolar() {
         return $this->idDolar;
     }

     public function setIdDolar($idDolar) {
         $this->idDolar = $idDolar;
     }

     public function getValor() {
         return $this->valor;
     }

     public function setValor($valor) {
         $this->valor = $valor;
     }

     public function getIdTipoDolar() {
         return $this->idTipoDolar;
     }

     public function setIdTipoDolar($idTipoDolar) {
         $this->idTipoDolar = $idTipoDolar;
     }

     public function getFecha() {
         return $this->fecha;
     }

     public function setFecha($fecha) {
         $this->fecha = $fecha;
     }



}

?>
