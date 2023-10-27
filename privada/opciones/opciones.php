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

      echo"<h1>OPCIONES</h1>";   
      $sql = $db->Prepare("SELECT *
                          FROM grupos 
                          WHERE estado <> 'X'
                          ");  
  $rs = $db->GetAll($sql);
echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
    <tr>
    <th>
    <b>Grupo</b><br />
    <select name='grupo' onChange='buscar_opcion()'>
    <option value=''>--Seleccione--</option>";
    foreach ($rs as $k => $fila) {
    echo"<option value='".$fila['grupo']."'>".$fila['grupo']."</option>";
    }  

echo"</select>
</th> 
        <th>
          <b>Opcion</b><br />
          <input type='text' name='opcion' value='' size='10' onKeyUp='buscar_opcion()'>
        </th>
        <th>
          <b>Contenido</b><br />
          <input type='text' name='contenido' value='' size='10' onKeyUp='buscar_opcion()'>
        </th>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";


echo"<div id='opciones1'> ";

contarRegistros($db,"opciones");
paginacion("opciones.php?");

$sql = $db->Prepare("SELECT g.*,o.*
      FROM opciones o
      INNER JOIN grupos g ON g.id_grupo = o.id_grupo
      WHERE g.estado <> 'X' 
      AND o.id_opcion>1
      AND o.id_grupo>1
      AND o.estado <> 'X'
      
      LIMIT ? OFFSET ? 
  ");  
  $rs = $db->GetAll($sql, array($nElem,$regIni));

  if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                <th>NRO</th><th>GRUPOS</th><th>OPCIONES</th><th>CONTENIDO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total= $pag-1;
                $a= $nElem*$total;
                $b= $b+1+$a;

            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                <td align='center'>".$b."</td>
                        <td align='center'>".$fila['grupo']."</td>
                        <td>".$fila['opcion']."</td>
                        <td>".$fila['contenido']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_opcion"]."' method='post' action='opcion_modificar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
                            <input type='hidden' name='id_grupo' value='".$fila['id_grupo']."'>
                            <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_opcion"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' 
                            title='Eliminar opcion Sistema'
                            onclick='javascript:return(confirm(\"Desea realmente Eliminar al opcion ".$fila["usuario"]." ?\"))'; 
                            location.href=='opcion_eliminar.php''> 
                            Eliminar>>
                            </a>
                          </form>                        
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