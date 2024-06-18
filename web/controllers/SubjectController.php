<?php  
class SubjectController{

    public function yearSelect()
	{

		$showSubject = SubjectModel::showYearSubject();

		foreach ($showSubject as $key => $value) {
			echo '<option value="' . $value['id_year_subject'] . '">' . $value['year'] .'</option>';
		}
	}
        

   
    static public function newSubject($id, $name, $state) {
        $id_career = $id;
        $name_career = $name;
        $state = $state;
        if (!empty($_POST['name_subject']) && !empty($_POST['details']) && !empty($_POST['id_year'])) {
            // Recoger los datos del formulario
            $name_subject = ucwords(strtolower(trim($_POST['name_subject'])));
            $details_subject = trim($_POST['details']);
            $id_year = $_POST['id_year'];

            if (!preg_match('/^[A-Za-zÀ-ÿ0-9\s]+$/', $name_subject) || strlen($name_subject) > 100) {
                echo '<script>
                    alert("El nombre de la materia no puede contener caracteres especiales, y debe tener una longitud máxima de 100 caracteres.");
                    window.history.back();
                    </script>';
                return;
            }

            if (!preg_match('/^[0-9]+$/', $details_subject)) {
                echo '<script>
                    alert("La carga horaria debe contener solo números.");
                    window.history.back();
                    </script>';
                return;
            }
    
            // Llamar al método del modelo para crear una nueva materia
            $lastInsertedId = SubjectModel::newSubject($name_subject, $details_subject, $id_year, $id_career);
    
            if ($lastInsertedId) {
              
                AssignmentModel::assignSubjectToTeacher($lastInsertedId);
    
                echo '<script>
                window.location.href = "index.php?pages=manageSubject&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newSubject&message=correcto";
                </script>';
            } else {
                // Manejo de error si la inserción falla
                echo "La inserción de la materia falló.";
            }
        }
    }
    

    static public function getAllSubject($id){
        return SubjectModel::showSubject($id);

    }
   
    
    //logica para controlar el boton de edicion de materia y poder editar datos
    static public function updateSubject($id_career, $name_career, $state) {
        $name_subject = ucwords(strtolower(trim($_POST['subject_name'])));
        $details_subject = trim($_POST['detail']);
        $id_subject = $_POST['id_subject'];
    
        if (preg_match('/[0-9]/', $name_subject) || strlen($name_subject) > 100) {
            echo '<script>
                alert("El nombre de la materia no puede contener números.");
                window.history.back();
                </script>';
            return;
        }

        if (!preg_match('/^[0-9]+$/', $details_subject)) {
            echo '<script>
                alert("La carga horaria debe contener solo números.");
                window.history.back();
                </script>';
            return;
        }
    
        $update = SubjectModel::updateSubjectData($name_subject, $details_subject, $id_subject);
    
        if ($update) {
            // Si la actualización fue exitosa, redirige
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="index.php?pages=manageSubject&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=listSubject&message=correcto";
            </script>';
        }
    }
    
    //logica del boton de eliminar materia
    static public function eliminatedSubject($id_career,$name_career,$state){
        $id_subject=$_POST['id_subject']; // Obtener id_subject desde el formulario POST
        $delete=SubjectModel::deletedSubject($id_subject); // Cambiar el nombre de la función a la que llamas aquí
        if ($delete) {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            
             window.location="index.php?pages=manageSubject&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=listSubject&message=correcto";
            </script>';
        }
    }
    
    
    

    
}
       




?>