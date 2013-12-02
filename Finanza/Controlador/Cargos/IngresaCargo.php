<?php

require_once '../../Modelo/Cargo/Cargo.php';
require_once '../../Modelo/Conexion.php';




$conexión = new Conexion();
$conexión -> conectar();


$cargo = new Cargo();

$cargo->setCargo($_POST['Titulo']);
$cargo->setDescripcion($_POST['Descripcion']);
 
   
                   
                    

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                    
                        
                        $sql1 = "insert into Cargos(Titulo, Descripcion) values('".$cargo->getCargo()."','".$cargo->getDescripcion()."')";
                   
                        
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

