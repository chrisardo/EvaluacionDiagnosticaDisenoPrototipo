<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    </script>
</head>

<body>
    <div id="columnchart_material" style="width: 1000px; height: 600px;"></div>


    <script>
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: 'resumen.php',
            success: function(response) {
                function drawChart() {


                    var prueba = [
                        ['Niveles de logro', 'PI', 'I', 'P', 'S'],
                        ['Niveles de logro', 125, 250, 156, 156]
                    ];

                    var padre = [
                        ['Niveles de logro', 'PI', 'I', 'P', 'S']
                    ];

                    let datos = response.map(item => item.nombre);
                    var compe = [...new Set(datos)];

                    compe.map(c => {
                        var com = [c];

                        response.filter(item => item.nombre === c).map(item => {
                            com.push(parseFloat(item.porcentaje));
                        })

                        padre.push(com);
                    })

                    var data = google.visualization.arrayToDataTable(padre);

                    var options = {
                        chart: {
                            title: 'Company Performancesssssss',
                            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                        },
                        width: '100%',
                        height: '100%',

                        legend: 'top',
                        hAxis: {
                            maxTextLines: 10,
                            textStyle: {
                                fontSize: 10,
                            }
                        }

                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }

                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);
            }
        });
    </script>

</body>

</html>