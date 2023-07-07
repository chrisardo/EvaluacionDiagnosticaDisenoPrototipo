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
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Importar datos de I.E</title>
    <link rel="icon" href='img/logo.jpg' sizes="32x32" type="img/jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css2/style.css" />
    <link rel="stylesheet" href="css2/invitado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" type="text/css" href="css/cssGenerales.css">
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
                /*$consulta = mysqli_query($mysqli, "SELECT * FROM administrador
                 INNER JOIN rol on administrador.codigorol=rol.codigorol  
          WHERE id_admin='$idlog'");
                $admini = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
                foreach ($admini as $array) {
                    $id = $array['id_admin'];
                    $nom = $array["nombres"];
                    $apelli = $array["apellidos"];
                }*/
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

    <div class="container">
        <h3 class="text-center">
            Importe CSV datos de las instituciones educativas
        </h3>
        <hr>
        <br><br>
        <div class="row">
            <div class="col-md-7">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div style="display: inline-block;">
                        <input type="file" name="dataCliente" id="file-input" class="form-control" />
                        <!--<label class="file-input__label" for="file-input">
                            <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
                            <span>Elegir Archivo Excel</span></label>-->
                    </div>
                    <div style="display: inline-block; margin-top:6px;">
                        <div style=" display: inline-block;">
                            <input type="submit" name="subir" class="btn-primary" value="Leer datos CSV" />
                        </div>
                        <div style="display: inline-block;">
                            <input type="submit" name="importar" class="btn-success" value="Importar a la BD" />
                        </div>
                    </div>
                </form>
            </div>
            <div style="margin-top: 10px;">
                <?php
                /*$sqlClientes = ("SELECT * FROM clientes ORDER BY id ASC");
        $queryData   = mysqli_query($con, $sqlClientes);
        $total_client = mysqli_num_rows($queryData);*/
                if (isset($_POST['subir'])) {
                    $tipo       = $_FILES['dataCliente']['type'];
                    $tamanio    = $_FILES['dataCliente']['size'];
                    $archivotmp = $_FILES['dataCliente']['tmp_name'];
                    $lineas     = file($archivotmp);
                    $i = 0;
                    $cantidad_registros = count($lineas);
                    $cantidad_regist_agregados =  ($cantidad_registros - 1);
                ?>

                    <h6 class="text-center bg-primary" style="color:white;">
                        Lista de las I.E <strong>(<?php echo $cantidad_regist_agregados;
                                                    ?>)</strong>
                    </h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Codigo modular</th>
                                <th>Nombre</th>
                                <th>Nivel</th>
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($lineas as $linea) { //recorre todo el array de cada dato del excel
                                $cantidad_registros = count($lineas);
                                $cantidad_regist_agregados =  ($cantidad_registros - 1);

                                if ($i != 0) {

                                    $datos = explode(";", $linea);

                                    $id                = !empty($datos[0])  ? ($datos[0]) : '';
                                    $cod_modu                = !empty($datos[1])  ? ($datos[1]) : '';
                                    $nombre               = !empty($datos[2])  ? ($datos[2]) : '';
                                    $nivel               = !empty($datos[3])  ? ($datos[3]) : '';
                                    $estado               = !empty($datos[4])  ? ($datos[4]) : '';
                                    $departamento            = !empty($datos[5])  ? ($datos[5]) : '';
                                    $provincia               = !empty($datos[6])  ? ($datos[6]) : '';
                                    $distrito               = !empty($datos[7])  ? ($datos[7]) : '';
                                }
                                $i++;
                                /*$i = 1;
                while ($data = mysqli_fetch_array($queryData)) {*/ ?>
                                <tr>
                                    <th scope="row"><?php echo @$id; ?></th>
                                    <th scope="row"><?php echo   @$cod_modu; ?></th>
                                    <th scope="row"><?php echo @$nombre; ?></th>
                                    <td><?php echo @$nivel; ?></td>

                                    <td><?php echo @$departamento; ?></td>
                                    <td><?php echo utf8_encode(@$provincia); ?></td>
                                    <td><?php echo utf8_encode(@$distrito); ?></td>
                                    <td><?php echo utf8_encode(@$estado); ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="submit" name="importar" class="btn-success" value="Importar a la BD" />
                    </form>

                <?php
                }
                ?>
            </div>
            <?php if (isset($_POST['importar'])) {
                $tipo       = $_FILES['dataCliente']['type'];
                $tamanio    = $_FILES['dataCliente']['size'];
                $archivotmp = $_FILES['dataCliente']['tmp_name'];
                $lineas     = file($archivotmp);
                $i = 0;
                foreach ($lineas as $linea) { //recorre todo el array de cada dato del excel
                    $cantidad_registros = count($lineas);
                    $cantidad_regist_agregados =  ($cantidad_registros - 1);

                    if ($i != 0) {

                        $datos = explode(";", $linea);

                        $id                = !empty($datos[0])  ? ($datos[0]) : '';
                        $cod_modu                = !empty($datos[1])  ? ($datos[1]) : '';
                        $nombre               = !empty($datos[2])  ? ($datos[2]) : '';
                        $nivel               = !empty($datos[3])  ? ($datos[3]) : '';
                        $estado               = !empty($datos[4])  ? ($datos[4]) : '';
                        $departamento            = !empty($datos[5])  ? ($datos[5]) : '';
                        $provincia               = !empty($datos[6])  ? ($datos[6]) : '';
                        $distrito               = !empty($datos[7])  ? ($datos[7]) : '';
                        if ($estado == "Inactivo") {
                            $estado_ie = 0;
                        } else if ($estado == "Activo") {
                            $estado_ie = 1;
                        }
                        if (!empty($departamento) && !empty($provincia) && !empty($distrito)) {
                            $sql_departamento = mysqli_query($con, "SELECT id, nombre FROM departamentos 
                                 WHERE nombre='" . ($departamento) . "' ");
                            $cant_duplicidad_departamento = mysqli_num_rows($sql_departamento);
                            //$sql_departamento2 = mysqli_query($con, "SELECT id, nombre FROM departamentos");
                            $departamentos = mysqli_fetch_all($sql_departamento, MYSQLI_ASSOC);
                            foreach ($departamentos as $row_depa) {
                                @$id_depa = $row_depa['id'];
                                $nombre_depa = $row_depa['nombre'];
                            }

                            $sql_provincias = mysqli_query($con, "SELECT id, nombre FROM provincias 
                            WHERE nombre='" . ($provincia) . "' ");
                            $cant_duplicidad_provincias = mysqli_num_rows($sql_provincias);

                            $provincias = mysqli_fetch_all($sql_provincias, MYSQLI_ASSOC);
                            foreach ($provincias as $array_co) {
                                $id_provin = $array_co['id'];
                                $nombre_provin = $array_co['nombre'];
                            }

                            $sql_distrito = mysqli_query($con, "SELECT nombre FROM distritos 
                            WHERE nombre='" . ($distrito) . "' ");
                            $cant_duplicidad_distirto = mysqli_num_rows($sql_distrito);
                        }
                        //No existe Registros Duplicados en la tabla departamentos
                        if ($cant_duplicidad_departamento == 0) {
                            $sql_insert_departament = mysqli_query($con, "INSERT INTO departamentos(nombre)VALUES('$departamento')");
                        } else {
                            $sql_update_departament =  mysqli_query($mysqli, "UPDATE departamentos SET nombre='$departamento'  WHERE nombre='$departamento'");
                        }
                        //No existe Registros Duplicados en la tabla provincias
                        if ($cant_duplicidad_provincias == 0) {
                            if ($departamento && $provincia) {
                                $sql_insert_provinci = mysqli_query($con, "INSERT INTO provincias(nombre, departamento_id)
                                VALUES('$provincia', '$id_depa')");
                            }
                        } else {
                            $sql_update_pronicias =  mysqli_query($mysqli, "UPDATE provincias SET nombre='$provincia', departamento_id='$id_depa'
                            WHERE nombre='$provincia'");
                        }
                        //No existe Registros Duplicados en la tabla distritos
                        if ($cant_duplicidad_distirto == 0) {
                            $sql_insert_distrit = mysqli_query($con, "INSERT INTO distritos(nombre, departamento_Id, provincias_id)
                            VALUES('$distrito', '$id_depa', '$id_provin')");
                        } else {
                            $sql_update_distrit =  mysqli_query($mysqli, "UPDATE distritos SET nombre='$distrito', departamento_Id='$id_depa', provincias_id='$id_provin'
                             WHERE nombre='$distrito'");
                        }
                        if (!empty($cod_modu)) {
                            $checkemail_duplicidad = ("SELECT cod_mod_ie FROM institucion_educativa 
                                 WHERE cod_mod_ie='" . ($cod_modu) . "' ");
                            $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
                            $cant_duplicidad = mysqli_num_rows($ca_dupli);
                        }
                        //No existe Registros Duplicados
                        if ($cant_duplicidad == 0) {
                            $sql_ie = mysqli_query($con, "INSERT INTO institucion_educativa(id_ie,cod_mod_ie, nombre_ie, nivel_ie, departamento_ie, provincia_ie, distrito_ie, estado_ie, fecharegistro)
                                 VALUES('$id', '" . $cod_modu . "', '" . $nombre . "', 
                                 '" . $nivel . "', '" . utf8_encode($departamento) . "', '" . utf8_encode($provincia) . "', '" . utf8_encode($distrito) . "', '" . $estado_ie . "', now())");
                        }
                        /**Caso Contrario actualizo el o los Registros ya existentes*/
                        else {
                            $sql_ie =  mysqli_query($mysqli, "UPDATE institucion_educativa SET 
                            nombre_ie = '" . $nombre . "', 
                                nivel_ie = '" . $nivel . "', estado_ie = '" . $estado_ie . "'
                                WHERE cod_mod_ie='" . $cod_modu . "'");
                        }
                    }
                    $i++;
                }
                if ($sql_ie) {
                    echo '<div class="alert alert-primary" role="alert">Registro exitoso!.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Hubo problemas al insertar los datos. </div>';
                    echo "Error: " . $sql_ie . "<br>" . mysqli_error($mysqli);
                }
            } ?>
        </div>
    </div>
    <?php require("vista/footer.php"); ?>

</body>

</html>