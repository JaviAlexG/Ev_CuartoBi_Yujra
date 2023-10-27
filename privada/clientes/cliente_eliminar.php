<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$id_cliente = $_REQUEST["id_cliente"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";


$sql = $db->Prepare("SELECT *
                    FROM pedidos
                    WHERE id_cliente = ?
                    AND estado <> 'X'
                    ");
           
$rs = $db->GetAll($sql, array($id_cliente));

if(!$rs) {
    $reg = array();
    $reg["estado"] = "X";
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("clientes", $reg, "UPDATE", "id_cliente='".$id_cliente."'"); 
    header("Location: clientes.php");
    exit();
}else{
    echo"<div class='mensaje'>";
         $mensage = "NO SE ELIMINARON LOS DATOS DEL CLIENTE PORQUE TIENE HERENCIA";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='clientes.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
}

echo"</body>
</html>";
?>