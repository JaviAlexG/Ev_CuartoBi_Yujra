<?php

ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>           
           </head>
           <body>";
        

            $sql = $db->Prepare("SELECT CONCAT_WS(' ',em.nombre,em.apellido) as persona, fun.funcion, ho.hora_ingreso, ho.hora_salida
		 					FROM empleados em		 					
		 					INNER JOIN funciones fun ON em.id_funcion=fun.id_funcion
                             INNER JOIN horarios ho ON em.id_horario=ho.id_horario
                            WHERE em.estado ='A'
							AND fun.estado = 'A'
                            AND ho.estado = 'A'
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
            $fecha = date("Y-m-d H:i:s");
                if ($rs){
                    echo"<table border='0' width='100%'>
                    <tr>
                        <td><img src='http://".$_SERVER['HTTP_HOST']."/sis_segundo_2022/privada/empresa/logos/{$logo}' width='50%'></td>
                        <td align='center'width='80%'><h1>REPORTE DE EMPLEADOS CON HORARIOS Y FUNCIONES</h1></td>
                    </tr>
                    </table>";
                    echo"
                    <center>
                        <table border='1' cellspacing='0' width='100%'>
                        <tr>
                        <th>Nro</th><th>EMPLEADOS</th><th>FUNCION</th><th>INGRESO</th><th>SALIDA</th>
                        </tr>";
                        $b=1;
                        foreach($rs as $k => $fila){
                            echo"<tr>
                                <td aling='center'>".$b."</td>
                                <td>".$fila['persona']."</td>
                                <td><i>".$fila['funcion']."</i></td>
                                <td>".$fila['hora_ingreso']."</td>
                                <td>".$fila['hora_salida']."</td>
                            </tr>";
                            $b=$b+1;
                        }
                        echo"</table><br>
                        <b>Fecha :</b>".$fecha."</center>";

                }
                echo "</body>
                    </html>";

            $html=ob_get_clean();
            //echo $html;

            require_once("../dompdf/autoload.inc.php");
            use Dompdf\Dompdf;
            $dompdf =new Dompdf();

            $options = $dompdf->getOptions();
            $options->set(array('isRemoteEnabled' => true));
            $dompdf->setOptions($options);


            $dompdf->loadHtml($html);

            $dompdf->setPaper('latter');

            //$dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            $dompdf->stream("archivo.pdf", array("Attachment" => false));

        ?>  