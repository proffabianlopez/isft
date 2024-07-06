<?php
class CorrelativeController
{
    //Llama al modelo para mostrar las materias en forma de input selectorios
    public function correlativeSelect($id)
    {

        $showCorrelative = CorrelativeModel::showSubjectCorrelative($id);

        foreach ($showCorrelative as $key => $value) {
            echo '<option value="' . $value['id_subject'] . '">' . $value['name_subject'] . '</option>';
        }
    }

    //Controlador para insertar nueva correlativa
    static public function newCorrelative($id, $name, $state)
    {
        $id_career = $id;
        $name_career = $name;
        $state = $state;
        $id_subject = $_POST["toRender"];
        $id_correlative = $_POST["subjectApproved"];

        if ($id_subject != $id_correlative) {
            $result = CorrelativeModel::addSubjectCorrelative($id_subject, $id_correlative); // RREBISAR DESPUES

            if ($result === "La relación se ha insertado correctamente.") {
                echo '<script>
            window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&message=correcto";
            </script>';
            } else {
                echo '<script>
            window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&correlative=error";
            </script>';
            }
        } else {
            echo '<script>
        window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&message=error";
        </script>';
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

        $execute = CorrelativeModel::editCorrelative($new_id_subject, $new_id_correlative, $id_correlative);

        if ($execute) {
            echo '<script>
            window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&message=correcto";
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
