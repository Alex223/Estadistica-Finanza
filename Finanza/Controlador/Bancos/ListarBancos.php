<?php


            
                     require_once '../../Modelo/Conexion.php';
                     require_once '../../Modelo/Banco/Banco.php';




                        $conexión = new Conexion();
                        $conexión -> conectar();
                 
                         $banco = new Banco();
                            
                 
                     echo("   <table class='table table-striped'> 
                          
                      <tr>
                          <td align='center' ><b> ID</b> </td><td align='center'><b> Nombre Banco </b></td><td align='center'><b> Número de Cuenta </b></td><td align='center'><b> Saldo </b></td><td align='center'><b> Tipo Moneda </b></td><td colspan='2'></td>
                          
                      </tr>");
                                         
                       

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
                        //    echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                          //   exit;

                          
                            
                        }
                         
                    
                       
                        $ID_NOM_MON="";
                        $indice=0;
                                while ($fila1 = mysql_fetch_assoc($resultado1)) {
                                    
                                   $banco->setId($fila1["ID_BANCO"]); 
                                   $banco->setNombre($fila1["NOMBREBA"]);
                                   $banco->setNumeroCuenta($fila1["NUMEROCUENTABA"]);
                                   $banco->setSaldo($fila1["SALDOBA"]);
                                   
                                   


                                $sql2 = "SELECT * FROM tipo_moneda where ID_TIPO_MONEDA=".$fila1["tipo_moneda_ID_TIPO_MONEDA"];
                                
                             
                                
                                $resultado2 = mysql_query($sql2);
                                
                                while ($fila2 = mysql_fetch_assoc($resultado2)) {
                                     
                                 $ID_NOM_MON = $fila2['NOMBRETM'];
                                                                         
                                
                                     

                                echo("
                            
                                <tr>
                                <td align='center'><div id_".$indice."'> <a  href='#'><span id='id2_".$indice."' >".$banco->getId()."</span></a></div></td>
                                <td align='center'><div id='id3_".$indice."'><span name='NOMBREBA' id='id4_".$indice."'  ondblclick=" .'"'."dobleclickB('id4_".$indice."','id3_".$indice."','".$banco->getId()."')".';"'.">".$banco->getNombre()."</div></td>
                                <td align='center'><div id='id5_".$indice."'><span name='NUMEROCUENTABA' id='id6_".$indice."' ondblclick=" .'"'."dobleclickB('id6_".$indice."','id5_".$indice."','".$banco->getId()."')".';"'.">".$banco->getNumeroCuenta()."</span></div> </td>
                                <td align='center'><div id='id7_".$indice."'><span name='SALDOBA' id='id8_".$indice."' ondblclick=" .'"'."dobleclickB('id8_".$indice."','id7_".$indice."','".$banco->getId()."')".';"'.">". number_format($banco->getSaldo(), 2, ',','.')."</span></div></td>    
                                <td align='center'><div id='id9_".$indice."'><span name='TIPO_MONEDA' id='id10_".$indice."' ondblclick=" .'"'."dobleclickB('id10_".$indice."','id9_".$indice."','".$banco->getId()."')".';"'.">".$ID_NOM_MON."</span></div> </td>
                                <td colspan='2' align='center'><button title='Elimina el registro : ".$banco->getId()."' class='btn btn-default  btn-sm' onclick='EliminaBanco(".$banco->getId().");' type='button'><span class='glyphicon glyphicon glyphicon-trash'></span></button></td>
                                </tr> 

"); 
                                
                                $indice=$indice + 1;
                                }
                                
                                
                                
                                }
                                
                             
                     
                       
                          echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-sm btn-default' title='Crea un registro' type='button'onclick=".'"'."IngresarFilaBanco();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar </span></button></td><td colspan='7'></td>
                                    </tr>");
                                
                                echo("</table>");
?>
