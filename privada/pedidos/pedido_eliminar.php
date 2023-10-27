<?php
session_start();
require_once("../../conexion.php");

$id_pedido = $_REQUEST["id_pedido"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";


$sql = $db->Prepare("SELECT *
                    FROM pedidos
                    WHERE id_pedido = ?
                    AND estado <> 'X'
                    ");
           
$rs = $db->GetAll($sql, array($id_pedido));
require_once("../../libreria_menu.php");
if(!$rs) {
    $reg = array();
    $reg["estado"] = "X";
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("pedidos", $reg, "UPDATE", "id_pedido='".$id_pedido."'"); 
    header("Location: pedidos.php");
    exit();
}else{
    echo"<div class='mensaje'>";
         $mensage = "NO SE ELIMINARON LOS DATOS DEL EMPLEADO PORQUE TIENE HERENCIA";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='pedidos.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
}

echo"</body>
</html>";
?>