<?php

require_once '../../Modelo/Banco/Banco.php';
require_once '../../Modelo/Conexion.php';




$conexión = new Conexion();
$conexión -> conectar();


$banco = new Banco();

$banco->setNombre($_POST['nombre']);
$banco->setNumeroCuenta($_POST['numero']);
$banco->setSaldo($_POST["saldo"]);
$banco->setIdTipoMoneda($_POST['tipo']);  
   
                   
                    

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                    
                        
                        $sql1 = "insert into banco(NOMBREBA, NUMEROCUENTABA, SALDOBA, tipo_moneda_ID_TIPO_MONEDA) values('".$banco->getNombre()."',".$banco->getNumeroCuenta().",".$banco->getSaldo().",".$banco->getIdTipoMoneda().")";
                   
                        
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

