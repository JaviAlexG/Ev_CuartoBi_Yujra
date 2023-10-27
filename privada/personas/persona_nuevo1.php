<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$nombres = $_POST["nombres"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$ci = $_POST["ci"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];

if(($nombres!="") and ($ci!="")){
   $reg = array();                              //cambios
   $reg["id_empresa_calzado"] = 1;
   $reg["nombres"] = $nombres;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["ci"] = $ci;
   $reg["telefono"] = $telefono;
   $reg["direccion"] = $direccion;
   
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("personas", $reg, "INSERT"); 
   header("Location: personas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='persona_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 