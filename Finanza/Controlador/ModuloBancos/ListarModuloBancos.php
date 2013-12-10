<?php


include_once '../../Modelo/Conexion.php';
include_once '../../Modelo/Banco/Banco.php';

    $bancoSeleccionado = $_POST["seleccionado"];
    $fecha = $_POST["fecha"];
    
    $fecha_ano = substr($fecha,-10,4); 
    $fecha_mes = substr($fecha,-5,2); 
    $fecha_dia = substr($fecha,-2); 
     
    $fecha_mes_dato = intval($fecha_mes);
    $fecha_mes_dato += 1;
    
    
    $fecha_final = $fecha_ano."-".$fecha_mes_dato."-".$fecha_dia;
    
    
    
   $conexión = new Conexion();
    $conexión -> conectar();
    $banco = new Banco(); 
   

    

                          if (!$conexión) {
                              echo "No pudo conectarse a la BD: " . mysql_error();
                              exit;
                          }

                          if (!mysql_select_db($conexión->base())) {
                              echo "No ha sido posible seleccionar la BD: " . mysql_error();
                              exit;
                          }

                          $sql1 = "SELECT * FROM banco";


                          $resultado1 = mysql_query($sql1);


                          if (!$resultado1) {
                             echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            
                             exit;
                          }

                          if (mysql_num_rows($resultado1) == 0) {
                              
                            // echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                             echo("no hay bancos");
                             exit;
                             
                            }

                     
                          
                   

                    while ($fila = mysql_fetch_assoc($resultado1)) {

                     if($fila["ID_BANCO"]==$bancoSeleccionado){
                         
                         $banco->setId($fila["ID_BANCO"]);
                         $banco->setNombre($fila["NOMBREBA"]);
                         $banco->setNumeroCuenta($fila["NUMEROCUENTABA"]);
                         $banco->setSaldo($fila["SALDOBA"]);
                       
                         
                     }
                    
                    }
                    
                    
                       $valorSaldoanterior = 0;
                    
                        $respuesta = "
                            
                          <table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                                <tr>
                                    <td style='background-color: darkgray' colspan='3'><b> Banco Actual: ".$banco->getNombre()."</b></td><td style='background-color: darkgray' id='fecha'></td><td style='background-color: darkgray' colspan='2' >Deposito</td><td style='background-color: darkgray'></td><td style='background-color: darkgray' colspan='2'>Conciliación</td>
                                </tr>

                                <tr  >
                                    <td style='background-color: darkgray' align='center'>Fecha</td>
                                    <td style='background-color: darkgray' align='center'>Numero de Cheque</td>
                                    <td style='background-color: darkgray' align='center'>Detalle</td>
                                    <td style='background-color: darkgray' align='center'>Giros</td>
                                    <td style='background-color: darkgray' align='center'>0 día</td>
                                    <td style='background-color: darkgray' align='center'>1 día</td>
                                    <td style='background-color: darkgray' align='center'>Saldo</td>
                                    <td style='background-color: darkgray' align='center'>CH x COB</td>
                                    <td style='background-color: darkgray' align='center'>Valor</td>
                                </tr>

                                <tr>
                                
                            ";
                        
                          
                           
                        
                           //Fila inicial
                        
                        
                            $sql3 = "SELECT * FROM saldo_historial_banco WHERE fecha<'".$fecha_final."' && banco_ID_BANCO=".$bancoSeleccionado." order by fecha desc";


                          $resultado3 = mysql_query($sql3);


                          if (!$resultado3) {
                             echo "No se pudo ejecutar con exito la consulta ($sql3) en la BD: " . mysql_error();
                            
                             exit;
                          }
                        $i=1;
                          if (mysql_num_rows($resultado3) == 0) {
                              
                                $respuesta .=" 
                                
                                    <td align='center'> 0 </td>
                                    <td align='center'> - </td>
                                    <td align='center' style='background-color: darkgray'>Saldo Anteriores</td> 
                                    <td align='center'> 0 </td>
                                    <td align='center'> 0 </td>
                                    <td align='center'> 0 </td>
                                    <td align='center'>".$valorSaldoanterior."</td>
                                    <td align='center'> - </td>
                                    <td align='center'> 0 </td>
                                    
                                </tr>";
                                   
                            }else{
                            
                           while ($fila3 = mysql_fetch_assoc($resultado3)) {
                            if ($i==1){
                                $respuesta .=" 
                                
                                    <td align='center'> 0 </td>
                                    <td align='center'> - </td>
                                    <td align='center' style='background-color: darkgray'>Saldo Anteriores</td> 
                                    <td align='center'> 0 </td>
                                    <td align='center'> 0 </td>
                                    <td align='center'> 0 </td>
                                    <td align='center'>".$fila3['saldo_final_dia']."</td>
                                    <td align='center'> - </td>
                                    <td align='center'> 0 </td>
                                    
                                </tr>";
                                 $i++;
                                 $valorSaldoanterior=intval($fila3['saldo_final_dia']);
                                 }
                                       
                           }
                            
                            
                            
                           
                            }
                        
                           //Resto de las filas   dependiendo de la naturaleza de la transaccion, si es cheque o giro                    
                        
                        
                           $sql2 = "SELECT * FROM transaccion WHERE FECHAT='".$fecha_final."' && banco_ID_BANCO=". $bancoSeleccionado;


                          $resultado2 = mysql_query($sql2);


                          if (!$resultado2) {
                             echo "No se pudo ejecutar con exito la consulta ($sql2) en la BD: " . mysql_error();
                             exit;
                          }

                          if (mysql_num_rows($resultado2) == 0) {
                              
                            //echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                           
                                 // Suma Final
                               
                               $respuesta .="
                                 
                                
                                <tr>
                                    <td align='center' style='background-color: darkgray'><button class='btn btn-default btn-sm' type='button' onclick=".'"'.'"'.">Ingresar</button></td> 
                                    <td align='center' style='background-color: darkgray' colspan='2'></td>
                                    <td align='center' style='background-color: darkgray'> Total Giros </td>
                                    <td align='center'  style='background-color: darkgray' colspan='2'> Total Depositos </td>
                                    <td align='center'  style='background-color: darkgray'> </td>
                                    <td align='center'  style='background-color: darkgray'> NumeroxCobro</td>
                                    <td align='center'  style='background-color: darkgray'> Total Valor </td>
                                    
                                </tr>

                                <tr>
                                    
                                    <td align='center'  colspan='7'></td> 
                                    <td align='center' style='background-color: darkgray'> Banco</td>
                                    <td align='center' > Valor de la cuenta </td>
                                    
                                </tr>

                             <tr>
                                   
                                    <td align='center' colspan='7'></td> 
                                    <td align='center' style='background-color: darkgray'> Diferencia</td>
                                    <td align='center'> Valor Diferencia </td>
                                    
                                </tr>
                                
";
                               

                        $respuesta .=" </table>
                           <p align='right'> <button class='btn btn-default btn-sm' type='button' onclick=".'"'.'"'.">Cuadrar Día</button></p>";
                              
                              
                              
                              $respuesta .=" </table>";
                              echo($respuesta);
                              exit;
                             
                            }
                        
                        
                        
                          
                        
                        
                               while($fila2 = mysql_fetch_assoc($resultado2)){
                                   
                               $subtotal = intval($valorSaldoanterior)-intval($fila2['MONTOT']);
                               
                               
                              $respuesta .=" <td align='center'>".$fila2['FECHAT']."</td>
                                    <td align='center'> SI ES CHEQUE</td>
                                    <td align='center'>Saldo Anteriores</td> 
                                    <td align='center'> ".$fila2['MONTOT']." </td>
                                    <td align='center'> - </td>
                                    <td align='center'> - </td>
                                    <td align='center' style='background-color: darkgray'>".$subtotal."</td>
                                    <td align='center' style='background-color: darkgray'>SI ES CHEQUE </td>
                                    <td align='center' style='background-color: darkgray'> ".$fila2['MONTOT']." </td>
                                    
                                </tr>";
                               }
                               
                               
                               
                               // Suma Final
                               
                               $respuesta .="
                                 
                                
                                <tr>
                                    <td align='center' style='background-color: darkgray'><button class='btn btn-default btn-sm' type='button' onclick=".'"'.'"'.">Ingresar</button></td> 
                                    <td align='center' style='background-color: darkgray' colspan='2'></td>
                                    <td align='center' style='background-color: darkgray'> Total Giros </td>
                                    <td align='center'  style='background-color: darkgray' colspan='2'> Total Depositos </td>
                                    <td align='center'  style='background-color: darkgray'  > </td>
                                    <td align='center'  style='background-color: darkgray'> NumeroxCobro</td>
                                    <td align='center'  style='background-color: darkgray'> Total Valor </td>
                                    
                                </tr>

                                <tr>
                                    
                                    <td align='center'  colspan='7'></td> 
                                    <td align='center' style='background-color: darkgray'> Banco</td>
                                    <td align='center' > Valor de la cuenta </td>
                                    
                                </tr>

                             <tr>
                                   
                                    <td align='center' colspan='7'></td> 
                                    <td align='center' style='background-color: darkgray'> Diferencia</td>
                                    <td align='center'> Valor Diferencia </td>
                                    
                                </tr>
                                
";
                               

                        $respuesta .=" </table>
                           <p align='right'> <button class='btn btn-default btn-sm' type='button' onclick=".'"'.'"'.">Cuadrar Día</button></p>";
                     echo($respuesta);
                     exit;
                         



?>