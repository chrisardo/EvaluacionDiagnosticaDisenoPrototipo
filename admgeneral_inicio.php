<?php
session_start();
if (@!$_SESSION['id']) {
    echo "<script>location.href='login.php'</script>";
} elseif ($_SESSION['rol'] == 3) {
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
    <title>Importar datos director|Evaluación diagnóstica</title>
    <link rel="icon" href='img/logo.jpg' sizes="32x32" type="img/jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css" />
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
                        <a class="nav-link" href="admgeneral_inicio.php"> Importar datos director </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item ">
                        <a class="nav-link" href="subirdatoscsv.php"> Importar datos de I.E </a>
                    </li>
                    <!--<div class="dropdown-divider"></div>
                    <li class="nav-item ">
                        <a class="nav-link" href="evaluacionDiagnostica_director.php"> Evaluación diagnóstica </a>
                    </li>-->
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
                    $apelli = $array["apellidos"];
                }
                ?>
            </a>
            <div style="margin-left: 16px;" class="navbar-brand order-1 order-justify-content-end dropdown show" id="yui_3_17_2_1_1636218170770_38">
                <a href="#" tabindex="0" class=" " style="color: white;" id="action-menu-toggle-1" aria-label="Menú de usuario" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" aria-controls="action-menu-1-menu">
                    <img src="img/puntosblancos.png" style="width: 36px; height: 32px;">
                    <!--<b class="caret"></b>-->
                </a>
                <div class="dropdown-menu dropdown-menu-right menu align-tr-br" id="action-menu-1-menu" data-rel="menu-content" aria-labelledby="action-menu-toggle-1" role="menu" data-align="tr-br">
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
    <div class="container" style="margin-top: 10px;">
        <h3 class="text-center">
            <?php echo sed::decryption($nom); ?> Importe archivo excel del datos del director
        </h3>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-12">
                <form action="admgeneral_inicio.php" id="form-login" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <input type="file" name="archivo" id="file-input" accept=".xlsm, .csv, .xlsx" class="form-control" />
                        </div>
                        <div class="col">
                            <input type="submit" name="subirexcel_director" class="form-control btn-success" value="Importar datos Excel" />
                            <!--<button type="button" id="entrar" <?php //if ($estado_subido_excel == 1) { 
                                                                    ?> disabled<?php //} 
                                                                                ?> style="color: white; margin-top: 6px;" class="btn btn-primary g-recaptcha">Importar datos de evaluación diagnóstica</button>-->
                        </div>
                </form>
            </div>
            <?php
            $consut_adm = mysqli_query($mysqli, "SELECT * FROM administrador
                 INNER JOIN rol on administrador.codigorol=rol.codigorol where administrador.codigorol=1");
            $cant_duplicidad = mysqli_num_rows($consut_adm);
            $adminis = mysqli_fetch_all($consut_adm, MYSQLI_ASSOC);
            echo "Se importaron datos: " . $cant_duplicidad . " del director<br>";
            foreach ($adminis as $array) {
                $id = $array['id_admin'];
                $nom = sed::decryption($array["username"]);
                $cod_mod_ie = sed::decryption($array["contrasena"]);

                //echo $nom . " " . $cod_mod_ie . "<br>";
            }
            ?>
            <?php
            if (isset($_POST['subirexcel_director'])) { //Si dio click al boton de importar datos excel
                //Obteniendo los datos del name de cada input
                $archivo = $_FILES['archivo']['name'];
                //Obtenemos algunos datos necesarios sobre el archivo excel
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = $_FILES['archivo']['tmp_name'];
                /*if (@$datos['success'] == 1 && @$datos['score'] >= 0.9) {
                        if ($datos['action'] == 'validarUsuario') {*/
                $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                if ($temp) {
                    $arr_file = explode('.', $_FILES['archivo']['name']); //Si el archivo excel esta separado por comas
                    $extension = end($arr_file);
                    if ('xlsm' == $extension || 'xlsx' == $extension) { //Si el archivo excel cargado su extension es 'xlsm'
                        if ($tamano < 3000000) {
                            require "controlador/importar_datos_director.php"; //Llamando a la importacion de datos excel a la base de datos
                        }
                    }
                }
            }
            ?>
        </div><br><br>

    </div>
    <?php require("vista/footer.php"); ?>
</body>

</html>