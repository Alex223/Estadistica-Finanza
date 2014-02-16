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
$sql_0 = "SELECT * from coberturas";
$sql_1 = "SELECT * from forma_de_pago";
$sql_2 = "SELECT * from banco";
$sql_3 = "SELECT * from tipo_estado_c";
$sql_4 = "SELECT * from tipo_estado_bodega";

$resultado_0 = mysql_query($sql_0);
$resultado_1 = mysql_query($sql_1);
$resultado_2 = mysql_query($sql_2);
$resultado_3 = mysql_query($sql_3);
$resultado_4 = mysql_query($sql_4);

if (mysql_num_rows($resultado_0) == 0  ) {

    $control="2";
}

if( mysql_num_rows($resultado_1) == 0){
    
  $control="3";  
    
}

if(mysql_num_rows($resultadao_2) == 0){
    
  $control="4";  
    
}

if(mysql_num_rows($resultado_3)==0){
    
  $control="5";  
    
}

if(mysql_num_rows($resultado_4) == 0)
{
    
  $control=6;  
    
}
echo $control;

?>
