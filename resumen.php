<?php

require_once 'controlador/connectdb.php';

$sql = "SELECT resumen_evaluacion.id_competencia,c.nombre,SUM(resumen_evaluacion.porcentaje) porcentaje,resumen_evaluacion.id_nivel from resumen_evaluacion
INNER JOIN competencias c ON c.id_competencia=resumen_evaluacion.id_competencia
where resumen_evaluacion.cod_mod_ie='1794163' and resumen_evaluacion.id_asignatura='1'
GROUP by resumen_evaluacion.id_nivel,c.nombre;";


$resultados = $mysqli->query($sql);

/* while ($fila = $resultados->fetch_assoc()) {
    echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
} */

$response = array();

while ($rows = $resultados->fetch_array()) {
    $response[] = array(
        'nombre' => $rows['nombre'],
        'porcentaje' => $rows['porcentaje'],
        'nivel' => $rows['id_nivel'],

    );
}

echo json_encode($response);
