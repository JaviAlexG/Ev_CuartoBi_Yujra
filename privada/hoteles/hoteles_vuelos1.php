<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

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
        
           $sql = $db->Prepare("SELECT CONCAT_WS(' - ',vu.origen, vu.destino) AS vuelo, ho.codigo, ho.nombre, ho.telefonos, ho.direccion
           FROM hoteles ho	
           INNER JOIN vuelos vu ON vu.id_hotel=ho.id_hotel 					
          ");
$rs = $db->GetAll($sql);

            $sql1 = $db->Prepare("SELECT *
		 					FROM empresa_calzados		 							 					
                            WHERE id_empresa_calzado=1
							AND estado = 'A'
							");
		    $rs1 = $db->GetAll($sql1);
            $nombre =$rs1[0]["nombre"];
            $logo =$rs1[0]["logo"];
            $fecha =date("Y-m-d H:i:s");
                if ($rs){
                    echo"<table width='100%' border='0'>
                        <td><img src='../empresa/logos/{$logo}' width='70%'></td>
                        <td align='center'  width='80%'><h1>REPORTES DE HOTELES</h1></td>
                    </table>";
                    echo"
                    <center>
                        <table border='1' cellspacing='0'>
                        <tr>
                        <th>Nro</th><th>VUELO</th><th>COD</th><th>HOTEL</th><th>TELEFONOS</th><th>DIRECCION</th>
                        </tr>";
                        $b=1;
                        foreach($rs as $k => $fila){
                            echo"<tr>
                                <td aling='center'>".$b."</td>
                                <td>".$fila['vuelo']."</td>
                                <td>".$fila['codigo']."</td>
                                    <td>".$fila['nombre']."</td>
                                    <td>".$fila['telefonos']."</td>
                                    
                                    <td>".$fila['direccion']."</td>
                            </tr>";
                            $b=$b+1;
                        }
                        echo"<table><br>
                        <b>Fecha :</b>".$fecha."</center>";

                }
                echo "</body>
                    </html>";

?>