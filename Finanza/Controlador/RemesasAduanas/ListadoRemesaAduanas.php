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




$sql_0 = "SELECT ID_TIPO_DOLAR from tipo_dolar where NOMBRETDO='Aduana'";
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

$dolar_aduna = number_format($dolar->getValor(), 2, ',','.');




$TABLA1 = "<table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                                
                                <tr>
                                  <!--Primera Fila Tabla -->   
                                     <td align='center' style='background-color: darkgray' colspan='13'>Gastos de Internación</td>
                                     <td align='center' style='background-color: darkgray' colspan='13'>Mesiva</td>

                                </tr> 
                                <!--Segunda Fila Tabla -->
                                 <tr>
                                     <td align='center' ></td>
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
                                     <td align='center' ></td>
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
                                   
                                     <td></td>   
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
                                     <td></td> 
                               </tr>
                               

        <tr>
                                     <td></td> 
                                     <td>Comprobación IVA</td>
                                     <td colspan='4'></td> 
                                     <td style='color:red'>0</td>
                                     <td></td>
                                     <td style='color:red'>0</td>
                                     <td></td>
                                     <td style='color:red'>0</td>
                                     <td style='background-color: darkgray; color:red'>0</td>
                                     <td colspan='14'></td>  
                               </tr>

        <tr>
                                   
                                     <td colspan='11'></td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td colspan='14'></td>
                                    
                                     
                               </tr>



                                <tr>
                                    
                                     <td colspan='11'></td>
                                     <td style='background-color: darkgray; color:red'> 0 </td>
                                     <td colspan='14'></td>
                                    
                               </tr>
      
                          <tr id='filaIngreso'>
                          <td></td> 
                         <td><button class='btn btn-default' type='button'onclick=" . '"' . "IngresarFilaAduana();" . '""' . " ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='24 '></td>
                         </tr>";
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
        $TotalMesDiciembre=0;
    
    
    while ($filaZ = mysql_fetch_assoc($resultadoZ)) {

        
        
        
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


        $CostoCif = number_format( floatval($cargoCif->getCostoCif()) + floatval($cargoCif->getFleteCif()) + floatval($cargoCif->getPrimaCif()), 2, ',','');

        
        
        
        //tipo Derechos

        $sql_b = "SELECT NOMBRETDE from tipo_derechos where ID_TIPO_DERECHOS=" . $remesa1->getIdTipoDerecho();
        $resultado_b = mysql_query($sql_b);

        while ($filax = mysql_fetch_assoc($resultado_b)) {
            $tipoDerecho->setNombreTipoDerecho($filax["NOMBRETDE"]);
        }
       

        if ($tipoDerecho->getNombreTipoDerecho() == "6") {
            $Costo6 =  number_format( $CostoCif * 0.6, 2, ',','.');
        } else {
            $Costo6 =  number_format( 0, 2, ',','.');
        }

        
         
        
        
        $Costo19 = number_format( $CostoCif * 0.19, 2, ',','.');

        $TotalCosto = number_format( $Costo6 + $Costo19, 2, ',','.'); 

        $Costo030 = number_format( $CostoCif * 0.003, 2, ',','.');

        $Costo_Dolar = number_format($dolar->getValor()*($TotalCosto+$Costo030), 2, ',','.');
         
        ///****************************************************
        
        //id cargo otros
        
        $sql_c = "SELECT MARGEN_CO from cargo_otro where ID_CARGO_OTROS=" .$remesa1->getIdCargoOtro();
        $resultado_c = mysql_query($sql_c);

        while ($filaw = mysql_fetch_assoc($resultado_c)) {
            $CargoOtro->setMargen($filaw["MARGEN_CO"]);
        }
        
        
        $carOtro = number_format($CargoOtro->getMargen(), 2, ',','.');
        
        $TotalRemesa =  number_format($Costo_Dolar + $carOtro, 2, ',','.');
        
        
         
        
        //pasear datos por meses
        
        $datoMes = $Costo19*$dolar_aduna + $Costo030*0.15966387*$dolar_aduna + $carOtro*0.15966387;
        
        
        if( substr($remesa1->getFechare(),-5,2) == "1"){$MesEnero = number_format($datoMes , 2, ',','.'); }
        else{$MesEnero = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "2"){$MesFebrero = number_format($datoMes , 2, ',','.'); }
        else{$MesFebrero = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "3"){$MesMarzo = number_format($datoMes , 2, ',','.'); }
        else{$MesMarzo = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "4"){$MesAbril = number_format($datoMes , 2, ',','.'); }
        else{$MesAbril = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "5"){$MesMayo = number_format($datoMes , 2, ',','.'); }
        else{$MesMayo = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "6"){$MesJunio = number_format($datoMes , 2, ',','.'); }
        else{$MesJunio = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "7"){$MesJulio = number_format($datoMes , 2, ',','.'); }
        else{$MesJulio = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "8"){$MesAgosto = number_format($datoMes , 2, ',','.'); }
        else{$MesAgosto = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "9"){$MesSeptiembre = number_format($datoMes , 2, ',','.'); }
        else{$MesSeptiembre = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "10"){$MesOctubre = number_format($datoMes , 2, ',','.'); }
        else{$MesOctubre = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "11"){$MesNoviembre = number_format($datoMes , 2, ',','.'); }
        else{$MesNoviembre = number_format(0 , 2, ',','.');}
        
        if( substr($remesa1->getFechare(),-5,2) == "12"){$MesDiciembre = number_format($datoMes , 2, ',','.'); }
        else{$MesDiciembre = number_format(0 , 2, ',','.');}
       
            
        
        
        
        
        ///******sumo totales**********
        
        $TotalCosto19 = (float)$TotalCosto19 + (float)$Costo19;
        $TotalCosto030 += (float)$Costo030;
        $TotalcarOtro += (float)$carOtro;
        $TotalRemesaFila += (float)$TotalRemesa;
        $TotalCuadraturaIzquierda = $TotalCosto19* $dolar_aduna + (($TotalCosto030* $dolar_aduna)/1.19)*0.19  + (($TotalcarOtro/1.19)-$TotalcarOtro)*-1 ;
       
        
        //columana meses
        
        $TotalMesEnero = number_format($TotalMesEnero + $MesEnero , 2, ',','.');
        $TotalMesFebrero= number_format($TotalMesFebrero + $MesFebrero , 2, ',','.');
        $TotalMesMarzo= number_format($TotalMesMarzo + $MesMarzo , 2, ',','.');
        $TotalMesAbril= number_format($TotalMesAbril + $MesAbril , 2, ',','.');
        $TotalMesMayo= number_format($TotalMesMayo + $MesMayo , 2, ',','.');
        $TotalMesJunio= number_format($TotalMesJunio + $MesJunio , 2, ',','.');
        $TotalMesJulio= number_format($TotalMesJulio + $MesJulio , 2, ',','.');
        $TotalMesAgosto=  number_format($TotalMesAgosto + $MesAgosto , 2, ',','.');
        $TotalMesSeptiembre= number_format($TotalMesSeptiembre + $MesSeptiembre , 2, ',','.');
        $TotalMesOctubre= number_format($TotalMesOctubre + $MesOctubre , 2, ',','.');
        $TotalMesNoviembre= number_format($TotalMesNoviembre + $MesNoviembre , 2, ',','.');
        $TotalMesDiciembre= number_format($TotalMesDiciembre + $MesDiciembre , 2, ',','.');
      //  echo ($TotalMesDiciembre." , ");
    $TotalCuadraturaDerecha = number_format($TotalMesEnero+$TotalMesFebrero+$TotalMesMarzo+$TotalMesMayo+ $TotalMesAbril+$TotalMesJunio+$TotalMesJulio+$TotalMesAgosto+$TotalMesSeptiembre+$TotalMesOctubre+$TotalMesNoviembre+$TotalMesDiciembre , 2, ',','.');
    $CuadraturaFinal  = number_format($TotalCuadraturaIzquierda - $TotalCuadraturaDerecha , 2, ',','.');   
    
        //****************************
    // para un posterior analisis
    // <td align='center' ><button class='btn btn-default' type='button' onclick=".'"'."IngresoCobertura();".'"'." ><span class='glyphicon glyphicon-chevron-right'></span></button></td> 
        $TABLA1 .="<tr>
                                     <td align='center' ></td>
                                     <td align='center' >" . $remesa1->getNumeroCarpeta() . "</td>
                                     <td align='center' >" . $remesa1->getProveedor() . "</td> 
                                     <td align='center' >" . $CostoCif . "</td>
                                     <td align='center' >" . $tipoDerecho->getNombreTipoDerecho() . " </td>
                                     <td align='center' >" . $Costo6 . "</td>
                                     <td align='center' >" . $Costo19 . "</td>
                                     <td align='center' >" . $TotalCosto . "</td>
                                     <td align='center' > " . $Costo030 . "</td> 
                                     <td align='center' >".$Costo_Dolar."</td>
                                     <td align='center' style='background-color: darkgray'>".$carOtro."</td>
                                     <td align='center' style='background-color: yellow'> ".$TotalRemesa."</td>
                                     <td align='center' >".$remesa1->getFechare()."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesEnero."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesFebrero."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesMarzo."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesAbril."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesMayo."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesJunio."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesJulio."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesAgosto."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesSeptiembre."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesOctubre."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesNoviembre."</td>
                                     <td align='center' style='background-color: darkgray'>".$MesDiciembre."</td>
                                     <td align='center' ><button class='btn btn-default' type='button' onclick=".'"'."EliminaRemesa();".'"'." ><span class='glyphicon glyphicon-minus-sign'></span></button></td> 
                                  

                                </tr> ";
    }
}
//Final
$TABLA1 .="           <tr>
                                   
                                     <td></td>
                                     <td style='background-color: darkgray'>Total Internación</td> 
                                     <td style='background-color: darkgray' colspan='4'></td> 
                                     <td style='background-color: darkgray'>".number_format( $TotalCosto19 , 2, ',','.')." </td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>".number_format( $TotalCosto030 , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>".number_format( $TotalcarOtro , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'>".number_format( $TotalRemesaFila , 2, ',','.')."</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>".$TotalMesEnero."</td>
                                     <td style='background-color: darkgray'>".$TotalMesFebrero."</td>
                                     <td style='background-color: darkgray'>".$TotalMesMarzo."</td>
                                     <td style='background-color: darkgray'>".$TotalMesAbril."</td>
                                     <td style='background-color: darkgray'>".$TotalMesMayo."</td>
                                     <td style='background-color: darkgray'>".$TotalMesJunio."</td>
                                     <td style='background-color: darkgray'>".$TotalMesJulio."</td>
                                     <td style='background-color: darkgray'>".$TotalMesAgosto."</td>
                                     <td style='background-color: darkgray'>".$TotalMesSeptiembre."</td>
                                     <td style='background-color: darkgray'>".$TotalMesOctubre."</td>
                                     <td style='background-color: darkgray'>".$TotalMesNoviembre."</td>
                                     <td style='background-color: darkgray'>".$TotalMesDiciembre."</td>
                                     <td></td>    
                                         
                               </tr>
                               

        <tr>
                                     <td></td>
                                     <td>Comprobación IVA</td>
                                     <td colspan='4'></td> 
                                     <td style='color:red'>".number_format( $TotalCosto19* $dolar_aduna , 2, ',','.')."</td>
                                     <td></td>
                                     <td style='color:red'>".number_format( (($TotalCosto030* $dolar_aduna)/1.19)*0.19 , 2, ',','.')."</td>
                                     <td></td>
                                     <td style='color:red'>".number_format( (($TotalcarOtro/1.19)-$TotalcarOtro)*-1 , 2, ',','.')."</td>
                                     <td style='background-color: darkgray; color:red'>".number_format($TotalCuadraturaIzquierda   , 2, ',','.')."</td>
                                     <td colspan='14'></td>  
                               </tr>

        <tr>
                                   
                                     <td colspan='11'></td>
                                     <td style='background-color: darkgray'>".$TotalCuadraturaDerecha." </td>
                                     <td colspan='14'></td>
                                    
                                     
                               </tr>



                                <tr>
                                    
                                     <td colspan='11'></td>
                                     <td style='background-color: darkgray; color:red'> ".$CuadraturaFinal." </td>
                                     <td colspan='14'></td>
                                    
                               </tr>
                          <tr id='filaIngreso'>
                          <td></td>
                            <td><button class='btn btn-default' type='button'onclick=" . '"' . "IngresarFilaAduana();" . '""' . " ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='24 '></td>
                         </tr>
</table>
      ";
echo $TABLA1;
exit;
?>
