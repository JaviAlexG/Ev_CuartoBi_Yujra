<?php
session_start();
require_once("../../conexion.php");


$id_proveedor = $_REQUEST["id_proveedor"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";





    $reg = array();
    $reg["estado"] = "X";
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("proveedores", $reg, "UPDATE", "id_proveedor='".$id_proveedor."'"); 
    header("Location: proveedores.php");
    exit();

    /*echo"<div class='mensaje'>";
         $mensage = "NO SE ELIMINARON LOS DATOS DEL USUARIO PORQUE TIENE HERENCIA";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='usuarios.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;*/
        require_once("../../libreria_menu.php");

echo"</body>
</html>";
?>