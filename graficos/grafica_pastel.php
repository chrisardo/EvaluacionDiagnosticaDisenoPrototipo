<div id="chart_div" style="width: 900px; height: 500px;"></div>
<!--Load the AJAX API-->
<script type="text/javascript" src="js/google-chart-loader.js"></script>
<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {
        // Create the data table.
        var data = google.visualization.arrayToDataTable([
            ['Tarea', 'SUBTOTAL'],
            [
                <?php foreach ($competencias as $row_c) {
                    $nombre_compe = $row_c['nombre'];
                    $id_compe = $row_c['id_competencia'];
                    echo "'" . $nombre_compe . "'"; ?>, 3
                <?php } ?>
            ]
        ]);


        // Set chart options
        var options = {
            'title': 'Grafica de nivel de logro sastifatoria alcanzado.',
            'width': 400,
            'height': 300
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<?php
/*$sql_resumen = mysqli_query($mysqli, "SELECT resumen_evaluacion.id_competencia, resumen_evaluacion.id_nivel id_nivel_re, resumen_evaluacion.porcentaje porcentaje, 
          resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura id_asignatura, resumen_evaluacion.cod_mod_ie,
          grado.id_grado, grado.nombre_grado g_nombre_grado
          FROM resumen_evaluacion inner join grado on grado.id_grado=resumen_evaluacion.id_grado 
          where resumen_evaluacion.id_asignatura='$asignaturas' and resumen_evaluacion.id_grado='$grados' and resumen_evaluacion.cod_mod_ie='$cod_mod_ie'
          group by resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura ORDER BY resumen_evaluacion.id_grado ASC");
$cant_resumen = mysqli_num_rows($sql_resumen);
//if ($cant_resumen > 0) {
$resumen_eva = mysqli_fetch_all($sql_resumen, MYSQLI_ASSOC);
foreach ($resumen_eva as $row_r) {
    $id_grado = $row_r['id_grado'];
    $id_nivel_re = $row_r['id_nivel_re'];
    $id_asigna = $row_r['id_asignatura'];

    $sql_nivel_res = mysqli_query($mysqli, "SELECT*FROM nivel_logro_evalua");
    $cant_nivel_res = mysqli_num_rows($sql_nivel_res);
    $nivel_res = mysqli_fetch_all($sql_nivel_res, MYSQLI_ASSOC);

    $sql_competencias = mysqli_query($mysqli, "SELECT*FROM competencias WHERE id_asignatura='$id_asigna' ");
    $cant_competencias = mysqli_num_rows($sql_competencias);
    $competencias = mysqli_fetch_all($sql_competencias, MYSQLI_ASSOC);
    $sql_asignaturas = mysqli_query($mysqli, "SELECT*FROM asignatura WHERE id_asignatura='$id_asigna' ");
    $cant_asignaturas = mysqli_num_rows($sql_asignaturas);
    $asignaturas = mysqli_fetch_all($sql_asignaturas, MYSQLI_ASSOC);
    foreach ($asignaturas as $row_as) {
    }
}*/
?>