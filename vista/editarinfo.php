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
    <title>Editar información| Evaluación diagnóstica</title>
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
        <h2><strong>Editar información básica</strong></h2>
    </center>
    <?php
    $id = @$_SESSION['id'];
    require("../controlador/connectdb.php");
    include '../controlador/sed.php';
    $consulta_director = mysqli_query($mysqli, "SELECT * FROM administrador  WHERE id_admin='$id'");
    $director = mysqli_fetch_all($consulta_director, MYSQLI_ASSOC);
    foreach ($director as $rowd) {
        $id = $rowd['id_admin'];
        $emai = SED::decryption($rowd['correo']);
    }
    ?>
    <div class="container border border-success">
        <form action="" method="post">
            <!--id="form-login"-->
            <div class="row g-3">
                <div class="col">
                    <input type="hidden" class="form-control" name="id" value="<?php //echo $id; 
                                                                                ?>">
                    <label for="" class="formulario__label"><strong>Nombre: </strong></label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo SED::decryption($rowd['nombres']); ?>">
                </div>
                <div class="col">
                    <label for="" class="formulario__label"><strong>Apellido:</strong></label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo SED::decryption($rowd['apellidos']); ?>">
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <label for="" class="formulario__label"><strong>Username:</strong> </label>
                    <input type="text" class="form-control" name="username" value="<?php echo SED::decryption($rowd['username']); ?>">
                </div>
                <div class="col">
                    <label for="" class="formulario__label"><strong>Celular: </strong></label>
                    <input type="number" class="form-control" name="celular" value="<?php echo $rowd['celular']; ?>">
                </div>
            </div>
            <center>
                <input type="submit" id="boton" name="edit_infor" value="Actualizar información" class="btn btn-success" style="margin-top: 16px;">
                <!--<button type="button" id="entrar" style="color: white; margin-top: 4px;" class="btn btn-primary g-recaptcha">Cambiar</button>-->
            </center>
        </form>
        <?php
        if (isset($_POST['edit_infor'])) {
            //$id_session = $_SESSION['idusu'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $usname = $_POST['username'];
            $celul = $_POST['celular'];
            $celular = "51" . $celul;
            $nombreus = sed::encryption($nombre);
            $apellidoe = sed::encryption($apellido);
            $user_nam = sed::encryption($usname);
            if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['username'])) {
                if ($celular <= 51999999999 && $celular >= 51900000000) {
                    $resul = mysqli_query($mysqli, "UPDATE administrador 
                        SET nombres = '$nombreus', apellidos='$apellidoe', username= '$user_nam', celular= '$celul' 
                        WHERE id_admin='$id'");
                    if (@$resul) {
                        echo '<div class="alert alert-primary" role="alert">Actualizado con éxito. </div>';
                        echo "<script>location.href='editarinfo.php'</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Hubo problemas al insertar los datos del logueo </div>';
                        echo "Error: " . $resul . "<br>" . mysqli_error($mysqli);
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">El numero de celular tiene que ser de 9. </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Tienes que completar todo el formulario. </div>';
            }
        }
        ?>
        <script>
            if ($('#boton').val() != "boton")
                $('#boton').attr("disabled", false);
            else
                $('#boton').attr("disabled", true);
        </script>
    </div>
</body>

</html>