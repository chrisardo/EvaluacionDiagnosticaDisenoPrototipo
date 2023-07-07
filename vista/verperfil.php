<?php
//validar
session_start();
if (@!$_SESSION['id']) {
    echo "<script>location.href='./login.php'</script>";
} elseif ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) {
    /*if ((time() - $_SESSION['last_login_timestamp']) > 240) { // 900 = 15 * 60  
        setcookie("cerrarsesion", 1, time() + 60000); //6o segundos es 1 minuto, 86400 segundos es por 24 horas
        echo "<script>location.href='desconectar.php'</script>";
    } else {
        $_SESSION['last_login_timestamp'] = time();
    }*/
} else {
    echo "<script>location.href='./login.php'</script>";
}
require("../controlador/connectdb.php");
include '../controlador/sed.php';
$idlog = @$_SESSION['id'];

$sql_admin = mysqli_query($mysqli, "SELECT*FROM administrador INNER JOIN rol 
    on administrador.codigorol=rol.codigorol
    WHERE administrador.id_admin=$idlog order by id_admin desc");
$cant_admin = mysqli_num_rows($sql_admin);
$administra = mysqli_fetch_all($sql_admin, MYSQLI_ASSOC);
foreach ($administra as $rowd) {
    $cod_modu = $rowd['cod_mod_ie'];
    $q_ie1 = mysqli_query($mysqli, "SELECT*FROM institucion_educativa WHERE cod_mod_ie='$cod_modu'");
    $ie1 = mysqli_fetch_all($q_ie1, MYSQLI_ASSOC);
    foreach ($ie1 as $row_ie1) {
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo sed::decryption($rowd['nombres']); ?>|Evaluación diagnóstica</title>
    <?php
    if (base64_encode($rowd['img'])) {
    ?>
        <link rel="icon" href='data:image/jpg;base64,<?php echo base64_encode($rowd['img']); ?>' sizes="32x32" type="img/jpg">
    <?php
    } else {
    ?>
        <link rel="icon" href='img/perfil.png' sizes="32x32" type="img/jpg">
    <?php
    }
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/invitado.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success justify-content-sm-start fixed-top">
        <div class="container-fluid">
            <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) { ?>
                <a class="" href="./adm.php">
                    <img src="../img/atras.png" style="width: 30px; height: 40px;">
                </a>
            <?php } elseif ($_SESSION['rol'] == 1) { ?>
                <a class="" href="../adm.php">
                    <img src="../img/atras.png" style="width: 30px; height: 40px;">
                </a>
            <?php } ?>

            <a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-99 mr-auto" style="font-size: 16px;" href="#">
                <!--<img src="../img/logoGrel_ED.png" style="width: 30px; height: 30px;" alt="logo eva">-->
                <strong>Evaluación diagnóstica</strong>
            </a>
        </div>
    </nav>
    <br><br>
    <center>
        <li>
            <div class="invi border-success " style=" border:2px solid blue; width: 50%;height: 180%;" category="iquitos">
                <?php
                if (base64_encode($rowd['img'])) {
                ?>
                    <img src="data:image/jpg;base64,<?php echo base64_encode($rowd['img']); ?>" style="width: 100%" alt="imagen invitado">
                <?php
                } else {
                ?>
                    <img src="../img/perfil.png" style="width: 100%" alt="imagen invitado">
                <?php
                }
                ?>

                <p class="p"><?php echo sed::decryption($rowd['nombres']); ?></p>

            </div>
        </li>
        <div style="margin-top: 3px;">
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="file" name="archivo" class="form-control bg-success" style="display: inline-block; width: 381px; border: 2px solid orangered; color:white;" aria-label="Archivo">
                <input type="submit" name="editar_foto" id="boton" style="display: inline-block; width: 82px;" class="btn btn-success" value="Cambiar">
            </form>
        </div>
        <?php
        if (isset($_POST['editar_foto'])) {
            $id_session = $_SESSION['id'];
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['archivo']['name'];
            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = addslashes(file_get_contents($_FILES['archivo']['tmp_name']));
                if ($temp) {
                    //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                    if (($tipo == "image/jpeg") || ($tipo == "image/jpg") || ($tipo == "image/png")) {
                        if ($tamano < 3000000) {
                            $imgeperfil = mysqli_query($mysqli, "UPDATE administrador SET administrador.img = '$temp'
                            WHERE administrador.id_admin='$id_session'");
                            if ($imgeperfil) {
                                echo '<div class="alert alert-primary" role="alert">Se actualizó. </div>';
                                if (@$a == 1) {
                                    echo "<script>location.href='verperfil.php?a=1'</script>";
                                } else {
                                    echo "<script>location.href='verperfil.php'</script>";
                                }
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert">El tamaño máximo de la imagen es: 3 MB. </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Solo se puede subir imagenes .jpg, .jpeg, .png. </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Pon una imagen de tu empresa.</div>';
                }
            }
        }
        ?>
    </center>
    <div style="margin-left: 16px; margin-top: 3px;">
        <h1 style="color:green;"><strong>Información básica</strong></h1>
        <?php if ($_SESSION['rol'] == 1) { ?>
            <p><strong>Cod. Modular: <?php echo sed::decryption($rowd['cod_mod_ie']); ?> </strong></p>
            <p><strong>Institucion Educativa: <?php echo sed::decryption($row_ie1['nombre_ie']); ?> </strong></p>
            <p><strong>Nivel: <?php echo sed::decryption($row_ie1['nivel_ie']); ?> </strong></p>
        <?php } ?>
        <p><strong>Celular: <?php echo $rowd['celular']; ?> </strong></p>
        <p><strong>Estado: <?php
                            if ($rowd['estado'] == 1) {
                                echo "Habilitado";
                            } elseif ($rowd['estado'] == 2) {
                                echo "Inhabilitado";
                            } ?> </strong></p>
    </div>
</body>

</html>