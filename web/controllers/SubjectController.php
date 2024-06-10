<?php  
class SubjectController{

    public function yearSelect()
	{

		$showSubject = SubjectModel::showYearSubject();

		foreach ($showSubject as $key => $value) {
			echo '<option value="' . $value['id_year_subject'] . '">' . $value['year'] .'</option>';
		}
	}
        

   
    
    static public function newSubject($id, $name,$state) {
        // Decodificar los parámetros id y name
        $id_career = $id;
        $name_career =$name;
        $state =$state;
        if (!empty($_POST['name_subject']) && !empty($_POST['details']) && !empty($_POST['id_year'])) {
            // Recoger los datos del formulario
            $name_subject = ucwords(strtolower(trim($_POST['name_subject'])));
            $details_subject = strtolower(trim($_POST['details']));
            $id_year = $_POST['id_year'];
    
            // Llamar al método del modelo para crear una nueva materia
            $createNewSubject = SubjectModel::newSubject($name_subject, $details_subject, $id_year, $id_career);
    
            if ($createNewSubject) {
                echo '<script>
            window.location.href = "index.php?pages=manageSubject&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newSubject&message=correcto";
                </script>';
             
            }
        }
    }
    
    
    
    

}


?>