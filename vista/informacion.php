<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información | Evaluación diagnóstica</title>
    <link rel="icon" href='../img/logo.jpg' sizes="32x32" type="img/jpg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css2/style.css" />
</head>

<body>
    <?php
    require("../controlador/connectdb.php");
    include '../controlador/sed.php';
    extract($_GET);
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success justify-content-sm-start fixed-top">
        <div class="container-fluid">
            <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) { ?>
                <a class="" href="../admgeneral_inicio.php">
                    <img src="../img/atras.png" style="width: 30px; height: 40px;">
                </a>
            <?php } elseif ($_SESSION['rol'] == 1) { ?>
                <a class="" href="../adm.php">
                    <img src="../img/atras.png" style="width: 30px; height: 40px;">
                </a>
            <?php } ?>
            <a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-99 mr-auto" style="font-size: 15px;" href="#">
                <img src="../img/logo.jpg" style="width: 30px; height: 30px;" alt="logo grel">
                <strong>Evaluación diagnóstica</strong>
            </a>
        </div>
    </nav>
    <br><br><br>
    <div class="border-success" style="width: 90%; margin-left: 22px;">
        <div style="width: 100%; border:2px solid green;">
            <img src="../img/informa.png" style="width: 30px; height: 30px; margin-left: 6px; margin-top: -10px;">
            <h1 style="display: inline-block;">Información</h1>
        </div>
        <div style="width: 100%; border: 2px solid green; ">
            <div style="margin-top: 3px">
                <a href="editarinfo.php">
                    <img src="../img/perfil.png" style="width: 30px; height: 30px; margin-left: 26px;">
                    Información básica
                </a>
            </div>
            <?php if ($_SESSION['rol'] == 1) { ?>
                <div style="width: 90%; height: 2px; background-color:green; margin-top: 3px; margin-left: 6px;"></div>
                <div style="margin-top: 3px">
                    <a href="dni.php">
                        <img src="../img/dni.png" style="width: 30px; height: 30px; margin-left: 26px;">
                        Cambiar mi D.N.I
                    </a>
                </div>
            <?php } ?>
            <div style="width: 90%; height: 2px; background-color:green; margin-top: 3px; margin-left: 6px;"></div>
            <div style="margin-top: 3px">
                <a href="email.php">
                    <img src="../img/email.png" style="width: 30px; height: 30px; margin-left: 26px;">
                    Cambiar correo
                </a>
            </div>
            <div style="width: 90%; height: 2px; background-color: green; margin-top: 3px; margin-left: 6px;"></div>

            <div style="margin-top: 3px">
                <a href="password.php">
                    <img src="../img/password.png" style="width: 30px; height: 30px; margin-left: 26px;">
                    Cambiar contraseña</a>
            </div>
        </div>
    </div>
</body>

</html>