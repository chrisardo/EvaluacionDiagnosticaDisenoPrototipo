<?php
$archivo = mysqli_fetch_all($q_archivo, MYSQLI_ASSOC);
foreach ($archivo as $row_file) {
    @$name_file = $row_file['nombre'];
    $fecha_resumen = $row_file['fecha'];
}
?>
<div class="container-fluid text-center bg-info">
    Fecha de actualización <span>
        <?php
        if (!empty($fecha_resumen) && @$inst_edu  > 0) {
            echo " de la institucion educativa: " . $fecha_resumen;
        } else {
            echo ":" . $fecha_resumen;
        }
        ?> </span>
</div>