<?php



                     require_once '../../Modelo/Conexion.php';
                     require_once '../../Modelo/CargoCIF/CargoCif.php';
                     
                       $idCargoCif = $_POST["idCif"];



                        $conexión = new Conexion();
                        $conexión -> conectar();
                        $cargoC = new CargoCif();
                         
                            
                 
                                         
                       

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db($conexión->base())) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM cargo_cif where ID_CARGO_CIF=".$idCargoCif;
                     
                        
                        $resultado1 = mysql_query($sql1);
                       

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                            
                            echo "No Hay Registro!";
                            exit;
                        }

                        while ($fila = mysql_fetch_assoc($resultado1)){
                            $cargoC->setCostoCif($fila["COSTOCIF"]);
                            $cargoC->setFleteCif($fila["FLETECIF"]);
                            $cargoC->setPrimaCif($fila["PRIMACIF"]);
                            
                            
                        }
                            
                    echo ("<table id='editor'class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>
                             <tr>
                                 <td colspan='2'>Datos Costo Cif</td>
                             </tr>
                             <tr>
                                 <td>Cif: </td>
                                 <td>
                               
                                   <input class='form-control' onkeypress=".'"'."unfocuRemesa(event) ".";return event.keyCode!=13;".'"'." onchange=".'"'."sumaCif()".'"'." id='ingreso2_1' placeholder='Costo Cif...' value='".number_format($cargoC->getCostoCif() , 2, ',','.')."'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </td>
                                 
                             </tr>
                             <tr>
                                 <td>Flete: </td>
                                 <td><input class='form-control' onkeypress=".'"'."unfocuRemesa(event) ".";return event.keyCode!=13;".'"'." onchange=".'"'."sumaCif()".'"'." id='ingreso2_2' placeholder='Costo Flete...' value='".number_format($cargoC->getFleteCif() , 2, ',','.')."'/></td>
                             </tr>
                             <tr>
                                 <td>Prima: </td>
                                 <td><input class='form-control' onkeypress=".'"'."unfocuRemesa(event) ".";return event.keyCode!=13;".'"'." onchange=".'"'."sumaCif()".'"'." id='ingreso2_3' placeholder='Costo Prima...' value='".number_format($cargoC->getPrimaCif() , 2, ',','.')."'/></td> 
                             </tr>
                             <tr>
                                 <td>Costo Cif: </td><td><div id='totalCif'>".number_format(($cargoC->getCostoCif()+$cargoC->getFleteCif()+$cargoC->getPrimaCif()) , 2, ',','.')."</div>
                                 </td>
                             </tr>
                             <tr>
                                 <td></td>
                                 <td align='right'><button class='btn btn-default btn-sm' title='Guarda los cambios' type='button'onclick=".'"'."ModificaRemesa();".'""'." ><span class='glyphicon glyphicon-plus-sign'></span></button></td>
                             </tr>
                        </table>
                        

");
                            
                            
                        
                        
                        exit();
?>
