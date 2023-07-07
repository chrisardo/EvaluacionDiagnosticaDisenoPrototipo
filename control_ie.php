<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Evaluacion diagnostica">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://evaluaciondiagnostica-grel.000webhostapp.com/" />
    <meta name="twitter:title" content="Evaluacion diagnostica">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="https://evaluaciondiagnostica-grel.000webhostapp.com/img/logokillari.jpg">
    <meta property="og:image" content="https://evaluaciondiagnostica-grel.000webhostapp.com/img/logokillari.jpg">
    <meta property="og:locale" content="es_ES">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Control | Evaluacion diagnostica">
    <meta property="og:url" content="https://evaluaciondiagnostica-grel.000webhostapp.com/">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta property="og:site_name" content="Evaluacion diagnostica">

    <title>Control | Evaluación diagnostica</title>
    <link rel="icon" href='img/logo.jpg' sizes="32x32" type="img/jpg">
    <link rel="stylesheet" href="./css/nav-conten.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="libreria/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>

    <!--<script src="https://www.google.com/recaptcha/api.js?render=6Le5wKIkAAAAABPaAg4SmdnEYW5EmJ28kwla7HGq"></script>
    <script>
        $(document).ready(function() {
            $('#entrar').click(function() {
                grecaptcha.ready(function() {
                    grecaptcha.execute('6Le5wKIkAAAAABPaAg4SmdnEYW5EmJ28kwla7HGq', {
                        action: 'validarUsuario'
                    }).then(function(token) {
                        $('#form-login').prepend('<input type="hidden" name="token" value="' + token + '">');
                        $('#form-login').prepend('<input type="hidden" name="action" value="validarUsuario">');
                        $('#form-login').submit();
                    });
                });
            })
        })
    </script>-->
</head>

<body>
    <!--  INICIO DEL HEADER -->
    <header>
        <nav class="bg-body-tertiary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <a class="navbar-brand" href="#">
                            <img src="img/logoGrel_ED.png" alt="Bootstrap" width="" height="72">
                        </a>
                    </div>
                    <div class="col">
                        <p style="margin-top: 4px; color:green; font-size: 26px;">Presentación de resultados</p>
                    </div>
                </div>
            </div>

            </div>
        </nav>
        <nav class="navbar navbar-expand-lg navbar ">
            <div class="container">

                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto gap-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="resumen_evaluacion_diagnostica.php">Resumen Evaluación
                                Diagnóstica</a>
                        </li>
                        <li class="nav-item border border-dark rounded bg-body-tertiary">
                            <a class="nav-link active " href="control_ie.php">Control de Instituciones Educativas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php
    require("controlador/connectdb.php"); //Llamar a la conexion de la BD
    include 'controlador/sed.php'; //Llmar al metodo de encriptacion y desencriptar
    ?>
    <div style="margin-top:6px; background: #40CFFF;">
        <form action="" id="form-login" enctype="multipart/form-data" style="margin-left:46px;" method="post">
            <div class="row">
                <div class="col">
                    <div style="display: inline-block;">
                        <label for="" style="color:white;" class="formulario__label">GREL: </label>
                    </div>
                    <div style="display: inline-block; margin-top:4px; margin-left:6px;">
                        <select id="codigo" name="departamento" class="form-control">
                            <option value="" selected="">Selecciona</option>
                            <?php
                            //Consulta para seleccionar el campo departamento de la tabla de institucion educativa
                            $q_region = mysqli_query($mysqli, "SELECT departamento_ie FROM institucion_educativa GROUP BY departamento_ie");
                            $region = mysqli_fetch_all($q_region, MYSQLI_ASSOC);
                            foreach ($region as $row_r) {
                            ?>
                                <option value="<?php echo $row_r['departamento_ie']; ?>"><?php echo $row_r['departamento_ie']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div style="display: inline-block;">
                        <label for="" style="color:white;" class="formulario__label">UGEL: </label>
                    </div>
                    <div style="display: inline-block; margin-top:4px; margin-left:6px;">
                        <select id="provinci" name="provinci" class="form-control">
                            <option value="" selected="">Selecciona</option>
                            <?php
                            //Consulta para seleccionar el campo provincia de la tabla de institucion educativa
                            $q_provincia = mysqli_query($mysqli, "SELECT provincia_ie FROM institucion_educativa GROUP BY provincia_ie");
                            $provincias = mysqli_fetch_all($q_provincia, MYSQLI_ASSOC);
                            foreach ($provincias as $row_p) {
                            ?>
                                <option value="<?php echo $row_p['provincia_ie']; ?>"><?php echo $row_p['provincia_ie']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div style="display: inline-block;">
                        <label for="" style="color:white;" class="formulario__label">DISTRITO: </label>
                    </div>
                    <div style="display: inline-block; margin-top:4px; margin-left:6px;">
                        <select id="" name="distritos" class="form-control">
                            <option value="" selected="">Selecciona</option>
                            <?php
                            //Consulta para seleccionar el campo distrito de la tabla de institucion educativa
                            $q_distrito = mysqli_query($mysqli, "SELECT distrito_ie FROM institucion_educativa GROUP BY distrito_ie");
                            $distrito = mysqli_fetch_all($q_distrito, MYSQLI_ASSOC);
                            foreach ($distrito as $row_d) {
                            ?>
                                <option value="<?php echo $row_d['distrito_ie']; ?>"><?php echo $row_d['distrito_ie']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div style="display: inline-block;">
                        <label for="" style="color:white;" class="formulario__label">I.E.: </label>
                    </div>
                    <div style="display: inline-block; margin-top:4px; margin-left:0px;">
                        <select id="" name="i_ed" class="form-control">
                            <option value="" selected="">Selecciona cód. modular</option>
                            <?php

                            //Consulta para seleccionar el campo distrito de la tabla de institucion educativa
                            $q_colegio = mysqli_query($mysqli, "SELECT cod_mod_ie, nombre_ie FROM institucion_educativa GROUP BY cod_mod_ie");
                            $cant_colegio = mysqli_num_rows($q_colegio);
                            $colegio = mysqli_fetch_all($q_colegio, MYSQLI_ASSOC);
                            foreach ($colegio as $row_c) {
                            ?>
                                <option value="<?php echo $row_c['cod_mod_ie']; ?>"><?php echo $row_c['cod_mod_ie']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <input type="submit" name="verificar" class="btn btn-success" value="Verificar" style="color: white; margin-top: 5px;" />
                    <!--<button type="button" id="entrar" style="color: white; margin-top: 6px;" class="btn btn-primary g-recaptcha">Verificar</button>-->

                </div>
            </div>
        </form>
    </div>
    <?php
    /*if (isset($_POST['token']) && isset($_POST['action'])) {
            $token = $_POST['token'];
            $action = $_POST['action'];
            $secret = '6Le5wKIkAAAAALzbGF3ER6Du6QlUZF3YH_D8hIv3'; // Ingresa tu clave secreta del recaptcha.....
            @$response2 = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token");
            $datos = json_decode($response2, true);*/
    if (isset($_POST['verificar'])) { //Al darle click en el boton verificar
        //Llamando los name: departamento, provincia, distrito de los inputs
        $departamentos = $_POST['departamento'];
        $provin = $_POST['provinci'];
        $distrito = $_POST['distritos'];
        $inst_edu = $_POST['i_ed'];
        @$cod_mod_ie = sed::encryption($inst_edu);
        if (empty($_POST['departamento']) && empty($_POST['provinci']) && empty($_POST['distritos']) && empty($_POST['i_ed'])) { //Si los name de los inputs del departamento, provincia y distrito están vacíos
            echo "Define los parámetros de las opciones";
            $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa");
            $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
            WHERE estado_subido_excel=1");
            $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
            WHERE estado_subido_excel=0");
            require "vista/opcionesElegir.php";
        } else {
            if (!empty($_POST['departamento'])) { //Si eligio la opcion del departamento
                if (!empty($_POST['provinci']) && empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien la provincia
                    $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE departamento_ie='$departamentos' and provincia_ie='$provin' order by provincia_ie");
                    $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1 and departamento_ie='$departamentos' and provincia_ie='$provin'");
                    $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0 and departamento_ie='$departamentos' and provincia_ie='$provin'");
                    require "vista/opcionesElegir.php";
                    @$q_archivo = mysqli_query($mysqli, "SELECT*FROM upload order by fecha desc");
                    require "vista/fechaEvaluacion.php";
                }
                if (empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien el distrito
                    //Consulta para seleccionar el departamento y la distrito de la tabla institucion educativa
                    $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where departamento_ie='$departamentos'and distrito_ie='$distrito'");
                    $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                   WHERE estado_subido_excel=1 and departamento_ie='$departamentos'and distrito_ie='$distrito'");
                    $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                   WHERE estado_subido_excel=0 and departamento_ie='$departamentos'and distrito_ie='$distrito'");
                    require "vista/opcionesElegir.php";
                    @$q_archivo = mysqli_query($mysqli, "SELECT*FROM upload order by fecha desc");
                    require "vista/fechaEvaluacion.php";
                }
                if (empty($_POST['provinci']) && empty($_POST['distritos']) && $_POST['i_ed'] < 0) { //Al elegir el departamento no selecciono ni la provicnia ni el distrito
                    //Consulta para obtener el depatamento seleccionado de la tabla institucion educativa
                    $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where departamento_ie='$departamentos' ");
                    $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                     WHERE estado_subido_excel=1 and departamento_ie='$departamentos'");
                    $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                     WHERE estado_subido_excel=0 and departamento_ie='$departamentos'");
                    require "vista/opcionesElegir.php";
                    @$q_archivo = mysqli_query($mysqli, "SELECT*FROM upload order by fecha desc");
                    require "vista/fechaEvaluacion.php";
                }
                if (!empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono la provicnia y el distrito
                    if ($_POST['i_ed'] > 0) { //Al elegir el departamento selecciono la provicnia y el distrito
                        //Consulta para obtener el depatamento, provincia y el distrito seleccionado de la tabla institucion educativa
                        $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa 
                             where cod_mod_ie='$cod_mod_ie' and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito' ");
                        $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                       WHERE cod_mod_ie='$cod_mod_ie' and estado_subido_excel=1 and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito'");
                        $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                       WHERE cod_mod_ie='$cod_mod_ie' and estado_subido_excel=0 and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito'");
                        require "vista/opcionesElegir.php";
                        @$q_archivo = mysqli_query($mysqli, "SELECT*FROM upload where cod_mod_ie='$cod_mod_ie'");
                        require "vista/fechaEvaluacion.php";
                    } else {
                        //Consulta para obtener el depatamento, provincia y el distrito seleccionado de la tabla institucion educativa
                        $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa 
                                 where departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito' ");
                        $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                           WHERE estado_subido_excel=1 and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito'");
                        $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                                           WHERE estado_subido_excel=0 and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito'");
                        require "vista/opcionesElegir.php";
                        @$q_archivo = mysqli_query($mysqli, "SELECT*FROM upload order by fecha desc");
                        require "vista/fechaEvaluacion.php";
                    }
                }
            } else {
                $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa");
                $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                WHERE estado_subido_excel=1");
                $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
                WHERE estado_subido_excel=0");
                require "vista/opcionesElegir.php";
                @$q_archivo = mysqli_query($mysqli, "SELECT*FROM upload order by fecha desc");
                require "vista/fechaEvaluacion.php";
            }
        }
    } else {
        $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa");
        $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
        WHERE estado_subido_excel=1");
        $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
        WHERE estado_subido_excel=0");
        require "vista/opcionesElegir.php";
        @$q_archivo = mysqli_query($mysqli, "SELECT*FROM upload order by fecha desc");
        require "vista/fechaEvaluacion.php";
    }
    ?>


    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-sm-9">
                <div class="row align-items-md-stretch pb-4">
                    <div class="col-md-6">
                        <h6 class="py-2">Control de Evaluación Diagnóstica
                            <?php
                            if (isset($_POST['verificar'])) { //Al darle click en el boton verificar
                                if (!empty($_POST['departamento'])) { //Si eligio la opcion del departamento
                                    if (!empty($_POST['provinci']) && empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien la provincia
                                        echo "de: " . $_POST['departamento'] . " >" . $_POST['provinci'];
                                    }
                                    if (empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien el distrito
                                        echo "de: " . $_POST['departamento'] . " >" . $_POST['distritos'];
                                    }
                                    if (empty($_POST['provinci']) && empty($_POST['distritos'])) { //Al elegir el departamento no selecciono ni la provicnia ni el distrito
                                        echo "de: " . $_POST['departamento'];
                                    }
                                    if (!empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono la provicnia y el distrito
                                        echo "de: " . $_POST['departamento'] . " >" . $_POST['provinci'] . " >" . $_POST['distritos'];
                                    }
                                }
                            }
                            ?>
                        </h6>

                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-success btn-sm">Exportar Excel</button>
                        <button type="button" class="btn btn-danger btn-sm">Exportar PDF</button>
                        <!--<button type="button" class="btn btn-warning btn-sm">Imprimir</button>-->
                    </div>
                </div>
                <main>
                    <div class="container pb-4">
                        <div class="row align-items-md-stretch pb-4">
                            <div class="col-md-6 ">
                                <?php
                                if (isset($_POST['verificar'])) { //Al darle click en el boton verificar
                                    //Llamando los name: departamento, provincia, distrito de los inputs
                                    $departamentos = $_POST['departamento'];
                                    $provin = $_POST['provinci'];
                                    $distrito = $_POST['distritos'];
                                    if (empty($_POST['departamento']) && empty($_POST['provinci']) && empty($_POST['distritos'])) { //Si los name de los inputs del departamento, provincia y distrito están vacíos
                                        $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa");
                                        $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1");
                                        $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0");
                                        require "graficos/grafico_pastel_ie.php";
                                    } else {
                                        if (!empty($_POST['departamento'])) { //Si eligio la opcion del departamento
                                            if (!empty($_POST['provinci']) && empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien la provincia
                                                $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE departamento_ie='$departamentos' and provincia_ie='$provin' order by provincia_ie");
                                                $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1 and departamento_ie='$departamentos' and provincia_ie='$provin'");
                                                $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0 and departamento_ie='$departamentos' and provincia_ie='$provin'");
                                                require "graficos/grafico_pastel_ie.php";
                                            }
                                            if (empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien el distrito
                                                //Consulta para seleccionar el departamento y la distrito de la tabla institucion educativa
                                                $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where departamento_ie='$departamentos'and distrito_ie='$distrito'");
                                                $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1 and departamento_ie='$departamentos'and distrito_ie='$distrito'");
                                                $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0 and departamento_ie='$departamentos'and distrito_ie='$distrito'");
                                                require "graficos/grafico_pastel_ie.php";
                                            }
                                            if (empty($_POST['provinci']) && empty($_POST['distritos'])) { //Al elegir el departamento no selecciono ni la provicnia ni el distrito
                                                //Consulta para obtener el depatamento seleccionado de la tabla institucion educativa
                                                $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where departamento_ie='$departamentos' ");
                                                $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1 and departamento_ie='$departamentos'");
                                                $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0 and departamento_ie='$departamentos'");
                                                require "graficos/grafico_pastel_ie.php";
                                            }
                                            if (!empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono la provicnia y el distrito
                                                //Consulta para obtener el depatamento, provincia y el distrito seleccionado de la tabla institucion educativa
                                                $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito' ");
                                                $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1 and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito'");
                                                $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0 and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito'");
                                                require "graficos/grafico_pastel_ie.php";
                                            }
                                        } else {
                                            $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa");
                                            $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1");
                                            $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0");
                                            require "graficos/grafico_pastel_ie.php";
                                        }
                                    }
                                } else {
                                    $consult_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa");
                                    $sql_subidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=1");
                                    $sql_nosubidas = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE estado_subido_excel=0");
                                    require "graficos/grafico_pastel_ie.php";
                                }
                                ?>

                            </div>
                            <div class="col-md-6 bg-light border rounded-3">
                                <?php require "Mapas/mapa2.php"; ?>
                            </div>
                            <div class="container text-center pt-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <?php
                                        if (isset($_POST['verificar'])) { //Al darle click en el boton verificar
                                            //Llamando los name: departamento, provincia, distrito de los inputs
                                            $departamentos = $_POST['departamento'];
                                            $provin = $_POST['provinci'];
                                            $distrito = $_POST['distritos'];
                                            $inst_edu = $_POST['i_ed'];
                                            $inst_edu2 = sed::encryption($inst_edu);

                                            if (empty($_POST['departamento']) && empty($_POST['provinci']) && empty($_POST['distritos']) && empty($_POST['i_ed'])) { //Si los name de los inputs del departamento, provincia y distrito están vacíos

                                            } else {
                                                if (!empty($_POST['departamento'])) { //Si eligio la opcion del departamento
                                                    if (!empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono la provicnia y el distrito

                                                        if ($_POST['i_ed'] > 0) { //Al elegir el departamento selecciono la provicnia y el distrito
                                                            //Consulta para obtener el depatamento, provincia y el distrito seleccionado de la tabla institucion educativa
                                                            $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where cod_mod_ie='$inst_edu2' and departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito'");
                                                            require "vista/tabla_control_ie.php";
                                                        } else {
                                                            //Consulta para obtener el depatamento, provincia y el distrito seleccionado de la tabla institucion educativa
                                                            $consult_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where departamento_ie='$departamentos' and provincia_ie='$provin' and distrito_ie='$distrito' ");
                                                            require "vista/tabla_control_ie.php";
                                                        }
                                                    }
                                                } else {
                                                }
                                            }
                                        } else {
                                        }
                                        ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>