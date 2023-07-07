<div style="width: 90%; margin-left:26px;">

    <div class="container-fluid p-2">
        <?php
        $cant_resumen = mysqli_num_rows($sql_resumen);
        //if ($cant_resumen > 0) {
        $resumen_eva = mysqli_fetch_all($sql_resumen, MYSQLI_ASSOC);
        foreach ($resumen_eva as $row_r) {
            $id_grado = $row_r['id_grado'];
            $id_nivel_re = $row_r['id_nivel_re'];
            $id_asigna = $row_r['id_asignatura'];

            $sql_nivel_res = mysqli_query($mysqli, "SELECT*FROM nivel_logro_evalua");
            $cant_nivel_res = mysqli_num_rows($sql_nivel_res);
            $nivel_res = mysqli_fetch_all($sql_nivel_res, MYSQLI_ASSOC);

            $sql_competencias = mysqli_query($mysqli, "SELECT*FROM competencias WHERE id_asignatura='$id_asigna' ");
            $cant_competencias = mysqli_num_rows($sql_competencias);
            $competencias = mysqli_fetch_all($sql_competencias, MYSQLI_ASSOC);
            $sql_asignaturas = mysqli_query($mysqli, "SELECT*FROM asignatura WHERE id_asignatura='$id_asigna' ");
            $cant_asignaturas = mysqli_num_rows($sql_asignaturas);
            $asignaturas = mysqli_fetch_all($sql_asignaturas, MYSQLI_ASSOC);
            foreach ($asignaturas as $row_as) {
            }
        ?>
            <center>
                <table class="table" style="margin-top: -0px;">
                    <thead>
                        <tr style="<?php
                                    if ($row_as['nombre'] == "MATEMATICA") {
                                        echo "background:orange;";
                                    } elseif ($row_as['nombre'] == "LECTURA") {
                                        echo "background:greenyellow;";
                                    }

                                    ?>">
                            <th style="width: 71%;  border: 2px solid black;" scope="col">
                                <?php echo $row_r['g_nombre_grado']; ?> ( <?php echo $row_as['nombre']; ?> ) </th>
                            <th style="border: 2px solid black; " scope="col">Promedio porcentual <?php echo $row_r['g_nombre_grado']; ?> </th>
                        </tr>
                    </thead>
                </table>
                <table class="table" style="margin-top: -16px; ">
                    <thead>
                        <tr>
                            <th style="border: 2px solid black;" scope="col">
                                Nivel de logro de las
                                <?php
                                if ($row_as['nombre'] == "MATEMATICA") {
                                    echo "competencias";
                                } elseif ($row_as['nombre'] == "LECTURA") {
                                    echo "capacidades";
                                }

                                ?>
                            </th>
                            <!--<th scope="col">Cod. producto</th>-->
                            <?php foreach ($nivel_res as $row_n) {
                                $letra_nombre_nivele = $row_n['letra_nombre']; ?>
                                <th style="border: 2px solid black; 
                            <?php if ($row_n['letra_nombre'] == "P.I") {
                                    echo "background:red;";
                                } elseif ($row_n['letra_nombre'] == "I") {
                                    echo "background:red;";
                                } elseif ($row_n['letra_nombre'] == "P") {
                                    echo "background:yellow;";
                                } elseif ($row_n['letra_nombre'] == "S") {
                                    echo "background:green;";
                                }
                            ?>" scope="col">
                                    <?php echo $letra_nombre_nivele; ?>
                                </th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="container_card">
                            <?php foreach ($competencias as $row_c) {
                                $nombre_compe = $row_c['nombre'];
                                $id_compe = $row_c['id_competencia']; ?>
                                <tr>
                                    <td style="vertical-align: middle; border: 2px solid black;">
                                        <?php echo $nombre_compe; ?></td>
                                    <?php
                                    $sql_resumen3 = mysqli_query($mysqli, "SELECT resumen_evaluacion.id_competencia, resumen_evaluacion.id_nivel id_nivel_re, resumen_evaluacion.porcentaje porcentaje, 
                                            resumen_evaluacion.id_grado, resumen_evaluacion.id_asignatura, resumen_evaluacion.cod_mod_ie
                                            FROM resumen_evaluacion where resumen_evaluacion.cod_mod_ie='$cod_mod_ie' and resumen_evaluacion.id_competencia='$id_compe' and resumen_evaluacion.id_grado='$id_grado' and resumen_evaluacion.id_asignatura='$id_asigna' 
                                            ORDER BY resumen_evaluacion.id_resumen ASC");
                                    $cant_resumen3 = mysqli_num_rows($sql_resumen3);
                                    $resumen_eva3 = mysqli_fetch_all($sql_resumen3, MYSQLI_ASSOC);
                                    foreach ($resumen_eva3 as $row_r3) {
                                        $porcentaje = $row_r3['porcentaje'];
                                    ?>
                                        <td style="vertical-align: middle; border: 2px solid black;"><?php echo $porcentaje; ?></td>
                                    <?php } ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </div>
                    </tbody>
                </table>
            <?php //require "graficos.php";
            //echo "hola";
        }
        //} 
            ?>
            </center>
    </div>
</div>