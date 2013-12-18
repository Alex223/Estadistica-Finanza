<?php


class TipoEstadoBodega {
  var $idTipoEstadoBodega;
  var $TipoEstadoBodega;
  function __construct() {
      
  }
  public function getIdTipoEstadoBodega() {
      return $this->idTipoEstadoBodega;
  }

  public function setIdTipoEstadoBodega($idTipoEstadoBodega) {
      $this->idTipoEstadoBodega = $idTipoEstadoBodega;
  }

  public function getTipoEstadoBodega() {
      return $this->TipoEstadoBodega;
  }

  public function setTipoEstadoBodega($TipoEstadoBodega) {
      $this->TipoEstadoBodega = $TipoEstadoBodega;
  }


}

?>
