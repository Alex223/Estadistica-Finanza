<?php



session_start(); 

$nomUsuario=$_SESSION['nom_user']; 
$apeUsuario=$_SESSION['ape_user'];

echo ($nomUsuario." ".$apeUsuario);
?>
