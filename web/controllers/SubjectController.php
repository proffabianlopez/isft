<?php  
class SubjectController{

    public function yearSelect()
	{

		$showSubject = SubjectModel::showYearSubject();

		foreach ($showSubject as $key => $value) {
			echo '<option value="' . $value['id_year_subject'] . '">' . $value['year'] .'</option>';
		}
	}
    // static public function newSubject($id, $name) {
        
    //     $id_career = base64_decode($id);
    //     $name_career = base64_decode($name);
        
    
    //     if (!empty($_POST['name_subject']) && !empty($_POST['name_subject'])) {			
    
    //         $name_subject = ucwords(strtolower(trim($_POST['name_subject'])));
    //         $details_subject = strtolower(trim($_POST['details']));
    //         $id_year = $_POST['id_year'];
    
    //          $createNewSubject = SubjectModel::newSubject($name_subject, $details_subject, $id_year, $id_career);
    //         // return SubjectModel::newSubject($name_subject, $details_subject, $id_year, $id_career);
             
    //          if($createNewSubject){
    //             echo '<script>
    //             if (window.history.replaceState) {
    //                 window.history.replaceState(null, null, window.location.href);
    //             }
    //              alert("Se creó correctamente la materia");
    //             location.reload();
    //             </script>';
    //          }
            
          
    //      }//else{
    //     //     echo '<script>alert("El formulario no recibe datos vacios");window.location="index.php";</script>';  
    //     // }
    // }              

    static public function newSubject($id, $name) {
        // Decodificar los parámetros id y name
        $id_career = base64_decode($id);
        $name_career = base64_decode($name);
    
        if (!empty($_POST['name_subject']) && !empty($_POST['details'])) {
            // Recoger los datos del formulario
            $name_subject = ucwords(strtolower(trim($_POST['name_subject'])));
            $details_subject = strtolower(trim($_POST['details']));
            $id_year = $_POST['id_year'];
    
            // Llamar al método del modelo para crear una nueva materia
            $createNewSubject = SubjectModel::newSubject($name_subject, $details_subject, $id_year, $id_career);
    
            // if ($createNewSubject) {
            //     // Mostrar el mensaje de éxito y actualizar la URL
            //     echo '<script>
            //         if (window.history.replaceState) {
            //             window.history.replaceState(null, null, 
                       
            //         }

            //           window.location="../index.php?pages=manageSubject&id_career=' . urlencode($id) . '&name_career=' . urlencode($name) . '&subfolder=newSubject&message=correcto";

            //         </script>';
            // }
        }
    }
    
    
    
    

}


?>