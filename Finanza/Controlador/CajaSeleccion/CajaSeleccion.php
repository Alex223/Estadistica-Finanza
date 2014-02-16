<?php

require_once '../../Modelo/Conexion.php';
require_once '../../Modelo/CajaSeleccion/CajaSeleccion.php';

$edita_o_ingresa=$_POST["edita_o_ingresa"];
$registro = $_POST["id"];
$tabla = $_POST["tabla"];
$tipoId = $_POST["tipoId"];
$tipoTitulo=$_POST["tipoTitulo"];
$TituloSelect =$_POST["TituloSelect"];





  $conexión = new Conexion();
  $conexión -> conectar();
  $selecion = new CajaSeleccion();    
  
  
  
                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM ".$tabla;
                     
                        
                        $resultado1 = mysql_query($sql1);
                       

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                           echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                           exit;

                          
                            
                        }
               
                           if ($edita_o_ingresa == '0') {
                        
                    $insert ="<div name='".$tabla."' id='editor' onkeypress=".'"'."unfocusb(event);return event.keyCode!=13;".'"'."> <select id='seleccion' class='selectpicker' data-style='btn-primary'>";
                       
                     while ($fila1 = mysql_fetch_assoc($resultado1)) {
                                
                                    
                                    $selecion->setIdSelect($fila1[$tipoId]);
                                    $selecion->setNombreSelect($fila1[$tipoTitulo]);
                                    
                                   
                                    
                                   if(strcmp($TituloSelect , $selecion->getNombreSelect()) == 0){
                                    
                                       $insert  =$insert."<option id='seleccionado' selected value='".$selecion->getIdSelect()."'>".$selecion->getNombreSelect()."</option>";
                                   }else{ 
                                    
                                   $insert  =$insert."<option value='".$selecion->getIdSelect()."'>".$selecion->getNombreSelect()."</option>"; }   
                                    
                                }
  
                     $insert = $insert."</select>";
                    
                     
                      $insert = $insert."<span id='idReg' name='".$registro."'></span>
                        <button class='btn btn-default btn-sm' title='Guarda los cambios'  type='button' onclick=".'"'."ModificaIngreso".$tabla."();".'"'." ><span class='glyphicon glyphicon-plus-sign'></span></button>";  
                    
                           }
                           
                           else{
                                $insert ="<div name='".$tabla."' id='editor'> <select id='seleccion' class='selectpicker' data-style='btn-primary'>";
                          
                                
                                 while ($fila1 = mysql_fetch_assoc($resultado1)) {
                                
                                    
                                    $selecion->setIdSelect($fila1[$tipoId]);
                                    $selecion->setNombreSelect($fila1[$tipoTitulo]);
                                    
                                    
                                   if( $selecion->getIdSelect() == 1 ){
                                       
                                       $insert  =$insert."<option id='seleccionado' selected value='".$selecion->getIdSelect()."'>".$selecion->getNombreSelect()."</option>";
                                   }else{ 
                                    
                                   $insert  =$insert."<option value='".$selecion->getIdSelect()."'>".$selecion->getNombreSelect()."</option>"; }   
                                    
                                }
  
                            $insert = $insert."</select>";     
                                
                           }
                           
                           
                 
                        
  echo($insert);
  exit;

?>
