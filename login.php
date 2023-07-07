<?php session_start(); //inciar session
include 'controlador/sed.php';
require("controlador/connectdb.php"); //requerir la conexion a la base de datos
/*if (isset($_POST['token']) && isset($_POST['action'])) {
    $token = $_POST['token'];
    $action = $_POST['action'];
    $secret = '6Le5wKIkAAAAALzbGF3ER6Du6QlUZF3YH_D8hIv3'; // Ingresa tu clave secreta del recaptcha.....
    @$response2 = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token");
    $datos = json_decode($response2, true);*/
if (isset($_POST['inicio'])) {
    $nombreusuario = $_POST['username']; //mail es el nombre del cuadro de texto del input
    $contrase = $_POST['pass']; //recoge el password que ingresamos
    /*$username1 = sed::encryption($nombreusuario);
    $contra1 = sed::encryption($contrase);*/
    //administrador director
    $sql_admin = mysqli_query($mysqli, "SELECT * FROM administrador
   INNER JOIN rol on administrador.codigorol=rol.codigorol
   WHERE administrador.cod_mod_ie='$nombreusuario' and administrador.contrasena='$contrase' and administrador.codigorol=1");
    $cant_admin = mysqli_num_rows($sql_admin);
    //GREL y UGEL
    $sql_admin_gel_ugel = mysqli_query($mysqli, "SELECT * FROM administrador
        INNER JOIN rol on administrador.codigorol=rol.codigorol
        WHERE administrador.username='$nombreusuario' and administrador.contrasena='$contrase' and administrador.codigorol=2");
    $cant_gel_ugel = mysqli_num_rows($sql_admin_gel_ugel);
    //General
    $sql_adm_general = mysqli_query($mysqli, "SELECT * FROM administrador
        INNER JOIN rol on administrador.codigorol=rol.codigorol
        WHERE administrador.username='$nombreusuario' and administrador.contrasena='$contrase' and administrador.codigorol=3");
    $cant_general = mysqli_num_rows($sql_adm_general);

    if (isset($_COOKIE["blocke" . $nombreusuario])) {
    } else {
        /*if (@$datos['success'] == 1 && @$datos['score'] >= 0.9) {
            if ($datos['action'] == 'validarUsuario') {*/
        if ($cant_admin > 0) {
            if ($use = mysqli_fetch_assoc($sql_admin)) {
                if ($contrase == $use['contrasena']) {
                    if ($use['estado'] == 1) { //si cuenta está habilitado
                        //print_r($datos);
                        // verificar la respuesta
                        //echo "director";

                        $_SESSION['id'] = $use['id_admin'];
                        $_SESSION['rol'] = $use['codigorol'];
                        $_SESSION['last_login_timestamp'] = time();
                        echo "<script>location.href='resumenGeneral_director.php'</script>";
                    }
                }
            }
            //echo "<script>location.href='registro.php'</script>";
        } elseif ($cant_gel_ugel > 0) {
            if ($use = mysqli_fetch_assoc($sql_admin_gel_ugel)) {
                if ($contrase == $use['contrasena']) {
                    if ($use['estado'] == 1) { //si cuenta está habilitado
                        $_SESSION['id'] = $use['id_admin'];
                        $_SESSION['rol'] = $use['codigorol'];
                        $_SESSION['last_login_timestamp'] = time();
                        echo "Adinistrador";
                        //echo "<script>location.href='evaluaciones_subidas.php?resumen_subido=1'</script>";
                    }
                }
            }
        } elseif ($cant_general > 0) {
            if ($use = mysqli_fetch_assoc($sql_adm_general)) {
                if ($contrase == $use['contrasena']) {
                    if ($use['estado'] == 1) { //si cuenta está habilitado
                        $_SESSION['id'] = $use['id_admin'];
                        $_SESSION['rol'] = $use['codigorol'];
                        $_SESSION['last_login_timestamp'] = time();
                        //echo "Adinistrador heneral";
                        echo "<script>location.href='admgeneral_inicio.php'</script>";
                    }
                }
            }
        } else {
            if (isset($_COOKIE["$nombreusuario"])) {
                $contcoockie = $_COOKIE["$nombreusuario"];
                $contcoockie++;
                setcookie($nombreusuario, $contcoockie, time() + 120);
                if ($contcoockie >= 4) {
                    setcookie("blocke" . $nombreusuario, $contcoockie, time() + 43200); //6o segundos es 1 minuto, 86400 segundos es por 24 horas, 43200 segundos es 12 horas.
                }
            } else {
                setcookie($nombreusuario, 1, time() + 120);
            }
        }
        /* }
        } else {
        }*/
    }
}
if (isset($_COOKIE["cerrarsesion"])) {
    //echo "<div class='alert alert-danger' role='alert'> Se detecto 4 minuto de inactividad. Inicia sesión nuevamente</div>";
    setcookie("cerrarsesion", 1, time() - 60000); //6o segundos es 1 minuto, 86400 segundos es por 24 horas
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href='img/logo.jpg' sizes="32x32" type="img/jpg">
    <link rel="stylesheet" href="./css/nav-conten.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="libreria/chart.min.js"></script>
    <link rel="stylesheet" href="./css/nav-conten.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                            <img src="img/logoGrel_ED.png" alt="Bootstrap" width="" height="62">
                        </a>
                    </div>
                    <div class="col">
                        <p style="margin-top: 4px; color:green; font-size: 28px;">Presentación de resultados</p>
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
                        <li class="nav-item ">
                            <a class="nav-link" href="control_ie.php">Control de Instituciones Educativas</a>
                        </li>
                        <li class="nav-item border border-dark rounded bg-body-tertiary">
                            <a class="nav-link active " href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container-fluid py-2">
        <div class="row">
            <center>
                <div class="col-sm-6 bg-light border rounded-3">
                    <div style="height: 35px;" class="bg-success">
                        <center>
                            <div class="panel-title" style="color:white;">Iniciar Sesi&oacute;n</div>
                        </center>
                    </div>
                    <div style="padding-top:20px" class="panel-body">
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="form-login" class="formulario column" action="login.php" method="post">
                            <div class="row">
                                <div class="col">
                                    <label style="font-size: 14pt; color:#000;"><b>Username:</b></label>
                                    <input type="text" name="username" class="form-control" placeholder="Ingrese su código modular" required><br>
                                    <label style="font-size: 14pt; color:#000;"><b>Contraseña:</b></label>
                                    <div style="width: 100%;">
                                        <input type="password" name="pass" ID="txtPassword" class="form-control" style="float: left; width: 85%;" placeholder="Ingrese su contraseña" required>
                                        <button id="show_password" class="btn btn-success" style="float:left;height: 34px; margin-left: 3px;" type="button" onclick="mostrarPassword()"> <span style="color:white;" class="fa fa-eye-slash icon"></span> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <center>
                                        <input class="btn btn-success" type="submit" name="inicio" style="margin-top: 10px; color:white;" value="Iniciar Sesión">
                                        <!--<button type="button" id="entrar" style="color: white; margin-top: 6px;" class="btn btn-success g-recaptcha">Ingresar</button>-->
                                    </center><br>
                                </div>
                            </div>

                            <!--Entrada de clase boton tipo "envio" de nombre "inicio" como valor poniendole "Iniciar session"-->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                        <a style="color:green;" href="recuperar_password.php">¿Se te olvidó tu contraseña?</a>
                                        <!--<a style="float:right; position: relative; color:green;" href="recupe.php">Registrarme</a>-->
                                    </div>
                                </div>
                            </div><br>
                        </form>
                        <script>
                            function mostrarPassword() {
                                var cambio = document.getElementById("txtPassword");

                                if (cambio.type == "password") {
                                    cambio.type = "text";
                                    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                                } else {
                                    cambio.type = "password";
                                    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                                }
                            }
                            $(document).ready(function() {
                                $('#usernam').on('input change', function() { //El boton se habilita cuando se escribe el formulario nombre
                                    if ($(this).val() != '') {
                                        $('#entrar').prop('disabled', false);
                                    } else {
                                        $('#entrar').prop('disabled', true);
                                    }
                                });
                                //CheckBox mostrar contraseña
                                $('#ShowPassword').click(function() {
                                    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                                });
                            });
                        </script>
                        <?php
                        /* if (isset($_POST['token']) && isset($_POST['action'])) {
                            $token = $_POST['token'];
                            $action = $_POST['action'];
                            $secret = '6Le5wKIkAAAAALzbGF3ER6Du6QlUZF3YH_D8hIv3'; // Ingresa tu clave secreta.....
                            @$response2 = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token");
                            $datos = json_decode($response2, true);*/
                        if (isset($_POST['inicio'])) {
                            $nombreusuario = $_POST['username']; //mail es el nombre del cuadro de texto del input
                            $contrase = $_POST['pass']; //recoge el password que ingresamos
                            /*$username1 = sed::encryption($nombreusuario);
                            $contra1 = sed::encryption($contrase);*/
                            //para login director
                            $sql_admini = mysqli_query($mysqli, "SELECT * FROM administrador
                                           INNER JOIN rol on administrador.codigorol=rol.codigorol
                                           WHERE administrador.cod_mod_ie='$nombreusuario' and administrador.contrasena='$contrase' and administrador.codigorol=1");
                            $cant_admini = mysqli_num_rows($sql_admini);
                            //GREL y UGEL
                            $sql_admin_gel_ugel = mysqli_query($mysqli, "SELECT * FROM administrador
                            INNER JOIN rol on administrador.codigorol=rol.codigorol
                            WHERE administrador.cod_mod_ie='$nombreusuario' and administrador.contrasena='$contrase' and administrador.codigorol=2");
                            $cant_gel_ugel = mysqli_num_rows($sql_admin_gel_ugel);
                            //General
                            $sql_adm_general = mysqli_query($mysqli, "SELECT * FROM administrador
                                INNER JOIN rol on administrador.codigorol=rol.codigorol
                                WHERE administrador.username='$nombreusuario' and administrador.contrasena='$contrase' and administrador.codigorol=3");
                            $cant_general = mysqli_num_rows($sql_adm_general);
                            if (isset($_COOKIE["blocke" . $nombreusuario])) {
                                echo "<div class='alert alert-danger' role='alert'>$nombreusuario ha sido bloqueado.</div>";
                            } else {
                                // verificar la respuesta del recaptcha
                                /*if (@$datos['success'] == 1 && @$datos['score'] >= 0.9) {
                                    if ($datos['action'] == 'validarUsuario') {*/
                                if ($cant_admini > 0) {
                                    if ($use = mysqli_fetch_assoc($sql_admin)) {
                                        if ($contrase == $use['contrasena']) {
                                            echo "hola";
                                            if ($use['estado'] == 2) { //si está baneado
                                                echo "<div class='alert alert-danger' role='alert'>$nombreusuario su cuenta ha sido inhabilitada.</div>";
                                            } else {
                                            }
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger' role='alert'>$nombreusuario su contraseña es incorrecta.</div>";
                                    }
                                } elseif ($cant_gel_ugel > 0) {
                                    if ($use = mysqli_fetch_assoc($sql_admin_gel_ugel)) {
                                        if ($contrase == $use['contrasena']) {
                                            if ($use['estado'] == 2) { //si está baneado
                                                echo "<div class='alert alert-danger' role='alert'>$nombreusuario su cuenta ha sido inhabilitada.</div>";
                                            } else {
                                            }
                                        } else {
                                            echo "<div class='alert alert-danger' role='alert'>$nombreusuario su contraseña es incorrecta.</div>";
                                        }
                                    }
                                } elseif ($cant_general > 0) {
                                    if ($use = mysqli_fetch_assoc($sql_adm_general)) {
                                        if ($contrase == $use['contrasena']) {
                                            if ($use['estado'] == 2) { //si está baneado
                                                echo "<div class='alert alert-danger' role='alert'>$nombreusuario su cuenta ha sido inhabilitada.</div>";
                                            } else {
                                            }
                                        } else {
                                            echo "<div class='alert alert-danger' role='alert'>$nombreusuario su contraseña es incorrecta.</div>";
                                        }
                                    }
                                }
                                /* } else {
                                        echo "<div class='alert alert-danger' role='alert'>Acceso incorrecto.</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger' role='alert'>$nombreusuario parece eres un robot.</div>";
                                }*/
                            }
                        }
                        if (isset($_COOKIE["cerrarsesion"])) {
                            echo "<div class='alert alert-danger' role='alert'> Se detecto 4 minuto de inactividad. Inicia sesión nuevamente</div>";
                        }
                        ?>
                    </div>
                </div>
            </center>
        </div>
    </div>
    </div>
    <div class="container">

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>