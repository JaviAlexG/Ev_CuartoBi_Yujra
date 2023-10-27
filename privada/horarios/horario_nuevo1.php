<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$hora_ingreso = $_POST["hora_ingreso"];
$hora_salida = $_POST["hora_salida"];


if(($hora_ingreso!="") and ($hora_salida!="")){
   $reg = array();                              //cambios
   $reg["hora_ingreso"] = $hora_ingreso;
   $reg["hora_salida"] = $hora_salida;   
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("horarios", $reg, "INSERT"); 
   header("Location: horarios.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA HORA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='horario_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 