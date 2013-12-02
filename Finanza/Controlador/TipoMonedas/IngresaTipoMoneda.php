<?php


require_once '../../Modelo/TipoMoneda/TipoMoneda.php';
require_once '../../Modelo/Conexion.php';




$conexión = new Conexion();
$conexión -> conectar();


$TipoM = new TipoMoneda();

$TipoM->setNombre($_POST['Nombre']);

 
   
                   
                    

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                    
                        
                        $sql1 = "insert into tipo_moneda(NOMBRETM) values('".$TipoM->getNombre()."')";
                   
                        
                        $resultado1 = mysql_query($sql1);

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                       if ($resultado1) {
                            echo "Registro Creado!";
                            exit;
                        }
?>

