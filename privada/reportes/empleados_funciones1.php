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
        
    $sql = $db->Prepare("SELECT CONCAT_WS(' ',em.nombre,em.apellido) as persona, fun.funcion
                        FROM empleados em		 					
                        INNER JOIN funciones fun ON em.id_funcion=fun.id_funcion
                        WHERE em.estado ='A'
                        AND fun.estado = 'A'
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
                        <td align='center'  width='80%'><h1>REPORTES DE EMPLEADOS Y FUNCIONES</h1></td>
                    </table>";
                    echo"
                    <center>
                        <table border='1' cellspacing='0'>
                        <tr>
                            <th>Nro</th><th>EMPLEADOS</th><th>FUNCIONES</th>
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
                        echo"<table><br>
                        <b>Fecha :</b>".$fecha."</center>";

                }
                echo "</body>
                    </html>";

?>