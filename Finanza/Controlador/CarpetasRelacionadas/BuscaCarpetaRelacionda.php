<?php





    include_once '../../Modelo/Conexion.php';

    
    $carpeta = $_POST["carpeta"];
    
    
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

                          $sql = "SELECT NUMEROCARPETARA FROM remesa_aduana where NUMEROCARPETARA=".$carpeta;


                          $resultado = mysql_query($sql);


                          if (!$resultado) {
                             echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
                            
                             exit;
                          }

                          if (mysql_num_rows($resultado) == 0) {
                              
                              echo "0";
                              exit;
                          }
                          $i=0;
                          while($fila=mysql_fetch_assoc($resultado)){
                              
                            
                              $i++;
                          }

                          if($i === 1){
                              
                              echo "1";
                              exit;
                          }
                          else {
                              
                              echo "0";
                              exit;
                              
                          }
?>
