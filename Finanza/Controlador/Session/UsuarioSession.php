<?php



session_start(); 


   
 $nomUsuario=$_SESSION['nom_user']; 
 $apeUsuario=$_SESSION['ape_user'];   
    
 
 if ($nomUsuario==null){
     
    /*echo "  <script>

              function redireccionar() 
                 {
                  location.href='/Estadistica-Finanza/Finanza/index.html';
                    } 
                   setTimeout ('redireccionar()', 0);
                 </script>";
 */
 }
else{echo ($nomUsuario." ".$apeUsuario);}




?>
