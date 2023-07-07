<?php
if (isset($_POST['subirexcel_director'])) { //Si dio click al boton de importar datos excel

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
                $fila1 = $sheet->getCellByColumnAndRow(2, $indiceFila);
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
                //Condicion para obtener los datos del indice de 'Director lectura' del archivo excel
                if ($indiceHoja == 0) { //Si el indice hoja es del Director lectura
                    //$valorCod = sed::encryption($valorRaw);
                    $sql_admin = mysqli_query($mysqli, "SELECT * FROM administrador
                    INNER JOIN rol on administrador.codigorol=rol.codigorol
                    WHERE administrador.cod_mod_ie='$valorRaw' and administrador.codigorol=1");
                    $cant_admin = mysqli_num_rows($sql_admin);
                    //No existe Registros Duplicados
                    if ($cant_admin == 0) {
                        $inserData = mysqli_query($mysqli, "INSERT INTO administrador
                            (contrasena, cod_mod_ie, codigorol, fecharegistro, estado) 
                            VALUES('$valorRaw', '$valorRaw', '1',now(), '1')");

                        if ($inserData) { // Si se importo los datos del archivo excel
                            echo '<div class="alert alert-primary" role="alert">Insertado correctamente. </div>';
                            echo "<script>location.href='admgeneral_inicio.php'</script>";
                        } else {
                            echo '<div class="alert alert-primary" role="alert">Error al insertar. </div>';
                            die(mysqli_error($mysqli)); //Botará el error si no se llega a subir el archivo excel a la BD
                        }
                    } else {
                        $actuData = mysqli_query($mysqli, "UPDATE administrador  SET  contrasena='$valorRaw', cod_mod_ie='$valorRaw'
                            WHERE  administrador.cod_mod_ie='$valorRaw' and administrador.codigorol=1");
                        if ($actuData) { // Si se importo los datos del archivo excel
                            echo '<div class="alert alert-primary" role="alert">Actualizado correctamente. </div>';
                            echo "<script>location.href='admgeneral_inicio.php'</script>";
                        } else {
                            echo '<div class="alert alert-primary" role="alert">Error al actualizar. </div>';
                            die(mysqli_error($mysqli)); //Botará el error si no se llega a subir el archivo excel a la BD
                        }
                    }
                }
            }
        }
    }
} else {
    echo "<script>location.href='controlador/desconectar.php'</script>";
}
