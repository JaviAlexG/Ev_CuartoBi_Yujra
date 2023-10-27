<?php
//mio
ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
        <head>           
           </head>
           <body>";
        
            /*$sql = $db->Prepare("SELECT CONCAT_WS(' ',nombres,ap,am) as persona, usu.usuarios
		 					FROM vista_pers_usu");
		    $rs = $db->GetAll($sql);

            $sql1 = $db->Prepare("SELECT *
		 					FROM empresa_calzados		 							 					
                            WHERE id_empresa_calzado=1
							AND estado = 'A'
							");
		    $rs1 = $db->GetAll($sql1);*/

            $sql =$db->Prepare("SELECT CONCAT_WS(' ',per.nombres,per.ap,per.am) as persona, u.*
                    FROM personas per
                    INNER JOIN usuarios u ON u.id_persona=per.id_persona
                    WHERE u.estado='A' AND per.estado='A'
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
                        <td align='center'width='80%'><h1>REPORTES DE PERSONAS-USUARIOS</h1></td>
                    </tr>
                    </table>";
                    echo"
                    <center>
                        <table border='1' cellspacing='0' width='100%'>
                        <tr>
                            <th>Nro</th><th>PERSONAS</th><th>NOMBRE DE USUARIO</th>
                        </tr>";
                        $b=1;
                        foreach($rs as $k => $fila){
                            echo"<tr>
                                <td aling='center'>".$b."</td>
                                <td>".$fila['persona']."</td>
                                <td><i>".$fila['usuarios']."</i></td>
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