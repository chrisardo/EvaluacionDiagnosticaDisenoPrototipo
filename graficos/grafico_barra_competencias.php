<canvas id="myChart"></canvas>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        title: 'Grafica de nivel de logro sastifatoria alcanzado de los colegios por provincia.',
        /* valores: line, bar*/

        data: {
            labels: ['Competencia 1', 'Competencia 2', 'Competencia 3', 'Competencia 4'
                <?php
                /*$sql_competencias = mysqli_query($mysqli, "SELECT * FROM competencias
                WHERE id_asignatura=2");
                $competencias = mysqli_fetch_all($sql_competencias, MYSQLI_ASSOC);
                foreach ($competencias as $row_com) {
                    $competencia = $row_com['nombre']; ?>
                    <?php echo "'" . $competencia . "',";
                    ?>
                <?php } */ ?>
            ],
            //labels: ['Red', 'Blue', 'Yellow', 'Green'],
            datasets: [{
                label: ['Nivel de logro de las competencias'],
                data: [
                    <?php
                    $sql_competencias = mysqli_query($mysqli, "SELECT*FROM competencias WHERE id_asignatura='1' ");
                    $cant_competencias = mysqli_num_rows($sql_competencias);
                    $competencias = mysqli_fetch_all($sql_competencias, MYSQLI_ASSOC);
                    foreach ($competencias as $row_c) {
                        $nombre_compe = $row_c['nombre'];
                        $id_compe = $row_c['id_competencia'];
                        $sql_resumen3 = mysqli_query($mysqli, "SELECT resumen_evaluacion.id_competencia, resumen_evaluacion.id_nivel id_nivel_re, SUM(resumen_evaluacion.porcentaje) porcentaje, 
                            resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura, resumen_evaluacion.cod_mod_ie
                            FROM resumen_evaluacion where resumen_evaluacion.id_competencia='$id_compe'
                            ORDER BY resumen_evaluacion.id_resumen ASC");
                        $cant_resumen3 = mysqli_num_rows($sql_resumen3);
                        $resumen_eva3 = mysqli_fetch_all($sql_resumen3, MYSQLI_ASSOC);
                        foreach ($resumen_eva3 as $row_r3) {
                            $porcentajes = $row_r3['porcentaje'];
                        }
                        //echo $nombre_compe . " : " . $porcentajes . "<br>";
                        echo "'" . $porcentajes . "',";
                    }
                    ?>
                ],
                backgroundColor: 'rgb(14, 209, 69)',
                borderWidth: 2
            }],
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    function CargarDatosGraficoBar() {
        $.ajax({
            url: 'controlador_grafico.php',
            type: 'POST'
        }).done(function(resp) {
            alert(resp);
        })
    }
</script>