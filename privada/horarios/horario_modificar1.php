<?php
session_start();
require_once("../../conexion.php");

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_horario=$_POST["id_horario"];

$hora_ingreso = $_POST["hora_ingreso"];
$hora_salida = $_POST["hora_salida"];


if(($hora_ingreso!="") and ($hora_salida!="")){
    $reg = array();
    $reg["hora_ingreso"] = $hora_ingreso;
    $reg["hora_salida"] = $hora_salida;

    

    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("horarios", $reg, "UPDATE", "id_horario='".$id_horario."'"); 
    header("Location: horarios.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICARON LOS DATOS DEL HORARIO";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='horarios.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
    }
 

    
 echo "</body>
       </html> ";
 ?> 