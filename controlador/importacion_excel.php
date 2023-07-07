<?php
//codigo web: https://parzibyte.me/blog/2019/02/14/leer-archivo-excel-php-phpspreadsheet/
//https://www.baulphp.com/leer-archivo-excel-con-php-descargar-ejemplo/
/*/if (isset($_POST['token']) && isset($_POST['action'])) {
    $token = $_POST['token'];
    $action = $_POST['action'];
    $secret = '6Le5wKIkAAAAALzbGF3ER6Du6QlUZF3YH_D8hIv3'; // Ingresa tu clave secreta del recaptcha.....
    @$response2 = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token");
    $datos = json_decode($response2, true);*/
if (isset($_POST['subirexcel'])) { //si se dio click al 
    /*if (@$datos['success'] == 1 && @$datos['score'] >= 0.9) {
        if ($datos['action'] == 'validarUsuario') {*/
    if ($temp) {
        require './vendor/autoload.php'; //Llamando la libreria php de excel Spreadsheets
        require("controlador/connectdb.php"); //Lamando la conexion de la base de datos
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES['archivo']['tmp_name']); //Leyendo el archivo excel por medio de la libreira Spreadsheets
        $totalDeHojas = $reader->getSheetCount(); //Obteniendo los indices dela hioja de excel
        # Iterar indice de hoja por hoja
        for ($indiceHoja = 0; $indiceHoja < $totalDeHojas; $indiceHoja++) {
            # Obtener hoja en el índice que vaya del ciclo
            $sheet = $reader->getSheet($indiceHoja);
            //echo "<h3>Vamos en la hoja con índice $indiceHoja</h3>";

            $sheetData = $sheet->toArray();
            //print_r($sheetData);
            # Calcular el máximo valor de la fila como entero, es decir, el
            # límite de nuestro ciclo
            $numeroMayorDeFila = $sheet->getHighestRow(); // Numérico de las filas
            $letraMayorDeColumna = $sheet->getHighestColumn(); // Letra de las columna
            # Convertir la letra al número de columna correspondiente
            $numeroMayorDeColumna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraMayorDeColumna); //Convirtiendo la letra de la columna a numeros

            # Iterar filas con ciclo for e índices
            for ($indiceFila = 2; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {
                # Obtener celda por fila
                $fila1 = $sheet->getCellByColumnAndRow(1, $indiceFila);
                # Y ahora que tenemos una celda trabajamos con ella igual que antes
                # El valor, así como está en el documento
                $valorRaw = $fila1->getValue();
                # Fila, que comienza en 1, luego 2 y así...
                $fila = $fila1->getRow();
                # Columna, que es la A, B, C y así...
                $columna = $fila1->getColumn();
                # Formateado por ejemplo como dinero o con decimales
                $valorFormateado = $fila1->getFormattedValue();
                # Si es una fórmula y necesitamos su valor, llamamos a:
                $valorCalculado = $fila1->getCalculatedValue();
                //Fila2
                $fila2 = $sheet->getCellByColumnAndRow(2, $indiceFila);
                # Y ahora que tenemos una celda trabajamos con ella igual que antes
                # El valor, así como está en el documento
                $valorRaw2 = $fila2->getValue();
                $filacelda2 = $fila2->getRow();
                # Columna, que es la A, B, C y así...
                $filacolumna2 = $fila2->getColumn();
                //Fila 3-> P.I
                $fila3 = $sheet->getCellByColumnAndRow(35, $indiceFila);
                # El valor, así como está en el documento
                $valorRaw3 = $fila3->getValue();
                # Fila, que comienza en 1, luego 2 y así...
                $celdafila3 = $fila3->getRow();
                # Columna, que es la A, B, C y así...
                $columnasfila3 = $fila3->getColumn();
                # Formateado por ejemplo como dinero o con decimales
                $valorFormateado3 = $fila3->getFormattedValue();
                # Si es una fórmula y necesitamos su valor, llamamos a:
                $valorCalculado3 = $fila3->getCalculatedValue();
                //Fila 4 -> I
                $fila4 = $sheet->getCellByColumnAndRow(36, $indiceFila);
                # El valor, así como está en el documento
                $valorRaw4 = $fila4->getValue();
                # Fila, que comienza en 1, luego 2 y así...
                $celdafila4 = $fila4->getRow();
                # Columna, que es la A, B, C y así...
                $columnasfila4 = $fila4->getColumn();
                # Formateado por ejemplo como dinero o con decimales
                $valorFormateado4 = $fila4->getFormattedValue();
                # Si es una fórmula y necesitamos su valor, llamamos a:
                $valorCalculado4 = $fila4->getCalculatedValue();
                //Fila 5 -> P
                $fila5 = $sheet->getCellByColumnAndRow(37, $indiceFila);
                # El valor, así como está en el documento
                $valorRaw5 = $fila5->getValue();
                # Fila, que comienza en 1, luego 2 y así...
                $celdafila5 = $fila5->getRow();
                # Columna, que es la A, B, C y así...
                $columnasfila5 = $fila5->getColumn();
                # Formateado por ejemplo como dinero o con decimales
                $valorFormateado5 = $fila5->getFormattedValue();
                # Si es una fórmula y necesitamos su valor, llamamos a:
                $valorCalculado5 = $fila5->getCalculatedValue();
                //Fila 6 -> S
                $fila6 = $sheet->getCellByColumnAndRow(38, $indiceFila);
                # El valor, así como está en el documento
                $valorRaw6 = $fila6->getValue();
                # Fila, que comienza en 1, luego 2 y así...
                $celdafila6 = $fila6->getRow();
                # Columna, que es la A, B, C y así...
                $columnasfila6 = $fila6->getColumn();
                # Formateado por ejemplo como dinero o con decimales
                $valorFormateado6 = $fila6->getFormattedValue();
                # Si es una fórmula y necesitamos su valor, llamamos a:
                $valorCalculado6 = $fila6->getCalculatedValue();
                //Si el valor obtenido de la fuila A solo es el grado
                if ($valorRaw > 0 && $valorRaw != "MATEMATICA" && $valorRaw != "LECTURA" && $valorRaw != "COMPETENCIAS" && $valorRaw != "CAPACIDADES") {
                    //$valorraw= $valorRaw . " <br>";
                    $nombregrado = "grado " . $valorRaw; //Obteniendo el numero del grado
                    if ($valorRaw > 0) { //si la fila A es un numero
                        //Consulta para saber si el grado que se agregue a la BD está insertado
                        $checkgrado_duplicidad = mysqli_query($mysqli, "SELECT*FROM grado 
                                            WHERE id_grado='" . ($valorRaw) . "' ");
                        $cant_duplicidad = mysqli_num_rows($checkgrado_duplicidad);
                        $grados = mysqli_fetch_all($checkgrado_duplicidad, MYSQLI_ASSOC);
                        foreach ($grados as $array_g) {
                            $id_grados = $array_g['id_grado'];
                        }
                    }
                }
                //Condicion para obtener los datos del indice de 'Director lectura' del archivo excel
                if ($indiceHoja == 0) { //Si el indice hoja es del Director lectura
                    if ($valorRaw == "LECTURA") {
                        $checkasign_duplicidad = mysqli_query($mysqli, "SELECT*FROM asignatura 
                                                WHERE nombre='" . ($valorRaw) . "' ");
                        $asigna = mysqli_fetch_all($checkasign_duplicidad, MYSQLI_ASSOC);
                        foreach ($asigna as $array) {
                            $id_asi = $array['id_asignatura'];
                        }
                    }
                    if ($valorRaw2 != "" && $valorRaw2 != "PRIMARIA" && $valorRaw2 != "SECUNDARIA" && $valorRaw2 != "NIVEL DE LOGRO DE LAS CAPACIDADES") {
                        //Consulta para obtener el id y nombre de la tabla 'competencias'
                        $sql_competencia2 = mysqli_query($mysqli, "SELECT*FROM competencias where id_asignatura=2 and nombre='$valorRaw2'");
                        $cant_dupli2 = mysqli_num_rows($sql_competencia2);
                        $competen2 = mysqli_fetch_all($sql_competencia2, MYSQLI_ASSOC);
                        foreach ($competen2 as $array_co) {
                            $id_compe = $array_co['id_competencia'];
                            $nombre_compe = $array_co['nombre'];
                            $id_asigna = $array_co['id_asignatura'];
                        }
                        //Condicion para obtener los datos del promedio de inicio (P.I)
                        if ($valorRaw3 != "P.I" && $valorRaw3 != "PROMEDIO 1" && $valorRaw3 != "PROMEDIO 2" && $valorRaw3 != "PROMEDIO 3" && $valorRaw3 != "PROMEDIO 4" && $valorRaw3 != "PROMEDIO 5" && $valorRaw3 != "PROMEDIO 6") {
                            //Consulta para saber si existe agregado el promedio 
                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                            where id_competencia='$id_compe' and id_nivel=1 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                    (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                    VALUES('$id_compe', '1', '$valorFormateado3', '$valorCalculado3','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado3', promedio='$valorCalculado3', fecha=now()
                                                    WHERE id_competencia='$id_compe' and id_nivel=1 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                        if ($valorFormateado4 > 0) {
                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                                where id_competencia='$id_compe' and id_nivel=2 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                        (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                        VALUES('$id_compe', '2', '$valorFormateado4', '$valorCalculado4','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado4', promedio='$valorCalculado4',fecha=now()
                                                        WHERE id_competencia='$id_compe' and id_nivel=2 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                        if ($valorFormateado5 > 0) {
                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                                where id_competencia='$id_compe' and id_nivel=3 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                        (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                        VALUES('$id_compe', '3', '$valorFormateado5', '$valorCalculado5','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado5', promedio='$valorCalculado5',fecha=now()
                                                        WHERE id_competencia='$id_compe' and id_nivel=3 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                        if ($valorFormateado6 > 0) {
                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                                where id_competencia='$id_compe' and id_nivel=4 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                        (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                        VALUES('$id_compe', '4', '$valorFormateado6', '$valorCalculado6','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado6', promedio='$valorCalculado6',fecha=now()
                                                        WHERE id_competencia='$id_compe' and id_nivel=4 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                    }
                }
                if ($indiceHoja == 1) {
                    if ($valorRaw == "MATEMATICA") {
                        $checkasign_duplicidad = mysqli_query($mysqli, "SELECT*FROM asignatura 
                                                WHERE nombre='" . ($valorRaw) . "' ");
                        $asigna = mysqli_fetch_all($checkasign_duplicidad, MYSQLI_ASSOC);
                        foreach ($asigna as $array) {
                            $id_asi = $array['id_asignatura'];
                        }
                    }
                    if ($valorRaw2 != "" && $valorRaw2 != "PRIMARIA" && $valorRaw2 != "SECUNDARIA" && $valorRaw2 != "NIVEL DE LOGRO DE LAS COMPETENCIAS") {
                        $sql_competencia2 = mysqli_query($mysqli, "SELECT*FROM competencias where id_asignatura=1 and nombre='$valorRaw2'");
                        $cant_dupli2 = mysqli_num_rows($sql_competencia2);
                        $competen2 = mysqli_fetch_all($sql_competencia2, MYSQLI_ASSOC);
                        foreach ($competen2 as $array_co) {
                            $id_compe = $array_co['id_competencia'];
                            $nombre_compe = $array_co['nombre'];
                            $id_asigna = $array_co['id_asignatura'];
                        }
                        if ($valorRaw3 != "P.I" && $valorRaw3 != "PROMEDIO 1" && $valorRaw3 != "PROMEDIO 2" && $valorRaw3 != "PROMEDIO 3" && $valorRaw3 != "PROMEDIO 4" && $valorRaw3 != "PROMEDIO 5" && $valorRaw3 != "PROMEDIO 6") {

                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                            where id_competencia='$id_compe' and id_nivel=1 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                    (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                    VALUES('$id_compe', '1', '$valorFormateado3', '$valorCalculado3','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado3', promedio='$valorCalculado3',fecha=now()
                                                    WHERE id_competencia='$id_compe' and id_nivel=1 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                        if ($valorFormateado4 > 0) {
                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                                where id_competencia='$id_compe' and id_nivel=2 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                        (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                        VALUES('$id_compe', '2', '$valorFormateado4', '$valorCalculado4','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado4', promedio='$valorCalculado4',fecha=now()
                                                        WHERE id_competencia='$id_compe' and id_nivel=2 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                        if ($valorFormateado5 > 0) {
                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                                where id_competencia='$id_compe' and id_nivel=3 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                        (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                        VALUES('$id_compe', '3', '$valorFormateado5', '$valorCalculado5','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado5', promedio='$valorCalculado5',fecha=now()
                                                        WHERE id_competencia='$id_compe' and id_nivel=3 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                        if ($valorFormateado6 > 0) {
                            $sql_re = mysqli_query($mysqli, "SELECT*FROM resumen_evaluacion 
                                                where id_competencia='$id_compe' and id_nivel=4 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            $re_cant_dupli = mysqli_num_rows($sql_re);
                            //No existe Registros Duplicados
                            if ($re_cant_dupli == 0) {
                                $inserData = mysqli_query($mysqli, "INSERT INTO resumen_evaluacion 
                                                        (id_competencia, id_nivel, porcentaje, promedio,id_grado, id_asignatura, cod_mod_ie, fecha) 
                                                        VALUES('$id_compe', '4', '$valorFormateado6', '$valorCalculado6','$id_grados', '$id_asigna', '$cod_modu_director', now())");
                            } else {
                                $actuData = mysqli_query($mysqli, "UPDATE resumen_evaluacion  SET  porcentaje='$valorFormateado6', promedio='$valorCalculado6',fecha=now()
                                                        WHERE id_competencia='$id_compe' and id_nivel=4 and id_grado='$id_grados' and id_asignatura='$id_asigna' and cod_mod_ie='$cod_modu_director'");
                            }
                        }
                    }
                }
            }
        }
    }
    /*}
    } else {
        echo "<div class='alert alert-danger' role='alert'>Parece eres un robot.</div>";
    }*/
} else {
    echo "<script>location.href='controlador/desconectar.php'</script>";
}
