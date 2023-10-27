<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$funcion = $_REQUEST["funcion"];
$fecha= date("Y-m-d H:i:s");




echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

if($funcion == "T"){
   /*$sql = $db->Prepare("SELECT CONCAT_WS(' ',ap,am,nombres) as persona, if (genero= 'F','FEMENINO',   'MASCULINO') AS genero
                        FROM personas
                        WHERE estado <> 'X' 
                        ");
    $rs = $db->GetAll($sql);*/



    $sql = $db->Prepare("SELECT CONCAT_WS(' ',em.nombre,em.apellido) as persona, fun.funcion as funcion
		 					FROM empleados em		 					
		 					INNER JOIN funciones fun ON em.id_funcion=fun.id_funcion
                            WHERE em.estado ='A'
							AND fun.estado = 'A'
							");
		    $rs = $db->GetAll($sql);

} else {
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',em.nombre,em.apellido) as persona, CASE
    WHEN fun.funcion = 'TRANSPORTE' THEN 'TRANSPORTE'
    WHEN fun.funcion = 'GTE. ADMINISTRATIVO' THEN 'GTE. ADMINISTRATIVO'
    WHEN fun.funcion = 'EMPLEADO' THEN 'EMPLEADO'
    WHEN fun.funcion = 'GTE. COMERCIAL' THEN 'GTE. COMERCIAL'
    WHEN fun.funcion = 'GTE. PRODUCCION' THEN 'GTE. PRODUCCION'
    WHEN fun.funcion = 'GTE. FINANZAS' THEN 'GTE. FINANZAS'
    WHEN fun.funcion = 'SUPERVISOR' THEN 'SUPERVISOR'
    WHEN fun.funcion = 'ENCARGADO DE VENTAS' THEN 'ENCARGADO DE VENTAS'
    WHEN fun.funcion = 'DISEÑADOR' THEN 'DISEÑADOR'
    WHEN fun.funcion = 'SUPERV. DE DISTRIBUCION' THEN 'SUPERV. DE DISTRIBUCION'
    WHEN fun.funcion = 'SUPERV. DE VENTAS' THEN 'SUPERV. DE VENTAS'
    ELSE 'NINGUNO'
    END AS funcion
    FROM empleados em
    INNER JOIN funciones fun ON em.id_funcion=fun.id_funcion
    WHERE funcion=?
    AND em.estado = 'A'
    AND fun.estado = 'A'
    ");
$rs = $db->GetAll($sql, array($funcion));
   }

   $sql1 = $db->Prepare("SELECT *
    FROM empresa_calzados
    WHERE id_empresa_calzado=1
    AND estado <> 'X' 
    ");
$rs1 = $db->GetAll($sql1);
$nombre=$rs1[0]["nombre"];
$logo =$rs1[0]["logo"];

   echo"<html> 
   <head>
     
     <script type='text/javascript'>

     var ventanaCalendario=false
            function imprimir() {
            if(confirm(' Desea imprimir ?')){
                window.print();
            }
        }
            </script>
   </head>
   <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";
   if($rs){
    echo"<table widh='100%'' border='0'>
        <tr>
            <td><img src='../empresa/logos/{$logo}' width='70%'></td>
            <td align='center'  width='80%'><h1>REPORTES DE PERSONAS-USUARIOS</h1></td>
        </tr>
    </table>";
    echo"<center>
        <table border='1' cellspacing='0'>
            <tr>
                <th>Nro</th><th>PERSONAS</th><th>FUNCION</th>
            </tr>";
            $b=1;
            foreach($rs as $k => $fila){
                echo"<tr>
                    <td aling='center'>".$b."</td>
                    <td>".$fila['persona']."</td>
                    <td><i>".$fila['funcion']."</i></td>
                </tr>";
                $b=$b+1;
            }
        echo"</table><br>
        <b>Fecha :</b>".$fecha."</center>";
   }
echo "</body>
  </html> ";
?> 