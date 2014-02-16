<?php


class CajaSeleccion {
   
   var $idSelect;
   var $nombreSelect;
   
   function __construct() {
       
   }

   public function getIdSelect() {
       return $this->idSelect;
   }

   public function setIdSelect($idSelect) {
       $this->idSelect = $idSelect;
   }

   public function getNombreSelect() {
       return $this->nombreSelect;
   }

   public function setNombreSelect($nombreSelect) {
       $this->nombreSelect = $nombreSelect;
   }


}

?>
