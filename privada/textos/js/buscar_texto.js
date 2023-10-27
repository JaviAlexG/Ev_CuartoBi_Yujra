"use strict"
function buscar_texto(){
    var d1, d2, d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('texto1');
    d1 = document.formu.tipo_texto.value;
    d2 = document.formu.codigo.value;
    d3 = document.formu.texto.value;
    d4 = document.formu.nro_paginas.value;
    //alert(d1);
    ajax = nuevoAjax();
    url = 'ajax_buscar_texto.php'
    param = 'tipo_texto='+d1+'&codigo='+d2+'&texto='+d3+'&nro_paginas='+d4;
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