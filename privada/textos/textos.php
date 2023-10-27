<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_texto.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='texto_nuevo.php'>Nueva Texto</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
         <h1>LISTADO DE TEXTOS</h1>";
         echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

$sql = $db->Prepare("SELECT *
                    FROM tipos_textos                 
                        ");
$rs = $db->GetAll($sql);

echo"
<!------INICIO BUSCADOR---------------->
    <center>
     <form action='#'' method='post' name='formu'>
     <table border='1' class='listado'>
    <tr>
    <th>
     <b>TIPO DE TEXTO</b><br />
     <select name='tipo_texto' onChange='buscar_texto()'>
     <option value=''>--Seleccione--</option>";
     foreach ($rs as $k => $fila) {
     echo"<option value='".$fila['tipo_texto']."'>".$fila['tipo_texto']."</option>";
     }  

echo"</select>
</th> 
        <th>
          <b>Codigo</b><br />
          <input type='text' name='codigo' value='' size='10' onKeyUp='buscar_texto()'>
        </th>
        <th>
          <b>Texto</b><br />
          <input type='text' name='texto' value='' size='10' onKeyUp='buscar_texto()'>
        </th>
        <th>
          <b>Nro Paginas</b><br />
          <input type='text' name='nro_paginas' value='' size='10' onKeyUp='buscar_texto()'>
        </th>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='texto1'> ";

$sql = $db->Prepare("SELECT *
                     FROM textos te, tipos_textos tip
                     WHERE te.id_tipo_texto=tip.id_tipo_texto
                     ORDER BY id_texto DESC                      
                        ");
$rs = $db->GetAll($sql);

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>TIPOS DE TEXTO</th><th>CODIGO</th><th>TEXTO</th><th>PAGINAS</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['tipo_texto']."</td>
                        <td>".$fila['codigo']."</td>
                        <td>".$fila['texto']."</td>
                        <td>".$fila['nro_paginas']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_texto"]."' method='post' action='texto_modificar.php'>
                            <input type='hidden' name='id_texto' value='".$fila['id_texto']."'>
                            <a href='javascript:document.formModif".$fila['id_texto'].".submit();' title='Modificar Texto del Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_texto"]."' method='post' action='texto_eliminar.php'>
                            <input type='hidden' name='id_texto' value='".$fila["id_texto"]."'>
                            <a href='javascript:document.formElimi".$fila['id_texto'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al empleado ".$fila["texto"]." ".$fila["codigo"]." ?\"))'; location.href='empleado_eliminar.php''> 
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

echo "</body>
      </html> ";

 ?>