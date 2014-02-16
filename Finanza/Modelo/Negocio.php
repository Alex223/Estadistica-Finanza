<?php

require_once 'Conexion.php';
 
  
  
 class Negocio {
 
     function __construct() {
         
     }
     function Conectar(conexion $con){
         return $con->conectar('localhost:3306', 'root', '');
         
     }
     
      function insertarCliente(Encuesta $Enc){
         
         $con = new conexion();
         $conexion = $this->conectar($con);
         mysql_select_db("mydb") or die ('<div id=errorB> Error -> No se pudo conectar a la Base de datos!</div>');
         
         
         $insertar = "insert into Encuesta(Rut_Encuestado,Nombre_Encuestado,Fecha) values('".$Enc->getRut()."','".$Enc->getNombre()."','".$Enc->getDate()."');";
         echo ($insertar);
         mysql_query($insertar,$conexion)
                 or die('<div id="errorQ"> Error -> No se pudo ejecuar la query!</div>');
         $con->desconectar($conexion);
         
        
         
     }
     
     function ListarUsuarios(String $nombre){
          
         $con = new conexion();
         $conexion = $this->conectar($con);
         mysql_select_db("mydb") or die ('<div id=errorB> Error -> No se pudo conectar a la Base de datos!</div>');
          
         $mostrar = "select Nombre_Encuestado from Encuesta where Nombre_Encuestado='".$nombre."' ";
          
         
         mysql_query($mostrar,$conexion)
                 or die('<div id="errorQ"> Error -> No se pudo ejecuar la query!</div>');
         
         
    
         $con->desconectar($conexion);  
     }
     
     function totalUsuarios(){
                      
       $con = new conexion();
         $conexion = $this->conectar($con);
         
         mysql_select_db("prueba") or die ('<div id=errorB> Error -> No se pudo conectar a la Base de datos!</div>');
           
          $mostrar = "SELECT COUNT(*) FROM usuario";
          mysql_query($mostrar,$conexion) or die('<div id="errorQ"> Error -> No se pudo ejecuar la query!</div>');
          $con->desconectar($conexion);
          
         return mysql_query($mostrar,$conexion);
          
          
     }
     
 }
?>

