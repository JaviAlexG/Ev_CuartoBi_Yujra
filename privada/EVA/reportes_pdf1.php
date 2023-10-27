<?php

ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>           
           </head>
           <body>";
        

            $sql = $db->Prepare("SELECT CONCAT_WS(' ',cli.nombre,cli.apellido) as persona, pe.monto_total
		 					FROM pedidos pe		 					
		 					INNER JOIN clientes cli ON pe.id_cliente=cli.id_cliente

                            WHERE pe.estado ='A'
							AND cli.estado = 'A'

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
                        <td align='center'width='80%'><h1>REPORTE DE CLIENTES</h1></td>
                    </tr>
                    </table>";
                    echo"
                    <center>
                        <table border='1' cellspacing='0' width='100%'>
                        <tr>
                        <th>Nro</th><th>CLIENTE</th><th>MONTO TOTAL</th>
                        </tr>";
                        $b=1;
                        foreach($rs as $k => $fila){
                            echo"<tr>
                                <td aling='center'>".$b."</td>
                                <td>".$fila['persona']."</td>
                                <td>".$fila['monto_total']."</td>
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