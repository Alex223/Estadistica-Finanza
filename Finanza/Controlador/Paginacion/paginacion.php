     <?php 

                        require_once '../../Modelo/Conexion.php';


                        $tabla=$_POST['tabla'];

                        $conexión = new Conexion();
                        $conexión -> conectar();
                        
                        
                        //------------------------------------

                      

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }
                        
                        if ($tabla == "usuario"){$sql = "SELECT COUNT(*) FROM ".$tabla." where ESTADO=1";}
                        else{"SELECT COUNT(*) FROM ".$tabla;}
                        $resultado = mysql_query($sql);

                        if (!$resultado) {
                            echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado) == 0) {
                            echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                            exit;
                        }
                                while ($fila = mysql_fetch_assoc($resultado)) {

                                echo ($fila['COUNT(*)']);           

                                }  
        
        
        ?>