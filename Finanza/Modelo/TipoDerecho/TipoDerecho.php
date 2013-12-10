<?php


 
class TipoDerecho {
   var $idTipoDerecho;
   var $NombreTipoDerecho;
   
   function __construct() {
       
   }
   public function getIdTipoDerecho() {
       return $this->idTipoDerecho;
   }

   public function setIdTipoDerecho($idTipoDerecho) {
       $this->idTipoDerecho = $idTipoDerecho;
   }

   public function getNombreTipoDerecho() {
       return $this->NombreTipoDerecho;
   }

   public function setNombreTipoDerecho($NombreTipoDerecho) {
       $this->NombreTipoDerecho = $NombreTipoDerecho;
   }



}

?>
