"use strict"
function buscar_empleado(){
    var d1, d2, d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('empleados1');
    d1 = document.formu.funcion.value;
    d2 = document.formu.nombre.value;
    d3 = document.formu.apellido.value;
    d4 = document.formu.ci.value;
    //alert(d1);
    ajax = nuevoAjax();
    url = 'ajax_buscar_empleado.php'
    param = 'funcion='+d1+'&nombre='+d2+'&apellido='+d3+'&ci='+d4;
    //alert(param)
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}