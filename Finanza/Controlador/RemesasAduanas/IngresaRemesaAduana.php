<?php



    include_once '../../Modelo/Conexion.php';
    include_once '../../Modelo/RemesaAduana/RemesaAduana.php';
    include_once '../../Modelo/CargoCIF/CargoCif.php';
    include_once '../../Modelo/TipoDerecho/TipoDerecho.php'; 
    include_once '../../Modelo/CargoOtro/CargoOtro.php';  
    include_once '../../Modelo/CarpetaRelacionada/CarpetaRelacionada.php';
    
    $remesa = new RemesaAduana();
    $cargoCif = new CargoCif();
    $tDerecho = new TipoDerecho();
    $cargoOtro = new CargoOtro();
    $carpeta = new CarpetaRelacionada();
    $conexión = new Conexion();
    $conexión -> conectar();
    
    
    $cargoCif ->setCostoCif($_POST["campo2_1"]); if($cargoCif ->getCostoCif($_POST["campo2_1"]) == ""){$cargoCif ->setCostoCif(0);}
    $cargoCif ->setFleteCif($_POST["campo2_2"]); if($cargoCif ->getFleteCif($_POST["campo2_1"]) == ""){$cargoCif ->setFleteCif(0);}
    $cargoCif ->setPrimaCif($_POST["campo2_3"]); if($cargoCif ->getPrimaCif($_POST["campo2_1"]) == ""){$cargoCif ->setPrimaCif(0);}
    
   $totalCostoCif =floatval($cargoCif->getCostoCif()) + floatval($cargoCif->getFleteCif()) + floatval($cargoCif->getPrimaCif());
    
    
    //Guarda registro Costo Cif
   
               if (!$conexión) {
                              echo "No pudo conectarse a la BD: " . mysql_error();
                              exit;
                          }

                          if (!mysql_select_db($conexión->base())) {
                              echo "No ha sido posible seleccionar la BD: " . mysql_error();
                              exit;
                          }
                          
                          $sql = "select COSTOCIF, FLETECIF, PRIMACIF from  cargo_cif  where  COSTOCIF=".$cargoCif->getCostoCif()." && FLETECIF=".$cargoCif->getFleteCif()." && PRIMACIF=".$cargoCif->getPrimaCif();
                          $resultado = mysql_query($sql);

                 if (!$resultado) {
                            echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
                            exit;
                          }

                  if (mysql_num_rows($resultado) == 0) {
                              
                       $sql1 = "insert into cargo_cif(COSTOCIF, FLETECIF, PRIMACIF) values(".$cargoCif->getCostoCif().",".$cargoCif->getFleteCif().",".$cargoCif->getPrimaCif() .")";
                       $resultado1 = mysql_query($sql1);     
                       if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                          }
                          
                       $sql2 = "select * from  cargo_cif  where  COSTOCIF=".$cargoCif->getCostoCif()." && FLETECIF=".$cargoCif->getFleteCif()." && PRIMACIF=".$cargoCif->getPrimaCif();
                       $resultado2 = mysql_query($sql2);
                          
                          
                        while ($fila2 = mysql_fetch_assoc($resultado2)) {
                            
                            //Seteo id en remesa
                              $remesa->setIdCargoCif($fila2["ID_CARGO_CIF"]); 
                        }   
                                                        }
                           else{
                               
                             $sql2 = "select * from  cargo_cif  where  COSTOCIF=".$cargoCif->getCostoCif()." && FLETECIF=".$cargoCif->getFleteCif()." && PRIMACIF=".$cargoCif->getPrimaCif();
                              $resultado2 = mysql_query($sql2);
                          
                          
                                while ($fila2 = mysql_fetch_assoc($resultado2)) {

                                    //Seteo id en remesa
                                      $remesa->setIdCargoCif($fila2["ID_CARGO_CIF"]); 
                                }   


                         }
                               
                           
                          
           
  
   
   
   //Tipo Derecho 
                                                        
    //$tDerecho->setNombreTipoDerecho($_POST["campo4"]);
   
   
    
    //Seteo id en remesa
    $remesa->setIdTipoDerecho($_POST["campo4"]);

                  
                               
                           
    
       
                                                        
     //********** final***********************************                                                    
                                                        
   
 
    
    
    //Cargo Otro
                         
         $cargoOtro->setMargen($_POST["campo5"]);
   
   //Ingresar registro Cargo Otro
    
         
         if($_POST["campo5"]!=""){
   
                    $sql20 = "select * from  cargo_otro  where  MARGEN_CO=".$cargoOtro->getMargen();
                          $resultado20 = mysql_query($sql20);

                 if (!$resultado20) {
                            echo "No se pudo ejecutar con exito la consulta ($sql20) en la BD: " . mysql_error();
                            exit;
                          }

                  if (mysql_num_rows($resultado20) == 0) {
                              
                       $sql21 = "insert into cargo_otro(MARGEN_CO,OTROCO) values(".$cargoOtro->getMargen().", 0)";
                       $resultado21 = mysql_query($sql21);     
                       if (!$resultado21) {
                            echo "No se pudo ejecutar con exito la consulta ($sql21) en la BD: " . mysql_error();
                            exit;
                          }
                          
                       $sql22 = "select * from  cargo_otro  where  MARGEN_CO=".$cargoOtro->getMargen();
                       $resultado22 = mysql_query($sql22);
                          
                          
                        while ($fila22 = mysql_fetch_assoc($resultado22)) {
                            
                            //Seteo id en remesa
                             $remesa->setIdCargoOtro($fila22["ID_CARGO_OTROS"]); 
                        }   
                                                        }
                           else{
                               
                             $sql22 = "select * from  cargo_otro  where  MARGEN_CO=".$cargoOtro->getMargen();
                             $resultado22 = mysql_query($sql22);
                          
                          
                                while ($fila22 = mysql_fetch_assoc($resultado22)) {

                                    //Seteo id en remesa
                                      $remesa->setIdCargoOtro($fila22["ID_CARGO_OTROS"]); 
                                }   


                         }               
                         
                         
         }
    $remesa->setNumeroCarpeta($_POST["campo"]);
    $remesa->setProveedor($_POST["campo1"]);
    $remesa->setFechare($_POST["campo6"]);
    
    
    
    ///id Carpeta Relaciona
    $carpeta->setNumeroCarpeta($_POST["campo7"]);
    if ($carpeta->getNumeroCarpeta() != "" || $carpeta->getNumeroCarpeta() !=0){
        
         $sql30 = "select * from  carpeta_relacionada  where  NUMEROCARPETACR=".$carpeta->getNumeroCarpeta();
                          $resultado30 = mysql_query($sql30);

                 if (!$resultado30) {
                            echo "No se pudo ejecutar con exito la consulta ($sql30) en la BD: " . mysql_error();
                            exit;
                          }
                          
                                
                  while ($fila30 = mysql_fetch_assoc($resultado30)) {
                            
                            
                    $remesa->setIdCarpetaRelacionada($fila30["ID_CARPETA_RELACIONA"]); 
                  }
                     
        
    }
    else{
        
                    $sql30 = "select * from  carpeta_relacionada  where  NUMEROCARPETACR=0";
                    $resultado30 = mysql_query($sql30);

                 if (!$resultado30) {
                            echo "No se pudo ejecutar con exito la consulta ($sql30) en la BD: " . mysql_error();
                            exit;
                          } 
        
              if (mysql_num_rows($resultado30) == 0) {
                  
                  $sql40 = "insert into carpeta_relacionada(NUMEROCARPETACR) values(0)";
                    $resultado40 = mysql_query($sql40);

                 if (!$resultado40) {
                            echo "No se pudo ejecutar con exito la consulta ($sql40) en la BD: " . mysql_error();
                            exit;
                          } 
                  
                  $sql50 = "select * from  carpeta_relacionada  where  NUMEROCARPETACR=0";
                  $resultado50 = mysql_query($sql50); 
                  
                   if (!$resultado50) {
                            echo "No se pudo ejecutar con exito la consulta ($sql50) en la BD: " . mysql_error();
                            exit;
                          } 
                  while ($fila50 = mysql_fetch_assoc($resultado50)) {
                            
                            
                    $remesa->setIdCarpetaRelacionada($fila50["ID_CARPETA_RELACIONA"]); 
                  }        
                  
                  
              }else{
                     while ($fila30 = mysql_fetch_assoc($resultado30)) {
                            
                            
                    $remesa->setIdCarpetaRelacionada($fila30["ID_CARPETA_RELACIONA"]); 
                  }
                  
              }
        
    }
    
   // $remesa->setIdCarpetaRelacionada($_POST["campo7"]);
    
    
    
    // calculo de la remesa total
    
    if(intval($tDerecho->getNombreTipoDerecho()) =="6"){
        
         $remesa->setTotalRemesa($totalCostoCif*0,06);
    }
    
    
     $remesa->setTotalRemesa(floatval($remesa->getTotalRemesa())+ $totalCostoCif*0,19);
     $remesa->setTotalRemesa(floatval($remesa->getTotalRemesa()) + floatval($remesa->getTotalRemesa())*0,003);
     $remesa->setTotalRemesa(floatval($remesa->getTotalRemesa()) + $cargoOtro->getMargen());
    
    
     $remesa->setIdCarga(1);
     
    $sqlfinal = "INSERT INTO remesa_aduana(NUMEROCARPETARA, PROVEEDORRA, FECHARA,tipo_carga_ID_CARGA, cargo_cif_ID_CARGO_CIF, cargo_otro_ID_CARGO_OTROS, tipo_derechos_ID_TIPO_DERECHOS, carpeta_relacionada_ID_CARPETA_RELACIONA, TotalRemesas) 
                 values(".$remesa->getNumeroCarpeta().",'".$remesa->getProveedor()."', '".$remesa->getFechare()."', ".$remesa->getIdCarga().", ".$remesa->getIdCargoCif().",".$remesa->getIdCargoOtro().", ".$remesa->getIdTipoDerecho().", ".$remesa->getIdCarpetaRelacionada().",".$remesa->getTotalRemesa().")";
   
    
      $resultadoFinal = mysql_query($sqlfinal);

                 if (!$resultadoFinal) {
                            echo "No se pudo ejecutar con exito la consulta ($sqlfinal) en la BD: " . mysql_error();
                            exit;
                          }
                          else{
                              
                              echo "Remesa de Aduna Creada!";
                              exit;
                          }

?>
