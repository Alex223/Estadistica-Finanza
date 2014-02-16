<?php


class CarpetaRelacionada {
   var $idCarpeta;
   var $numeroCarpeta;
   
   function __construct() {
       
   }
   public function getIdCarpeta() {
       return $this->idCarpeta;
   }

   public function setIdCarpeta($idCarpeta) {
       $this->idCarpeta = $idCarpeta;
   }

   public function getNumeroCarpeta() {
       return $this->numeroCarpeta;
   }

   public function setNumeroCarpeta($numeroCarpeta) {
       $this->numeroCarpeta = $numeroCarpeta;
   }



    
    
}

?>
