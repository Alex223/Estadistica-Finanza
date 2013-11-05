
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script  src="/bootstrap/js/validarut.js"></script>
       
           <script>
            
            
            function dobleclick(id,objetivo,idReg){
       
                 var acceso = document.getElementById('editor');  
                 
                 if (acceso === null){
                var columna =  document.getElementById(id).getAttribute('name');
                var dato = document.getElementById(id);
               var cuadro_editador;
              if(columna === 'RUT') { cuadro_editador = "<input max='10'maxlength='10' class='form-control' onkeypress="+'"'+"unfocus(event)"+";"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'><span id='idReg' name='"+idReg+"'></span> <button class='btn btn-default' type='button'onclick="+'"'+"ModificaIngreso();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input>"; }
              else {  cuadro_editador  ="<input class='form-control' onkeypress="+'"'+"unfocus(event)"+";"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default' type='button'onclick="+'"'+"ModificaIngreso();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";}
               document.getElementById(objetivo).innerHTML=cuadro_editador;
               $( "#editor" ).focus();
           }
           
           }
             
             function TeclearEnter(e) {
                  
                  if (e.keyCode === 13) { $( "#editor" ).focus();}
              
                                      }
             
             
            /*function TeclearEnter(e) {
                  
                  if (e.keyCode === 13) {
                      var columna = document.getElementById('editor').getAttribute('name');
                      var dato = document.getElementById('editor').getAttribute('placeholder').trim();
                      var dato2 = document.getElementById('editor').value;
                      var idReg = document.getElementById('idReg').getAttribute('name');
                   
                     
                   if( dato === dato2){
                       
                       alert("Es el mismo dato! '"+dato+"'" );
                       
                       cargarPHP( '/Contralador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );  
                     
                   }
                   
                   else{
                       
                       alert('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                       
                      
                       $.ajax({
                        type:"POST",
                        url: "/Contralador/Usuarios/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato}
                        }).done(function(msg){
                        alert(msg);
                        });
                        
                     cargarPHP( '/Contralador/Usuarios/Listado_Usuario.php','#contenido_dinamico' ); 
                       
                       
                      
                       
                   }
                   
                           
                                         }
                                         
                    
                };
                
                */
                
                
                function ModificaIngreso(){
                  
                  
                      var columna = document.getElementById('editor').getAttribute('name');
                      var dato = document.getElementById('editor').getAttribute('placeholder').trim();
                      var dato2 = document.getElementById('editor').value;
                      var idReg = document.getElementById('idReg').getAttribute('name'); 
                   
                     if (dato2 === ""){
                         alert('Se debe ingresar datos!');
                     }else{
                   if( dato === dato2){
                       
                       alert("Es el mismo dato! '"+dato+"'" );
                       
                       cargarPHP( '/Contralador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );  
                     
                   }
                   
                   else{
                       
                       var r=confirm('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                        url: "/Contralador/Usuarios/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                        cargarPHP( '/Contralador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );
                             
                         }
                            
                    }     
                   }
                                         
                    
                };
                
                
                
                
                
                
                
    
    function eliminar(id){
    
    
         //window.confirm("Desea Realmente eliminar el registro "+ id);
         
         var r=confirm("¿Desea eliminar definitivamente el registro "+id.toString()+"?");
            if (r === true)
              {
                  
                        $.ajax({
                        type:"POST",
                        url: "/Contralador/Usuarios/EliminarUsuario.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        });
                  
             
              }
           
           cargarPHP( '/Contralador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );
    
    
    }
    function IngresarFila(){
    
    
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso' type='text' max='10' maxlength='10' placeholder='Rut...'/></td><td><input class='form-control'  id='ingreso2' type='text' placeholder='Primer Nombre...'/></td><td><input class='form-control'  id='ingreso3' type='text' placeholder='Segundo Nombre...'/></td><td><input class='form-control'  id='ingreso4' type='text' placeholder='Apellido Parteno...'/></td><td><input class='form-control'  id='ingreso5' type='text' placeholder='Apellido Materno...'/></td><td><input  class='form-control' id='ingreso6' type='text' placeholder='Nick'/></td><td><input  class='form-control' id='ingreso7' type='text' placeholder='Contraseña'/></td><td><input  class='form-control' id='ingreso8' type='text' placeholder='Cargo'/></td><td><button class='btn btn-default' type='button'onclick="+'"'+"validaIngresoCliente('ingreso','ingreso2','ingreso3','ingreso4','ingreso5','ingreso6','ingreso7','ingreso8');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td></tr>";
        
  
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;

               $( "#ingreso" ).focus();
    
    }
    function validaIngresoCliente(ingreso,ingreso2,ingreso3,ingreso4,ingreso5,ingreso6,ingreso7,ingreso8){
        
        var validador=1;
        var alerta="";
    
        //var rut = false;
        var dato = document.getElementById(ingreso).value;// rut
        var dato2 = document.getElementById(ingreso2).value.trim();//nombre_1
        var dato3 = document.getElementById(ingreso3).value.trim();//nombre_2
        var dato4 = document.getElementById(ingreso4).value.trim();//ap_pa
        var dato5 = document.getElementById(ingreso5).value.trim();//ap_ma
        var dato6 = document.getElementById(ingreso6).value.trim();//USER_LOGIN
        var dato7 = document.getElementById(ingreso7).value.trim();//PASSWORD
        var dato8 = document.getElementById(ingreso8).value.trim();//id_cargo
        
        if(dato === ""){validador=0;alerta+="Falta ingresar el rut!\n";}else{ 
          // alert(dato.substring(0,8)+" - "+dato.substring(9,10)+" lo que esta "+!validarut(dato.substring(0,8),dato.substring(9,10))); 
        if(!validarut(dato.substring(0,8),dato.substring(9,10))){validador=0;alerta+="rut no valido!\n";}
                                                                             }
        if(dato2 === ""){validador=0;alerta+="Falta ingresar el primer nombre!\n";}
        if(dato3 === ""){validador=0;alerta+="Falta ingresar el segundo nombre!\n";}
        if(dato4 === ""){validador=0;alerta+="Falta ingresar el apellido paterno!\n";}
        if(dato5 === ""){validador=0;alerta+="Falta ingresar el apellido materno!\n";}
        if(dato6 === ""){validador=0;alerta+="Falta ingresar el Nick!\n";}
        if(dato7 === ""){validador=0;alerta+="Falta ingresar el Contraseña!\n";}
        if(dato8 === ""){validador=0;alerta+="Falta ingresar el cargo!\n";}
        
        if(validador === 0 ){
            
            alert(alerta);
            
        }else{  
                        $.ajax({
                        type:"POST",
                        url: "/Contralador/Usuarios/CreaUsuario.php",
                        data:{RUT:dato.substring(0,8),
                            RUT_DV:dato.substring(9,10),
                            NOMBRE_1:dato2,
                            NOMBRE_2:dato3,
                            AP_PA:dato4,
                            AP_MA:dato5,
                            USER_LOGIN:dato6,
                            PASSWORD:dato7,
                            id_cargo:dato8
                        }
                        }).done(function(msg){
                        alert(msg);
                        });
                        
                       cargarPHP( '/Contralador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );
               }
    }

        function unfocus(e){
        
        if (e.keyCode === 27) {
        
       cargarPHP( '/Contralador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );
        }
    
    }

        </script> 
        <?php
require_once '../../Modelo/Negocio.php';
 
//$neg = new Negocio();

    
?>
        
    </head>
    <body>
        
        <h1></h1>
      <form class="">
            
                <div  class="form-horizontal">
                  <!-- Default panel contents -->
                  <div class="panel-heading" style="text-align: left; background:#639BF8"><h1>Usuarios </h1></div>
            
                 
                  <!-- Tabla dinaminca de usuarios -->
               
                      
                  <div id='contenido_tabla'>
                  
                      
                      
                 <?php
                 
                     echo("   <table class='table table-striped'> 
                          
                      <tr>
                          <td><b> ID</b> </td><td><b>Rut</b></td><td><b> Primer Nombre </b></td><td><b> Segundo Nombre </b></td><td><b> Apellido Paterno </b></td><td><b> Apellido Materno </b></td><td><b> Nick </b></td><td><b> Contraseña </b></td><td><b> Cargo </b></td><td><b> </b> </td>
                          
                      </tr>");
                 
                 
                     ?>
                     
            
                      
                       <?php   
                       
                                              
                        $conexión = mysql_connect("localhost", "root", "1234");

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql1 = "SELECT * FROM usuario";

                        $resultado1 = mysql_query($sql1);

                        if (!$resultado1) {
                            echo "No se pudo ejecutar con exito la consulta ($sql1) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado1) == 0) {
                        //    echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                          //   exit;

                           
                            
                        }
                         $fila1=0;
                         $indice=1;
                    
                        
                                while ($fila1 = mysql_fetch_assoc($resultado1)) {





                                echo("
                            
                                <tr>
                                <td><div id='id_".$indice."'> <a  href='#'><span id='id2_".$indice."' ondblclick=" .'"'."dobleclick('id_".$indice."','id2_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['ID_USUARIO']."</span></a></div></td>
                                <td><div id='id3_".$indice."'><span name='RUT' id='id4_".$indice."' ondblclick=" .'"'."dobleclick('id4_".$indice."','id3_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['RUT']."-".$fila1['RUT_DV']."</span></div></td>
                                <td><div id='id5_".$indice."'><span name='NOMBRE_1' id='id6_".$indice."' ondblclick=" .'"'."dobleclick('id6_".$indice."','id5_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['NOMBRE_1']."</span></div> </td>
                                <td><div id='id7_".$indice."'><span name='NOMBRE_2' id='id8_".$indice."' ondblclick=" .'"'."dobleclick('id8_".$indice."','id7_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['NOMBRE_2']."</span></div></td>    
                                <td><div id='id9_".$indice."'><span name='AP_PA' id='id10_".$indice."' ondblclick=" .'"'."dobleclick('id10_".$indice."','id9_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['AP_PA']."</span></div> </td>
                                <td><div id='id11_".$indice."'><span name='AP_MA' id='id12_".$indice."' ondblclick=" .'"'."dobleclick('id12_".$indice."','id11_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['AP_MA']."</span></div> </td>
                                <td><div id='id13_".$indice."'><span name='USER_LOGIN' id='id14_".$indice."' ondblclick=" .'"'."dobleclick('id14_".$indice."','id13_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['USER_LOGIN']."</span></div> </td>
                                <td><div  onkeypress='TeclearEnter(event);'  id='id15_".$indice."'><span name='PASSWORD' id='id16_".$indice."' ondblclick=" .'"'."dobleclick('id16_".$indice."','id15_".$indice."','".$fila1['ID_USUARIO']."')".';"'.">".$fila1['PASSWORD']."</span></div> </td>
                                <td>  Ejecutivo de comex</td>
                                <td><button class='btn btn-default' type='button' onclick=".'"'."eliminar(".$fila1['ID_USUARIO'].");".'""'."><span class='glyphicon glyphicon-remove-sign'></span></button></td>
                                </tr> 

"); 
                                
                                $indice=$indice + 1;
                                }
                                
                             
                      ?> 
                 
                       <?php
                       
                          echo("<tr id='filaIngreso'>
                                         <td><button class='btn btn-default' type='button'onclick=".'"'."IngresarFila();".'""'." ><span class='glyphicon glyphicon-plus-sign'> Agregar</span></button></td><td colspan='9'></td>
                                    </tr>");
                                
                                echo("</table>");
                       ?>
                        <h2>Total registros 
                            
                            
                            
                            
                            
                            
                            <?php 





                        
                        
                        //------------------------------------

                      

                        if (!$conexión) {
                            echo "No pudo conectarse a la BD: " . mysql_error();
                            exit;
                        }

                        if (!mysql_select_db("prueba")) {
                            echo "No ha sido posible seleccionar la BD: " . mysql_error();
                            exit;
                        }

                        $sql = "SELECT COUNT(*) FROM usuario";

                        $resultado = mysql_query($sql);

                        if (!$resultado) {
                            echo "No se pudo ejecutar con exito la consulta ($sql) en la BD: " . mysql_error();
                            exit;
                        }

                        if (mysql_num_rows($resultado) == 0) {
                            echo "No se han encontrado filas, nada a imprimir, asi que voy a detenerme.";
                            exit;
                        }
                                while ($fila = mysql_fetch_assoc($resultado)) {

                                echo ($fila['COUNT(*)']);           

                                }  
        
        
        ?>    </h2>
                 </div>
                  

        
         
                   
        </div>

       
           </form>  
    </body>
</html>