<?php
require_once '../../Modelo/usuario.php';
require_once '../../Modelo/Conexion.php';




$conexión = new Conexion();
$conexión -> conectar();


$usuario = new usuario();

$usuario->setRUT($_POST['RUT']);
$usuario->setRUT_DV($_POST['RUT_DV']);
$usuario->setPASSWORD($_POST["PASSWORD"]);
$usuario->setNOMBRE_1($_POST['NOMBRE_1']);
$usuario->setNOMBRE_2($_POST['NOMBRE_2']);
$usuario->setAP_PA($_POST['AP_PA']);
$usuario->setAP_MA($_POST['AP_MA']);
$usuario->setUSER_LOGIN($_POST['USER_LOGIN']);
$usuario->setPASSWORD($_POST['PASSWORD']);
$id_cargo=   $_POST['id_cargo'];
   
   
                   
                        //$conexión = mysql_connect("localhost", "root", "1234");

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                    
                        
                        $sql1 = "insert into usuario(NOMBRE_1,NOMBRE_2,AP_PA,AP_MA,RUT,RUT_DV,USER_LOGIN,PASSWORD,ESTADO) values('".$usuario->getNOMBRE_1()."','".$usuario->getNOMBRE_2()."','".$usuario->getAP_PA()."','".$usuario->getAP_MA()."',".$usuario->getRUT().",'".$usuario->getRUT_DV()."','".$usuario->getUSER_LOGIN()."','".$usuario->getPASSWORD()."',1)";
                   
                        
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
