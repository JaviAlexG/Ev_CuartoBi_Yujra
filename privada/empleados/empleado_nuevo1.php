<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_funcion = $_POST["id_funcion"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$ci = $_POST["ci"];


if(($nombre!="") and ($ci!="")){
   $reg = array();                              //cambios
   $reg["id_empresa_calzado"] = 1;
   $reg["id_funcion"] = $id_funcion;
   $reg["id_horario"] = 1;

   $reg["nombre"] = $nombre;
   $reg["apellido"] = $apellido;
   $reg["ci"] = $ci;

   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("empleados", $reg, "INSERT"); 
   header("Location: empleados.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='empleado_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 