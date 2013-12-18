<?php



include_once '../../Modelo/Conexion.php';
include_once '../../Modelo/Dolar/Dolar.php';
include_once '../../Modelo/Cobertura/Cobertura.php';
include_once '../../Modelo/RemesaAduana/RemesaAduana.php';
include_once '../../Modelo/FormaDePago/FormaDePago.php';
include_once '../../Modelo/Banco/Banco.php';
include_once '../../Modelo/TipoEstadoCobertura/TipoEstadoCobertura.php';
include_once '../../Modelo/TipoEstadoBodega/TipoEstadoBodega.php';


$conexión = new Conexion();
$conexión->conectar();
$dolar = new Dolar();
$cobertura = new Cobertura();
$remesa_Aduana  = new RemesaAduana();
$formaDePago = new FormaDePago();
$banco = new Banco();
$tipoEstadoCobertura = new TipoEstadoCobertura();
$tipoEstadoBodega = new TipoEstadoBodega();


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
    
   if (mysql_num_rows($resultado_1) != 0) {

    while ($fila_1 = mysql_fetch_assoc($resultado_1)) {
        $dolar->setIdDolar($fila_1["ID_DOLAR"]);
        $dolar->setValor($fila_1["VALOR"]);
        $dolar->setIdTipoDolar($fila_0["tipo_dolar_ID_TIPO_DOLAR"]);
        $dolar->setFecha($fila_1["FECHADO"]);
    }
                                         }
                                         
       else{$dolar->setValor(0) ;}                                  
} else {
    $dolar->setValor(0) ;
}





 $tablaCobertura ="<table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                                
                                <tr>
                                    <td  align='center' style='background-color: darkgray' colspan='24' ><b>Coberturas de Importación al día</b></td>
                                </tr> 
                                
                                <tr>
                                     <td  align='center' style='background-color: darkgray'>Estado LC</td> 
                                     <td  align='center' style='background-color: darkgray'>CTA</td>
                                     <td  align='center' style='background-color: darkgray'>En bodega</td>
                                     <td  align='center' style='background-color: darkgray'>Carpeta</td>
                                     <td  align='center' style='background-color: darkgray'>Banco o Proveedor</td>
                                     <td  align='center' style='background-color: darkgray'></td> 
                                     <td  align='center' style='background-color: darkgray'>Fecha Venta</td>
                                     <td  align='center' style='background-color: darkgray'>Fecha Cobertura</td>
                                     <td  align='center' style='background-color: darkgray'>Fecha Flujo</td>
                                     <td  align='center' style='background-color: darkgray'>Us$</td>
                                     <td  align='center' style='background-color: darkgray'>Al cambio $ ".number_format($dolar->getValor(), 2, ',', '.')." $ ".number_format($dolar->getValor()*1.02, 2, ',', '.')."</td>    
                                     <td  align='center' style='background-color: darkgray'>Enero</td> 
                                     <td  align='center' style='background-color: darkgray'>Febrero</td> 
                                     <td  align='center' style='background-color: darkgray'>Marzo</td>
                                     <td  align='center' style='background-color: darkgray'>Abril</td>
                                     <td  align='center' style='background-color: darkgray'>Mayo</td>
                                     <td  align='center' style='background-color: darkgray'>Junio</td>
                                     <td  align='center' style='background-color: darkgray'>Julio</td> 
                                     <td  align='center' style='background-color: darkgray'>Agosto</td>
                                     <td  align='center' style='background-color: darkgray'>Septiembre</td>
                                     <td  align='center' style='background-color: darkgray'>Octubre</td> 
                                     <td  align='center' style='background-color: darkgray'>Noviembre</td>
                                     <td  align='center' style='background-color: darkgray'>Diciembre</td> 
                                     <td  style='background-color: darkgray'></td>
                                </tr>";


 
                                      
 
 

$sql = "SELECT * from coberturas";
$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0) {

// fin corbertura
    
    
      $tablaCobertura .="<tr>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Carpeta</td>
                                     <td  align='left' style='background-color: darkgray' colspan='2'>Totales $</td>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray' >0</td>
                                     <td  align='center' style='background-color: darkgray'> </td>
                                     <td  align='center' style='background-color: darkgray'>0</td> 
                                     <td  align='center' style='background-color: darkgray'>0</td> 
                                     <td  align='center' style='background-color: darkgray'>0</td>
                                     <td  align='center' style='background-color: darkgray'>0</td>
                                     <td  align='center' style='background-color: darkgray'>0</td>
                                     <td  align='center' style='background-color: darkgray'>0</td>
                                     <td  align='center' style='background-color: darkgray'>0</td> 
                                     <td  align='center' style='background-color: darkgray'>0</td>
                                     <td  align='center' style='background-color: darkgray'>0</td>
                                     <td  align='center' style='background-color: darkgray'>0</td> 
                                     <td  align='center' style='background-color: darkgray'>0</td>
                                     <td  align='center' style='background-color: darkgray'>0</td> 
                                     <td  style='background-color: darkgray'></td>
                                </tr>
                                
                                <tr>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Carpeta</td>
                                     <td  align='left' style='background-color: darkgray' colspan='2'>Totales $</td>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Total US$</td>
                                     <td  align='center' style='background-color: darkgray'> Total al cambio</td>
                                     <td  align='center' style='background-color: darkgray'>Enero</td> 
                                     <td  align='center' style='background-color: darkgray'>Febrero</td> 
                                     <td  align='center' style='background-color: darkgray'>Marzo</td>
                                     <td  align='center' style='background-color: darkgray'>Abril</td>
                                     <td  align='center' style='background-color: darkgray'>Mayo</td>
                                     <td  align='center' style='background-color: darkgray'>Junio</td>
                                     <td  align='center' style='background-color: darkgray'>Julio</td> 
                                     <td  align='center' style='background-color: darkgray'>Agosto</td>
                                     <td  align='center' style='background-color: darkgray'>Septiembre</td>
                                     <td  align='center' style='background-color: darkgray'>Octubre</td> 
                                     <td  align='center' style='background-color: darkgray'>Noviembre</td>
                                     <td  align='center' style='background-color: darkgray'>Diciembre</td> 
                                      <td  style='background-color: darkgray'></td>
                                </tr>";

    
    
    
}


else{
    
    
    while ($fila = mysql_fetch_assoc($resultado)) {
        
        
        $cobertura->setIdCobertura($fila["ID_COBERTURAS"]);
        $cobertura->setFECHAFLUJOCO($fila["FECHAFLUJOCO"]);
        $cobertura->setID_REMESAS_ADUANA($fila["remesa_aduana_ID_REMESAS_ADUANA"]);
        $cobertura->setID_FORMA_PAGO($fila["forma_de_pago_ID_FORMA_PAGO"]);
        $cobertura->setID_BANCO($fila["banco_ID_BANCO"]);
        $cobertura->setID_TIPO_ESTADO_C($fila["tipo_estado_c_ID_TIPO_ESTADO_C"]);
        $cobertura->setID_TIPO_ESTADO_BODEGA($fila["tipo_estado_bodega_ID_TIPO_ESTADO_BODEGA"]);
        
        $sql2 = "SELECT * from remesa_aduana where =".$cobertura->getID_REMESAS_ADUANA();
        
        $resultado2 = mysql_query($sql2);

        if (mysql_num_rows($resultado2) == 0) {echo "Error con registro";}

        while($fila2 = mysql_fetch_assoc($resultado2)){
            
            $remesa_Aduana->setId($fila2["ID_REMESAS_ADUANA"]);
            $remesa_Aduana->setNumeroCarpeta($fila2["NUMEROCARPETARA"]);
            $remesa_Aduana->setProveedor($fila2["PROVEEDORRA"]);
            $remesa_Aduana->setFechare($fila2["FECHARA"]);
            $remesa_Aduana->setIdCarga($fila2["tipo_carga_ID_CARGA"]);
            $remesa_Aduana->setIdCargoCif($fila2["cargo_cif_ID_CARGO_CIF"]);
            $remesa_Aduana->setIdCargoOtro($fila2["cargo_otro_ID_CARGO_OTROS"]);
            $remesa_Aduana->setIdTipoDerecho($fila2["tipo_derechos_ID_TIPO_DERECHOS"]);
            $remesa_Aduana->setIdCarpetaRelacionada($fila2["carpeta_relacionada_ID_CARPETA_RELACIONA"]);
            $remesa_Aduana->setTotalRemesa($fila2["TotalRemesas"]);
               
        }  
        $sql3 = "SELECT * from forma_de_pago where ID_FORMA_PAGO=".$cobertura->getID_FORMA_PAGO();
        $resultado3 = mysql_query($sql3);

        if (mysql_num_rows($resultado3) == 0) {echo "Error con registro";}

        while($fila3 = mysql_fetch_assoc($resultado3)){
        
        $formaDePago->setIdFormaDePago($fila3["ID_FORMA_PAGO"]);
        $formaDePago->setFormaDePago($fila3["NOMBREFP"]);
        
        }
        
        $sql4 = "SELECT * from banco where ID_BANCO=".$cobertura->getID_BANCO();
        $resultado4 = mysql_query($sql4);

        if (mysql_num_rows($resultado4) == 0) {echo "Error con registro";}

        
        
        while($fila4 = mysql_fetch_assoc($resultado4)){
        
        $banco->setId($fila4["ID_BANCO"]);
        $banco->setNombre($fila4["NOMBREBA"]);
        $banco->setNumeroCuenta($fila4["NUMEROCUENTABA"]);
        $banco->setSaldo($fila4["SALDOBA"]);
        $banco->setIdTipoMoneda($fila4["tipo_moneda_ID_TIPO_MONEDA"]);
        
        }
        
         
        $sql5 = "SELECT * from tipo_estado_c where ID_TIPO_ESTADO_C=".$cobertura->getID_TIPO_ESTADO_C();
        $resultado5 = mysql_query($sql5);

        if (mysql_num_rows($resultado5) == 0) {echo "Error con registro";}
  
        while($fila5 = mysql_fetch_assoc($resultado5)){
        
        $tipoEstadoCobertura->setIdTipoEstadoCobertura($fila5["ID_TIPO_ESTADO_C"]); 
        $tipoEstadoCobertura->setTipoEstadoCobertura($fila5["NOMBRETEC"]);
        }
        
          
        $sql6 = "SELECT * from tipo_estado_bodega where ID_TIPO_ESTADO_BODEGA=".$cobertura->getID_TIPO_ESTADO_BODEGA();
        $resultado6 = mysql_query($sql6);

        if (mysql_num_rows($resultado6) == 0) {echo "Error con registro";}
  
        while($fila6 = mysql_fetch_assoc($resultado6)){
        
            $tipoEstadoBodega->setIdTipoEstadoBodega($fila6["ID_TIPO_ESTADO_BODEGA"]);
            $tipoEstadoBodega->setTipoEstadoBodega($fila6["NOMBRETEC"]);
        
        }
                   
        
        
   $tablaCobertura .= "
                                     <td  align='center' style='background-color: darkgray'>".."</td> 
                                     <td  align='center' style='background-color: darkgray'>Carpeta</td>
                                     <td  align='left' style='background-color: darkgray' colspan='2'>Totales $</td>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Total US$</td>
                                     <td  align='center' style='background-color: darkgray'> Total al cambio</td>
                                     <td  align='center' style='background-color: darkgray'>Enero</td> 
                                     <td  align='center' style='background-color: darkgray'>Febrero</td> 
                                     <td  align='center' style='background-color: darkgray'>Marzo</td>
                                     <td  align='center' style='background-color: darkgray'>Abril</td>
                                     <td  align='center' style='background-color: darkgray'>Mayo</td>
                                     <td  align='center' style='background-color: darkgray'>Junio</td>
                                     <td  align='center' style='background-color: darkgray'>Julio</td> 
                                     <td  align='center' style='background-color: darkgray'>Agosto</td>
                                     <td  align='center' style='background-color: darkgray'>Septiembre</td>
                                     <td  align='center' style='background-color: darkgray'>Octubre</td> 
                                     <td  align='center' style='background-color: darkgray'>Noviembre</td>
                                     <td  align='center' style='background-color: darkgray'>Diciembre</td> 
                                     <td  style='background-color: darkgray'></td>       
                                     <td align='center' ><button class='btn btn-default' type='button' onclick=".'"'."EliminaCobertura();".'"'." ><span class='glyphicon glyphicon-minus-sign'></span></button></td> ";
        
     
        
    }

   //final
     $tablaCobertura .="<tr>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Carpeta</td>
                                     <td  align='left' style='background-color: darkgray' colspan='2'>Totales $</td>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Total US$</td>
                                     <td  align='center' style='background-color: darkgray'> Total al cambio</td>
                                     <td  align='center' style='background-color: darkgray'>Enero</td> 
                                     <td  align='center' style='background-color: darkgray'>Febrero</td> 
                                     <td  align='center' style='background-color: darkgray'>Marzo</td>
                                     <td  align='center' style='background-color: darkgray'>Abril</td>
                                     <td  align='center' style='background-color: darkgray'>Mayo</td>
                                     <td  align='center' style='background-color: darkgray'>Junio</td>
                                     <td  align='center' style='background-color: darkgray'>Julio</td> 
                                     <td  align='center' style='background-color: darkgray'>Agosto</td>
                                     <td  align='center' style='background-color: darkgray'>Septiembre</td>
                                     <td  align='center' style='background-color: darkgray'>Octubre</td> 
                                     <td  align='center' style='background-color: darkgray'>Noviembre</td>
                                     <td  align='center' style='background-color: darkgray'>Diciembre</td> 
                                     <td  style='background-color: darkgray'></td>
                                </tr>
                                
                                <tr>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Carpeta</td>
                                     <td  align='left' style='background-color: darkgray' colspan='2'>Totales $</td>
                                     <td  align='center' style='background-color: darkgray' colspan='3' ></td> 
                                     <td  align='center' style='background-color: darkgray'>Total US$</td>
                                     <td  align='center' style='background-color: darkgray'> Total al cambio</td>
                                     <td  align='center' style='background-color: darkgray'>Enero</td> 
                                     <td  align='center' style='background-color: darkgray'>Febrero</td> 
                                     <td  align='center' style='background-color: darkgray'>Marzo</td>
                                     <td  align='center' style='background-color: darkgray'>Abril</td>
                                     <td  align='center' style='background-color: darkgray'>Mayo</td>
                                     <td  align='center' style='background-color: darkgray'>Junio</td>
                                     <td  align='center' style='background-color: darkgray'>Julio</td> 
                                     <td  align='center' style='background-color: darkgray'>Agosto</td>
                                     <td  align='center' style='background-color: darkgray'>Septiembre</td>
                                     <td  align='center' style='background-color: darkgray'>Octubre</td> 
                                     <td  align='center' style='background-color: darkgray'>Noviembre</td>
                                     <td  align='center' style='background-color: darkgray'>Diciembre</td>
                                     <td  style='background-color: darkgray'></td>
                                </tr>";

    
    
    
    }
 




$tablaCobertura .= "
                         <tr id='filaIngreso'>
                          <td></td>
                            <td><button class='btn btn-default' type='button'onclick=" . '"' . "IngresarFilaCobertura();" . '""' . " ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='24 '></td>
                         </tr>    

</table>"; 
echo $tablaCobertura;
exit;




?>
