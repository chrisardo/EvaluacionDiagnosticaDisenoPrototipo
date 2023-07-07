<?php
//validar
session_start();
if (@!$_SESSION['id']) {
    echo "<script>location.href='../login.php'</script>";
} elseif ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) {
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
    <title>Contraseña|Evaluación diagnóstica</title>
    <link rel="icon" href='../img/logo.jpg' sizes="32x32" type="img/jpg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    </nav><br><br><br>
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
        $emai = SED::decryption($rowd['correo']);
        $cod_modu = $rowd['cod_mod_ie'];
    }
    ?>
    <center>
        <h2><strong>Editar contraseña <?php //echo sed::decryption($rowd['contrasena']);
                                        ?></strong></h2>
    </center>
    <div class="container border border-success">
        <form action="" id="form-login" method="post">
            <div class="row g-3">
                <div class="col">
                    <label for="" class="formulario__label"><strong>Nueva contraseña:</strong> </label>
                    <div class="input-group">
                        <input type="password" name="contrasenuevo" ID="txtPassword" class="form-control" placeholder="Ingrese su nueva contraseña.">
                        <div class="input-group-append">
                            <button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <label for="" class="formulario__label"><strong>Contraseña actual: </strong></label>
                    <div class="input-group">
                        <input type="password" ID="txtPassword1" class="form-control" name="contraseantigua" placeholder="Ingrese su contraseña actual para verificar">
                        <div class="input-group-append">
                            <button id="show_password1" class="btn btn-success" type="button" onclick="mostrarPassword1()"> <span class="fa fa-eye-slash icon"></span> </button>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <input type="submit" name="edit_infor" value="Actualizar contraseña" class="btn btn-success" style="margin-top: 16px;">
                <!--<button type="button" id="entrar" style="color: white; margin-top: 4px;" class="btn btn-primary g-recaptcha">Actualizar</button>--><br>
            </center><br>
        </form>
        <?php
        if (isset($_POST['edit_infor'])) {
            $id_session = $_SESSION['id'];
            $contrasenuevo = $_POST['contrasenuevo'];
            $contraseantigua = $_POST['contraseantigua'];
            //$contranuevoe = sed::encryption($contrasenuevo);
            if (!empty($_POST['contrasenuevo']) && !empty($_POST['contraseantigua'])) {
                $contra_admin = mysqli_query($mysqli, "SELECT * FROM administrador  WHERE contrasena='$contrasenuevo'");
                $check_contra_admin = mysqli_num_rows($contra_admin);
                //Si la contraseña se repite en director, grel, ugel
                if ($check_contra_admin > 0) {
                    if ($check_admin > 0) { //si existe el usuario cliente
                        if ($contrase == $contraseantigua) { // Si la contraseña del cliente es correcto
                            if ($contrase == $contrasenuevo) {
                                echo "<div class='alert alert-danger' role='alert'>$nombre_director Es tu misma contraseña.</div>";
                            } else {
                                echo '<div class="alert alert-danger" role="alert">La nueva contraseña que ingresaste ya existe. </div>';
                            }
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>$nombre_director tu contraseña actual es incorrecto.</div>";
                            //echo "<script>location.href='password.php'</script>";
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">No se puede editar porque tu usuario no existe. </div>';
                    }
                } else { //Si la contraseña acutal no se repite en la contraseña del cliente o adm o empresa o repartidor
                    if ($check_admin > 0) {
                        if ($contrase == $contraseantigua) { // Si la contrase antigua ingresada es correcta
                            echo '<div class="alert alert-primary" role="alert">Actualizado con Exito. </div>';
                            $resul = mysqli_query($mysqli, "UPDATE administrador SET contrasena= '$contrasenuevo' WHERE id_admin='$id_session'");
                            if (@$resul) {
                                echo "<script>location.href='password.php'</script>";
                            } else {
                                echo "Error: " . $resul . "<br>" . mysqli_error($mysqli);
                            }
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>$nombre_director tu contraseña actual es incorrecto.</div>";
                            //echo "<script>location.href='password.php'</script>";
                        }
                    }
                }
            }
        }
        ?>
        <script>
            function mostrarPassword1() {
                var cambio1 = document.getElementById("txtPassword1");
                if (cambio1.type == "password") {
                    cambio1.type = "text";
                    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                } else {
                    cambio1.type = "password";
                    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                }
            }

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
                $('#ShowPassword1').click(function() {
                    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                });
                $('#ShowPassword').click(function() {
                    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                });
            });
        </script>
    </div>
</body>

</html>