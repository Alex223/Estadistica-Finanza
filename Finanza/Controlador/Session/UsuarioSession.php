<?php



session_start(); 

if(!isset($_SESSION['nom_user'])){echo "redireccionar"; }
else{
     $nomUsuario=$_SESSION['nom_user']; 
     $apeUsuario=$_SESSION['ape_user'];     
     echo ($nomUsuario." ".$apeUsuario);
    
}


?>
