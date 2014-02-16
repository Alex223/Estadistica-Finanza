<?php


require_once '../../Modelo/Conexion.php';



    $ACTUAL = $_POST["cont0"];
    $NUEVA = $_POST["cont1"];
       
    session_start(); 
    
    $ID = $_SESSION["id_user"];
        
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
                        
                        
                        
                        ///******************************************************
                        
                        
                        $sql = "SELECT * FROM usuario  where ID_USUARIO=".$ID." && PASSWORD='".$ACTUAL."'";
                        
                         $resultado = mysql_query($sql);

                        
                         if (!$resultado) {
                            echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
                            exit;
                            
                            
                        }
                        
                        
                        if (mysql_num_rows($resultado) == 0) {
                            
                           
                            echo("0");
                            exit;
                            
                        }
                              
                   
                             
                         
                        
                        $sql1 = "UPDATE usuario SET PASSWORD='".$NUEVA."'  WHERE ID_USUARIO=".$ID; 
                       
                        
                        $resultado2 = mysql_query($sql1);
                      
                             if (!$resultado2) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                            
                            
                        }    
                        echo("1");
                            exit;
                      
                        
                       
                        
                          
                        
                        
                       

       
?>
