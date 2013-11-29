<?php


include_once '../../Modelo/Conexion.php';
include_once '../../Modelo/Banco/Banco.php';

    $bancoSeleccionado = $_POST["seleccionado"];
    $fecha = $_POST["fecha"];   
    

   $conexión = new Conexion();
    $conexión -> conectar();
    $banco = new Banco(); 
   

    

                          if (!$conexión) {
                              echo "No pudo conectarse a la BD: " . mysql_error();
                              exit;
                          }

                          if (!mysql_select_db("prueba")) {
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

                         
                          
                   $i=1;

                    while ($fila = mysql_fetch_assoc($resultado1)) {

                     if($i==$bancoSeleccionado){
                         
                         $banco->setId($fila["ID_BANCO"]);
                         $banco->setNombre($fila["NOMBREBA"]);
                         $banco->setNumeroCuenta($fila["NUMEROCUENTABA"]);
                         $banco->setSaldo($fila["SALDOBA"]);
                     $i++;    
                         
                     }
                    
                    }
                        $respuesta = "
                            
                          <table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                                <tr>
                                    <td colspan='4'><b> Banco Actual: ".$banco->getNombre()."</b></td><td colspan='2'>Depositos</td><td id='fecha'></td><td colspan='2'>Conciliación</td>
                                </tr>

                                <tr>
                                    <td align='center'>Fecha</td><td align='center'>Numero de Cheque</td><td align='center'>Detalle</td><td align='center'>Giros</td><td align='center'>0 día</td><td align='center'>1 día</td><td align='center'>Saldo</td><td align='center'>CH x COB</td><td align='center'>Valor</td>
                                </tr>

                                <tr>
                                
                            ";
                        
                          
                        
                        
                           $sql2 = "SELECT * FROM transaccion";


                          $resultado2 = mysql_query($sql2);


                          if (!$resultado2) {
                             echo "No se pudo ejecutar con exito la consulta ($sql2) en la BD: " . mysql_error();
                            
                             exit;
                          }

                          if (mysql_num_rows($resultado2) == 0) {
                              
                            //echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                           
                              $respuesta .=" </table>";
                              echo($respuesta);
                              exit;
                             
                            }
                        
                        
                        
                        
                        
                        
                               while($fila2 = mysql_fetch_assoc($resultado2)){
                        
                              $respuesta .=" <td align='center'>13/03/2013</td>
                                    <td align='center'> - </td>
                                    <td align='center'>Saldo Anteriores</td> 
                                    <td align='center'> - </td>
                                    <td align='center'> - </td>
                                    <td align='center'> - </td>
                                    <td align='center'>39.284.993</td>
                                    <td align='center'> - </td>
                                    <td align='center'> - </td>
                                </tr>";
                               }

                        $respuesta .=" </table>";
                     echo($respuesta);
                     exit;
                         



?>