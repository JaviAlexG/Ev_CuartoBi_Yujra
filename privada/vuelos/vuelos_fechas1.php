<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$fecha1 = $_REQUEST["fecha1"];
$fecha2 = $_REQUEST["fecha2"];

$fecha11 = DATE($fecha1);
$fecha22 = DATE($fecha2);

$sql = $db->Prepare("SELECT CONCAT_WS(' - ',origen,destino) as vuelo, fecha
                    FROM vuelos		 					
                    WHERE fecha BETWEEN ? AND ?
                    ");
$rs = $db->GetAll($sql, array($fecha1,$fecha2));

$sql1 = $db->Prepare("SELECT *
		 			FROM empresa_calzados	 							 					
                    WHERE id_empresa_calzado=1
					AND estado = 'A'
					");
$rs1 = $db->GetAll($sql1);
$nombres =$rs1[0]["nombre"];
$logo =$rs1[0]["logo"];

echo"<html>
        <head>
           <script type='text/javascript'>
            var ventanaCalendario=false
            function imprimir(){
                if(confirm(' Desea imprimir ?')){
                    window.print();
                }
            }
           </script>
           </head>
           <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";
        

            if ($rs){
                echo"<table width='100%' border='0'>
                <tr>
                    <td><img src='../empresa/logos/{$logo}' width='70%'></td>
                    <td align='center'  width='80%'><h1>REPORTES DE FECHAS DE VUELOS</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                        <th>Nro</th><th>ORIGEN Y DESTINO</th><th>FECHA DE VUELO</th>
                    </tr>";
                    $b=1;
                    foreach($rs as $k => $fila){
                        echo"<tr>
                            <td aling='center'>".$b."</td>
                            <td>".$fila['vuelo']."</td>
                            <td><i>".$fila['fecha']."</i></td> --
                        </tr>";
                        $b=$b+1;
                    }
                    echo"<table><br>
                    <b>DEL :</b>".$fecha11."<b>AL :</b>".$fecha22."
                    </center>";

            }

?>