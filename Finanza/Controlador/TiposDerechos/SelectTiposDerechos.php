<?php


    include_once '../../Modelo/Conexion.php';
    include_once '../../Modelo/TipoDerecho/TipoDerecho.php';
    
    $TipoSelect =$_POST["tipo"];
    $conexión = new Conexion();
    $conexión -> conectar();
    $tipoDerecho = new TipoDerecho();
    
    if (!$conexión) {
                              
    
                         echo "No pudo conectarse a la BD: " . mysql_error();
                              
                              
                              exit;
                          }

                          if (!mysql_select_db($conexión->base())) {
                              
                              
                              echo "No ha sido posible seleccionar la BD: " . mysql_error();
                              exit;
                          }

                          $sql = "SELECT * FROM tipo_derechos";


                          $resultado = mysql_query($sql);


                          if (!$resultado) {
                             echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
                            
                             exit;
                          }

                          if (mysql_num_rows($resultado) == 0) {
                              
                              echo "0";
                              exit;
                          }
                          
                          
                          
                        $insert = "<div>";
                        $insert .="<select id='seleccion' class='selectpicker' data-style='btn-primary'>";
                        
                        //crea
                          if ($TipoSelect == 'crea'){
                        $i=1;
                        while($fila=mysql_fetch_assoc($resultado)){
                            
                            $tipoDerecho->setIdTipoDerecho($fila["ID_TIPO_DERECHOS"]);
                            $tipoDerecho->setNombreTipoDerecho($fila["NOMBRETDE"]);
                              if( $i == 1 ){
                                       
                                    $insert .= "<option id='seleccionado' selected value='".$tipoDerecho->getIdTipoDerecho()."'>".$tipoDerecho->getNombreTipoDerecho()."</option>";
                                   }
  
                             else{
                                 
                                  $insert .= "<option id='seleccionado' value='".$tipoDerecho->getIdTipoDerecho()."'>".$tipoDerecho->getNombreTipoDerecho()."</option>";
                             }
                            $i++;
                          }
                              }
                              //Edita
                              else{}
                              

                              $insert .= "</select></div>";    
                          echo $insert;   
                        exit;
?>
