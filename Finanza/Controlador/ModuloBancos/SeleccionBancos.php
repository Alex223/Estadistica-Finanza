<?php

include_once '../../Modelo/Banco/Banco.php';
include_once '../../Modelo/TipoMoneda/TipoMoneda.php';
include_once '../../Modelo/Conexion.php';

  $id = $_POST["id"];

   $conexión = new Conexion();
    $conexión -> conectar();
    $banco = new Banco(); 
    $TIPO = new TipoMoneda();

    

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
                               echo("0");
                             exit;
                             
                            }

                 
                          $i=1;
                    $resultadoQuery = "<select class='selectpicker' id='selectpicker' onchange=".'"'.";".'"'.">";

                    while ($fila = mysql_fetch_assoc($resultado1)) {

                      
                            
                            $banco->setId($fila["ID_BANCO"]);
                            $banco->setNombre($fila["NOMBREBA"]);
                            $banco->setNumeroCuenta($fila["NUMEROCUENTABA"]);
                            $banco->setIdTipoMoneda($fila["tipo_moneda_ID_TIPO_MONEDA"]);
                               
                             $sql2 = "SELECT * FROM tipo_moneda";
                             $resultado2 = mysql_query($sql2);
                             
                        while ($fila2 = mysql_fetch_assoc($resultado2)) {
                       
                            if($banco->getIdTipoMoneda() == $fila2["ID_TIPO_MONEDA"]){$TIPO->setNombre($fila2["NOMBRETM"]); }
                            }
                            
                            
                            if( $i == $id){
                           $resultadoQuery .="<option selected value='".$banco->getId()."' >".$banco->getId()."| ".$banco->getNombre()."-".$banco->getNumeroCuenta()." -> ".$TIPO->getNombre()."</option>"; 
                            }
                            else{
                                
                                $resultadoQuery .="<option value='".$banco->getId()."' >".$banco->getId()."| ".$banco->getNombre()."-".$banco->getNumeroCuenta()." -> ".$TIPO->getNombre()."</option>";  
                                
                            }
                           $i++;
                           
                            }   
                        
                        
                        $resultadoQuery .= "</select>";
                        
                        
                       echo($resultadoQuery);
                    
                         



   




 exit;

?>
