<?php




class Banco {
var $nombre;
var $numeroCuenta;
var $saldo;
var $idTipoMoneda; 

function __construct() {
    
}
public function getNombre() {
    return $this->nombre;
}

public function setNombre($nombre) {
    $this->nombre = $nombre;
}

public function getNumeroCuenta() {
    return $this->numeroCuenta;
}

public function setNumeroCuenta($numeroCuenta) {
    $this->numeroCuenta = $numeroCuenta;
}

public function getSaldo() {
    return $this->saldo;
}

public function setSaldo($saldo) {
    $this->saldo = $saldo;
}

public function getIdTipoMoneda() {
    return $this->idTipoMoneda;
}

public function setIdTipoMoneda($idTipoMoneda) {
    $this->idTipoMoneda = $idTipoMoneda;
}



}

?>
