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
    static public function newCorrelative()
    {
        $id_career = $_POST['idCareer'];
        $id_subject = $_POST["toRender"];
        $id_correlative = $_POST["subjectApproved"];

        if ($id_subject == 'Seleccione una materia' || $id_correlative == 'Seleccione correlativa') {
            $response["status"] = "error";
            $response["message"] = "No se seleccionó materia.";
            return $response;
        }

        $id_year_subject = SubjectModel::getIdSubject($id_subject);
        $id_year_correlative = SubjectModel::getIdSubject($id_correlative);

        // Validacion que la materia en 'Para rendir...' no pueda ser de 1er año
        if ($id_year_subject["id_year"] == 1) {
            $response["status"] = "error";
            $response["message"] = "No se pueden seleccionar materias del primer año.";
            return $response;
        }

        // Validación para que la materia no sea la misma
        if ($id_subject == $id_correlative) {
            $response["status"] = "error";
            $response["message"] = "No se puede seleccionar la misma materia para armar la correlativa.";
            return $response;
        }
        // Validación materias de año superior no pueden ser correlativas de año inferior
        if ($id_year_correlative["id_year"] > $id_year_subject["id_year"]) {
            $response["status"] = "error";
            $response["message"] = "Materias de años superiores no pueden ser correlativas de materias de años inferiores.";
            return $response;
        }

        // Validación por si la correlativa ya existe
        $existingCorrelative = CorrelativeModel::checkExistingCorrelative($id_subject, $id_correlative);
        if ($existingCorrelative) {
            $response["status"] = "error";
            $response["message"] = "Esta correlativa ya existe.";
            return $response;
        }

        $execute = CorrelativeModel::addSubjectCorrelative($id_subject, $id_correlative);

        if ($execute) {
            $response['title'] = "¡EXITO!";
            $response["status"] = "successLoad";
            $response["message"] = "Se registro la correlativa correctamente.";
            return $response;
        } else {
            $response["status"] = "error";
            $response["message"] = "Hubo un problema al crear la correlativa";
            return $response;
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
    static public function editCorrelative()
    {
        $id_correlative = $_POST["id_correlativeEdit"];
        $new_id_subject = $_POST["toRenderEdit"];
        $new_id_correlative = $_POST["subjectApprovedEdit"];

        $id_year_subject = SubjectModel::getIdSubject($new_id_subject);
        $id_year_correlative = SubjectModel::getIdSubject($new_id_correlative);

        // Validacion que la materia en 'Para rendir...' no pueda ser de 1er año
        if ($id_year_subject["id_year"] == 1) {
            $response["status"] = "error2";
            $response["message"] = "No se pueden seleccionar materias del primer año.";
            return $response;
        }

        // Validación para que la materia no sea la misma
        if ($new_id_subject == $new_id_correlative) {
            $response["status"] = "error2";
            $response["message"] = "No se puede seleccionar la misma materia para armar la correlativa.";
            return $response;
        }

        // Validación materias de año superior no pueden ser correlativas de año inferior
        if ($id_year_correlative["id_year"] > $id_year_subject["id_year"]) {
            $response["status"] = "error2";
            $response["message"] = "Materias de años superiores no pueden ser correlativas de materias de años inferiores.";
            return $response;
        }

        // Validación por si la correlativa ya existe
        $existingCorrelative = CorrelativeModel::checkExistingCorrelative($new_id_subject, $new_id_correlative);
        if ($existingCorrelative) {
            $response["status"] = "error2";
            $response["message"] = "Esta correlativa ya existe.";
            return $response;
        }

        // Actualización
        $execute = CorrelativeModel::editCorrelative($new_id_subject, $new_id_correlative, $id_correlative);

        if ($execute) {
            $response['title'] = "¡EXITO!";
            $response["status"] = "successLoad";
            $response["message"] = "Se actualizó la correlativa correctamente.";
            return $response;
        } else {
            $response["status"] = "error2";
            $response["message"] = "Hubo un problema al crear la correlativa";
            return $response;
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
