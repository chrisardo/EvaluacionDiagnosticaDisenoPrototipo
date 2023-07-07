<!DOCTYPE html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="¡Hola!Somos Killari Postres, hacemos postres a gusto y pedido del cliente para todo tipo de ocasión">
    <!--<meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kilaripostres.000webhostapp.com/" />
    <meta name="twitter:title" content="Killari Postres">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="https://kilaripostres.000webhostapp.com/img/logokillari.jpg">
    <meta property="og:image" content="https://kilaripostres.000webhostapp.com/img/logokillari.jpg">
    <meta property="og:locale" content="es_ES">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Recuperar | Killari Postres">
    <meta property="og:url" content="https://kilaripostres.000webhostapp.com/">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta property="og:site_name" content="Killari Postres">-->
    <title>Recuperar Contraseña | Evaluación diagnóstica</title>
    <link rel="icon" href='img/logo.jpg' sizes="32x32" type="img/jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <nav style="width: 100%; height: 50px; background-color: green;" class="fixed-top">
        <div class="">
            <a class="" style="margin-left: 16px;" href="login.php">
                <img src="img/atras.png" style="margin-top: 5px; width: 30px; height: 40px;">
            </a>
            <a class="" style="font-size: 22px; margin-top: 12px; color:white;">
                <img src="img/logo.jpg" style="width: 35px; height: 34px;" alt="logo killaripostres">
                <strong>Evaluación diagnóstica</strong>
            </a>
        </div>
    </nav>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <center>
                        <div class="panel-title" style="color:blue;">Recuperar mi Constraseña</div>
                    </center>
                </div>
                <div style="padding-top:10px" class="panel-body">
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    <form id="loginform" class="form-horizontal" role="form" method="POST" autocomplete="off">
                        <label style="font-size: 14pt; color: #000;"><b>Celular:</b></label>
                        <input type="number" class="form-control" name="celular" required="required" placeholder="Ejemplo: 912345678">
                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <center><button id="btn-login" type="submit" name="btn_consultar" value="Consultar" class="btn btn-success">Consultar mi contraseña</a></center>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                    <!--<strong>Aún no tienes cuenta?</strong> <a href="rgistrarse.php">Registrate aquí</a>-->
                                    <!--a style="float:right; position: relative; " href="logueo.php">Ir a iniciar sesión</a>-->
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['btn_consultar'])) {
                        require('controlador/testAltiriaSms.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>