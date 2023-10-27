<?php
session_start();
require_once("../../conexion.php");

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_proveedor=$_POST["id_proveedor"];

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];

$direccion = $_POST["direccion"];


if(($nombre!="") and ($apellido!="")){
    $reg = array();
    $reg["id_empresa_calzado"] = 1;
    $reg["nombre"] = $nombre;
    $reg["apellido"] = $apellido;
    $reg["direccion"] = $direccion;

    

    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("proveedores", $reg, "UPDATE", "id_proveedor='".$id_proveedor."'"); 
    header("Location: proveedores.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICARON LOS DATOS DEL PROVEEDOR";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='proveedores.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
    }
 

    
 echo "</body>
       </html> ";
 ?> 