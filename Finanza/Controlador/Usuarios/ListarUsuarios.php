     
                 <?php
                 
            
                     require_once '../../Modelo/Conexion.php';
                     require_once '../Cargos/Seleccion_Cargo.php';




                        $conexión = new Conexion();
                        $conexión -> conectar();
                 
                 
                 
                     echo("   <table class='table table-striped'> 
                          
                      <tr>
                          <td><b> ID</b> </td><td><b>Rut</b></td><td><b> Primer Nombre </b></td><td><b> Segundo Nombre </b></td><td><b> Apellido Paterno </b></td><td><b> Apellido Materno </b></td><td><b> Nick </b></td><td><b> Contraseña </b></td><td><b> Cargo </b></td><td><b> </b> </td>
                          
                      </tr>");
                                         
                       

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM usuario WHERE ESTADO=1";
                     
                        
                        $resultado1 = mysql_query($sql1);
                       

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                        //    echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                          //   exit;

                           
                            
                        }
                         $fila1=0;
                         $indice=1;
                         $usuarioVsCargo="";
                         $idCargo="";
                    
                        
                                while ($fila1 = mysql_fetch_assoc($resultado1)) {


                                $sql2 = "SELECT * FROM Usuario_vs_Cargos where usuario_ID_USUARIO=".$fila1['ID_USUARIO'];
                                
                             
                                
                                $resultado2 = mysql_query($sql2);
                                
                                while ($fila2 = mysql_fetch_assoc($resultado2)) {
                                     
                                 $usuarioVsCargo = $fila2['Cargos_idCargos'];
                                 
                                 }
                                 
                                 $sql3 = "SELECT Titulo FROM Cargos where idCargos =".$usuarioVsCargo;
                                 $resultado3 = mysql_query($sql3);
                                            while ($fila3 = mysql_fetch_assoc($resultado3)) {
 
                                            $idCargo = $fila3['Titulo'];
                                            

                                            }
                                     

                                echo("
                            
                                <tr>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id_".$indice."'> <a  href='#'><span id='id2_".$indice."' ondblclick=" .'"'."dobleclick('id_".$indice."','id2_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['ID_USUARIO']."</span></a></div></td>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id3_".$indice."'>".$fila1['RUT']."-".$fila1['RUT_DV']."</div></td>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id5_".$indice."'><span name='NOMBRE_1' id='id6_".$indice."' ondblclick=" .'"'."dobleclick('id6_".$indice."','id5_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['NOMBRE_1']."</span></div> </td>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id7_".$indice."'><span name='NOMBRE_2' id='id8_".$indice."' ondblclick=" .'"'."dobleclick('id8_".$indice."','id7_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['NOMBRE_2']."</span></div></td>    
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id9_".$indice."'><span name='AP_PA' id='id10_".$indice."' ondblclick=" .'"'."dobleclick('id10_".$indice."','id9_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['AP_PA']."</span></div> </td>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id11_".$indice."'><span name='AP_MA' id='id12_".$indice."' ondblclick=" .'"'."dobleclick('id12_".$indice."','id11_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['AP_MA']."</span></div> </td>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id13_".$indice."'><span name='USER_LOGIN' id='id14_".$indice."' ondblclick=" .'"'."dobleclick('id14_".$indice."','id13_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['USER_LOGIN']."</span></div> </td>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id15_".$indice."'><span name='PASSWORD' id='id16_".$indice."' ondblclick=" .'"'."dobleclick('id16_".$indice."','id15_".$indice."','".$fila1['ID_USUARIO']."')".';"'."> ****** </span></div> </td>
                                <td><div onkeypress=".'"'."unfocus(event);".'"'." id='id17_".$indice."'><span name='Cargo' id='id18_".$indice."' ondblclick=" .'"'."dobleclick('id18_".$indice."','id17_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$idCargo." </span></div></td>
                                <td><button class='btn btn-default' type='button' onclick=".'"'."eliminar(".$fila1['ID_USUARIO'].");".'""'."><span class='glyphicon glyphicon-remove-sign'></span></button></td>
                                </tr> 

"); 
                                
                                $indice=$indice + 1;
                                }
                                
                             
                     
                       
                          echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-default' type='button'onclick=".'"'."IngresarFila();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='9'></td>
                                    </tr>");
                                
                                echo("</table>");
                       ?>
                   
                            
                            
                            
                            
                            
                            