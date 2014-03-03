<?php

include_once '../../Modelo/Conexion.php';
include_once '../../Modelo/RemesaAduana/RemesaAduana.php';
include_once '../../Modelo/CargoCIF/CargoCif.php';
include_once '../../Modelo/TipoDerecho/TipoDerecho.php';
include_once '../../Modelo/Dolar/Dolar.php';
include_once '../../Modelo/CargoOtro/CargoOtro.php';

$conexión = new Conexion();
$conexión->conectar();
$remesa1 = new RemesaAduana();
$cargoCif = new CargoCif();
$tipoDerecho = new TipoDerecho();
$dolar = new Dolar();
$CargoOtro = new CargoOtro();


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






$dolar_aduna = number_format($dolar->getValor(), 2, ',','.');






$TABLA1 = "<table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                                
                                <tr>
                                  <!--Primera Fila Tabla -->   
                                     <td align='center' style='background-color: darkgray' colspan='13'>Gastos de Internación</td>
                                     <td align='center' style='background-color: darkgray' colspan='13'>Mesiva</td>

                                </tr> 
                                <!--Segunda Fila Tabla -->
                                 <tr>
                                     
                                     <td align='center' style='background-color: darkgray'>Carperta</td>
                                     <td align='center' style='background-color: darkgray'>Proveedor</td> 
                                     <td align='center' style='background-color: darkgray'>Cif </td>
                                     <td align='cent    er' style='background-color: darkgray'>Estado Bodega</td>
                                     <td align='center' style='background-color: darkgray'>6%</td>
                                     <td align='center' style='background-color: darkgray'>19%</td>
                                     <td align='center' style='background-color: darkgray'>Total</td>
                                     <td align='center' style='background-color: darkgray'>0,30%</td> 
                                     <td align='center' style='background-color: darkgray'>Dolar Aduana(".$dolar_aduna.")</td>
                                     <td align='center' style='background-color: darkgray'>Otro $</td>
                                     <td align='center' style='background-color: yellow'>Total Remesa</td>
                                     <td align='center' style='background-color: darkgray'>Fecha Pago</td>
                                     <td align='center' style='background-color: darkgray'>Enero</td>
                                     <td align='center' style='background-color: darkgray'>Febrero</td>
                                     <td align='center' style='background-color: darkgray'>Marzo</td>
                                     <td align='center' style='background-color: darkgray'>Abril</td>
                                     <td align='center' style='background-color: darkgray'>Mayo</td>
                                     <td align='center' style='background-color: darkgray'>Junio</td>
                                     <td align='center' style='background-color: darkgray'>Julio</td>
                                     <td align='center' style='background-color: darkgray'>Agosto</td>
                                     <td align='center' style='background-color: darkgray'>Septiembre</td>
                                     <td align='center' style='background-color: darkgray'>Octubre</td>
                                     <td align='center' style='background-color: darkgray'>Noviembre</td>
                                     <td align='center' style='background-color: darkgray'>Diciembre</td>
                                     <td colspan='2' align='center' ></td>
                                 </tr> ";




$sqlZ = "SELECT * FROM remesa_aduana";


$resultadoZ = mysql_query($sqlZ);


if (!$resultadoZ) {
    echo "No se pudo ejecutar con exito la consulta ($sqlZ) en la BD: " . mysql_error();

    exit;
}


if (mysql_num_rows($resultadoZ) == 0) {

    $TABLA1 .="
                                 <tr>
                                   
                                      
                                     <td style='background-color: darkgray'>Total Internación</td> 
                                     <td style='background-color: darkgray' colspan='4'></td> 
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td colspan='2'></td> 
                               </tr>
                               

        <tr>
                                     
                                     <td>Comprobación IVA</td>
                                     <td colspan='4'></td> 
                                     <td style='color:red'>0</td>
                                     <td></td>
                                     <td style='color:red'>0</td>
                                     <td></td>
                                     <td style='color:red'>0</td>
                                     <td style='background-color: darkgray; color:red'>0</td>
                                     <td colspan='15'></td>  
                               </tr>

        <tr>
                                   
                                     <td colspan='10'></td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td colspan='15'></td>
                                    
                                     
                               </tr>



                                <tr>
                                    
                                     <td colspan='10'></td>
                                     <td style='background-color: darkgray; color:red'> 0 </td>
                                     <td colspan='15'></td>
                                    
                               </tr>
      
                          <tr id='filaIngreso'>
                          
                         <td><button class='btn btn-default btn-sm' type='button'onclick=" . '"' . "IngresarFilaRemesa();" . '""' . " ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='25 '></td>
                         </tr>";
    echo ($TABLA1);
    exit;
} else {

        $TotalCosto19 = 0;
        $TotalCosto030 = 0;
        $TotalcarOtro = 0;
        $TotalRemesaFila = 0;
        
        
        $TotalMesEnero=0;
        $TotalMesFebrero=0;
        $TotalMesMarzo=0;
        $TotalMesAbril=0;
        $TotalMesMayo=0;
        $TotalMesJunio=0;
        $TotalMesJulio=0;
        $TotalMesAgosto=0;
        $TotalMesSeptiembre=0;
        $TotalMesOctubre=0;
        $TotalMesNoviembre=0;
        $TotalMesDiciembre=0.0;
        $indice = 0;
    
    while ($filaZ = mysql_fetch_assoc($resultadoZ)) {

        
        
        $remesa1->setId($filaZ["ID_REMESAS_ADUANA"]);  
        $remesa1->setNumeroCarpeta($filaZ["NUMEROCARPETARA"]);
        $remesa1->setProveedor($filaZ["PROVEEDORRA"]);
        $remesa1->setIdCarga($filaZ["tipo_carga_ID_CARGA"]);
        $remesa1->setIdCargoCif($filaZ["cargo_cif_ID_CARGO_CIF"]);
        $remesa1->setIdCargoOtro($filaZ["cargo_otro_ID_CARGO_OTROS"]);
        $remesa1->setIdTipoDerecho($filaZ["tipo_derechos_ID_TIPO_DERECHOS"]);
        $remesa1->setTotalRemesa($filaZ["carpeta_relacionada_ID_CARPETA_RELACIONA"]);
        $remesa1->setFechare($filaZ["FECHARA"]);


        $sql_a = "SELECT COSTOCIF,FLETECIF,PRIMACIF from cargo_cif where ID_CARGO_CIF=" . $remesa1->getIdCargoCif();
        $resultado_a = mysql_query($sql_a);

        while ($filay = mysql_fetch_assoc($resultado_a)) {
            $cargoCif->setCostoCif($filay["COSTOCIF"]);
            $cargoCif->setFleteCif($filay["FLETECIF"]);
            $cargoCif->setPrimaCif($filay["PRIMACIF"]);
        }


        $CostoCif = floatval($cargoCif->getCostoCif()) + floatval($cargoCif->getFleteCif()) + floatval($cargoCif->getPrimaCif());

        
        
        
        //tipo Derechos

        $sql_b = "SELECT NOMBRETDE from tipo_derechos where ID_TIPO_DERECHOS=" . $remesa1->getIdTipoDerecho();
        $resultado_b = mysql_query($sql_b);

        while ($filax = mysql_fetch_assoc($resultado_b)) {
            $tipoDerecho->setNombreTipoDerecho($filax["NOMBRETDE"]);
        }
       

        if ($tipoDerecho->getNombreTipoDerecho() == "6") {
            $Costo6 =  $CostoCif * 0.6;
        } else {
            $Costo6 =  0;
        }

        
         
        
        
        $Costo19 = $CostoCif * 0.19;

        $TotalCosto =  $Costo6 + $Costo19; 

        $Costo030 = $CostoCif * 0.003;

        $Costo_Dolar = $dolar->getValor()*$TotalCosto+$Costo030;
         
        ///****************************************************
        
        //id cargo otros
       
        $sql_c = "SELECT MARGEN_CO from cargo_otro where ID_CARGO_OTROS=" .$remesa1->getIdCargoOtro();
        $resultado_c = mysql_query($sql_c);

        while ($filaw = mysql_fetch_assoc($resultado_c)) {
            $CargoOtro->setMargen($filaw["MARGEN_CO"]);
        }
        
        
        $carOtro = $CargoOtro->getMargen();
        
        $TotalRemesa = $Costo_Dolar + $carOtro;
        
        
         
        
        //parsear datos por meses
        
        
        
       // $dato +=0.1;
      
        
      
       
     //  echo ($dato." / ");
        
        $datoMes = $Costo19*$dolar_aduna + $Costo030*0.15966387*$dolar_aduna + $carOtro*0.15966387;
        
        
        
        
        
        
        if( substr($remesa1->getFechare(),-5,2) == "1"){$MesEnero = $datoMes; }
        else{$MesEnero = 0;}
        
        if( substr($remesa1->getFechare(),-5,2) == "2"){$MesFebrero = $datoMes; }
        else{$MesFebrero = 0 ;}
        
        if( substr($remesa1->getFechare(),-5,2) == "3"){$MesMarzo = $datoMes; }
        else{$MesMarzo = 0;}
        
        if( substr($remesa1->getFechare(),-5,2) == "4"){$MesAbril =$datoMes; }
        else{$MesAbril = 0 ;}
        
        if( substr($remesa1->getFechare(),-5,2) == "5"){$MesMayo = datoMes ; }
        else{$MesMayo = 0;}
        
        if( substr($remesa1->getFechare(),-5,2) == "6"){$MesJunio =$datoMes; }
        else{$MesJunio = 0 ;}
        
        if( substr($remesa1->getFechare(),-5,2) == "7"){$MesJulio = $datoMes; }
        else{$MesJulio = 0 ;}
        
        if( substr($remesa1->getFechare(),-5,2) == "8"){$MesAgosto = $datoMes; }
        else{$MesAgosto = 0;}
        
        if( substr($remesa1->getFechare(),-5,2) == "9"){$MesSeptiembre = $datoMes; }
        else{$MesSeptiembre = 0 ;}
        
        if( substr($remesa1->getFechare(),-5,2) == "10"){$MesOctubre = $datoMes; }
        else{$MesOctubre = 0 ;}
        
        if( substr($remesa1->getFechare(),-5,2) == "11"){$MesNoviembre = $datoMes; }
        else{$MesNoviembre = 0 ;}
        
        if( substr($remesa1->getFechare(),-5,2) == "12"){$MesDiciembre =$datoMes; }
        else{$MesDiciembre = 0;}
       
         // echo($MesDiciembre." - ");  
        
        
        
        
        ///******sumo totales**********
        
        $TotalCosto19 =$TotalCosto19 + $Costo19;
        $TotalCosto030 = $TotalCosto030 + $Costo030;
        $TotalcarOtro = $TotalcarOtro + $carOtro;
        $TotalRemesaFila = $TotalRemesaFila + $TotalRemesa;
       
        
        //columana meses
        
        $TotalMesEnero = $TotalMesEnero + $MesEnero;
        $TotalMesFebrero= $TotalMesFebrero + $MesFebrero;
        $TotalMesMarzo= $TotalMesMarzo + $MesMarzo ;
        $TotalMesAbril= $TotalMesAbril + $MesAbril;
        $TotalMesMayo= $TotalMesMayo + $MesMayo;
        $TotalMesJunio= $TotalMesJunio + $MesJunio ;
        $TotalMesJulio= $TotalMesJulio + $MesJulio ;
        $TotalMesAgosto=  $TotalMesAgosto + $MesAgosto;
        $TotalMesSeptiembre= $TotalMesSeptiembre + $MesSeptiembre ;
        $TotalMesOctubre= $TotalMesOctubre + $MesOctubre;
        $TotalMesNoviembre = $TotalMesNoviembre + $MesNoviembre ;
        $TotalMesDiciembre = $TotalMesDiciembre + $MesDiciembre;
                
       // $TotalMesDiciembre = number_format($TotalMesDiciembre , 2, ',','.');
       //echo ($MesDiciembre." = ".$TotalMesDiciembre." - ");
  
    
        //****************************
    // para un posterior analisis
    // <td align='center' ><button class='btn btn-default' type='button' onclick=".'"'."IngresoCobertura();".'"'." ><span class='glyphicon glyphicon-chevron-right'></span></button></td> 
        $TABLA1 .="<tr>
                                     
                                     <td align='center' ><div id='id_".$indice."'><span name='NUMEROCARPETARA' id='id2_".$indice."' ondblclick=" .'"'."dobleclickRemesa('id2_".$indice."','id_".$indice."','".$remesa1->getId()."')".';"'.">". $remesa1->getNumeroCarpeta() ."</span></div></td>
                                     <td align='center' ><div id='id3_".$indice."'><span name='PROVEEDORRA' id='id4_".$indice."' ondblclick=" .'"'."dobleclickRemesa('id4_".$indice."','id3_".$indice."','".$remesa1->getId()."')".';"'.">".$remesa1->getProveedor()."</span></div></td> 
                                     <td align='center' ><div id='id5_".$indice."'><span name='CodigoCif' id='id6_".$indice."' ondblclick=" .'"'."dobleclickRemesa('id6_".$indice."','id5_".$indice."','".$remesa1->getId()."')".';"'.">".number_format($CostoCif , 2, ',','.') ."</span></div><div id='CodigoCif_".$indice."' name='".$remesa1->getIdCargoCif()."'></div></td>
                                     <td align='center' ><div id='id7_".$indice."'><span name='tipo_derechos_ID_TIPO_DERECHOS' id='id8_".$indice."' ondblclick=" .'"'."dobleclickRemesa('id8_".$indice."','id7_".$indice."','".$remesa1->getId()."')".';"'.">".$tipoDerecho->getNombreTipoDerecho() ."</span></div></td>
                                     <td align='center' style='background-color: gainsboro' >".number_format($Costo6 , 2, ',','.') . "</td>
                                     <td align='center' style='background-color: gainsboro' >".number_format($Costo19 , 2, ',','.')  . "</td>
                                     <td align='center' style='background-color: gainsboro' >".number_format($TotalCosto , 2, ',','.') . "</td>
                                     <td align='center' style='background-color: gainsboro' > ".number_format($Costo030 , 2, ',','.') . "</td> 
                                     <td align='center' style='background-color: gainsboro' >".number_format($Costo_Dolar , 2, ',','.')."</td>
                                     <td align='center' >".number_format($carOtro , 2, ',','.')."</td>
                                     <td align='center' style='background-color: yellow'> ".number_format($TotalRemesa , 2, ',','.')."</td>
                                     <td align='center' >".$remesa1->getFechare()."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesEnero , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesFebrero , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesMarzo , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesMayo , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesEnero , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesJunio , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesJulio , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesAgosto , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesSeptiembre , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesOctubre , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesNoviembre , 2, ',','.')."</td>
                                     <td align='center' style='background-color: darkgray'>".number_format($MesDiciembre , 2, ',','.')."</td>
                                     <td colspan='2' align='center' ><button class='btn btn-default  btn-sm'  type='button' onclick=".'"'."EliminaRemesa();".'"'." ><span class='glyphicon glyphicon-minus-sign'></span></button></td> 
                                  

                                </tr> ";
        $indice ++;
    }
}




    $TotalCuadraturaIzquierda = $TotalCosto19* $dolar_aduna + (($TotalCosto030* $dolar_aduna)/1.19)*0.19  + (($TotalcarOtro/1.19)-$TotalcarOtro)*-1 ;
    $TotalCuadraturaDerecha = $TotalMesEnero + $TotalMesFebrero + $TotalMesMarzo + $TotalMesAbril +  $TotalMesMayo + $TotalMesJunio + $TotalMesJulio + $TotalMesAgosto + $TotalMesSeptiembre + $TotalMesOctubre + $TotalMesNoviembre + $TotalMesDiciembre;
    $CuadraturaFinal  =$TotalCuadraturaIzquierda - $TotalCuadraturaDerecha;  

    
  
    
    
//Final
$TABLA1 .="           <tr>
                                   
                                
                                     <td style='background-color: darkgray'>Total Internación</td> 
                                     <td style='background-color: darkgray' colspan='4'></td> 
                                     <td style='background-color: darkgray'>".number_format( $TotalCosto19 , 2, ',','.')." </td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>".number_format( $TotalCosto030 , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>".number_format( $TotalcarOtro , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format( $TotalRemesaFila , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesEnero , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesFebrero , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesMarzo , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesAbril , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesMayo , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesJunio , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesJulio , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesAgosto , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesSeptiembre , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesOctubre , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format($TotalMesNoviembre , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>". number_format($TotalMesDiciembre , 2, ',','.')."</td>
                                     <td colspan='2'></td>    
                                         
                               </tr>
                               

        <tr>
                                     
                                     <td>Comprobación IVA</td>
                                     <td colspan='4'></td> 
                                     <td style='color:red'>".number_format( $TotalCosto19* $dolar_aduna , 2, ',','.')."</td>
                                     <td></td>
                                     <td style='color:red'>".number_format( (($TotalCosto030* $dolar_aduna)/1.19)*0.19 , 2, ',','.')."</td>
                                     <td></td>
                                     <td style='color:red'>".number_format( (($TotalcarOtro/1.19)-$TotalcarOtro)*-1 , 2, ',','.')."</td>
                                     <td style='background-color: darkgray; color:red'>".number_format($TotalCuadraturaIzquierda   , 2, ',','.')."</td>
                                     <td colspan='15'></td>  
                               </tr>

        <tr>
                                   
                                     <td colspan='10'></td>
                                     <td style='background-color: darkgray'>".number_format( $TotalCuadraturaDerecha , 2, ',','.')." </td>
                                     <td colspan='15'></td>
                                    
                                     
                               </tr>



                                <tr>
                                    
                                     <td colspan='10'></td>
                                        <td style='background-color: darkgray; color:red'> ".number_format( $CuadraturaFinal , 2, ',','.')." </td>
                                     <td colspan='14'></td>
                                    
                               </tr>
                          <tr id='filaIngreso'>
                         
                            <td><button class='btn btn-default btn-sm' type='button'onclick=" . '"' . "IngresarFilaRemesa();" . '""' . " ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='25'></td>
                         </tr>
</table>
 
      ";
echo $TABLA1;
exit;
?>
