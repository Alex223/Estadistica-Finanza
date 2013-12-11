<?php



include_once '../../Modelo/Conexion.php';
include_once '../../Modelo/Dolar/Dolar.php';



$conexión = new Conexion();
$conexión->conectar();
$dolar = new Dolar();




if (!$conexión) {


    echo "No pudo conectarse a la BD: " . mysql_error();
    exit;
}

if (!mysql_select_db($conexión->base())) {


    echo "No ha sido posible seleccionar la BD: " . mysql_error();
    exit;
}




$sql_0 = "SELECT ID_TIPO_DOLAR from tipo_dolar where NOMBRETDO='Cobertura'";
$resultado_0 = mysql_query($sql_0);

if (mysql_num_rows($resultado_0) != 0) {


    while ($fila_0 = mysql_fetch_assoc($resultado_0)) {
        $dolar->setIdTipoDolar($fila_0["ID_TIPO_DOLAR"]);
    }

    $sql_1 = "SELECT * from dolar where tipo_dolar_ID_TIPO_DOLAR=".$dolar->getIdTipoDolar();
    $resultado_1 = mysql_query($sql_1);

    while ($fila_1 = mysql_fetch_assoc($resultado_1)) {
        $dolar->setIdDolar($fila_1["ID_DOLAR"]);
        $dolar->setValor($fila_1["VALOR"]);
        $dolar->setIdTipoDolar($fila_0["tipo_dolar_ID_TIPO_DOLAR"]);
        $dolar->setFecha($fila_1["FECHADO"]);
    }
    
} else {
    $dolar->setValor(0) ;
}





 $tablaCobertura ="<table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                                
                                <tr>
                                    <td></td><td colspan='22'>Coberturas de Importación al día</td>
                                </tr> 
                                
                                <tr>
                                     <td>Estado LC</td> 
                                     <td>CTA</td>
                                     <td>En bodega</td>
                                     <td>Carpeta</td>
                                     <td>Banco o Proveedor</td>
                                     <td></td> 
                                     <td>Fecha Venta</td>
                                     <td>Fecha Cobertura</td>
                                     <td>Fecha Flujo</td>
                                     <td>Us$</td>
                                     <td>Al cambio<p>$478,28<P>$481,73</td>
                                     <td>Enero</td> 
                                     <td>Febrero</td> 
                                     <td>Marzo</td>
                                     <td>Abril</td>
                                     <td>Mayo</td>
                                     <td>Junio</td>
                                     <td>Julio</td> 
                                     <td>Agosto</td>
                                     <td>Septiembre</td>
                                     <td>Octubre</td> 
                                     <td>Noviembre</td>
                                     <td>Diciembre</td> 
                                </tr>";


 
 
 
 
if (!$conexión) {


    echo "No pudo conectarse a la BD: " . mysql_error();
    exit;
}

if (!mysql_select_db($conexión->base())) {


    echo "No ha sido posible seleccionar la BD: " . mysql_error();
    exit;
}




$sql = "SELECT * from cobertras";
$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0) {


    
    
    
}


else{
    
    
    while ($fila = mysql_fetch_assoc($resultado)) {
        
    
        
       
        
        
    }

   //final
    
    $tablaCobertura .= "";
    
    
    }
 

                              /*   <tr>
                                     <td>2</td> <td>Chile</td><td>2</td><td>1596</td><td>KENKUO</td><td>7</td>  <td> - </td> <td> - </td> <td>04/07/2013</td><td>110.475,00</td><td>53.218.636</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                                </tr>*/  
   
                           
                                
               






$tablaCobertura .= "</table>"; 
echo $tablaCobertura;
exit;




?>
