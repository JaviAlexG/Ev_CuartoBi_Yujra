<?php
session_start();
require_once("../../conexion.php");

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$id_cliente =$_POST["id_cliente"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];

if(($nombre!="") and ($apellido!="")){
    $reg = array();
    $reg["id_empresa_calzado"] = 1;
    $reg["nombre"] = $nombre;
    $reg["apellido"] = $apellido;
    $reg["direccion"] = $direccion;
    $reg["telefono"] = $telefono;

    

    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("clientes", $reg, "UPDATE", "id_cliente='".$id_cliente."'"); 
    header("Location: clientes.php");
    exit();
 } else {
            echo"<div class='mensaje'>";
         $mensage = "NO SE MODIFICARON LOS DATOS DEL CLIENTE";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='clientes.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
    }
 

    
 echo "</body>
       </html> ";
 ?> 