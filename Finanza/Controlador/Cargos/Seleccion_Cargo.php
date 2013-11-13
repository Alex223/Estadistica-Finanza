<?php

 
      
      
   function  cajaSelecion($id){

   

  $conexión = mysql_connect("localhost", "root", "1234");

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }


                          
                            
                                 $sql =  "SELECT idCargos,Titulo FROM Cargos";  
                                   
                                
                                 
                                 $selectbox ="<select id='seleccion'>";  
                                $resultado = mysql_query($sql);
                                            while ($fila = mysql_fetch_assoc($resultado)) {
 
                                                if($fila['idCargos']==$id){
                                                    
                                                 $selectbox  =$selectbox."<option id='elegido' selected='selected' value='".$fila['idCargos']."'>".$fila['Titulo']."</option>  ";     
                                                }else{
                                                
                                            $selectbox  =$selectbox."<option value='".$fila['idCargos']."'>".$fila['Titulo']."</option>  ";
                                                }
                                }
                                   $selectbox =$selectbox."</select>";
                                   
                                  
                                return($selectbox);
                                
                                            }

?>
