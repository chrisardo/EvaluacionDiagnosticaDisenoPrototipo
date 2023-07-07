<tbody>
    <tr>
        <th class="col bg-info">Institución educativa</th>
        <th class="col bg-info">Código modular</th>
        <th class="col bg-info">Nivel</th>
        <td class="col bg-danger" style="color:white;">Proceso Inicio (%)</td>
        <td class="col bg-danger" style="color:white;">Inicio (%)</td>
        <td class="col bg-warning" style="color:white;">Proceso (%)</td>
        <td class="col bg-success" style="color:white;">Satisfactorio (%)</td>
    </tr>
</tbody>
<?php
/*$ies = mysqli_fetch_all($consult_ie, MYSQLI_ASSOC);
foreach ($ies as $row_ie) {*/
?>
<tr>
    <td style="vertical-align: middle; border: 2px solid black;">
        <?php //echo sed::decryption($row_ie['nombre_ie']);
        ?></td>
    <td style="vertical-align: middle; border: 2px solid black;">
        <?php //echo sed::decryption($row_ie['cod_mod_ie']);
        ?></td>
    <td style="vertical-align: middle; border: 2px solid black;">
        <?php //echo sed::decryption($row_ie['nivel_ie']);
        ?></td>
    <td style="vertical-align: middle; border: 2px solid black;">
        <?php
        /*if ($row_ie['estado_subido_excel'] == 1) {
                echo "X";
            }*/
        ?></td>
    <td style="vertical-align: middle; border: 2px solid black;">
        <?php
        /*if ($row_ie['estado_subido_excel'] == 0) {
                echo "X";
            }*/
        ?></td>
    <td style="vertical-align: middle; border: 2px solid black;">
        <?php
        /*if ($row_ie['estado_subido_excel'] == 0) {
                echo "X";
            }*/
        ?></td>
    <td style="vertical-align: middle; border: 2px solid black;">
        <?php
        /*if ($row_ie['estado_subido_excel'] == 0) {
                echo "X";
            }*/
        ?></td>
</tr>
<?php //} 
?>