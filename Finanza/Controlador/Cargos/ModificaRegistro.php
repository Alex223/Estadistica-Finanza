<?php

require_once '../../Modelo/Conexion.php';





 $id=$_POST['id'];
            $col =$_POST['col'];
            $valor =$_POST['valor'];
            
       
            
                                   
                        $conexión = new Conexion();
                        $conexión -> conectar();
                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                       
                        
                        $sql1 = "update Cargos set ".$col."='".$valor."' where idCargos=".$id;
                   
                        
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