<?php
session_start();
require_once("../../conexion.php");

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_empleado=$_POST["id_empleado"];
$id_funcion=$_POST["id_funcion"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$ci = $_POST["ci"];

// emple

if((($nombre!="") and ($apellido!="") )){
    $reg = array();

    $reg["id_empleado"] = $id_empleado;
    $reg["id_empresa_calzado"] = 1;
    $reg["id_funcion"] = $id_funcion;

    $reg["nombre"] = $nombre;
    $reg["apellido"] = $apellido;
    $reg["ci"] = $ci;

    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("empleados", $reg, "UPDATE", "id_empleado='".$id_empleado."'"); 
    header("Location: empleados.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICO EL USUARIO";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='empleados.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
    }
 

    
 echo "</body>
       </html> ";
 ?> 