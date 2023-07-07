<canvas id="myChart" style="width:100%;" height="100"></canvas>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        title: 'Grafica de nivel de logro sastifatoria alcanzado.',
        /* valores: line, bar*/

        data: {
            labels: [
                <?php foreach ($competencias as $row_c) {
                    $nombre_compe = $row_c['nombre'];
                    $id_compe = $row_c['id_competencia']; ?>
                    <?php echo "'" . $nombre_compe . "',"; ?>
                <?php } ?>
            ],
            //labels: ['Red', 'Blue', 'Yellow', 'Green'],
            datasets: [{
                label: ['hola'

                ],
                data: [
                    <?php foreach ($competencias as $row_c) {
                        $nombre_compe = $row_c['nombre'];
                        $id_compe = $row_c['id_competencia'];
                        $sql_resumen3 = mysqli_query($mysqli, "SELECT resumen_evaluacion.id_competencia, resumen_evaluacion.id_nivel id_nivel_re, resumen_evaluacion.porcentaje porcentaje, 
                        resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura, resumen_evaluacion.cod_mod_ie
                        FROM resumen_evaluacion where resumen_evaluacion.cod_mod_ie='$cod_mod_ie' and resumen_evaluacion.id_competencia='$id_compe' and resumen_evaluacion.id_grado='$id_grado' and resumen_evaluacion.id_asignatura='$id_asigna' 
                        ORDER BY resumen_evaluacion.id_resumen ASC");
                        $cant_resumen3 = mysqli_num_rows($sql_resumen3);
                        $resumen_eva3 = mysqli_fetch_all($sql_resumen3, MYSQLI_ASSOC);
                        foreach ($resumen_eva3 as $row_r3) {
                            $porcentaje = $row_r3['porcentaje'];
                        } ?>
                        <?php echo "" . $porcentaje . ","; ?>
                    <?php
                    } ?>

                ],
                backgroundColor: ['red', 'blue', 'green', 'orange'],
                borderColor: ['blue', 'greenyellow', 'green'],
                borderWidth: 1
            }],
        },

        options: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
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