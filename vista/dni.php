<?php
//validar
session_start();
if (@!$_SESSION['id']) {
    echo "<script>location.href='../login.php'</script>";
} elseif ($_SESSION['rol'] == 1) {
    /*if ((time() - $_SESSION['last_login_timestamp']) > 240) { // 900 = 15 * 60  
        setcookie("cerrarsesion", 1, time() + 60000); //6o segundos es 1 minuto, 86400 segundos es por 24 horas
        echo "<script>location.href='../controlador/desconectar.php'</script>";
    } else {
        $_SESSION['last_login_timestamp'] = time();
    }*/
} else {
    echo "<script>location.href='../login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D.N.I| Evaluación diagnóstica</title>
    <link rel="icon" href='../img/logo.jpg' sizes="32x32" type="img/jpg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/script.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!--<script src="https://www.google.com/recaptcha/api.js?render=6LdaxhsiAAAAAJf10JdThCppbMHLyiDH24SPp4r9"></script>
    <script>
        $(document).ready(function() {
            $('#entrar').click(function() {
                grecaptcha.ready(function() {
                    grecaptcha.execute('6LdaxhsiAAAAAJf10JdThCppbMHLyiDH24SPp4r9', {
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-success justify-content-sm-start fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand ">
                <a href="informacion.php">
                    <img src="../img/atras.png" style="width: 36px; height: 40px;">
                </a>
                <a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-99 mr-auto">
                    <img src="../img/logo.jpg" style="width: 36px; height: 40px;">Evaluación diagnóstica
                </a>
            </div>
        </div>
    </nav><br><br><br><br>
    <center>
        <h2><strong>Editar D.N.I</strong></h2>
    </center>
    <?php
    extract($_GET);
    require("../controlador/connectdb.php");
    include '../controlador/sed.php';
    $id = $_SESSION['id'];
    $sql_admin = mysqli_query($mysqli, "SELECT * FROM administrador  WHERE id_admin='$id'");
    $check_admin = mysqli_num_rows($sql_admin);
    $adminis = mysqli_fetch_all($sql_admin, MYSQLI_ASSOC);
    foreach ($adminis as $rowd) {
        $id = $rowd['id_admin'];
        $nombre_director = @SED::decryption($rowd['nombres']);
        $contrase = $rowd['contrasena'];
        $dni = $rowd['dni'];
        $cod_modu = $rowd['cod_mod_ie'];
    }
    ?>
    <div class="container border border-success">
        <form action="" method="post">
            <!--id="form-login"-->
            <div class="row g-3">
                <div class="col">
                    <h1 class="formulario__label">D.N.I: <?php echo $dni; ?></h1>
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <label for="" class="formulario__label"><strong>Nuevo D.N.I:</strong> </label>
                    <input type="number" class="form-control" name="dninuevo" placeholder="Ingrese su nuevo D.N.I a cambiar">
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <label for="" class="formulario__label"><strong>Contraseña Actual: </strong></label>
                    <div class="input-group">
                        <input type="password" class="form-control" ID="txtPassword" name="contrase" placeholder="Ingrese su contraseña actual">
                        <div class="input-group-append">
                            <button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <input type="submit" name="edit_infor" value="Actualizar" class="btn btn-success" style="margin-top: 16px;">
                <!--<button type="button" id="entrar" style="color: white; margin-top: 6px;" class="btn btn-primary g-recaptcha">Editar</button>-->
            </center><br>
        </form>
        <?php
        if (isset($_POST['edit_infor'])) {
            $id_session = $_SESSION['id'];
            $dninuevo = $_POST['dninuevo'];
            $contraseantigua = $_POST['contrase'];
            //$dnie = sed::encryption($dninuevo);
            if (!empty($_POST['dninuevo']) && !empty($_POST['contrase'])) {
                $dni_admin = mysqli_query($mysqli, "SELECT * FROM administrador WHERE dni='$dninuevo'");
                $contar_dni_admin = mysqli_num_rows($dni_admin);

                //Si el email nuevo existe en la tablas director, grel, ugel
                if ($contar_dni_admin > 0) {
                    if ($check_admin > 0) { // Si existe el email
                        if ($contrase == $contraseantigua) { // Si la contraseña del cliente es correcto
                            if ($dni == $dninuevo) {
                                echo "<div class='alert alert-danger' role='alert'>$nombre_director Es tu mismo D.N.I.</div>";
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Ya existe ese D.N.I. </div>';
                            }
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>$nombre_director tu contraseña actual es incorrecto.</div>";
                            //echo "<script>location.href='password.php'</script>";
                        }
                    }
                } else { //Si email nuevo no se repite  del cliente o adm o empresa o repartidor
                    if ($check_admin > 0) { // Si existe el email
                        if ($contrase == $contraseantigua) { // Si la contrase antigua ingresada es correcta
                            if ($dninuevo <= 99999999 && $dninuevo >= 10000000) {
                                $resul = mysqli_query($mysqli, "UPDATE administrador SET dni = '$dninuevo' WHERE id_admin='$id_session'");
                                if (@$resul) {
                                    echo '<div class="alert alert-primary" role="alert">Actualizado con éxito. </div>';
                                    // echo "<script>location.href='dni.php'</script>";
                                } else {
                                    echo "Error: " . $resul . "<br>" . mysqli_error($mysqli);
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">El numero de D.N.I tiene que ser de 8 digitos. </div>';
                            }
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>$nombre_director tu contraseña actual de administrador es incorrecto.</div>";
                            //echo "<script>location.href='password.php'</script>";
                        }
                    }
                }
            }
        }
        ?>
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
                //CheckBox mostrar contraseña
                $('#ShowPassword').click(function() {
                    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                });
            });
        </script>
    </div>

</body>

</html>