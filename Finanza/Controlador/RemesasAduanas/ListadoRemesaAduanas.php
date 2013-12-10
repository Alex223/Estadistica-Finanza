<?php


  include_once '../../Modelo/Conexion.php';
  include_once '../../Modelo/RemesaAduana/RemesaAduana.php';
  include_once '../../Modelo/CargoCIF/CargoCif.php';
    $conexión = new Conexion();
    $conexión -> conectar();
    $remesa1 = new RemesaAduana();
    $cargoCif = new CargoCif();
    
    
        $TABLA1 = "<table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                                
                                <tr>
                                  <!--Primera Fila Tabla -->   
                                     <td align='center' style='background-color: darkgray' colspan='12'>Gastos de Internación</td>
                                     <td align='center' style='background-color: darkgray' colspan='12'>Mesiva</td>

                                </tr> 
                                <!--Segunda Fila Tabla -->
                                 <tr>
                                     <td align='center' style='background-color: darkgray'>Carperta</td>
                                     <td align='center' style='background-color: darkgray'>Proveedor</td> 
                                     <td align='center' style='background-color: darkgray'>Cif </td>
                                     <td align='center' style='background-color: darkgray'>Estado Bodega</td>
                                     <td align='center' style='background-color: darkgray'>6%</td>
                                     <td align='center' style='background-color: darkgray'>19%</td>
                                     <td align='center' style='background-color: darkgray'>Total</td>
                                     <td align='center' style='background-color: darkgray'>0,30%</td> 
                                     <td align='center' style='background-color: darkgray'>Dolar Aduana</td>
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
                                     
                                 </tr> ";
     

    
                      if (!$conexión) {
                              
    
                         echo "No pudo conectarse a la BD: " . mysql_error();
                         exit;
                          }

                          if (!mysql_select_db($conexión->base())) {
                              
                              
                              echo "No ha sido posible seleccionar la BD: " . mysql_error();
                              exit;
                          }

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
                                     <td colspan='13'></td>  
                               </tr>

        <tr>
                                   
                                     <td colspan='10'></td>
                                     <td style='background-color: darkgray'>0</td>
                                     <td colspan='13'></td>
                                    
                                     
                               </tr>



                                <tr>
                                    
                                     <td colspan='10'></td>
                                     <td style='background-color: darkgray; color:red'> 0 </td>
                                     <td colspan='13'></td>
                                    
                               </tr>
      
                          <tr id='filaIngreso'>
                         <td><button class='btn btn-default' type='button'onclick=".'"'."IngresarFilaAduana();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='23 '></td>
                         </tr>";
                          exit;
                          }
                      else{
                          
                          
                          while($filaZ=mysql_fetch_assoc($resultadoZ)){
                              
                          
                              $remesa1->setNumeroCarpeta($filaZ["NUMEROCARPETARA"]);
                              $remesa1->setProveedor($filaZ["PROVEEDORRA"]);
                              $remesa1->setIdCarga($filaZ["tipo_carga_ID_CARGA"]);
                              $remesa1->setIdCargoCif($filaZ["cargo_cif_ID_CARGO_CIF"]); 
                              $remesa1->setIdCargoOtro($filaZ["cargo_otro_ID_CARGO_OTROS"]);
                              $remesa1->setIdTipoDerecho($filaZ["tipo_derechos_ID_TIPO_DERECHOS"]); 
                              $remesa1->setTotalRemesa($filaZ["carpeta_relacionada_ID_CARPETA_RELACIONA"]); 
                              
                             
                              $sql_a = "SELECT COSTOCIF,FLETECIF,PRIMACIF from cargo_cif where ID_CARGO_CIF=".$remesa1->getIdCargoCif();
                              $resultado_a = mysql_query($sql_a);
                              
                              while($filay=mysql_fetch_assoc($resultado_a))
                                   
                              {
                                 $cargoCif->setCostoCif($filay["COSTOCIF"]);
                                 $cargoCif->setFleteCif($filay["FLETECIF"]);
                                 $cargoCif->setPrimaCif($filay["PRIMACIF"]);
                              }
                              
                              
                              $CostoCif =floatval($cargoCif->getCostoCif())+floatval($cargoCif->getFleteCif())+floatval($cargoCif->getPrimaCif());
                              
                              
                          $TABLA1 .="<tr>
                                   
                                     <td align='center' >".$remesa1->getNumeroCarpeta()."</td>
                                     <td align='center' >".$remesa1->getProveedor()."</td> 
                                     <td align='center' >".$CostoCif ." </td>
                                     <td align='center' >".$cargoCif->getCostoCif()."</td>
                                     <td align='center' >6%</td>
                                     <td align='center' >19%</td>
                                     <td align='center' >Total</td>
                                     <td align='center' >0,30%</td> 
                                     <td align='center' >Dolar Aduana</td>
                                     <td align='center' style='background-color: darkgray'>Otro $</td>
                                     <td align='center' style='background-color: darkgray'>Total Remesa</td>
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
                                     <td align='center' style='background-color: darkgray'>Ocubre</td>
                                     <td align='center' style='background-color: darkgray'>Noviembre</td>
                                     <td align='center' style='background-color: darkgray'>Diciembre</td>
                                     
                                  

                                </tr> ";   
                              
                              
                          }
                      }
              //Final
                 $TABLA1 .="           <tr>
                                   
                                     
                                     <td style='background-color: darkgray'>Total Internación</td> 
                                     <td style='background-color: darkgray' colspan='4'></td> 
                                     <td style='background-color: darkgray'>Total 19% </td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>Total 0,30%</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'>Total Otros</td>
                                     <td style='background-color: darkgray'>Total</td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                                     <td style='background-color: darkgray'></td>
                               </tr>
                               

        <tr>
                                   
                                     <td>Comprobación IVA</td>
                                     <td colspan='4'></td> 
                                     <td style='color:red'>Total 19% </td>
                                     <td></td>
                                     <td style='color:red'>Total 0,30%</td>
                                     <td></td>
                                     <td style='color:red'>Total Otros</td>
                                     <td style='background-color: darkgray; color:red'>Total</td>
                                     <td colspan='13'></td>  
                               </tr>

        <tr>
                                   
                                     <td colspan='10'></td>
                                     <td style='background-color: darkgray'>Total </td>
                                     <td colspan='13'></td>
                                    
                                     
                               </tr>



                                <tr>
                                    
                                     <td colspan='10'></td>
                                     <td style='background-color: darkgray; color:red'> 0 </td>
                                     <td colspan='13'></td>
                                    
                               </tr>
                          <tr id='filaIngreso'>
                            <td><button class='btn btn-default' type='button'onclick=".'"'."IngresarFilaAduana();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='23 '></td>
                         </tr>
</table>
      ";
  echo $TABLA1;
 exit;
 

?>
