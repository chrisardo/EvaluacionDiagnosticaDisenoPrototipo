<?php
session_start();
if (@!$_SESSION['id']) {
    echo "<script>location.href='login.php'</script>";
} elseif ($_SESSION['rol'] == 1) {
    /*if ((time() - $_SESSION['last_login_timestamp']) > 240) { // 900 = 15 * 60  
        setcookie("cerrarsesion", 1, time() + 60000); //6o segundos es 1 minuto, 86400 segundos es por 24 horas
        echo "<script>location.href='controlador/desconectar.php'</script>";
    } else {
        $_SESSION['last_login_timestamp'] = time();
    }*/
} else {
    echo "<script>location.href='login.php'</script>";
}
header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" href='img/logo.jpg' sizes="32x32" type="img/jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="libreria/chart.min.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success justify-content-sm-start fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-99 mr-auto" style="font-size:13px;" href="#">
                <img src="img/logo.jpg" style="width: 30px; height: 30px;;" />
                <strong>Evaluación diagnóstica</strong>
            </a>
            <button class="navbar-toggler align-self-start" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-success p-3 p-lg-0 mt-5 mt-lg-0 d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end mobileMenu" id="navbarSupportedContent">
                <ul class="navbar-nav align-self-stretch">
                    <li class="nav-item active">
                        <a class="nav-link" href="resumenGeneral_director.php"> Resumen general </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item ">
                        <a class="nav-link" href="adm.php"> Importar Evaluación Diagnóstica </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="evaluacionDiagnostica_director.php"> Evaluación diagnóstica </a>
                    </li>
                </ul>
            </div>
            <?php
            require("controlador/connectdb.php");
            include 'controlador/sed.php';

            $idlog = @$_SESSION['id'];
            ?>
            <a style="margin-left: 4px;" href="" class="navbar-brand order-1 order-justify-content-end">
                <?php
                $consulta = mysqli_query($mysqli, "SELECT * FROM administrador
                 INNER JOIN rol on administrador.codigorol=rol.codigorol  
          WHERE id_admin='$idlog'");
                $admini = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
                foreach ($admini as $array) {
                    $id = $array['id_admin'];
                    $nom = $array["nombres"];
                    $cod_mod_ie = $array["cod_mod_ie"];
                    $apelli = $array["apellidos"];

                    $sql_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa
             WHERE cod_mod_ie='$cod_mod_ie'");
                    $ie = mysqli_fetch_all($sql_ie, MYSQLI_ASSOC);
                    foreach ($ie as $array_ie) {
                        $estado_subido_excel = $array_ie["estado_subido_excel"];
                        $nivel_ie = $array_ie["nivel_ie"];
                    }
                }
                ?>
            </a>
            <div style="margin-left: 16px;" class="navbar-brand order-1 order-justify-content-end dropdown show" id="yui_3_17_2_1_1636218170770_38">
                <a href="#" tabindex="0" class=" " style="color: white;" id="action-menu-toggle-1" aria-label="Menú de usuario" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" aria-controls="action-menu-1-menu">
                    <img src="img/puntosblancos.png" style="width: 36px; height: 32px;">
                    <!--<b class="caret"></b>-->
                </a>
                <div class="dropdown-menu dropdown-menu-right menu align-tr-br" id="action-menu-1-menu" data-rel="menu-content" aria-labelledby="action-menu-toggle-1" role="menu" data-align="tr-br">
                    <!--<a href="vista/verperfil.php" class="dropdown-item menu-action select" role="menuitem" data-title="mymoodle,admin" aria-labelledby="actionmenuaction-1">
                        <img src="img/perfil.png" style="width: 26px; height: 22px;"> <strong>PERFIL</strong>
                    </a>-->
                    <?php if ($_SESSION['rol'] == 1) { ?>
                        <!--<div class="dropdown-divider border-primary" style="background-color:blue;"></div>
                        <a href="reportarproblema.php" class="dropdown-item menu-action" role="menuitem" data-title="mymoodle,admin" aria-labelledby="actionmenuaction-1">
                            <img src="img/reportar.png" style="width: 30px; height: 30px;">
                            <strong>Reportar problema</strong>
                        </a>-->
                    <?php } elseif ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) { ?>
                    <?php } ?>
                    <div class="dropdown-divider border-primary" style="background-color:blue;"></div>
                    <a href="vista/informacion.php" class="dropdown-item menu-action" role="menuitem" data-title="mymoodle,admin" aria-labelledby="actionmenuaction-1">
                        <img src="img/informa.png" style="width: 30px; height: 30px;">
                        <strong>Información sobre su cuenta</strong>
                    </a>
                    <div class="dropdown-divider border-primary"></div>
                    <a href="controlador/desconectar.php" class="dropdown-item menu-action" role="menuitem" data-title="profile,moodle" aria-labelledby="actionmenuaction-2">
                        <img src="img/exi.png" style="width: 26px; height: 22px;"><strong> SALIR</strong>
                    </a>
                </div>
            </div>
        </div>
    </nav><br><br><br>
    <div class="col-md-12">
        <main>
            <div class="container pb-4">
                <div class="row align-items-md-stretch pb-4">
                    <div class="col-md-12">
                        <h6 class="py-2">Resultado de Evaluación Diagnóstica: Matemàtica</h6>
                    </div>
                    <div class="container text-center pt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class=" bg-info">Código modular</th>
                                        <th class=" bg-info">Nivel</th>
                                        <td class="bg-danger" style="color:white;">Proceso Inicio (%)</td>
                                        <td class="bg-danger" style="color:white;">Inicio (%)</td>
                                        <td class="bg-warning" style="color:white;">Proceso (%)</td>
                                        <td class="bg-success" style="color:white;">Satisfactorio (%)</td>
                                    </tr>
                                </tbody>
                                <?php
                                $sql_resumen3 = mysqli_query($mysqli, "SELECT resumen_evaluacion.id_competencia, resumen_evaluacion.id_nivel id_nivel_re, 
                                    SUM(resumen_evaluacion.porcentaje) porcentaje, 
                                                resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura, resumen_evaluacion.cod_mod_ie
                                                FROM resumen_evaluacion 
                                                where resumen_evaluacion.cod_mod_ie='$cod_mod_ie' and resumen_evaluacion.id_asignatura=1 
                                                group by resumen_evaluacion.id_nivel
                                                ORDER BY resumen_evaluacion.id_resumen ASC");
                                $cont_resumen = mysqli_num_rows($sql_resumen3);

                                $resumen_eva3 = mysqli_fetch_all($sql_resumen3, MYSQLI_ASSOC);
                                if ($cont_resumen > 0) { //Si existen datos
                                    foreach ($resumen_eva3 as $row_r3) {
                                        $porcentaje = $row_r3['porcentaje'];
                                        if ($row_r3['id_nivel_re'] == 1) {
                                            $porcentaje_nivel1 = $porcentaje;
                                        }
                                        if ($row_r3['id_nivel_re'] == 2) {
                                            $porcentaje_nivel2 = $porcentaje;
                                        }
                                        if ($row_r3['id_nivel_re'] == 3) {
                                            $porcentaje_nivel3 = $porcentaje;
                                        }
                                        if ($row_r3['id_nivel_re'] == 4) {
                                            $porcentaje_nivel4 = $porcentaje;
                                        }
                                    }
                                ?>
                                    <tr>

                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo sed::decryption($cod_mod_ie);
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo sed::decryption($nivel_ie);
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php
                                            echo $porcentaje_nivel1;
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo $porcentaje_nivel2;
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo $porcentaje_nivel3; ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo $porcentaje_nivel4; ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 bg-light border">
                        <?php
                        require "graficos/grafico_director_matematica.php"
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="col-md-12">
        <div class="row align-items-md-stretch pb-4">

        </div>
        <main>
            <div class="container pb-4">
                <div class="row align-items-md-stretch pb-4">
                    <div class="col-md-12">
                        <h6 class="py-2">Resultado de Evaluación Diagnóstica: Lectura</h6>
                    </div>
                    <div class="container text-center pt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class=" bg-info">Código modular</th>
                                        <th class=" bg-info">Nivel</th>
                                        <td class="bg-danger" style="color:white;">Proceso Inicio (%)</td>
                                        <td class="bg-danger" style="color:white;">Inicio (%)</td>
                                        <td class="bg-warning" style="color:white;">Proceso (%)</td>
                                        <td class="bg-success" style="color:white;">Satisfactorio (%)</td>
                                    </tr>
                                </tbody>
                                <?php
                                /*$sql_resumen3 = mysqli_query($mysqli, "SELECT resumen_evaluacion.id_competencia, resumen_evaluacion.id_nivel id_nivel_re, 
                                resumen_evaluacion.porcentaje porcentaje, 
                                            resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura, resumen_evaluacion.cod_mod_ie
                                            FROM resumen_evaluacion where resumen_evaluacion.cod_mod_ie='$cod_mod_ie' and resumen_evaluacion.id_asignatura='1' 
                                            ORDER BY resumen_evaluacion.id_resumen ASC");
                                $resumen_eva3 = mysqli_fetch_all($sql_resumen3, MYSQLI_ASSOC);
                                foreach ($resumen_eva3 as $row_r3) {*/
                                $sql_resumen3 = mysqli_query($mysqli, "SELECT resumen_evaluacion.id_competencia, resumen_evaluacion.id_nivel id_nivel_re, 
                                    SUM(resumen_evaluacion.porcentaje) porcentaje, 
                                                resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura, resumen_evaluacion.cod_mod_ie
                                                FROM resumen_evaluacion 
                                                where resumen_evaluacion.cod_mod_ie='$cod_mod_ie' and resumen_evaluacion.id_asignatura=2 
                                                group by resumen_evaluacion.id_nivel
                                                ORDER BY resumen_evaluacion.id_resumen ASC");
                                $cont_resumen = mysqli_num_rows($sql_resumen3);
                                $resumen_eva3 = mysqli_fetch_all($sql_resumen3, MYSQLI_ASSOC);
                                if ($cont_resumen > 0) {
                                    foreach ($resumen_eva3 as $row_r3) {
                                        $porcentaje = $row_r3['porcentaje'];
                                        if ($row_r3['id_nivel_re'] == 1) {
                                            $porcentaje_nivel1 = $porcentaje;
                                        }
                                        if ($row_r3['id_nivel_re'] == 2) {
                                            $porcentaje_nivel2 = $porcentaje;
                                        }
                                        if ($row_r3['id_nivel_re'] == 3) {
                                            $porcentaje_nivel3 = $porcentaje;
                                        }
                                        if ($row_r3['id_nivel_re'] == 4) {
                                            $porcentaje_nivel4 = $porcentaje;
                                        }
                                    }
                                ?>
                                    <tr>

                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo sed::decryption($cod_mod_ie);
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo sed::decryption($nivel_ie);
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php
                                            echo $porcentaje_nivel1;
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo $porcentaje_nivel2;
                                            ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo $porcentaje_nivel3; ?></td>
                                        <td style="vertical-align: middle; border: 2px solid black;">
                                            <?php echo $porcentaje_nivel4; ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 bg-light border">
                        <?php
                        require "graficos/grafico_director_lectura.php"
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php require("vista/footer.php"); ?>

</body>

</html>