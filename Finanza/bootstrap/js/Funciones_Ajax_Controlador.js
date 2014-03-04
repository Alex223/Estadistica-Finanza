
function iniciarLoad(){
    
    	var cl = new CanvasLoader('canvasloader-container');
                cl.setShape('spiral'); // default is 'oval'
		cl.setDiameter(30); // default is 40
		cl.setDensity(26); // default is 40
		cl.setRange(0.7); //        default is 1.3
		cl.setFPS(20); // default is 24
		//cl.show(); // Hidden by default
    return cl;
}



function fecha_inicio(){
             
             var f=new Date();
             var mes = (f.getMonth()+1) +"";
             var dia = f.getDate()+"";
          
             if (mes.length === 1){
                 
                 mes = "0"+mes;
                 
             }
             if (dia.length ===1){
                 
                 dia = "0"+dia;
             }
             
             var fecha = dia + "/" + mes + "/" +  f.getFullYear();
             return fecha;
               
               
           };
           
           
function cuentaRegistros (tabla){
    
     $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/CuentaRegistro/CuentaRegistro.php",
                        data:{tabla:tabla}
                        }).done(function(msg){
                            
                                
                         if( msg === "No hay registros" || msg === null){
        
                            alert("No hay registros de Tipo Moneda, Se debe ingresar al menos una antes de poder ingresar un banco!");
                            cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Monedas/Listado_Monedas.html' );
                           }  
                            
                        
                
                        }); 
    
    
}



function sessiont(id){
    
        $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Session/UsuarioSession.php",
                        data:{}
                        }).done(function(msg){
                           if (msg !== 'redireccionar'){  document.getElementById(id).innerHTML += msg;}
                           else{
                               alert("Seccion no iniciada, favor identificate");
                               location.href="/Estadistica-Finanza/Finanza/index.html";
                              }
                         
                        });
    
    
}
///***************************** Usuarios **************************************

  function ModificaIngresoUsuario(){
     
       var columna = document.getElementById('editor').getAttribute('name');
    
                    if (columna !== "Cargos"){
                  
                     
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
                    
                      
                      var seleccion2 = document.getElementById('seleccion').value;
                      var actual_seleccionado = document.getElementById('seleccionado').value;
                      var idReg = document.getElementById('idReg').getAttribute('name'); 
                      
                     
                      
                      if (seleccion2 === actual_seleccionado){
                          
                          alert("Es el mismo dato!" );
                          
                      }
                      
                           else{
                       
                       var r=confirm('¿desea realmente modificar el registro?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Usuarios/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:seleccion2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                        cargarPHP( '#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Usuarios/Listado_Usuarios.html' );
                             
                         }
                            
                    }   
                    
                }
            

}
                
                
   function dobleclick(id,objetivo,idReg){
       
                 var acceso = document.getElementById('editor');  
                 
                 if (acceso === null){
                var columna =  document.getElementById(id).getAttribute('name');
                var dato = document.getElementById(id);
               var cuadro_editador;
              if(columna === 'Cargo') { 
               
               cuadro_editador = generaSelecBox('0','seleccion','/Estadistica-Finanza/Finanza/Controlador/CajaSeleccion/CajaSeleccion.php','Cargos','idCargos','Titulo',objetivo,idReg, (dato.innerHTML).trim());}
              else {  cuadro_editador  ="<input class='form-control' onkeypress="+'"'+"unfocus(event)"+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default btn-sm' title='Guarda los cambios'  type='button'onclick="+'"'+"ModificaIngresoUsuario();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";}
               document.getElementById(objetivo).innerHTML=cuadro_editador;
               $( "#editor" ).focus();
           }
           
           }
             
             function TeclearEnter(e) {
                  
                  if (e.keyCode === 13) { alert('es  enter'); 
              
                                      }
                                  
    }
             
         function habilitarUsuario(id){
                
                   
         var r=confirm("¿Desea habilitar el usuario "+id.toString()+"?");
            if (r === true)
              {
                  
                        $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Usuarios/HabilitaUsuario.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        });
                  
             
              }
           
          listarUsuarios('contenido_tabla',0);
    
    
    
                
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
    
    function cancelaIngresoCliente(){
        
        
         cargarPHP( '#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Usuarios/Listado_Usuarios.html' );
        
    }
    
    function IngresarFila(){
    
    
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso' type='text' max='10' maxlength='10' placeholder='Rut...'/></td><td><input class='form-control'  id='ingreso2' type='text' placeholder='Primer Nombre...'/></td><td><input class='form-control'  id='ingreso3' type='text' placeholder='Segundo Nombre...'/></td><td><input class='form-control'  id='ingreso4' type='text' placeholder='Apellido Parteno...'/></td><td><input class='form-control'  id='ingreso5' type='text' placeholder='Apellido Materno...'/></td><td><input  class='form-control' id='ingreso6' type='text' placeholder='Nick'/></td><td><input  class='form-control' id='ingreso7' type='password' placeholder='Contraseña'/></td><td id='SelectBox' align='center'><div>SelectBox</div></td><td><button class='btn btn-default btn-sm' title='Añade un nuevo registro' type='button' type='button'onclick="+'"'+"validaIngresoCliente('ingreso','ingreso2','ingreso3','ingreso4','ingreso5','ingreso6','ingreso7','seleccion');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td>  <td><button title='Cancela Ingreso' class='btn btn-default btn-sm' type='button' onclick="+'"'+"cancelaIngresoCliente();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td></tr>";
        
  
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;
     generaSelecBox('1','ingreso','/Estadistica-Finanza/Finanza/Controlador/Bancos/SelectBoxBancos.php','Cargos','idCargos','Titulo','SelectBox',1,"no importa");

               $( "#ingreso" ).focus();
    
    }
    function validaIngresoCliente(ingreso,ingreso2,ingreso3,ingreso4,ingreso5,ingreso6,ingreso7, ingreso8){
        
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
        //if(dato8 === ""){validador=0;alerta+="Falta ingresar el cargo!\n";}
        
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


function listarUsuarios(id,estado){
    
    
      $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Usuarios/ListarUsuarios.php",
                        data:{estado:estado}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML = msg;
                       
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

       
            
            function cargarPHP(divIdentificador, url)
                {
                      
             
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
               
               
 //*********************************Modulo Bancos***********************************************
               
               function listarBancos(id){
    
    
      $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/Bancos/ListarBancos.php",
                        data:{}
                        }).done(function(msg){
                            
                            document.getElementById(id).innerHTML += msg;
                       
                        });

               }
               
      function cancelaIngresoBanco(){
    
   cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
}       
               
               
    function IngresarFilaBanco(){
        
        
    cuentaRegistros("tipo_moneda");
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso'placeholder='Nombre banco...'/></td><td><input class='form-control'  id='ingreso2' type='text' placeholder='Numero Cuenta...'/></td><td><input class='form-control'  id='ingreso3' type='text' placeholder=' Saldo...'/></td><td id='SelectBox' align='center'><div>SelectBox</div></td><td><button class='btn btn-default btn-sm' title='Añade un nuevo registro' type='button' onclick="+'"'+"validaIngresoBanco('ingreso','ingreso2','ingreso3');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td>  <td><button title='Cancela Ingreso' class='btn btn-default btn-sm' type='button' onclick="+'"'+"cancelaIngresoBanco();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td> </tr>";
        
  
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;
   
    generaSelecBox('1','ingreso','/Estadistica-Finanza/Finanza/Controlador/Bancos/SelectBoxBancos.php','tipo_moneda','ID_TIPO_MONEDA','NOMBRETM','SelectBox',1,"no importa");

          
    
    }
    
    ///Documentación muy importante
    
    /*
     * edita_o_ingresa = si es 0 es una edición; si es 1 es una creación
     * objetivoFocus = id donde sera foculizado el puntero luego de cargar el select 
     * url = dirección del controlador que lista las el select objetivo
     * tabla = tabla de la base de datos que trabaja el select o recurso
     * tipoId = Nombre de la columna id de la tabla trabajada
     * tipoTitulo = Nombre de la columna dato (especifico ej: reg: 1, casa; "casa" es el tipoTitulo) de la tabla trabajada
     * objetivo = id del div donde se insertara
     * idReg = solo si es edición de lo contrario 0 ingreso por defecto.
     * TituloSelect = Es el dato selecionado ej: si hay "1-casa,2-hotel", esta campo es la "casa o hotel", en creación de un nuevo registro no importa
     */
        
        
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
              
                cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocusb(event) "+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default btn-sm' title='Guarda los cambios'  type='button'onclick="+'"'+"ModificaIngresoBanco();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";
                  
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

function EliminaBanco(id){
    
       
    var r=confirm('¿Desea realmente eliminar el registro '+id+'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                         url: "/Estadistica-Finanza/Finanza/Controlador/Bancos/EliminaBanco.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Bancos/Listado_Bancos.html' );
                         
                         }
    
    
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
              
               cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocusc(event) "+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default btn-sm' title='Guarda los cambios' type='button'onclick="+'"'+"ModificaIngresoCargo();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";
                  
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
          
   function cancelaIngresoCargo(){
    
   cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Cargos/Listado_Cargos.html' );
}       
          
      function IngresarFilaCargo(){
        
        
        
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso'placeholder='Titulo...'/></td><td><input class='form-control'  id='ingreso2' type='text' placeholder='Descripcion...'/></td><td><button class='btn btn-default btn-sm' title='Añade un nuevo registro' type='button' onclick="+'"'+"validaIngresoCargo('ingreso','ingreso2');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td>  <td><button title='Cancela Ingreso' class='btn btn-default btn-sm' type='button' onclick="+'"'+"cancelaIngresoCargo();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td></tr>";
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

function EliminaCargo(id){
    
       
    var r=confirm('¿Desea realmente eliminar el registro '+id+'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                         url: "/Estadistica-Finanza/Finanza/Controlador/Cargos/EliminaCargo.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Cargos/Listado_Cargos.html' );
                         
                         }
    
    
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
              
               cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocustm(event) "+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default btn-sm' title='Guarda los cambios' type='button'onclick="+'"'+"ModificaIngresoTipoMoneda();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";
                  
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
          
          
 function cancelaIngresoTipoMoneda(){
    
  cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Monedas/Listado_Monedas.html' );
}

          
  function IngresarFilaTipoMoneda(){
        
        
        
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso'placeholder='Nombre Moneda...'/></td><td><button title='Añade un nuevo registro' class='btn btn-default btn-sm' type='button' onclick="+'"'+"validaIngresoTipoMoneda('ingreso');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td>  <td><button title='Cancela Ingreso' class='btn btn-default btn-sm' type='button' onclick="+'"'+"cancelaIngresoTipoMoneda();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td></tr>";
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

function EliminaTipoMoneda(id){
    
    
    var r=confirm('¿Desea realmente eliminar el registro '+id+'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                         url: "/Estadistica-Finanza/Finanza/Controlador/TipoMonedas/EliminaTipoMoneda.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP('#contenido', '/Estadistica-Finanza/Finanza/Vista/Monedas/Listado_Monedas.html');
                         
                         }
    
    
}



//*****************************Modulo Tipo Derecho************************************

function listarTipoDerechos(id){
    
       $.ajax({
                        type:"POST",
                        url: "/Estadistica-Finanza/Finanza/Controlador/TipoDerechos/ListarTipoDerechos.php",
                        data:{}
                        }).done(function(msg){
                           
                            document.getElementById(id).innerHTML += msg;
                       
                        });
    
}



  function dobleclickTDE(id,objetivo,idReg){
       
                 var acceso = document.getElementById('editor');  
                 
                 if (acceso === null){
                     
                     
                var columna =  document.getElementById(id).getAttribute('name');
                var dato = document.getElementById(id);
                 var cuadro_editador;
              
               cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocustde(event) "+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default btn-sm' title='Guarda los cambios' type='button'onclick="+'"'+"ModificaIngresoTipoDerecho();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></input></input>";
                  
                document.getElementById(objetivo).innerHTML=cuadro_editador;
                $( "#editor" ).focus();
            
                    
           }
                 
           }
        
       function unfocustde(e){
          
           if (e.keyCode === 27) {
       
              cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Tipos_Derechos/Listado_Tipos_Derechos.html');
        }
    
       
      }
      
      function ModificaIngresoTipoDerecho(){

                      var columna = document.getElementById('editor').getAttribute('name');
                      var dato = document.getElementById('editor').getAttribute('placeholder').trim();
                      var dato2 = document.getElementById('editor').value;
                      var idReg = document.getElementById('idReg').getAttribute('name'); 
                      
                    
                   
                     if (dato2 === ""){
                         alert('Se debe ingresar datos!');
                     }else{
                   if( dato === dato2){
                       
                       alert("Es el mismo dato! '"+dato+"'" );
                       
                             cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Tipos_Derechos/Listado_Tipos_Derechos.html');
                     
                   }
                   
                   else{
                       
                       var r=confirm('¿desea realmente modificar el registro '+ dato +' por el: '+ dato2 +'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/TipoDerechos/ModificaRegistro.php",
                        data:{id:idReg,col:columna,valor:dato2}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                              cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Tipos_Derechos/Listado_Tipos_Derechos.html');
                             
                         }
                            
                    }     
                   }
                                         
          }
          
 function IngresarFilaTipoDerecho(){
        
        
        
    
    var cuadro_editador ="<tr><td></td><td><input class='form-control' id='ingreso' placeholder='Número Derecho...'/></td><td><button title='Añade un nuevo registro' class='btn btn-default btn-sm' type='button' onclick="+'"'+"validaIngresoTipoDerecho('ingreso');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td>   <td><button title='Cancela Ingreso' class='btn btn-default btn-sm' type='button' onclick="+'"'+"cancelaIngresoTipoDerecho();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td></tr>";
    
    document.getElementById('filaIngreso').innerHTML=cuadro_editador;
    $( "#ingreso" ).focus();
    
    }


function cancelaIngresoTipoDerecho(){
    
       cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Tipos_Derechos/Listado_Tipos_Derechos.html' );
}

 function validaIngresoTipoDerecho(dato){
    
    var campo1 = document.getElementById(dato).value;
   
    
    
    var control = 0;
    var mensaje = "";
    if (campo1 ===""){mensaje +='Falta nombre tipo derecho!\n';control=1;}
   

    
    if(control===0){
        
        
                
                       var r=confirm('¿Desea realmente ingresar un nuevo registro?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/TipoDerechos/IngresaTipoDerecho.php",
                        data:{Nombre:campo1}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Tipos_Derechos/Listado_Tipos_Derechos.html' );
                             
                         }
        
    }else{alert(mensaje);}
    
    
    
    
}

function EliminaTipoDerecho(id){
    
    
    var r=confirm('¿Desea realmente eliminar el registro '+id+'?');
                         if (r === true){
                             
                            
                       $.ajax({
                        type:"POST",
                         url: "/Estadistica-Finanza/Finanza/Controlador/TipoDerechos/EliminaTipoDerecho.php",
                        data:{id:id}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Tipos_Derechos/Listado_Tipos_Derechos.html' );
                             
                         }
    
    
}

//******************************* Modulo Bancos****************************************

function CargasSeleccion(lugar,id){
    
           
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/ModuloBancos/SeleccionBancos.php",
                        data:{id:id}
                        }).done(function(msg){document.getElementById(lugar).innerHTML = msg;
                                              document.getElementById('datepicker').setAttribute("value", fecha_inicio());
                                              $('.selectpicker').selectpicker();
                                              $( "#datepicker" ).datepicker();
                                               
	
                                              
                    }); 
                    
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


//***************************Modulo Transaciones Bancos ************************







//***********  *************** Modulo Remesas Aduanas **************************
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

function listarRemesaAduanas(id, cl){
    
    cl.show();
    
    setTimeout (  function(){     $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/RemesasAduanas/ListadoRemesaAduanas.php",
                        data:{}
                        }).done(function(msg){document.getElementById(id).innerHTML += msg; });cl.kill();}  , 350);
 
              
 
}

function agregarOtroCargo(){
    
    var limite = document.getElementById('botonOtroCargo').getAttribute('name');
    var dato="";
    var filtro=0;
    var a,b=0;
    var arregloDatos = new Array();

    for(var i=0;i<=limite;i++){
      dato = (document.getElementById('ingreso4_'+i).value).trim();
      
      if (dato===""){
          filtro=1;
          
      }
        arregloDatos[i] = dato;
    }
      
    if (filtro===1){
        
      var  mensaje = "Deben estar llenos todos los campo del Otro Cargo anterior!";
           document.getElementById('barra_información').innerHTML =  "<div  style='border: 5px; width: auto; position: relative; text-align:center ; padding: 0.7em ;vertical-align: top ;width: auto;' class='alert alert-danger alert-dismissable ' > "+mensaje+"</div>";
           $(".alert").alert();
           setTimeout (  function(){document.getElementById('barra_información').innerHTML = "";},3000); 
        
      //  alert("Deben estar llenos todos los campo del Otro Cargo anterior! ");
        
    }
    else{
        
        a=parseInt(limite)+1;
        b=parseInt(limite)+2;
        
         for(var i=0;i<=limite;i++){
        
               document.getElementById('ingreso4_'+i).setAttribute("value",arregloDatos[i]);
  
              }
        var valorTabla = parseInt(numeroElemento= document.getElementById('botonOtroCargoMenos').getAttribute("name"))+1;
        document.getElementById('botonOtroCargoMenos').setAttribute("name",valorTabla);
        
        document.getElementById('otroCargo').innerHTML += "<table id='otroCargo_" + valorTabla + "' class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>     \n\
                      <tr>\n\
                      <td colspan='2'><input class='form-control' id='ingreso4_" + a + "'  placeholder='Tipo Otro Cargo...'/></td>\n\
                      </tr>\n\
                      <tr>\n\
                      <td colspan='2'><input class='form-control' onKeyPress="+'"'+"return validarFloatIngreso(event);"+'"'+"  id='ingreso4_" +  b + "' onblur="+'"'+"sumaOtroCargo();"+'"'+" placeholder='Costo Otro Cargo...'/></td>  \n\
                      </table>";
      document.getElementById('botonOtroCargo').setAttribute('name',b);  
        
    }
}

function EliminaOtroCargo(){
  
    var numeroElemento= document.getElementById('botonOtroCargoMenos').getAttribute("name");
    var inputs= document.getElementById('botonOtroCargo').getAttribute("name");
    if(numeroElemento !== "1"){

    var elementoHijo = document.getElementById('otroCargo_'+numeroElemento);
    var elementoPadre = document.getElementById("otroCargo");
  
    elementoPadre.removeChild(elementoHijo);
    document.getElementById('botonOtroCargoMenos').setAttribute("name",(parseInt(numeroElemento)-1));
    document.getElementById('botonOtroCargo').setAttribute("name",(parseInt(inputs)-2));
    sumaOtroCargo('ingreso4_1');
    
    }
    else{
         var  mensaje = "No hay Otros Cargos adicionales para eliminar!";
           document.getElementById('barra_información').innerHTML =  "<div  style='border: 5px; width: auto; position: relative; text-align:center ; padding: 0.7em ;vertical-align: top ;width: auto;' class='alert alert-danger alert-dismissable ' > "+mensaje+"</div>";
           $(".alert").alert();
           setTimeout (  function(){document.getElementById('barra_información').innerHTML = "";},3000); 
     //   alert('No hay Otros Cargos adicionales para eliminar!');
    }
}

function IngresarFilaRemesa(){
   
   selectTipoDerecho('ingreso3','crea'); 
   var filaIngreso ="<tr>\n\
                     <td colspan='2'><input class='form-control' id='ingreso' placeholder='Carpeta...'/></td> \n\
                     <td colspan='3'><input class='form-control' id='ingreso1' placeholder='Proveedor...'/></td> \n\
                     <td colspan='4'>\n\
                     <table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>\n\
                     <tr><td colspan='2'>Datos Costo Cif</td></tr>\n\
                     <tr>\n\
                       <td>Cif: </td><td><input   type='number' step='0.01' onKeyPress="+'"'+"return validarFloatIngreso(event);"+'"'+" class='form-control' onblur="+'"'+"sumaCif()"+'"'+" id='ingreso2_1' placeholder='Costo Cif...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                       <td>Flete: </td><td><input  type='number' step='0.01' onKeyPress="+'"'+"return validarFloatIngreso(event);"+'"'+" class='form-control' onblur="+'"'+"sumaCif()"+'"'+" id='ingreso2_2' placeholder='Costo Flete...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                       <td>Prima: </td><td><input  type='number' step='0.01' onKeyPress="+'"'+"return validarFloatIngreso(event);"+'"'+" class='form-control' onblur="+'"'+"sumaCif()"+'"'+" id='ingreso2_3' placeholder='Costo Prima...'/></td> \n\
                     </tr>\n\
                     <tr>\n\
                      <td>Costo Cif: </td><td><div id='totalCif'></div></td>\n\
                     </tr>\n\
                     </table></td>\n\
                     <td><div >Estado Bodega</div><div id='ingreso3'></div></td>\n\
                     <td colspan='3'>\n\
                      <div id='otroCargo'>\n\
                      <table class='table table-striped' id='otroCargo_1' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>     \n\
                      <tr>\n\
                      <td  colspan='3'><div id='unos'><input class='form-control' id='ingreso4_0' placeholder='Tipo Otros Cargos...'/></div</td>\n\
                      </tr>\n\
                      <tr>\n\
                      <td colspan='3'><input class='form-control' id='ingreso4_1' type='number' step='0.01' onKeyPress="+'"'+"return validarFloatIngreso(event);"+'"'+"  onblur="+'"'+"sumaOtroCargo();"+'"'+" placeholder='Costo Otros Cargos...'/></td>  \n\
                      </table>\n\
                       </div>\n\
                       <table class='table table-striped' style='border-width:1px;border-style: solid;border-color: #d5d5d5;border-radius: 5px'>\n\
                         </tr>\n\
                         <td colspan='3' align='right'>\n\
                          <button id='botonOtroCargo' name='1' class='btn btn-default btn-sm' title='Agrega Otro Cargo' type='button' onclick="+'"'+"agregarOtroCargo();"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button>\n\
                          <button id='botonOtroCargoMenos' name='1' class='btn btn-default btn-sm' title='Elimina Otro Cargo' type='button' onclick="+'"'+"EliminaOtroCargo();"+'"'+" ><span class='glyphicon glyphicon-minus-sign'> </span></button></td>\n\
                        </tr>\n\
                        <tr>\n\
                         <td align='left'>Total:</td><td><div id='totalOtroCargo'></div></td> \n\
                        </tr>\n\
                        </table>\n\
                     </td>\n\
                     <td colspan='3'><input  id='datepicker' title='Seleccionar fecha' class='fecha' style='width:75%;' readonly='' /><span class='add-on-propio' ><i class='glyphicon glyphicon-calendar'></i></span></td>\n\
                     <td colspan='4'><input class='form-control' id='ingreso5' placeholder='Carpeta Relacionada...'/></td>\n\
                     <td><button class='btn btn-default btn-sm'  title='Añade una nueva Remesa de Aduana' type='button' onclick="+'"'+"validaIngresoRemesa('ingreso','ingreso1','ingreso2_1','ingreso2_2','ingreso2_3','ingreso3','datepicker','ingreso5');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'> </span></button></td>\n\
                     <td><button class='btn btn-default btn-sm' title='Cancela el Ingreso de la Remesa' type='button' onclick="+'"'+"cancelaIngresoRemesa();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td>\n\
                     <td colspan='8'></td>\n\
                     </tr>";
    document.getElementById('filaIngreso').innerHTML=filaIngreso;
    $( "#ingreso" ).focus();
    $( "#datepicker" ).datepicker();
    document.getElementById('datepicker').setAttribute("value", fecha_inicio());
}

function sumaOtroCargo(){
   var limite = document.getElementById('botonOtroCargo').getAttribute('name');
   //var campo = document.getElementById(valor).value.trim();
   var i;
   var tag="";
   var dato="";
  // var control=1;
   var sumaTotal=parseFloat(0);
   
       for(i=1;i<=limite;i+=2){
           tag = "ingreso4_"+i;
           dato =(document.getElementById(tag).value).trim();
        
         
           if(dato!==""){
           
               //cambiar coma por punto; antes de trabajar
               sumaTotal +=parseFloat(dato.toString().replace(/,/g,"."));
           }
           else{
              document.getElementById('barra_información').innerHTML =  "<div  style='border: 5px; width: auto; position: relative; text-align:center ; padding: 0.7em ;vertical-align: top ;width: auto;' class='alert alert-danger alert-dismissable ' > Se debe ingresar un monto para Costo Otro Cargo!</div>";
              $(".alert").alert();
               setTimeout (  function(){document.getElementById('barra_información').innerHTML = "";},3000); 
            //alert("Se debe ingresar un monto para Costo Otro Cargo");
            
           
        }
      
      // alert(sumaTotal);
       
       document.getElementById('totalOtroCargo').innerHTML = sumaTotal.toString().replace(/\./g,','); 
   }

    
    
}

function validarFloatIngreso(e) {

   var  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla === 8 ) return true; //Tecla de retroceso (para poder borrar)
    if (tecla === 0) return true;//tabulador
    if (tecla === 44) return true; //Coma ( En este caso para diferenciar los decimales )
    if (tecla === 48) return true;
    if (tecla === 49) return true;
    if (tecla === 50) return true;
    if (tecla === 51) return true;
    if (tecla === 52) return true;
    if (tecla === 53) return true;
    if (tecla === 54) return true;
    if (tecla === 55) return true;
    if (tecla === 56) return true;
    if (tecla === 57) return true;
     
    var patron = /1/; //ver nota
    var te = String.fromCharCode(tecla);
    return patron.test(te);
    
}  




function sumaCif(){
    
    //dato.toString().replace(/,/g,".")
    
    
    var cif1 = document.getElementById('ingreso2_1').value+"";
    var cif2 = document.getElementById('ingreso2_2').value+"";
    var cif3 = document.getElementById('ingreso2_3').value+"";
    var total=0.0; 
    
    
    if (cif1===""){cif1=0;}
    if (cif2===""){cif2=0;}
    if (cif3===""){cif3=0;}
    
    total = parseFloat(cif1.toString().replace(/,/g,"."))+parseFloat(cif2.toString().replace(/,/g,"."))+parseFloat(cif3.toString().replace(/,/g,"."));
 

 
 document.getElementById('totalCif').innerHTML=total.toString().replace(/\./g,',');;

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
                             //   cargarPHP( '#contenido', '/Estadistica-Finanza/Finanza/Vista/Tipos_Derechos/Listado_Tipos_Derechos.html');
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


  function dobleclickRemesa(id,objetivo,idReg){
       
                 var acceso = document.getElementById('editor');  
                 
                 if (acceso === null){
                     
                     
                var columna =  document.getElementById(id).getAttribute('name');
               
                if (columna === 'CodigoCif'){
                    //genero la vista cif
                    
                     
                    var idCif =  document.getElementById('CodigoCif_'+id.substring(4,5)).getAttribute('name');
                  
                      $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/RemesasAduanas/EditaCifs.php",
                        data:{idCif:idCif}
                        }).done(function(msg){
                            
                            
                          document.getElementById(objetivo).innerHTML = msg; 
                          $( "#ingreso2_1" ).focus();
                            
                        });
                    
                    
                }else{
                var dato = document.getElementById(id);
                var cuadro_editador;
                cuadro_editador  ="<input class='form-control'  onkeypress="+'"'+"unfocuRemesa(event)"+";return event.keyCode!=13;"+'"'+" name ='"+columna+"' type='text' id='editor' placeholder='"+dato.innerHTML+"'/><span id='idReg' name='"+idReg+"'></span><button class='btn btn-default btn-sm' title='Guarda los cambios' type='button'onclick="+'"'+"ModificaRemesa();"+'""'+" ><span class='glyphicon glyphicon-plus-sign'></span></button>";
                 document.getElementById(objetivo).innerHTML=cuadro_editador;
                $( "#editor" ).focus();
                }
               
                
            
                    
           }
                 
           }
        


  function unfocuRemesa(e){
         
           if (e.keyCode === 27) {
              
           cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Aduanas/Listado_Aduanas.html');
        }

  }
  
  
  

function validaIngresoRemesa(d,d1,d2_1,d2_2,d2_3,d3,datepicker,d5){
 
   
     var campo = document.getElementById(d).value;//Carpeta
     var campo1 = document.getElementById(d1).value;//Proveedor
     var campo2_1 = document.getElementById(d2_1).value; //Costo Cif
     var campo2_2 = document.getElementById(d2_2).value;// Costo Flete 
     var campo2_3 = document.getElementById(d2_3).value; //costo prima
     var campo5 = document.getElementById(d3).value;//Estado en Bodega
     var campo6 = document.getElementById(datepicker).value; //Fecha
     var campo7 = document.getElementById(d5).value;//Carpeta Relacionada
     
    var control = 0;
    var mensaje = "";
     
     
     
    //Validacióm campos de Otro Cargo 
     
     
   var limite = document.getElementById('botonOtroCargo').getAttribute('name');
   var umbral = (parseInt(limite)+1)/2;
   
   var i;
   var dato,dato1;
   var valida=1;
  
       for(i=0;i<umbral;i++){
           dato =(document.getElementById('ingreso4_'+2*i).value).trim();
           dato1 =(document.getElementById('ingreso4_'+(2*i+1)).value).trim();
    
             
            if(dato !== ""){
                
                if(dato1 === ""){valida=2;}
                
            }else{
                
               if(dato1 !== ""){valida = 0;}
                 }
    
    
    
       }  
   
     
       
   
   

   //*******************************

    if (campo === ""){mensaje +='Falta el número de carpeta! \n';control=1;}
    else{
       if(isNaN(parseInt(campo))){mensaje +='Se debe ingresar sólo números para la carpeta! \n';control=1;}
       }
        
    
    if (campo1 === ""){mensaje +='Falta una Proveedor! \n';control=1;}
    if (campo2_1 === "" && campo2_2 === "" && campo2_3 === ""){ mensaje +='Falta al menos un costo Cif! \n';control=1;}
    if (valida ===0){mensaje +='Falta completar Tipo Otro Cargos ! \n';control=1;}
    if (valida ===2){mensaje +='Falta completar Costo Otro Cargos ! \n';control=1;}
    if (campo7 !== ""){
   
    if (verificaCarpeta(campo7) === false){mensaje +='No existe la carpeta ingresada! \n';control=1;}
    }
    
    
    if(control === 0) {
        
        // alert bootstrap
        
       //var confimacion ="<button class='btn btn-primary btn-lg' data-toggle='modal" data-target="#myModal">Launch demo modal</button>


                        $('#myModal').modal('show');

                       //var r=confirm('¿Desea realmente ingresar un nuevo registro?');
                        // ((if (r === true){
                             
                     
                         
        
    }else{
        
           document.getElementById('barra_información').innerHTML =  "<div  style='border: 5px; width: auto; position: relative; text-align:center ; padding: 0.7em ;vertical-align: top ;width: auto;' class='alert alert-danger alert-dismissable ' > "+mensaje+"</div>";
           $(".alert").alert();
           setTimeout (  function(){document.getElementById('barra_información').innerHTML = "";},3000);
                
            //    alert(mensaje);
            
            }
    
}

function agregarRemesaAduana(d,d1,d2_1,d2_2,d2_3,d3,datepicker,d5){
    
     var campo = document.getElementById(d).value;//Carpeta
     var campo1 = document.getElementById(d1).value;//Proveedor
     var campo2_1 = document.getElementById(d2_1).value; //Costo Cif
     var campo2_2 = document.getElementById(d2_2).value;// Costo Flete 
     var campo2_3 = document.getElementById(d2_3).value; //costo prima
     var campo5 = document.getElementById(d3).value;//Estado en Bodega
     var campo6 = document.getElementById(datepicker).value; //Fecha
     var campo7 = document.getElementById(d5).value;//Carpeta Relacionada
     
     
     
     
          
   var limite = document.getElementById('botonOtroCargo').getAttribute('name');
   var umbral = (parseInt(limite)+1)/2;
   
   var i;
   var dato,dato1;
  // var valida[limite+1] = new Array();
  
       for(i=0;i<umbral;i++){
           dato =(document.getElementById('ingreso4_'+2*i).value).trim();
           dato1 =(document.getElementById('ingreso4_'+(2*i+1)).value).trim();
    
             
            if(dato !== ""){
                
                if(dato1 === ""){valida=2;}
                
            }else{
                
               if(dato1 !== ""){valida = 0;}
                 }
    
    
    
       } 
     
     
                       $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/RemesasAduanas/IngresaRemesaAduana.php",
                        data:{ campo:campo,campo1:campo1,campo2_1:campo2_1,campo2_2:campo2_2,campo2_3:campo2_3,campo4:campo4,campo5:campo5, campo6:campo6, campo7:campo7}
                        }).done(function(msg){
                        alert(msg);
                        }); 
                        
                         cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Aduanas/Listado_Aduanas.html'); 
    
}

function cancelaIngresoRemesa(){
    
    
     cargarPHP('#contenido_dinamico', '/Estadistica-Finanza/Finanza/Vista/Aduanas/Listado_Aduanas.html'); 
    
    
}


///************************Coberturas********************************************************

function listarCoberturas(id){
    
         $.ajax({
                        type:"POST",
                            url: "/Estadistica-Finanza/Finanza/Controlador/Coberturas/ListarCoberturas.php",
                        data:{}
                        }).done(function(msg){document.getElementById(id).innerHTML += msg;});
                       
                            
    
    
    
}


function IngresarFilaCobertura(){
       
   selectTipoDerecho('ingreso3','crea'); 
   var filaIngreso ="<tr>\n\
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
                     <td colspan='3'><input class='form-control' id='ingreso4' placeholder='Otros Cargos...'/></td>\n\
                     <td colspan='2'><input class='form-control' id='ingreso5' placeholder='Fecha...'/></td>\n\
                     <td colspan='3'><input class='form-control' id='ingreso6' placeholder='Carpeta Relacionada...'/></td>\n\
                     <td><button class='btn btn-default' type='button' onclick="+'"'+"cancelaIngresoCobertura();"+'"'+" ><span class='glyphicon glyphicon-remove-sign'> </span></button></td>\n\
                     <td><button class='btn btn-default' type='button' onclick="+'"'+"validaIngresoAduana('ingreso','ingreso1','ingreso2_1','ingreso2_2','ingreso2_3','seleccion','ingreso4','ingreso5','ingreso6');"+'"'+" ><span class='glyphicon glyphicon-plus-sign'></span></button></td>\n\
                     <td colspan='12'></td>\n\
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

