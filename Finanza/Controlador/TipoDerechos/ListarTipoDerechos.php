<?php

                     require_once '../../Modelo/Conexion.php';
                     require_once '../../Modelo/TipoDerecho/TipoDerecho.php';




                        $conexión = new Conexion();
                        $conexión -> conectar();
                 
                         $tipoDerecho = new TipoDerecho();
                            
                 
                     echo("   <table class='table table-striped'> 
                          
                      <tr>
                          <td align='center' ><b> ID</b> </td><td align='center'><b> Número Tipo Derecho </b></td><td colspan='2'></td>
                          
                      </tr>");
                                         
                       

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM tipo_derechos";
                     
                        
                        $resultado1 = mysql_query($sql1);
                       

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                           
                           echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-default  btn-sm' type='button'onclick=".'"'."IngresarFilaTipoDerecho();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar </span></button></td><td colspan='3'></td>
                                    </tr>");
                                
                                echo("</table>"); 
                            
                            exit;

                          
                            
                        }
                         
                    
                       
                       
                        $indice=0;
                                while ($fila1 = mysql_fetch_assoc($resultado1)) {
                                    
                                   $tipoDerecho->setIdTipoDerecho($fila1["ID_TIPO_DERECHOS"]); 
                                   $tipoDerecho->setNombreTipoDerecho($fila1["NOMBRETDE"]);
                                  
                                   
                                 echo("
                            
                                <tr>
                                <td align='center'><div id_".$indice."'> <a  href='#'><span id='id2_".$indice."' >".$tipoDerecho->getIdTipoDerecho()."</span></a></div></td>
                                <td align='center'><div id='id3_".$indice."'><span name='NOMBRETDE' id='id4_".$indice."'  ondblclick=" .'"'."dobleclickTDE('id4_".$indice."','id3_".$indice."','".$tipoDerecho->getIdTipoDerecho()."')".';"'.">".$tipoDerecho->getNombreTipoDerecho()."</div></td>
                                <td colspan='2' align='center'><button title='Elimina el registro : ".$tipoDerecho->getIdTipoDerecho()."' class='btn btn-default  btn-sm' onclick='EliminaTipoDerecho(".$tipoDerecho->getIdTipoDerecho().");' type='button'><span class='glyphicon glyphicon glyphicon-trash'></span></button></td>
                                 </tr> 

"); 
                                
                                $indice=$indice + 1;
                                }
                                
                                
                                
                                
                                
                             
                     
                       
                          echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-default btn-sm' type='button'onclick=".'"'."IngresarFilaTipoDerecho();".'""'."  title='Crea un registro'><span class='glyphicon glyphicon-plus-sign'> Agregar </span></button></td><td colspan='3'></td>
                                    </tr>");
                                
                                echo("</table>");
?>
