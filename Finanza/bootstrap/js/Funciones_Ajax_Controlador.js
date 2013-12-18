

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
                       
                       cargarPHP( '/Estadistica-Finanza/Finanza/Controlador/Usuarios/Listado_Usuario.php','#contenido_dinamico' );  
                     
                   }
                   
                   else{
                       
                       var r=confirm('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Usuarios/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                        cargarPHP( '#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Usuarios/Listado_Usuarios.html' );
                             
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
              if(columna === 'RUT') { cuadro_editador = "<input max='10'maxlength='10' class='form-control' onkeypress="+'"'+"unfocus(event)"+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'><span id='idReg' name='"+idReg+"'></span> <button class='btn btn-default' type='button'onclick="+'"'+"ModificaIngreso();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input>"; }
              else {  cuadro_editador  ="<input class='form-control' onkeypress="+'"'+"unfocus(event)"+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default' type='button'onclick="+'"'+"ModificaIngreso();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";}
               document.getElementById(objetivo).innerHTML=cuadro_editador;
               $( "#editor" ).focus();
           }
           
           }
             
             function TeclearEnter(e) {
                  
                  if (e.keyCode === 13) { alert('es  enter'); 
              
                                      }
                                  
    }
             
            
    
    function eliminar(id){
    
    
         //window.confirm("Desea Realmente eliminar el registro "+ id);
         
         var r=confirm("¿Desea deshabilitar el usuario "+id.toString()+"?");
            if (r === true)
              {
                  
                        $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Usuarios/EliminarUsuario.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        });
                  
             
              }
           
         cargarPHP( '#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Usuarios/Listado_Usuarios.html' );
    
    
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
                        url: "/Estadistica-Finanza/Finanza/Controlador/Usuarios/CreaUsuario.php",
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
                        
                       cargarPHP( '#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Usuarios/Listado_Usuarios.html');
               }
    }


function listarUsuarios(id){
    
    
      $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Usuarios/ListarUsuarios.php",
                        data:{}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML += msg;
                       
                        });

    
    
}

                            
      function paginacion(tabla,id){
          
              $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Paginacion/paginacion.php",
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
                  var url="/Estadistica-Finanza/Finanza/Controlador/CerrarSeccion/CerrarSeccion.php";
                    $.ajax({   
                        type: "POST",
                        url:url,
                        data:{},
                        success: function(){       
                        redireccionar('/Estadistica-Finanza/Finanza/index.html').setTimeout ('redireccionar()', 0);
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
                       
                  var url="/Estadistica-Finanza/Finanza/Controlador/ValidaContrasena/ValidaContrasena.php";
                    $.ajax({   
                        type: "POST",
                        url:url,
                        data:{cont0:pass,cont1:nuevaPass},
                        success: function(ms){   
                     
                            
                            if(ms === "0"){ alert("Contraseña actual invalida!");}
                            else{
                                if(ms === "1"){
                                    alert("Contraseña actualizada.");
                                    redireccionar('/Estadistica-Finanza/Finanza/Marco.html').setTimeout ('redireccionar()', 0);
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
                        url: "/Estadistica-Finanza/Finanza/Controlador/Bancos/ListarBancos.php",
                        data:{}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML += msg;
                       
                        });

               }
    function IngresarFilaBanco(){
        
        
        
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso'placeholder='Nombre banco...'/></td><td><input class='form-control'  id='ingreso2' type='text' placeholder='Numero Cuenta...'/></td><td><input class='form-control'  id='ingreso3' type='text' placeholder=' Saldo...'/></td><td id='SelectBox'><div>SelectBox</div></td><td><button class='btn btn-default' type='button' onclick="+'"'+"validaIngresoBanco('ingreso','ingreso2','ingreso3');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td></tr>";
        
  
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;
   
    generaSelecBox('1','ingreso','/Estadistica-Finanza/Finanza/Controlador/Bancos/SelectBoxBancos.php','tipo_moneda','ID_TIPO_MONEDA','NOMBRETM','SelectBox',1,"no importa");

             //  $( "#ingreso" ).focus();
    
    }
        
        
    function generaSelecBox(edita_o_ingresa,objetivoFocus ,url,tabla, tipoId, tipoTitulo,objetivo,idReg, TituloSelect){
     
    
      $.ajax({
          
          
                        type:"POST",
                        url: url,
                        data:{id:idReg,tabla:tabla,tipoId:tipoId,tipoTitulo:tipoTitulo,edita_o_ingresa:edita_o_ingresa,TituloSelect:TituloSelect}
                        
                        }).done(function(msg){
                        
                        
                         var list=document.getElementById(objetivo);
                              list.removeChild(list.childNodes[0]);
                              
                            
                          document.getElementById(objetivo).innerHTML  += msg;
                          $( "#"+objetivoFocus ).focus();
                       
                        });
        
        

    }    
    
    
            function dobleclickB(id,objetivo,idReg){
       
                 var acceso = document.getElementById('editor');  
                 
                 if (acceso === null){
                     
                     
                var columna =  document.getElementById(id).getAttribute('name');
                var dato = document.getElementById(id);
                 var cuadro_editador;
              
                  if (columna === 'TIPO_MONEDA'){
                          
                      generaSelecBox('0','seleccion','/Estadistica-Finanza/Finanza/Controlador/Bancos/SelectBoxBancos.php','tipo_moneda','ID_TIPO_MONEDA','NOMBRETM',objetivo,idReg, dato.innerHTML);
                  }else{
              
                cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocusb(event) "+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default' type='button'onclick="+'"'+"ModificaIngresoBanco();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";
                  
                document.getElementById(objetivo).innerHTML=cuadro_editador;
                $( "#editor" ).focus();
            
                    }
           }
                 
           }
        
       function unfocusb(e){
          
           if (e.keyCode === 27) {
       
              cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
        }
        
   

}
    
        function unfocus(e){
        
        if (e.keyCode === 27) {
        
        cargarPHP( '#contenido_dinamico','/Estadistica-Finanza/Finanza/Vista/Usuarios/Listado_Usuarios.html' );
        }
    
    }
    
 function ModificaIngresoBanco(){

       var columna = document.getElementById('editor').getAttribute('name');
       
                    if (columna !== "TIPO_MONEDA"){
                  
                     
                      var dato = document.getElementById('editor').getAttribute('placeholder').trim();
                      var dato2 = document.getElementById('editor').value;
                      var idReg = document.getElementById('idReg').getAttribute('name'); 
                      
                    
                   
                     if (dato2 === ""){
                         alert('Se debe ingresar datos!');
                     }else{
                   if( dato === dato2){
                       
                       alert("Es el mismo dato! '"+dato+"'" );
                       
                        cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
                     
                   }
                   
                   else{
                       
                       var r=confirm('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Bancos/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                          cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
                             
                         }
                            
                    }     
                   }
                                         
                    
                }else{
                 
                    
                    var id = document.getElementById("seleccion").value;
                    var idReg = document.getElementById('idReg').getAttribute('name');
                    var anterior =  document.getElementById("seleccionado").value;
                      
                    
                    if (anterior===id){
                         alert("Es el mismo dato!");
                       
                        cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
                       
                        
                    }
                    
                    else{
                        
                        
                             
                       var r=confirm('¿desea realmente modificar el registro?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Bancos/ModificaRegistro.php",
                        data:{id:idReg,col:'tipo_moneda_ID_TIPO_MONEDA',valor:id}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                          cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
                             
                         }
                        
                    }
                   
                   
                }
            

     
 }

 
function validaIngresoBanco(dato,dato1,dato2){
    
    var campo1 = document.getElementById(dato).value;
    var campo2 = document.getElementById(dato1).value;
    var campo3 = document.getElementById(dato2).value;
    
    var control = 0;
    var mensaje = "";
    if (campo1 ===""){mensaje +='Falta nombre banco!\n';control=1;}
    if (campo2 ===""){mensaje +='Falta Numero cuenta!\n';control=1;}
    if (campo3 ===""){mensaje +='Falta Saldo!\n';control=1;}
    
    if(control===0){
        var campo4 = document.getElementById('seleccion').value;
        
                
                       var r=confirm('¿Desea realmente ingresar un nuevo registro?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Bancos/IngresaBanco.php",
                        data:{nombre:campo1,numero:campo2,saldo:campo3,tipo:campo4}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                          cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
                             
                         }
        
    }else{alert(mensaje);}
    
}


//*********************** Modulos Cargos*************************************

function listarCargos(id){
          $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Cargos/ListarCargos.php",
                        data:{}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML += msg;
                       
                        });
    
}



            function dobleclickC(id,objetivo,idReg){
       
                 var acceso = document.getElementById('editor');  
                 
                 if (acceso === null){
                     
                     
                var columna =  document.getElementById(id).getAttribute('name');
                var dato = document.getElementById(id);
                 var cuadro_editador;
              
               cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocusc(event) "+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default' type='button'onclick="+'"'+"ModificaIngresoCargo();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";
                  
                document.getElementById(objetivo).innerHTML=cuadro_editador;
                $( "#editor" ).focus();
            
                    
           }
                 
           }
        
       function unfocusc(e){
          
           if (e.keyCode === 27) {
       
              cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Cargos/Listado_Cargos.html' );
        }
    
       
      }
      
      
       function ModificaIngresoCargo(){

                      var columna = document.getElementById('editor').getAttribute('name');
                      var dato = document.getElementById('editor').getAttribute('placeholder').trim();
                      var dato2 = document.getElementById('editor').value;
                      var idReg = document.getElementById('idReg').getAttribute('name'); 
                      
                    
                   
                     if (dato2 === ""){
                         alert('Se debe ingresar datos!');
                     }else{
                   if( dato === dato2){
                       
                       alert("Es el mismo dato! '"+dato+"'" );
                       
                         cargarPHP( '#contenido', '/Vista/Cargos/Listado_Cargos.html' );
                     
                   }
                   
                   else{
                       
                       var r=confirm('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Cargos/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                          cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Cargos/Listado_Cargos.html' );
                             
                         }
                            
                    }     
                   }
                                         
          }
          
      function IngresarFilaCargo(){
        
        
        
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso'placeholder='Titulo...'/></td><td><input class='form-control'  id='ingreso2' type='text' placeholder='Descripcion...'/></td><td><button class='btn btn-default' type='button' onclick="+'"'+"validaIngresoCargo('ingreso','ingreso2');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td></tr>";
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;
    $( "#ingreso" ).focus();
    
    }
    
    
          
function validaIngresoCargo(dato,dato1){
    
    var campo1 = document.getElementById(dato).value;
    var campo2 = document.getElementById(dato1).value;
    
    
    var control = 0;
    var mensaje = "";
    if (campo1 ===""){mensaje +='Falta nombre cargo!\n';control=1;}
    if (campo2 ===""){mensaje +='Falta Descripcion del titulo!\n';control=1;}

    
    if(control===0){
        
        
                
                       var r=confirm('¿Desea realmente ingresar un nuevo registro?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Cargos/IngresaCargo.php",
                        data:{Titulo:campo1,Descripcion:campo2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                           cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Cargos/Listado_Cargos.html' );
                             
                         }
        
    }else{alert(mensaje);}
    
}

//******************Modulo Tipo Monedas**************************************

function listarTipoMonedas(id){
          $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/TipoMonedas/ListarTipoMonedas.php",
                        data:{}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML += msg;
                       
                        });
    
}


  function dobleclickTM(id,objetivo,idReg){
       
                 var acceso = document.getElementById('editor');  
                 
                 if (acceso === null){
                     
                     
                var columna =  document.getElementById(id).getAttribute('name');
                var dato = document.getElementById(id);
                 var cuadro_editador;
              
               cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocustm(event) "+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default' type='button'onclick="+'"'+"ModificaIngresoTipoMoneda();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";
                  
                document.getElementById(objetivo).innerHTML=cuadro_editador;
                $( "#editor" ).focus();
            
                    
           }
                 
           }
        
       function unfocustm(e){
          
           if (e.keyCode === 27) {
       
              cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Monedas/Listado_Monedas.html' );
        }
    
       
      }
    
       function ModificaIngresoTipoMoneda(){

                      var columna = document.getElementById('editor').getAttribute('name');
                      var dato = document.getElementById('editor').getAttribute('placeholder').trim();
                      var dato2 = document.getElementById('editor').value;
                      var idReg = document.getElementById('idReg').getAttribute('name'); 
                      
                    
                   
                     if (dato2 === ""){
                         alert('Se debe ingresar datos!');
                     }else{
                   if( dato === dato2){
                       
                       alert("Es el mismo dato! '"+dato+"'" );
                       
                          cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Monedas/Listado_Monedas.html' );
                     
                   }
                   
                   else{
                       
                       var r=confirm('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/TipoMonedas/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                           cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Monedas/Listado_Monedas.html' );
                             
                         }
                            
                    }     
                   }
                                         
          }
          
  function IngresarFilaTipoMoneda(){
        
        
        
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso'placeholder='Nombre Moneda...'/></td><td><button class='btn btn-default' type='button' onclick="+'"'+"validaIngresoTipoMoneda('ingreso');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td></tr>";
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;
    $( "#ingreso" ).focus();
    
    }
    
    function validaIngresoTipoMoneda(dato){
    
    var campo1 = document.getElementById(dato).value;
   
    
    
    var control = 0;
    var mensaje = "";
    if (campo1 ===""){mensaje +='Falta nombre tipo moneda!\n';control=1;}
   

    
    if(control===0){
        
        
                
                       var r=confirm('¿Desea realmente ingresar un nuevo registro?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/TipoMonedas/IngresaTipoMoneda.php",
                        data:{Nombre:campo1}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Monedas/Listado_Monedas.html' );
                             
                         }
        
    }else{alert(mensaje);}
    
}

//******************************* Modulo Bancos****************************************

function CargasSeleccion(lugar,id){
    
           
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/ModuloBancos/SeleccionBancos.php",
                        data:{id:id}
                        }).done(function(msg){document.getElementById(lugar).innerHTML = msg;}); 
                    
                            }

                         
                             
                         
    
    //ListarModuloBancos lista los flujos de un bancos según el día indicado, en el lugar especificado.
    //por defecto la fecha la inicia la vista, luego la tabla trabaja con la fecha.

 function ListaModuloBanco(lugar, seleccionado, fecha){
   
      
      $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/ModuloBancos/ListarModuloBancos.php",
                        data:{fecha: fecha, seleccionado:seleccionado}
                        }).done(function(msg){
     
                                
                         if (msg === "no hay bancos"){
                             
                            //no hay ningún banco ingresado
                            alert("No hay registros de Bancos, se debe ingresar primero al menos uno, en el modulo datos parametricos!");
                            cargarPHP('#contenido_dinamico','/Estadistica-Finanza/Finanza/Vista/Modulo_Parametricos/Parametricos.html');
                            
                        }else{
                        
                         document.getElementById(lugar).innerHTML = msg;  
                         
                          
                        }
                        
                        
                                         });
 
                
                                                  }


//***************************Modulo Bancos ******************************************



//***************Modulo Remesas**************************
function validaRegistrosAduana(){
    
    $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/RemesasAduanas/ValidaRegistros.php",
                        data:{}
                        }).done(function(msg){
                          
                         mensaje;  
                    if (msg !== "1"){
                       
                        if(msg ==="2") {mensaje +="Falta un tipo derecho!";}
                        if(msg ==="3") {mensaje +="Falta un tipo carga!";}
                        alert(mensaje);
                           cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Modulo_Parametricos/Parametricos.html');
                    }    
                    
                    });
                       
                   
    
    
}

function listarRemesaAduanas(id){
    
    
         $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/RemesasAduanas/ListadoRemesaAduanas.php",
                        data:{}
                        }).done(function(msg){document.getElementById(id).innerHTML += msg;});
                       
                            
    
}



function IngresarFilaAduana(){
   
   var tipoDerecho = selectTipoDerecho('ingreso3','crea'); 
   var filaIngreso ="<tr>\n\
                     <td></td>\n\
                     <td><input class='form-control' id='ingreso' placeholder='Carpeta...'/></td> \n\
                     <td colspan='2'><input class='form-control' id='ingreso1' placeholder='Proveedor...'/></td> \n\
                     <td colspan='4'>\n\
                     <table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>\n\
                     <tr><td colspan='2'>Datos Costo Cif</td></tr>\n\
                     <tr>\n\
                       <td>Cif: </td><td><input class='form-control' onchange="+'"'+"sumaCif()"+'"'+" id='ingreso2_1' placeholder='Costo Cif...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                       <td>Flete: </td><td><input class='form-control' onchange="+'"'+"sumaCif()"+'"'+" id='ingreso2_2' placeholder='Costo Flete...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                       <td>Prima: </td><td><input class='form-control' onchange="+'"'+"sumaCif()"+'"'+" id='ingreso2_3' placeholder='Costo Prima...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                      <td>Costo Cif: </td><td><div id='totalCif'></div></td>\n\
                     </tr>\n\
                     </table></td>\n\
                     <td><div >Estado Bodega</div><div id='ingreso3'></div></td>\n\
                     <td colspan='3'><input class='form-control' id='ingreso4' placeholder='Otro Cargo...'/></td>\n\
                     <td colspan='2'><input class='form-control' id='ingreso5' placeholder='Fecha...'/></td>\n\
                     <td colspan='3'><input class='form-control' id='ingreso6' placeholder='Carpeta Relacionada...'/></td>\n\
                     <td><button class='btn btn-default' type='button' onclick="+'"'+"cancelaIngreso();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td>\n\
                     <td><button class='btn btn-default' type='button' onclick="+'"'+"validaIngresoAduana('ingreso','ingreso1','ingreso2_1','ingreso2_2','ingreso2_3','seleccion','ingreso4','ingreso5','ingreso6');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></td>\n\
                     <td colspan='11'></td>\n\
                      </button>\n\
                     </td>\n\
                     </tr>";
    document.getElementById('filaIngreso').innerHTML=filaIngreso;
    $( "#ingreso" ).focus();
}

function sumaCif(){
    
    
    var cif1 = document.getElementById('ingreso2_1').value+"";
    var cif2 = document.getElementById('ingreso2_2').value+"";
    var cif3 = document.getElementById('ingreso2_3').value+"";
    var total=0.0; 
    
    
    if (cif1===""){cif1=0;}
    if (cif2===""){cif2=0;}
    if (cif3===""){cif3=0;}
    try{
    total = parseFloat(cif1)+parseFloat(cif2)+parseFloat(cif3);
} 
catch(error){
    
 
}
 if(isNaN(total)){
       alert("Debes ingresar solo números!");
       $( "#ingreso2_1" ).focus();
     
 }
 document.getElementById('totalCif').innerHTML=total;

}

function selectTipoDerecho(id,tipo){
    
     $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/TiposDerechos/SelectTiposDerechos.php",
                        data:{tipo:tipo}
                        }).done(function(msg){
                            if(msg === "0"){ 
                                alert("No hay registros de Tipo Derecho, se debe ingresar primero al menos uno, en el modulo datos parametricos!");
                                cargarPHP('#contenido_dinamico','/Estadistica-Finanza/Finanza/Vista/Modulo_Parametricos/Parametricos.html');
                            }
                            else{
                               
                            document.getElementById(id).innerHTML += msg;}
                       });
                        
                          
    
    
    
}

function verificaCarpeta(carpeta){
   

   
     $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/CarpetasRelacionadas/BuscaCarpetaRelacionda.php",
                        data:{carpeta:carpeta}
                        }).done(function(msg){
                          ///alert(msg);
                          a=false;
                        if(msg ==="1"){
                            
                           a = true;
                            
                        }   
                       else{a = false;}
                       
                       //alert(a);
                        
                        });
                        
                    //alert(a);
    return a;
}


function validaIngresoAduana(d,d1,d2,d3,d4,d5,d6,d7,d8){
 
   
     var campo = document.getElementById(d).value;
     var campo1 = document.getElementById(d1).value;
     var campo2_1 = document.getElementById(d2).value;
     var campo2_2 = document.getElementById(d3).value;
     var campo2_3 = document.getElementById(d4).value;
     var campo4 = document.getElementById(d5).value;
     var campo5 = document.getElementById(d6).value;
     var campo6 = document.getElementById(d7).value;
     var campo7 = document.getElementById(d8).value;
     
     

    
    var control = 0;
    var mensaje = "";
    if (campo === ""){mensaje +='Falta el número de carpeta!\n';control=1;}
    else{
       if(isNaN(parseInt(campo))){mensaje +='Se debe ingresar sólo números para la carpeta!\n';control=1;}
       }
        
    
    if (campo1 === ""){mensaje +='Falta una Proveedor!\n';control=1;}
    if (campo2_1 === "" && campo2_2==="" && campo2_3 ===""){ mensaje +='Falta al menos un costo Cif!\n';control=1;}
    if (isNaN(parseFloat(campo5))){mensaje +='Se debe Ingresa una número en otro cargo!\n';control=1;}
    if (campo6 === ""){mensaje +='Falta ingresar una fecha!\n';control=1;}
    
    if(campo7 !== ""){
    //por ver doble ajax 
    if (verificaCarpeta(campo7) === false){mensaje +='No existe la carpeta ingresada!\n';control=1;}
    }
    if(control===0){
        
        
                
                       var r=confirm('¿Desea realmente ingresar un nuevo registro?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/RemesasAduanas/IngresaRemesaAduana.php",
                        data:{ campo:campo,campo1:campo1,campo2_1:campo2_1,campo2_2:campo2_2,campo2_3:campo2_3,campo4:campo4,campo5:campo5, campo6:campo6, campo7:campo7}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Aduanas/Listado_Aduanas.html'); 
                         }
        
    }else{alert(mensaje);}
    
}



function sessiont(id){
    
        $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Session/UsuarioSession.php",
                        data:{}
                        }).done(function(msg){
                      
                           document.getElementById(id).innerHTML += msg;
                        });
    
    
}

function cancelaIngreso(){
    
    
     cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Aduanas/Listado_Aduanas.html'); 
    
    
}

function listarCoberturas(id){
    
         $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Coberturas/ListarCoberturas.php",
                        data:{}
                        }).done(function(msg){document.getElementById(id).innerHTML += msg;});
                       
                            
    
    
    
}


function IngresarFilaCobertura(){
       
   var tipoDerecho = selectTipoDerecho('ingreso3','crea'); 
   var filaIngreso ="<tr>\n\
                     <td></td>\n\
                     <td><input class='form-control' id='ingreso' placeholder='Carpeta...'/></td> \n\
                     <td colspan='2'><input class='form-control' id='ingreso1' placeholder='Proveedor...'/></td> \n\
                     <td colspan='4'>\n\
                     <table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>\n\
                     <tr><td colspan='2'>Datos Costo Cif</td></tr>\n\
                     <tr>\n\
                       <td>Cif: </td><td><input class='form-control' onchange="+'"'+"sumaCif()"+'"'+" id='ingreso2_1' placeholder='Costo Cif...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                       <td>Flete: </td><td><input class='form-control' onchange="+'"'+"sumaCif()"+'"'+" id='ingreso2_2' placeholder='Costo Flete...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                       <td>Prima: </td><td><input class='form-control' onchange="+'"'+"sumaCif()"+'"'+" id='ingreso2_3' placeholder='Costo Prima...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                      <td>Costo Cif: </td><td><div id='totalCif'></div></td>\n\
                     </tr>\n\
                     </table></td>\n\
                     <td><span id='estado'>Estado Bodega:</span><div id='ingreso3'></div></td>\n\
                     <td colspan='3'><input class='form-control' id='ingreso4' placeholder='Otro Cargo...'/></td>\n\
                     <td colspan='2'><input class='form-control' id='ingreso5' placeholder='Fecha...'/></td>\n\
                     <td colspan='3'><input class='form-control' id='ingreso6' placeholder='Carpeta Relacionada...'/></td>\n\
                     <td><button class='btn btn-default' type='button' onclick="+'"'+"cancelaIngresoCobertura();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td>\n\
                     <td><button class='btn btn-default' type='button' onclick="+'"'+"validaIngresoAduana('ingreso','ingreso1','ingreso2_1','ingreso2_2','ingreso2_3','seleccion','ingreso4','ingreso5','ingreso6');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></td>\n\
                     <td colspan='11'></td>\n\
                      </button>\n\
                     </td>\n\
                     </tr>";
    document.getElementById('filaIngreso').innerHTML=filaIngreso;
    $( "#ingreso" ).focus();

    
       
}

function cancelaIngresoCobertura(){
    
         cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Coberturas/Listado_Coberturas.html'); 
    
    
    
}

function validaRegistros(){
    
      $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Coberturas/ValidaRegistros.php",
                        data:{}
                        }).done(function(msg){
                         mensaje;  
                         
                         if(msg !== "1"){
                            
                                if (msg==="2"){mesaje = "Se debe ingresar antes  al menos una cobertura!"; }
                                if (msg==="3"){mesaje = "Se debe ingresar antes  al menos una forma de pagos!";}
                                if (msg==="4"){mesaje = "Se debe ingresar antes  al menos un Banco!";}
                                if (msg==="5"){mesaje = "Se debe ingresar antes  al menos un tipo estado cobertura!";}
                                if (msg==="6"){mesaje = "Se debe ingresar antes  al menos un tipo estado bodega!";}
                                
                               alert(mensaje);
                               cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Modulo_Parametricos/Parametricos.html');
                        }
                    });
                       
    
    
}