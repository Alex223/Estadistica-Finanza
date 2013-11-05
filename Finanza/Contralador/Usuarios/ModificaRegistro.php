<?php

            $id=$_POST['id'];
            $col =$_POST['col'];
            $valor =$_POST['valor'];
            
       
            
                                   
                        $conexión = mysql_connect("localhost", "root", "1234");

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        if ($col == 'RUT'){
                            
                         
                        $sql1 = "update usuario set RUT='".substr($valor, 0, strlen($valor)-2)."', RUT_DV='".substr($valor, strlen($valor)-1, strlen($valor))."' where ID_USUARIO=".$id;
                         
                        }else{
                        
                        $sql1 = "update usuario set ".$col."='".$valor."' where ID_USUARIO=".$id;
                   
                        }
                        $resultado1 = mysql_query($sql1);
  
                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }
                         
                        if ($resultado1) {
                            echo "Registro Modificado";
                            exit;
                        }
                      
            
       
        


?>
