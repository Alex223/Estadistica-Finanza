

  function ModificaIngreso(){
      
       var columna = document.getElementById('editor').getAttribute('name');
       
                    if (columna !== "Cargo"){
                  
                     
                      var dato = document.getElementById('editor').getAttribute('placeholder').trim();
                      var dato2 = document.getElementById('editor').value;
                      var idReg = document.getElementById('idReg').getAttribute('name'); 
                      
                    
                   
                     if (dato2 === ""){
                         alert('Se debe ingresar datos!');
                     }else{
                   if( dato === dato2){
                       
                       alert("Es el mismo dato! '"+dato+"'" );
                       
                       cargarPHP( '/Controlador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );  
                     
                   }
                   
                   else{
                       
                       var r=confirm('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                        url: "/Controlador/Usuarios/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                        cargarPHP( '#contenido_dinamico', '/Vista/Usuarios/Listado_Usuarios.html' );
                             
                         }
                            
                    }     
                   }
                                         
                    
                }else{
                    
                      var dato = document.getElementById('elegido').value;
                      var dato2 = document.getElementById('selecion').value;
                      
                      alert(dato+" a "+ dato2);
                    
                }
            

}
                
                
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
                  
                  if (e.keyCode === 13) { cargarPHP( '/Controlador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );  ;
              
                                      }
                                  
    }
             
            
    
    function eliminar(id){
    
    
         //window.confirm("Desea Realmente eliminar el registro "+ id);
         
         var r=confirm("¿Desea deshabilitar el usuario "+id.toString()+"?");
            if (r === true)
              {
                  
                        $.ajax({
                        type:"POST",
                        url: "/Controlador/Usuarios/EliminarUsuario.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        });
                  
             
              }
           
         cargarPHP( '#contenido_dinamico', '/Vista/Usuarios/Listado_Usuarios.html' );
    
    
    }
    function IngresarFila(){
    
    
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso' type='text' max='10' maxlength='10' placeholder='Rut...'/></td><td><input class='form-control'  id='ingreso2' type='text' placeholder='Primer Nombre...'/></td><td><input class='form-control'  id='ingreso3' type='text' placeholder='Segundo Nombre...'/></td><td><input class='form-control'  id='ingreso4' type='text' placeholder='Apellido Parteno...'/></td><td><input class='form-control'  id='ingreso5' type='text' placeholder='Apellido Materno...'/></td><td><input  class='form-control' id='ingreso6' type='text' placeholder='Nick'/></td><td><input  class='form-control' id='ingreso7' type='text' placeholder='Contraseña'/></td><td><input  class='form-control' id='ingreso8' type='text' placeholder='Cargo'/></td><td><button class='btn btn-default' type='button'onclick="+'"'+"validaIngresoCliente('ingreso','ingreso2','ingreso3','ingreso4','ingreso5','ingreso6','ingreso7','ingreso8');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td></tr>";
        
  
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;

               $( "#ingreso" ).focus();
    
    }
    function validaIngresoCliente(ingreso,ingreso2,ingreso3,ingreso4,ingreso5,ingreso6,ingreso7,ingreso8){
        
        var validador=1;
        var alerta="";
    
        
        var dato = document.getElementById(ingreso).value;// rut
        var dato2 = document.getElementById(ingreso2).value.trim();//nombre_1
        var dato3 = document.getElementById(ingreso3).value.trim();//nombre_2
        var dato4 = document.getElementById(ingreso4).value.trim();//ap_pa
        var dato5 = document.getElementById(ingreso5).value.trim();//ap_ma
        var dato6 = document.getElementById(ingreso6).value.trim();//USER_LOGIN
        var dato7 = document.getElementById(ingreso7).value.trim();//PASSWORD
        var dato8 = document.getElementById(ingreso8).value.trim();//id_cargo
        
        if(dato === ""){validador=0;alerta+="Falta ingresar el rut!\n";}else{ 
         
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
                        url: "/Controlador/Usuarios/CreaUsuario.php",
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
                        
                       cargarPHP( '#contenido_dinamico', '/Vista/Usuarios/Listado_Usuarios.html');
               }
    }

        function unfocus(e){
        
        if (e.keyCode === 27) {
        
        cargarPHP( '#contenido_dinamico','/Vista/Usuarios/Listado_Usuarios.html' );
        }
    
    }
function listarUsuarios(id){
    
    
      $.ajax({
                        type:"POST",
                        url: "/Controlador/Usuarios/ListarUsuarios.php",
                        data:{}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML += msg;
                       
                        });

    
    
}

                            
      function paginacion(tabla,id){
          
              $.ajax({
                        type:"POST",
                        url: "/Controlador/Paginacion/paginacion.php",
                        data:{tabla:tabla}
                        }).done(function(msg){
                          
                            document.getElementById(id).innerHTML +="Total Registro(s) "+msg;
                       
                        });
          
          
      }                  
                               
 
          
          
      
           
            function cargarL(pagina, id, divIdentificador)
                {
                    $.ajax({
                        async: true,
                        dataType: "html",
                        method: "post",
                        contentType: "application/x-www-form-urlencoded",
                        data: "id=" + id,
                        url: pagina + ".html",// ".php",
                        beforeSend: function() {
                            var x = $('#' + divIdentificador);
                            x.html("'<br>...<br>'");
                           //x.html(""<br>...<br>"");
                        },
                        success: function(datos) {

                            $('#' + divIdentificador).html(datos);

                        },
                        timeout: 20000,
                        error: function() {
                            var x = $('#' + divIdentificador);
                            x.html("<br>Error<br>");

                        }
                    });
                    return false;
                }        

       
            
            function cargarPHP(divIdentificador, pagina)
                {
                var url=pagina;
                    $.ajax({   
                        type: "POST",
                        url:url,
                        data:{},
                        success: function(datos){       
                            $(divIdentificador).html(datos);
                        }
                    });
                } 
                
               function exit(id){
                 var r;
               if (id===0){ r=confirm('¿Desea cambiar de usuario?'); }
               else{r=confirm('¿Desea salir de la sesión?'); }
               
            
               
               if (r === true){
                  var url="/Controlador/CerrarSeccion/CerrarSeccion.php";
                    $.ajax({   
                        type: "POST",
                        url:url,
                        data:{},
                        success: function(){       
                        redireccionar('/index.html').setTimeout ('redireccionar()', 0);
                        }
                    });
                
               }  
               
               }
               
               function redireccionar(url){location.href=url;};
               
               
               
               function ValidaVacio(){
          valor0 = document.getElementById("cont0").value.trim();
          valor = document.getElementById("cont1").value.trim();
          valor1 = document.getElementById("cont2").value.trim();
          
          var mensaje="";
          var filtro=0;
          if(valor0.length === 0){mensaje += "Se debe ingresar la contraseña actual!\n";filtro=1;}
          if(valor.length === 0){mensaje += "Se debe ingresar una nueva contraseña!\n";filtro=1;}
          if(valor1.length === 0){mensaje += "Se debe confirmar la nueva contraseña!\n";filtro=1;}
              
             if (filtro===0){
                if(valor!==valor1){
                    alert("Las contraseñas ingresadas debe ser iguales!");
                }else{
                    
                    ///query contraseña valida
                    
                    validaContrasena(valor0,valor1);
                    
                    
                }     
                 
             }else{
                 
                 alert(mensaje);
                 
             }
              
              
             
              
              
          
    }
               
               
               function validaContrasena(pass, nuevaPass){
                   
                  var r=confirm('¿Desea realmente actualizar la contraseña?');
                   if (r === true){
                       
                  var url="/Controlador/ValidaContrasena/ValidaContrasena.php";
                    $.ajax({   
                        type: "POST",
                        url:url,
                        data:{cont0:pass,cont1:nuevaPass},
                        success: function(ms){   
                     
                            
                            if(ms === "0"){ alert("Contraseña actual invalida!");}
                            else{
                                if(ms === "1"){
                                    alert("Contraseña actualizada.");
                                    redireccionar('/Marco.html').setTimeout ('redireccionar()', 0);
                                }else{
                                    
                                    alert(ms);
                                }
                                //alert("Contraseña actualizada.");
                               // 
                            }
                            
                           
                        }
                    });
                       
                       
                   }
                   
               }
               
               
               ///LISTAR BANCOS
               
               function listarBancos(id){
    
    
      $.ajax({
                        type:"POST",
                        url: "/Controlador/Bancos/ListarBancos.php",
                        data:{}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML += msg;
                       
                        });

               }
    