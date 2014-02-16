<?php


class CargoCif {
  var $idCargoCif;
  var $costoCif;
  var $fleteCif;
  var $primaCif;
  
  function __construct() {
      
  }
  public function getIdCargoCif() {
      return $this->idCargoCif;
  }

  public function setIdCargoCif($idCargoCif) {
      $this->idCargoCif = $idCargoCif;
  }

  public function getCostoCif() {
      return $this->costoCif;
  }

  public function setCostoCif($costoCif) {
      $this->costoCif = $costoCif;
  }

  public function getFleteCif() {
      return $this->fleteCif;
  }

  public function setFleteCif($fleteCif) {
      $this->fleteCif = $fleteCif;
  }

  public function getPrimaCif() {
      return $this->primaCif;
  }

  public function setPrimaCif($primaCif) {
      $this->primaCif = $primaCif;
  }


}

?>
