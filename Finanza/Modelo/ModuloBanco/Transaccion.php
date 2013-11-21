<?php


class Transaccion {
 
  var $id;
  var $MontoT;
  var $DetalleT;
  var $FechaT;
  var $IdBanco;
  var $IdTipoMoneda;
  var $IdTipoTrasaccion;
  function __construct() {
      
  }

  
  public function getId() {
      return $this->id;
  }

  public function setId($id) {
      $this->id = $id;
  }

  public function getMontoT() {
      return $this->MontoT;
  }

  public function setMontoT($MontoT) {
      $this->MontoT = $MontoT;
  }

  public function getDetalleT() {
      return $this->DetalleT;
  }

  public function setDetalleT($DetalleT) {
      $this->DetalleT = $DetalleT;
  }

  public function getFechaT() {
      return $this->FechaT;
  }

  public function setFechaT($FechaT) {
      $this->FechaT = $FechaT;
  }

  public function getIdBanco() {
      return $this->IdBanco;
  }

  public function setIdBanco($IdBanco) {
      $this->IdBanco = $IdBanco;
  }

  public function getIdTipoMoneda() {
      return $this->IdTipoMoneda;
  }

  public function setIdTipoMoneda($IdTipoMoneda) {
      $this->IdTipoMoneda = $IdTipoMoneda;
  }

  public function getIdTipoTrasaccion() {
      return $this->IdTipoTrasaccion;
  }

  public function setIdTipoTrasaccion($IdTipoTrasaccion) {
      $this->IdTipoTrasaccion = $IdTipoTrasaccion;
  }


    
}

?>
