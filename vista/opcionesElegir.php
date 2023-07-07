<div class="bg-dark-subtle d-flex justify-content-around flex-wrap">
    <div class="container text-center pt-2">
        <div class="row">
            <div class="col">
                <?php
                $cant_colegio = mysqli_num_rows($consult_ie);
                ?>
                <h6><?php echo $cant_colegio; ?></h6>
                <p>Total Instituciones Educativas
                    <?php
                    if (!empty($_POST['departamento'])) { //Si eligio la opcion del departamento
                        if (!empty($_POST['provinci']) && empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien la provincia
                            echo "de: " . $_POST['departamento'] . " >" . $_POST['provinci'];
                        }
                        if (empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono tambien el distrito
                            echo "de: " . $_POST['departamento'] . " >" . $_POST['distritos'];
                        }
                        if (empty($_POST['provinci']) && empty($_POST['distritos'])) { //Al elegir el departamento no selecciono ni la provicnia ni el distrito
                            echo "de: " . $_POST['departamento'];
                        }
                        if (!empty($_POST['provinci']) && !empty($_POST['distritos'])) { //Al elegir el departamento selecciono la provicnia y el distrito
                            echo "<br> " . $_POST['departamento'] . " >" . $_POST['provinci'] . " >" . $_POST['distritos'];
                        }
                    }
                    ?>
                </p>
            </div>
            <div class="col">
                <?php
                $cant_subidas = mysqli_num_rows($sql_subidas);
                ?>
                <h6><?php echo $cant_subidas; ?></h6>
                <p>Evaluación diagnóstica Subidas</p>
            </div>
            <div class="col">
                <?php
                $cant_nosubidas = mysqli_num_rows($sql_nosubidas);
                ?>
                <h6><?php echo $cant_nosubidas; ?></h6>
                <p>Evaluación diagnóstica No subidas</p>
            </div>
        </div>
    </div>
</div>