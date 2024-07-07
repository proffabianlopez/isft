<?php  
class SubjectController{

    //muestra los años de la materia
    public function yearSelect()
	{

		$showSubject = SubjectModel::showYearSubject();

		foreach ($showSubject as $key => $value) {
			echo '<option value="' . $value['id_year_subject'] . '">' . $value['year'] .'</option>';
		}
	}

    //muestra los años de loa materia que no coincidan con el año actual de la materia
    public function yearSelectSubject($currentYearId)
    {
        $showSubject = SubjectModel::showYearSubject();
    
        foreach ($showSubject as $key => $value) {
            if ($value['id_year_subject'] != $currentYearId) {
                echo '<option value="' . $value['id_year_subject'] . '">' . $value['year'] . '</option>';
            }
        }
    }
        

   //logica para crear una nueva materia
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
                echo 
                    '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="alert alert-danger mt-2">El nombre no puede tener caracteres especiales ni ser mayor a 100 caracteres.</div>
                    </div>
                </div>';
                return;
            }                      

            if (!preg_match('/^[0-9]+$/', $details_subject) || strlen($details_subject) > 3) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="alert alert-danger mt-2">La carga horaria debe contener solo números y no más de 3 caracteres.</div>
                    </div>
                </div>';
                return;
            }
            
    
            // Llamar al método del modelo para crear una nueva materia
            $subject = SubjectModel::newSubject($name_subject, $details_subject, $id_year, $id_career);
    
            if ($subject) {
              
               
    
                echo '<script>
                window.location.href = "index.php?pages=manageSubject&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=newSubject&message=correcto";
                </script>';
            } else {
                // Manejo de error si la inserción falla
                echo "La inserción de la materia falló.";
            }
        }
    }
    
    //trae todas las materias existentes de la carrera
    static public function getAllSubject($id){
        return SubjectModel::showSubject($id);

    }
   
    
    //logica para controlar el boton de edicion de materia y poder editar datos
    static public function updateSubject($id_career, $name_career, $state) {
        $name_subject = ucwords(strtolower(trim($_POST['subject_name'])));
        $details_subject = trim($_POST['detail']);
        $id_year=$_POST['id_year'];
        $id_subject = $_POST['id_subject'];
    
        if (!preg_match('/^[A-Za-zÀ-ÿ0-9\s]+$/', $name_subject) || strlen($name_subject) > 100) {
            echo 
                '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="alert alert-danger mt-2">El nombre no puede tener caracteres especiales ni ser mayor a 100 caracteres.</div>
                </div>
            </div>';
            return;
        }                      

        if (!preg_match('/^[0-9]+$/', $details_subject) || strlen($details_subject) > 3) {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="alert alert-danger mt-2">La carga horaria debe contener solo números y no más de 3 caracteres.</div>
                </div>
            </div>';
            return;
        }
     
        $update = SubjectModel::updateSubjectData($name_subject, $details_subject,$id_year,$id_subject);
    
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
            $deleteCorrelative=CorrelativeModel::deleteCorrelativeForSubject($id_subject);
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