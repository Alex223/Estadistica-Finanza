<?php


                     require_once '../../Modelo/Conexion.php';
                     require_once '../../Modelo/TipoMoneda/TipoMoneda.php';




                        $conexión = new Conexion();
                        $conexión -> conectar();
                 
                         $TipoMoneda = new TipoMoneda();
                            
                 
                     echo("   <table class='table table-striped'> 
                          
                      <tr>
                          <td align='center' ><b> ID</b> </td><td align='center'><b> Nombre Tipo Moneda </b></td><td colspan='2'></td>
                          
                      </tr>");
                                         
                       

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM tipo_moneda";
                     
                        
                        $resultado1 = mysql_query($sql1);
                       

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                           
                           echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-sm btn-default' type='button'onclick=".'"'."IngresarFilaTipoMoneda();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar </span></button></td><td colspan='4'></td>
                                    </tr>");
                                
                                echo("</table>"); 
                            
                            exit;

                          
                            
                        }
                         
                    
                       
                       
                        $indice=0;
                                while ($fila1 = mysql_fetch_assoc($resultado1)) {
                                    
                                   $TipoMoneda->setId($fila1["ID_TIPO_MONEDA"]); 
                                   $TipoMoneda->setNombre($fila1["NOMBRETM"]);
                                  
                                   
                                 echo("
                            
                                <tr>
                                <td align='center'><div id_".$indice."'> <a  href='#'><span id='id2_".$indice."' >".$TipoMoneda->getId()."</span></a></div></td>
                                <td align='center'><div id='id3_".$indice."'><span name='NOMBRETM' id='id4_".$indice."'  ondblclick=" .'"'."dobleclickTM('id4_".$indice."','id3_".$indice."','".$TipoMoneda->getId()."')".';"'.">".$TipoMoneda->getNombre()."</div></td>
                                <td colspan='2' align='center'><button title='Elimina el registro : ".$TipoMoneda->getId()."' class='btn btn-default  btn-sm' onclick='EliminaTipoMoneda(".$TipoMoneda->getId().");' type='button'><span class='glyphicon glyphicon glyphicon-trash'></span></button></td>
                                 </tr> 

"); 
                                
                                $indice=$indice + 1;
                                }
                                
                                
                                
                                
                                
                             
                     
                       
                          echo("<tr id='filaIngreso'>
                                         <td><button title='Crea un nuevo registro' class='btn btn-sm btn-default' type='button'onclick=".'"'."IngresarFilaTipoMoneda();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar </span></button></td><td colspan='3'></td>
                                    </tr>");
                                
                                echo("</table>");
?>
