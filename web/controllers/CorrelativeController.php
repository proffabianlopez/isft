<?php
class CorrelativeController
{
    public function correlativeSelect($id)
    {

        $showCorrelative = CorrelativeModel::showSubjectCorrelative($id);

        foreach ($showCorrelative as $key => $value) {
            echo '<option value="' . $value['id_subject'] . '">' . $value['name_subject'] . '</option>';
        }
    }

    static public function newCorrelative($id, $name, $state)
    {
        $id_career = $id;
        $name_career = $name;
        $state = $state;
        $id_subject = $_POST["toRender"];
        $id_correlative = $_POST["subjectApproved"];

        $execute = CorrelativeModel::newCorrelative($id_correlative, $id_subject);

        if ($execute) {
            echo '<script>
                window.location.href = "index.php?pages=manageCorrelatives&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newCorrelative&message=correcto";
                </script>';
        }
    }

    static public function listCorrelative($id)
    {
        return CorrelativeModel::showDataCorrelative($id);
    }

    static public function listMultipleCorrelatives($id)
    {
        return CorrelativeModel::showMultipleCorrelatives($id);
    }
}
