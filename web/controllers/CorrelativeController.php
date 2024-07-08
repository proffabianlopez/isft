<?php
class CorrelativeController
{
    //Llama al modelo para mostrar las materias en forma de input selectorios
    public function correlativeSelect($id)
    {
        $showCorrelative = CorrelativeModel::showSubjectCorrelative($id);

        foreach ($showCorrelative as $key => $value) {
            $displayText = $value['name_subject'] . ' - ' . $value['year_subject'];
            echo '<option value="' . $value['id_subject'] . '">' . str_pad($displayText, 50, ' ', STR_PAD_RIGHT) . '</option>';
        }
    }
    //Logica para crear o armar una nueva correlativa
    static public function newCorrelative($id, $name, $state)
    {
        $id_career = $id;
        $name_career = $name;
        $state = $state;
        $id_subject = $_POST["toRender"];
        $id_correlative = $_POST["subjectApproved"];

        if ($id_subject == 'Seleccione una materia' || $id_correlative == 'Seleccione correlativa') {
            echo '<script>
            window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&invalidSelection=error";
            </script>';
            return;
        }

        $id_year_subject = SubjectModel::getIdSubject($id_subject);
        $id_year_correlative = SubjectModel::getIdSubject($id_correlative);

        // Validacion que la materia en 'Para rendir...' no pueda ser de 1er año
        if ($id_year_subject["id_year"] == 1) {
            echo '<script>
            window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&yearCorrelative=error";
            </script>';
            return;
        }

        // Validación para que la materia no sea la misma
        if ($id_subject == $id_correlative) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&sameSubject=error";
        </script>';
            return;
        }

        // Validación materias de año superior no pueden ser correlativas de año inferior
        if ($id_year_correlative["id_year"] > $id_year_subject["id_year"]) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&yearOrderError=error";
        </script>';
            return;
        }

        // Validación por si la correlativa ya existe
        $existingCorrelative = CorrelativeModel::checkExistingCorrelative($id_subject, $id_correlative);
        if ($existingCorrelative) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&existCorrelative=error";
        </script>';
            return;
        }

        $execute = CorrelativeModel::addSubjectCorrelative($id_subject, $id_correlative);

        if ($execute) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&success=correcto";
        </script>';
        } else {
            echo '<script>alert("Error al actualizar la correlativa.");</script>';
        }
    }


    //Muestra las correlativas
    static public function listCorrelative($id)
    {
        return CorrelativeModel::showDataCorrelative($id);
    }

    //Muestra las materias y todas sus correlativas concatenadas
    static public function listMultipleCorrelatives($id)
    {
        return CorrelativeModel::showMultipleCorrelatives($id);
    }

    //Edita las correlativas
    static public function editCorrelative($id, $name, $state)
    {
        $id_career = $id;
        $name_career = $name;
        $state = $state;
        $id_correlative = $_POST["id_correlative"];
        $new_id_subject = $_POST["toRender"];
        $new_id_correlative = $_POST["subjectApproved"];

        $id_year_subject = SubjectModel::getIdSubject($new_id_subject);
        $id_year_correlative = SubjectModel::getIdSubject($new_id_correlative);

        // Validacion que la materia en 'Para rendir...' no pueda ser de 1er año
        if ($id_year_subject["id_year"] == 1) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&editYearCorrelative=error";
        </script>';
            return;
        }

        // Validación para que la materia no sea la misma
        if ($new_id_subject == $new_id_correlative) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&editSameSubject=error";
        </script>';
            return;
        }

        // Validación materias de año superior no pueden ser correlativas de año inferior
        if ($id_year_correlative["id_year"] > $id_year_subject["id_year"]) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&editYearOrderError=error";
        </script>';
            return;
        }

        // Validación por si la correlativa ya existe
        $existingCorrelative = CorrelativeModel::checkExistingCorrelative($new_id_subject, $new_id_correlative);
        if ($existingCorrelative) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&editExistCorrelative=error";
        </script>';
            return;
        }

        // Actualización
        $execute = CorrelativeModel::editCorrelative($new_id_subject, $new_id_correlative, $id_correlative);

        if ($execute) {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&editSuccess=correcto";
        </script>';
        } else {
            echo '<script>alert("Error al actualizar la correlativa.");</script>';
        }
    }



    //Elimina las correlativas
    static public function deleteCorrelative($id, $name, $state)
    {
        $id_career = $id;
        $name_career = $name;
        $state = $state;
        if (isset($_POST["id_correlative"])) {
            $id_correlative = $_POST["id_correlative"];

            $execute = CorrelativeModel::deleteCorrelative($id_correlative);

            if ($execute) {
                echo '<script>
                window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $_GET["id_career"] . '&name_career=' . $_GET["name_career"] . '&state=' . $_GET["state"] . '&subfolder=newCorrelative&message=deleted";
                </script>';
            } else {
                echo '<script>alert("Error al eliminar la correlativa.");</script>';
            }
        }
    }
}
