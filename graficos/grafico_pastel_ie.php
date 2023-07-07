<canvas id="myChart" style="width:100%;"></canvas>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        title: 'Grafica de nivel de logro sastifatoria alcanzado de los colegios.',
        /* valores: line, bar*/

        data: {
            labels: ["subidas", "no subidas"],
            //labels: ['Red', 'Blue', 'Yellow', 'Green'],
            datasets: [{
                label: ['hola', 'que tal'],
                data: [
                    <?php
                    /*$sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                    WHERE estado_subido_excel=1");
                    $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                    WHERE estado_subido_excel=0");*/

                    $cant_subidas = mysqli_num_rows($sql_subidas);
                    $cant_nosubidas = mysqli_num_rows($sql_nosubidas);
                    echo "'" . $cant_subidas . "'," . "'" . $cant_nosubidas . "',"; ?>
                ],
                backgroundColor: ['green', 'red'],
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