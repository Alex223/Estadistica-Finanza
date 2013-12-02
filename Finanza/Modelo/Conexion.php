<?php


class Conexion {
    function __construct() {
        
    }
    function conectar(){
        
        return mysql_connect("localhost","root","1234");
        
        
    }

    function desconectar($conexion){
        
        return mysql_close($conexion);
        
    }
    function base(){
        $base ="prueba";
        
        return $base;
     }
}
?>
