<?php
require_once '../../Modelo/Conexion.php';
require_once '../../Modelo/usuario.php';



$usuario = new usuario();


$usuario->setUSER_LOGIN($_POST['user1']);
$usuario->setPASSWORD($_POST['text1']);
$usuario->setESTADO(0);




//Se debe preguntar si estas?, cargo? y activo?


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
                        
                        $sql = "SELECT ID_USUARIO, NOMBRE_1, NOMBRE_2, AP_PA, AP_MA, ESTADO  FROM usuario WHERE USER_LOGIN='".$usuario->getUSER_LOGIN()."' && PASSWORD='".$usuario->getPASSWORD()."' && ESTADO=1";
                        
                      
                        $resultado = mysql_query($sql);
                              
 
                        if (!$resultado) {
                            echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado) == 0) {
                            
                            
                            echo "<script>alert('Usuario o Contraseña erroneo!');</script>
                                <script>

                                function redireccionar() 
                                {
                                location.href='/Estadistica-Finanza/Finanza/index.html';
                                } 
                                setTimeout ('redireccionar()', 0);
                                  </script>";
                            
                               // header( 'Location: /index.html');
                            exit;
                        }
                         
                       
                        
                           session_start();  
                        
                        
                        while ($fila = mysql_fetch_assoc($resultado)) {
                            
                            
                            //if ($fila['ID_USUARIO'] == $usuario->getUSER_LOGIN() && $fila['PASSWORD'] == $usuario->getPASSWORD() && $fila['ESTADO']==1){
                            
                               $usuario->setId_USER($fila['ID_USUARIO']);
                               $usuario->setESTADO($fila['ESTADO']);
                               $usuario->setNOMBRE_1($fila['NOMBRE_1']);
                               $usuario->setNOMBRE_2($fila['NOMBRE_2']);
                               $usuario->setAP_PA($fila['AP_PA']);
                               $usuario->setAP_MA($fila['AP_MA']);
                               $_SESSION["id_user"] =$fila['ID_USUARIO'];
                           // }
                                }  
                              
                                
                                IF ($usuario->getESTADO() == 1 ){
                                
                                $sql2 = "Select Cargos_idCargos from Usuario_vs_Cargos where usuario_ID_USUARIO=".$usuario->getId_USER();
                                $resultado2 = mysql_query($sql2); 
                              
                              
                                while ($fila2 = mysql_fetch_assoc($resultado2)) {

                                                  $_SESSION["NombreCargo"] =$fila2['Titulo'];

                                } 
                                
                                
                           
                                 echo "<script>alert('Bienvenido ".$usuario->getNOMBRE_1()." ".$usuario->getAP_PA()." ".$usuario->getAP_MA()."');</script>
                                <script>function redireccionar(){location.href='/Estadistica-Finanza/Finanza/Marco.html';} 
                                         setTimeout ('redireccionar()', 0);
                                </script>";
                                }
                                
                                else{
                                    
                                  
                            
                                    echo "<script>alert('Usuario NO VIGENTE, consulte al administrador.');</script>
                                <script>

                                function redireccionar() 
                                {
                                location.href='/Marco.html';
                                } 
                                setTimeout ('redireccionar()', 0);
                                  </script>";
                                    
                                }

?>
