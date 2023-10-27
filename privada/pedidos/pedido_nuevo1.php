<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_cliente = $_POST["id_cliente"];

$monto_total = $_POST["monto_total"];


if(($monto_total!="") and ($id_cliente!="")){
   $reg = array();                              //cambios
   $reg["id_cliente"] = $id_cliente;


   $reg["monto_total"] = $monto_total;

   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("pedidos", $reg, "INSERT"); 
   header("Location: pedidos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL PEDIDO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='pedido_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 