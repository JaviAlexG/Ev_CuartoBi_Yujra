<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <script type='text/javascript' src='../../ajax.js'></script>
        <script type='text/javascript'>
          function buscar(){
            var d1, contenedor, url;
            contenedor = document.getElementById('tipo_texto');
            contenedor2 = document.getElementById('tipo_texto_seleccionado');
            contenedor3 = document.getElementById('tipo_texto_insertada');

            d1 = document.formu.tipo_texto.value;


            ajax = nuevoAjax();
            url = 'ajax_buscar_text.php'
            param = 'tipo_texto='+d1;
            ajax.open('POST', url, true);
            ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');        
            ajax.onreadystatechange = function(){

          if(ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = '';
          }
        }
        ajax.send(param);
        
        }

        function buscar_tipo_texto(id_tipo_texto){
          var d1, contenedor, url;
          contenedor = document.getElementById('tipo_texto_seleccionado');
          contenedor2 = document.getElementById('tipo_texto');
          document.formu.id_tipo_texto.value = id_tipo_texto;

       d1 = id_tipo_texto;

            ajax = nuevoAjax();
            url = 'ajax_buscar_text.php';
            param = 'id_tipo_texto='+d1;
            ajax.open('POST', url, true);
            ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            ajax.onreadystatechange = function(){
              if(ajax.readyState == 4){
                contenedor.innerHTML = ajax.responseText;
                contenedor2.innerHTML = '';

    }
  }
  ajax.send(param)
}

              function insertar_tipo_texto1(){
              var d1, contenedor, url;
                contenedor = document.getElementById('tipo_texto_seleccionado');
                contenedor2 = document.getElementById('tipo_texto');
                contenedor3 = document.getElementById('tipo_texto_insertada');
                d1 = document.formu.tipo_texto1.value;



              if ((d1=='')){
                alert('Por fabor introdusca un Tipo de Texto');
                document.formu.ap1.focus();
                return;
            }

              

              ajax = nuevoAjax();
              url = 'ajax_inserta_texto.php';
              param = 'tipo_texto1='+d1;
              ajax.open('POST', url, true);
              ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
              alert('llega');
              ajax.onreadystatechange = function(){
                if(ajax.readyState == 4){
                    contenedor.innerHTML = ''; 
                    contenedor2.innerHTML = '';
                    contenedor3.innerHTML = ajax.responseText;  
        }
}
ajax.send(param);
}

            </script>
            </head>";
            echo"<body>
              <a  href='../../listado_tablas.php'>Listado de tablas</a>
              <a  href='textos.php'>Listado de Textos</a>
              <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       //echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; " ;
       //echo "ROL:  ".$_SESSION["sesion_rol"]."</h3>";
         echo" <h1>INSERTAR TEXTO</h1>";

$sql = $db->Prepare("SELECT *#CONCAT_WS(' ' ,am, ap, nombres, ci) as persona, id_persona
                     FROM tipos_textos
                   
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='texto_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Seleccionar Tipo de texto</th>
                    <td>
                    <table>
                     <tr>
                     <td>
                        <b></b><br/>
                        <input type='text' name='tipo_texto' value='' size='10' onkeyUp='buscar()'>
                        </td>
                       
                        </tr>
                        </table>
                        </td>
                    </tr>";
                  echo"<tr>
                        <td colspan ='6' align='center'>
                         <table width='100%'>
                         <tr>
                         <td colspan='3' align='center'>
                        <div id='tipo_texto'></div>
                        </td>
                        </tr>
                        </table>
                        </td>
                        </tr>
                        <tr>
                        <td colspan='6' align='center'>
                          <table width='100%'>
                          <tr>
                          <td colspan='3'>
                          <div id='tipo_texto_seleccionado'></div>
                          </td>
                          </tr>
                          </table>
                          </td>
                          </tr>
                          <tr>
                          <td colspan='6' align='center'>
                          <table width='100%'>
                          <tr>
                          <td colspan='3'>
                          <input type='hidden' name='id_tipo_texto'>
                          <div id='tipo_texto_insertada'></div>
                          </td>
                          </tr>
                          </table>
                          </td>
                          </tr>";
             echo"<tr>
                    <th><b>(*)Codigo</b></th>
                    <td><input type='text' name='codigo' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Texto</b></th>
                    <td><input type='text' name='texto' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Nro Paginas</b></th>
                    <td><input type='number' name='nro_paginas' size='2'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR TEXTO'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>