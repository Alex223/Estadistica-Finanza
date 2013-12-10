<?php


 
class RemesaAduana {

 var $id;
 var $numeroCarpeta;
 var $proveedor;
 var $fechare;
 var $idCarga;
 var $idCargoCif;
 var $idCargoOtro;           
 var $idTipoDerecho;
 var $idCarpetaRelacionada;
 var $totalRemesa;
 
 function __construct() {
     
 }

 public function getId() {
     return $this->id;
 }

 public function setId($id) {
     $this->id = $id;
 }

 public function getNumeroCarpeta() {
     return $this->numeroCarpeta;
 }

 public function setNumeroCarpeta($numeroCarpeta) {
     $this->numeroCarpeta = $numeroCarpeta;
 }

 public function getProveedor() {
     return $this->proveedor;
 }

 public function setProveedor($proveedor) {
     $this->proveedor = $proveedor;
 }

 public function getFechare() {
     return $this->fechare;
 }

 public function setFechare($fechare) {
     $this->fechare = $fechare;
 }

 public function getIdCarga() {
     return $this->idCarga;
 }

 public function setIdCarga($idCarga) {
     $this->idCarga = $idCarga;
 }

 public function getIdCargoCif() {
     return $this->idCargoCif;
 }

 public function setIdCargoCif($idCargoCif) {
     $this->idCargoCif = $idCargoCif;
 }

 public function getIdCargoOtro() {
     return $this->idCargoOtro;
 }

 public function setIdCargoOtro($idCargoOtro) {
     $this->idCargoOtro = $idCargoOtro;
 }

 public function getIdTipoDerecho() {
     return $this->idTipoDerecho;
 }

 public function setIdTipoDerecho($idTipoDerecho) {
     $this->idTipoDerecho = $idTipoDerecho;
 }

 public function getIdCarpetaRelacionada() {
     return $this->idCarpetaRelacionada;
 }

 public function setIdCarpetaRelacionada($idCarpetaRelacionada) {
     $this->idCarpetaRelacionada = $idCarpetaRelacionada;
 }

 public function getTotalRemesa() {
     return $this->totalRemesa;
 }

 public function setTotalRemesa($totalRemesa) {
     $this->totalRemesa = $totalRemesa;
 }


 
}

?>
