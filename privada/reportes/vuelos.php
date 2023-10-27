<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");

//$db->debug=true;

echo"<html> 
      <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
        <script type='text/javascript' src='../../ajax.js'></script>
        <script type='text/javascript' src='js/buscar_opcion.js'> </script>
      </head>
      <body>
      <a  href='../../listado_tablas.php'>Listado de tablas</a>
      <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

      echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
      echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

      echo"<h1>VUELOS</h1>";   
      



contarRegistros($db,"vuelos");
paginacion("vuelos.php?");

$sql = $db->Prepare("SELECT h.*, CONCAT_WS('-',v.origen,v.destino) as vue, v.*
      FROM vuelos v
      INNER JOIN hoteles h ON h.id_hotel = v.id_hotel
      WHERE v.id_vuelo>1
      AND h.id_hotel>1
      
      LIMIT ? OFFSET ? 
  ");  
  $rs = $db->GetAll($sql, array($nElem,$regIni));

  if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                <th>NRO</th><th>HOTEL</th><th>CIUDAD</th><th>VUELO</th><th>FECHA</th>
                  
                </tr>";
                $b=0;
                $total= $pag-1;
                $a= $nElem*$total;
                $b= $b+1+$a;

            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre']."</td>
                        <td>".$fila['ciudad']."</td>
                        <td>".$fila['vue']."</td>
                        <td>".$fila['fecha']."</td>
                                               
                        </td>
                    </tr>";
                    $b=$b+1;
            }
            echo"</table>
          </center>";
    }
echo"</div>";

echo"<!--PAGINACION------------------------>";
                  echo"<table border='0' align='center'>
                        <tr>
                        <td>";
                        if(!empty($urlback)){
                          echo"<a href=".$urlback." style='font-family:Verdana;font-size:9px;cursor:pointer';>&laquo;Anterior</a>";

                        }
                        if(!empty($paginas)){
                          foreach($paginas as $k=> $pagg){
                            if($pagg["npag"]== $pag){
                              if($pag != '1'){
                                echo"|";
                              }
                              echo"<b style='color:#FFFFFF;font-size: 12px;'>";
                          }else
                          echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>";echo $pagg["npag"]; echo"</a>";
                        }
                      }

                      if(($nPags > $nBotones) and (!empty($urlnext)) and ($pag <$nPags)){
                        echo"| <a href=".$urlnext." style='font-family: Verdana;font-size: 9px;cursor:pointer'>Siguiente&raquo;</a>";
                      }
                      echo"</td>
                      </tr>
                      </table>";
                      echo"<!--PAGINACION------------------------>";

echo "</body>
      </html> ";
      

?>