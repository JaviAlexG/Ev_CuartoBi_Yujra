<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$id_empleado = $_POST["id_empleado"];
$id_horario = $_POST["id_horario"];
$hora_ingreso = $_POST["hora_ingreso"];
$hora_salida = $_POST["hora_salida"];


if(($hora_ingreso!="") and ($hora_salida!="")){
   $reg = array();
   
   $reg["hora_ingreso"] = $hora_ingreso;
   $reg["hora_salida"] = $hora_salida;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"]; 
   $reg["estado"] = 'A';
   
   $regu["id_horario"]=$id_horario;
     
   $rs1 = $db->AutoExecute("horarios", $reg, "INSERT"); 
   $rs1 = $db->AutoExecute("empleados", $regu, "INSERT"); 
   header("Location: turnos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL USUARIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='turno_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 