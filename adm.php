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
    <title>Importar|Evaluación diagnóstica</title>
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
                    <li class="nav-item ">
                        <a class="nav-link" href="resumenGeneral_director.php"> Resumen general </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item active">
                        <a class="nav-link" href="adm.php"> Importar Evaluación Diagnóstica </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item ">
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
                    $cod_mod = $array["cod_mod_ie"];
                    $imagperfi = base64_encode($array['img']);
                    $nom = $array["nombres"];
                    $apelli = $array["apellidos"];
                    $sql_ie = mysqli_query($mysqli, "SELECT * FROM institucion_educativa WHERE cod_mod_ie='$cod_mod'");
                    $ie = mysqli_fetch_all($sql_ie, MYSQLI_ASSOC);
                    foreach ($ie as $array_ie) {
                        $cod_mod_ie = $array_ie["cod_mod_ie"];
                        $estado_subido_excel = $array_ie["estado_subido_excel"];
                    }
                }
                if ($imagperfi) {
                ?>
                    <img src="data:image/jpg;base64, <?php echo $imagperfi; ?>" style="width: 36px; height: 40px; border-radius: 14px;" alt="login">
                <?php
                } else {
                ?>
                    <img src="img/perfil.png" style="width: 40px; height: 40px;" alt="login">
                <?php
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
    <div class="container" style="margin-top: 10px;">
        <h3 class="text-center">
            Director importe archivo excel de evaluacion diagnostica
        </h3>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-12">
                <form action="adm.php" id="form-login" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="codigo_modiular" value="<?php echo $cod_mod_ie; ?>" class="form-control" />
                            <input type="file" name="archivo" id="file-input" accept=".xlsm" class="form-control" />
                        </div>
                        <div class="col">
                            <input type="submit" name="subirexcel" <?php if ($estado_subido_excel == 1) {
                                                                    ?> disabled <?php }
                                                                                ?> class="form-control btn-success" value="Importar datos Excel" />

                            <!--<button type="button" id="entrar" <?php //if ($estado_subido_excel == 1) { 
                                                                    ?> disabled<?php //} 
                                                                                ?> style="color: white; margin-top: 6px;" class="btn btn-primary g-recaptcha">Importar datos de evaluación diagnóstica</button>-->
                        </div>
                </form>
            </div>

        </div><br><br>

    </div>
    <?php
    if ($estado_subido_excel == 0) { //Si el administrador director no subió su excel
        /*if (isset($_POST['token']) && isset($_POST['action'])) {
            $token = $_POST['token'];
            $action = $_POST['action'];
            $secret = '6Le5wKIkAAAAALzbGF3ER6Du6QlUZF3YH_D8hIv3'; // Ingresa tu clave secreta del recaptcha.....
            @$response2 = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token");
            $datos = json_decode($response2, true);*/
        if (isset($_POST['subirexcel'])) { //Si dio click al boton de importar datos excel
            //Obteniendo los datos del name de cada input
            $cod_modu_director = $_POST['codigo_modiular'];
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
                if ('xlsm' == $extension) { //Si el archivo excel cargado su extension es 'xlsm'
                    if ($tamano < 3000000) {
                        require "controlador/importacion_excel.php"; //Llamando a la importacion de datos excel a la base de datos
                        $fname = date("YmdHis") . '_' . $archivo;
                        //Consullta para saber si se cargo el archivo ecel por medio de su nombre
                        $chk = mysqli_query($mysqli, "SELECT * FROM  upload where nombre = '$archivo' ");
                        $check = mysqli_num_rows($chk); //Contando la cantidad de archivos de excel subidos a la BD
                        if ($check) { //Verificando Si existe un archivo de excel subido
                            //Iniciando contador de archivo de excel subido
                            $i = 1;
                            $c = 0;
                            while ($c == 0) {
                                $i++;
                                $reversedParts = explode('.', strrev($archivo), 2);
                                $tname = (strrev($reversedParts[1])) . "_" . ($i) . '.' . (strrev($reversedParts[0]));
                                // var_dump($tname);exit;
                                $chk2 = mysqli_query($mysqli, "SELECT * FROM  upload where nombre = '$tname' and cod_mod_ie='$cod_modu_director'");
                                $check2 = mysqli_num_rows($chk2);
                                if ($check2 == 0) {
                                    $c = 1;
                                    $archivo = $tname;
                                }
                            }
                        }
                        //Poniendo el arhivo de excel subido en la carpeta llamado 'upload'
                        $move =  move_uploaded_file($temp, "upload/" . $fname);
                        if ($move) { //Si el archivo de excel está en la capeta 'upload'
                            //Consulta si el archivo excel del director subido
                            $chk3 = mysqli_query($mysqli, "SELECT * FROM  upload where cod_mod_ie='$cod_modu_director'");
                            $check3 = mysqli_num_rows($chk3); //Contando todos los archivos de excel subido por los directores
                            if ($check3 == 0) { //verificando si existe algun archivo de excel subido
                                //Consulta para actualizar el estado subido excel del director
                                $query_adm = mysqli_query($mysqli, "UPDATE institucion_educativa  
                        SET  estado_subido_excel=1 WHERE cod_mod_ie='$cod_modu_director'");
                                //Consultar para insertar el archivo excel subido por el director a la tabla 'upload'
                                $query = mysqli_query($mysqli, "INSERT INTO upload(nombre,fname, cod_mod_ie, fecha) 
                            VALUES('$archivo','$fname', '$cod_modu_director', now())");
                            } else { //Si no existe algun archivo subido por el director
                                $query_adm = mysqli_query($mysqli, "UPDATE institucion_educativa  
                        SET  estado_subido_excel=1 WHERE cod_mod_ie='$cod_modu_director'");
                                //Consulta para actualizar el archivo excel del director de la tabla upload
                                $query = mysqli_query($mysqli, "UPDATE upload  
                            SET  nombre='$archivo', fname='$fname',fecha=now() WHERE cod_mod_ie='$cod_modu_director'");
                            }

                            if ($query) { // Si se importo los datos del archivo excel
                                echo '<div class="alert alert-primary" role="alert">Ok. </div>';
                                echo "<script>location.href='adm.php'</script>";
                            } else {
                                die(mysqli_error($mysqli)); //Botará el error si no se llega a subir el archivo excel a la BD
                            }
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">El tamaño máximo es: 3 MB. </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Solo se puede subir extensiones: .xlsm </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Cargue su archivo excel de evaluaciòn diagnostica.</div>';
            }
            /*}
            } else {
                echo "<div class='alert alert-danger' role='alert'>Parece eres un robot.</div>";
            }*/
        }
    } elseif ($estado_subido_excel == 1) { //Si el director subió su archivo de excel está subido
        echo '<div class="alert alert-danger" role="alert">Solo se puede subir la evaluación diagnostica una vez, si lo subió mal comuniquese con un encargado de la GREL o UGEL.</div>';
    }
    ?>
    <?php require("vista/footer.php"); ?>
</body>

</html>