<?php

   $id=$_POST['id'];
   
   
                   
                        $conexión = mysql_connect("localhost", "root", "1234");

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                    
                        
                        $sql1 = "delete from usuario where ID_USUARIO=".$id;
                   
                        
                        $resultado1 = mysql_query($sql1);

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                       if ($resultado1) {
                            echo "Registro Eliminado";
                            exit;
                        }
            
       
?>
