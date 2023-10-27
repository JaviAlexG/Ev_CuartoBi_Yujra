<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>

            <script type= 'text/javascript'>
            function validar() {
                fecha1 =document.formu.date1.value;
                fecha2 =document.formu.date2.value;
                if ((document.formu.date1.value== '')||(document.formu.date2.value== '')||(document.formu.date1.value>
                    document.formu.date2.value)){
                    alert('Las fechas son incorrectas');
                    document.formu.date1.focus();
                    return;
                }
                ventanaCalendario=window.open('vuelos_fechas1.php?fecha1=' + fecha1 + '&fecha2=' +fecha2 , 'calendario', 'width=600, heigth=550, left=100, top=100,scrollbars=yes,menubars=no, statusbar=NO,status=NO,resizable=YES,location=NO')
            }
        </script>


        <script type='text/javascript' src='../../ajax.js'></script>
        <script type='text/javascript'>
          function buscar(){
            var d1, contenedor, url;
            contenedor = document.getElementById('personas');
            contenedor2 = document.getElementById('persona_seleccionado');
            contenedor3 = document.getElementById('persona_insertada');
            d1 = document.formu.am.value;
            d2 = document.formu.ap.value;
            d3 = document.formu.nombres.value;
            d4 = document.formu.ci.value;

            ajax = nuevoAjax();
            url = 'ajax_buscar_persona.php'
            param = 'am='+d1+'&ap='+d2+'&nombres='+d3+'&ci='+d4;
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

        function buscar_persona(id_persona){
          var d1, contenedor, url;
          contenedor = document.getElementById('persona_seleccionado');
          contenedor2 = document.getElementById('personas');
          document.formu.id_persona.value = id_persona;

       d1 = id_persona;

            ajax = nuevoAjax();
            url = 'ajax_buscar_persona1.php';
            param = 'id_persona='+d1;
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

              function insertar_persona(){
              var d1, contenedor, url;
                contenedor = document.getElementById('persona_seleccionado');
                contenedor2 = document.getElementById('personas');
                contenedor3 = document.getElementById('persona_insertada');
                d1 = document.formu.am1.value;
                d2 = document.formu.ap1.value;
                d3 = document.formu.nombres1.value;
                d4 = document.formu.ci1.value;
                d5 = document.formu.direccion1.value;
                d6 = document.formu.telefono1.value;

              if (d4 == ''){
                alert('El ci es incorrecto o el campo esta vacio');
                document.formu.ci1.focus();
                return;
              }

              if ((d1=='') && (d2=='')){
                alert('Por fabor introdusca un Apellido');
                document.formu.ap1.focus();
                return;
            }

              if (d3==''){
                alert('El nombre es incorrecto o el campo esta vacio');
                document.formu.nombres1.focus();
                return;
              }

              ajax = nuevoAjax();
              url = 'ajax_inserta_persona.php';
              param = 'ap1='+d1+'&am1='+d2+'&nombres1='+d3+'&ci1='+d4+'&direccion1='+d5+'&telefono1='+d6;
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

    </head>

        
        <body>
        <a href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion'
        style ='cursor:pointer;border-radius:10px;font-weight.bold;height: 25px;' class='boton_cerrar'></a>
            <h1>REPORTE DE FECHAS DE VUELOS</h1>;
            <form method='post' name='formu'>";
            echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; ";
	echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
                echo "<center>
                <table class='listado'>
                <tr>
                  <th>(*)Seleccionar ala Personas</th>
                  <td>
                  <table>
                   <tr>
                   <td>
                      <b>Fecha Inicio</b><br/>
                      <input type='text' name='fecha_inicio' value='' size='10' onkeyUp='buscar()'>
                      </td>
                     <td>
                      <b>Fecha Fin</b><br/>
                      <input type='text' name='fecha_fin' value='' size='10' onkeyUp='buscar()'>
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
                      <div id='personas'></div>
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
                        <div id='persona_seleccionado'></div>
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
                        <input type='hidden' name='id_persona'>
                        <div id='persona_insertada'></div>
                        </td>
                        </tr>
                        </table>
                        </td>
                        </tr>";


                    echo"<table border='1'>
                        <tr>
                            <th>*Fecha Inicio </th><th>:</th>
                            <td><input type='date' name='date1' class='tcal' value='' size='10'></td>
                            <th>*Fecha Fin </th><th>:</th>
                            <td><input type='date' name='date2' class='tcal' value='' size='10'></td>
                        </tr>
                        <tr>
                            <td align='center' colspan='6'>
                                <input type='hidden' name='accion' value=''>
                                <input type='button' value='Aceptar' onclick='validar();'' class='boton2'>
                            </td>
                        </tr>
                    </table>
                    </form>
                </center>";

        echo "</body>
            </html>";

?>
