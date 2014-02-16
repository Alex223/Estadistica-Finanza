<?php
     require_once '../../Modelo/Conexion.php';
     
     $tabla = $_POST["tabla"];
     
                        $conexión = new Conexion();
                        $conexión -> conectar();
                        
                        
                        $resultado = "";
                        
                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM ".$tabla;
                     
                        
                        $resultado1 = mysql_query($sql1);
                       

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                           $resultado = "No hay registros";
                        }
                        else{
                             $resultado = "hay registros";
                            
                        }
                        
                        echo $resultado;

?>
