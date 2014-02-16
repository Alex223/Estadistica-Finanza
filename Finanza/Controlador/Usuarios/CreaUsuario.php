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

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                    
                        
                        $sql1 = "insert into usuario(NOMBRE_1,NOMBRE_2,AP_PA,AP_MA,RUT,RUT_DV,USER_LOGIN,PASSWORD,ESTADO) values('".$usuario->getNOMBRE_1()."','".$usuario->getNOMBRE_2()."','".$usuario->getAP_PA()."','".$usuario->getAP_MA()."',".$usuario->getRUT().",'".$usuario->getRUT_DV()."','".$usuario->getUSER_LOGIN()."','".$usuario->getPASSWORD()."',1)";
                   
                        
                        $resultado1 = mysql_query($sql1);

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }
                        
                     
                        //se busca id del registro nuevo creado
                        
                     $sql2 = "select  ID_USUARIO FROM usuario WHERE RUT=".$usuario->getRUT()." && RUT_DV='".$usuario->getRUT_DV()."'";                
                        
                        $resultado2 = mysql_query($sql2);

                        if (!$resultado2) {
                            echo "No se pudo ejecutar con exito la consulta ($sql2) en la BD: " . mysql_error();
                            exit;
                        }
                        
                        $id_del_nuevo_usuario = 0;
                         while ($fila2 = mysql_fetch_assoc($resultado2)){
                             
                             $id_del_nuevo_usuario = $fila2["ID_USUARIO"];
                             
                         }
                        
                         
                         // se eliminar chequeo de constraint foreng key
                         
                          $sql3_1="SET FOREIGN_KEY_CHECKS = 0;";
                         
                         
                         $resultado3_1 = mysql_query($sql3_1);

                        if (!$resultado3_1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql3_1) en la BD: " . mysql_error();
                            exit;
                        }
                          
                        //se anida cargo al usuario creado
                         
                        $sql3 = "insert into Usuario_vs_Cargos(Cargos_idCargos,usuario_ID_USUARIO) values(".$id_cargo.",".$id_del_nuevo_usuario.")";
                   
                        
                        $resultado3 = mysql_query($sql3);

                        if (!$resultado3) {
                            echo "No se pudo ejecutar con exito la consulta ($sql3) en la BD: " . mysql_error();
                            exit;
                        }

                       
                        //volver el  chequeo de constraint foreng key
                        
                        
                            $sql3_3="SET FOREIGN_KEY_CHECKS = 1;";
                         
                         
                         $resultado3_3 = mysql_query($sql3_3);

                        if (!$resultado3_3) {
                            echo "No se pudo ejecutar con exito la consulta ($sql3_3) en la BD: " . mysql_error();
                            exit;
                        }
                        // si no hubo problemas se crea el nuevo usuario

                       if ($resultado1) {
                            echo "Registro Creado!";
                            exit;
                        }
?>
