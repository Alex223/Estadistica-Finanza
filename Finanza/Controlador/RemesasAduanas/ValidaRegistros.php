<?php

include_once '../../Modelo/Conexion.php';
$conexión = new Conexion();
$conexión->conectar();



if (!$conexión) {


    echo "No pudo conectarse a la BD: " . mysql_error();
    exit;
}

if (!mysql_select_db($conexión->base())) {


    echo "No ha sido posible seleccionar la BD: " . mysql_error();
    exit;
}

$control ="1";

$sql_1 = "SELECT * from tipo_derechos";
$sql_2 = "SELECT * from tipo_carga";



$resultado_1 = mysql_query($sql_1);
$resultado_2 = mysql_query($sql_2);


if (mysql_num_rows($resultado_1) == 0) {

    $control="2";
}   

if( mysql_num_rows($resultado_2) == 0){
    
  $control="3";  
    

}

echo $control;

?>

