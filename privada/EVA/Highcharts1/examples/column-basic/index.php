<?php
session_start();
require_once("../../../../../conexion.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Highcharts Example</title>

		<style type="text/css">
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
	</head>
	<body>
<script src="../../code/highcharts.js"></script>
<!--<script src="../../code/modules/exporting.js"></script>-->
<script src="../../code/modules/export-data.js"></script>
<!--<script src="../../code/modules/accessibility.js"></script>-->

<figure class="highcharts-figure">
    <div id="container"></div>
    <!--<p class="highcharts-description">
        A basic column chart comparing emissions by pollutant.
        Oil and gas extraction has the overall highest amount of
        emissions, followed by manufacturing industries and mining.
        The chart is making use of the axis crosshair feature, to highlight
        years as they are hovered over.
    </p>-->
</figure>



		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'REPORTE MONTO DE CLIENTES',
        align: 'left'
    },
    /*subtitle: {
        text: 'Source: WorldClimate.com'
    },*/

    subtitle: {
        text: 'Elaborado por Javier Yujra',
        align: 'left'
    },

    xAxis: {
        categories: [
            <?php
            $sql =$db->Prepare("SELECT * FROM clientes");
            $rs = $db->GetAll($sql);
            foreach($rs as $k => $fila)
            {
                ?>
                '<?php echo $fila["nombre"]; ?>',
                <?php
            }    
            ?>
        ]
    },
    yAxis: {
        title: {
            text: 'MONTO'
        }
    },

    

    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        /*name: 'Installation & Developers',*/
        name: 'Monto total',
        /*data: [43934, 48656, 65165, 81827, 112143, 142383,
            171533, 165174, 155157, 161454, 154610]*/
            data: [
                <?php
                $sql = $db->Prepare("SELECT * FROM pedidos");
                $rs = $db->GetAll($sql);
            foreach($rs as $k => $fila)
            {
                ?>
                <?php echo $fila["monto_total"]; ?>,
                <?php
            }    
            ?>
            ]
    }/*, {
        name: 'Manufacturing',
        data: [24916, 37941, 29742, 29851, 32490, 30282,
            38121, 36885, 33726, 34243, 31050]
    }, {
        name: 'Sales & Distribution',
        data: [11744, 30000, 16005, 19771, 20185, 24377,
            32147, 30912, 29243, 29213, 25663]
    }, {
        name: 'Operations & Maintenance',
        data: [null, null, null, null, null, null, null,
            null, 11164, 11218, 10077]
    }, {
        name: 'Other',
        data: [21908, 5548, 8105, 11248, 8989, 11816, 18274,
            17300, 13053, 11906, 10073]
    }*/],
});
		</script>
	</body>
</html>
