<?php

                     require_once '../../Modelo/Conexion.php';
                     require_once '../../Modelo/Cargo/Cargo.php';




                        $conexión = new Conexion();
                        $conexión -> conectar();
                 
                         $cargo = new Cargo();
                            
                 
                     echo("   <table class='table table-striped'> 
                          
                      <tr>
                          <td align='center' ><b> ID</b> </td><td align='center'><b> Titulo </b></td><td align='center'><b> Descripcion </b></td><td><td>
                          
                      </tr>");
                                         
                       

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM Cargos";
                     
                        
                        $resultado1 = mysql_query($sql1);
                       

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                           
                           echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-sm btn-default btn-block' type='button'onclick=".'"'."IngresarFilaCargo();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar </span></button></td><td colspan='4'></td>
                                    </tr>");
                                
                                echo("</table>"); 
                            
                            exit;

                          
                            
                        }
                         
                    
                       
                       
                        $indice=0;
                                while ($fila1 = mysql_fetch_assoc($resultado1)) {
                                    
                                   $cargo->setId($fila1["idCargos"]); 
                                   $cargo->setCargo($fila1["Titulo"]);
                                   $cargo->setDescripcion($fila1["Descripcion"]);
                                   
                                 echo("
                            
                                <tr>
                                <td align='center'><div id_".$indice."'> <a  href='#'><span id='id2_".$indice."' >".$cargo->getId()."</span></a></div></td>
                                <td align='center'><div id='id3_".$indice."'><span name='Titulo' id='id4_".$indice."'  ondblclick=" .'"'."dobleclickC('id4_".$indice."','id3_".$indice."','".$cargo->getId()."')".';"'.">".$cargo->getCargo()."</div></td>
                                <td align='center'><div id='id5_".$indice."'><span name='Descripcion' id='id6_".$indice."' ondblclick=" .'"'."dobleclickC('id6_".$indice."','id5_".$indice."','".$cargo->getId()."')".';"'.">".$cargo->getDescripcion()."</span></div> </td>
                                <td><td>
                                 </tr> 

"); 
                                
                                $indice=$indice + 1;
                                }
                                
                                
                                
                                
                                
                             
                     
                       
                          echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-sm btn-default btn-block' type='button'onclick=".'"'."IngresarFilaCargo();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar </span></button></td><td colspan='4'></td>
                                    </tr>");
                                
                                echo("</table>");
?>
