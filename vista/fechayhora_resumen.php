<?php
$cantfh_resumen = mysqli_num_rows($sql_fhresumen);
if ($cantfh_resumen > 0) {
    $fh_resumen = mysqli_fetch_all($sql_fhresumen, MYSQLI_ASSOC);
    foreach ($fh_resumen as $row_fh) {
        $codm_ie = $row_fh['cod_mod_ie'];
        $fecha_resumen = $row_fh['fecha'];
        $q_archivo = mysqli_query($mysqli, "SELECT*FROM upload where cod_mod_ie='$codm_ie'");
        $archivo = mysqli_fetch_all($q_archivo, MYSQLI_ASSOC);
        foreach ($archivo as $row_file) {
            @$name_file = $row_file['nombre'];
        }
        $q_ie = mysqli_query($mysqli, "SELECT*FROM institucion_educativa where cod_mod_ie='$cod_mod_ie'");
        $ie = mysqli_fetch_all($q_ie, MYSQLI_ASSOC);
        foreach ($ie as $row_ie) {
            $cod_ie = $row_ie['cod_mod_ie'];
            $nombre_ie = sed::decryption($row_ie['nombre_ie']);
        }
    }
?>
    <?php if (@$_SESSION['rol'] == 1) {
    } else { ?>
        <center>
            <div>
                <p class="titulo_contenido" style="font-size: 18px;"><strong> Instituciòn Educativa: <?php echo $nombre_ie; ?></strong></p>
            </div>
        </center>
    <?php } ?>
    <div style="width: 90%; margin-left:26px; height: 30px; text-align: center; margin-top: 4px; color: white; background: #40CFFF;" class="">
        Fecha de actualización: <span><?php echo $fecha_resumen; ?> </span>
    </div>

    <div id="navbarToggleExternalContent" style=" margin-left:26px; margin-top:6px;" class="justify-content-between barra_titulo">
        <div>
            <h1 class="titulo_contenido" style="display: inline-block; font-size: 22px;">Resultado de evaluacion diagnostica: <?php echo $nombre_ie; ?></h1>
            <div id=" reportes" style="display: inline-block; margin-left:100px;" data-html2canvas-ignore="" class="botonera_print">
                <?php

                ?>
                <!--<div style="display: inline-block;">
                    <button class="btn-success">
                        <?php /*if (@$name_file && $row_file['fname']) { ?>
                            <a href="downloadexcel.php?filename=<?php echo @$name_file; ?>&f=<?php echo @$row_file['fname']; ?>" style="color:white;">Exportar excel</a>
                        <?php } else { ?>
                            <a style="color:white;">Exportar excel</a>
                        <?php }*/ ?>
                        <?php ?>
                    </button>
                </div>
                <div style="display: inline-block;">
                    <button class="btn_alert" style="background-color: red; ">
                        <a href="pdf_resumen_evaluacion_diagnostica.php?cod_mod_ie=<?php //echo sed::decryption($cod_mod_ie); 
                                                                                    ?>" style="color:white;" target="_blank">
                            <div class="icon-impresora"></div>Ver como PDF
                        </a>
                    </button>
                </div>-->

            </div>
        </div>

    </div>
<?php }  ?>