<?php  
class SubjectController{

    public function yearSelect()
	{

		$showSubject = SubjectModel::showYearSubject();

		foreach ($showSubject as $key => $value) {
			echo '<option value="' . $value['id_year_subject'] . '">' . $value['year'] .'</option>';
		}
	}
    static public function newSubject($id, $name) {
        
        $id_career = base64_decode($id);
        $name = base64_decode($name);
        
    
        if (!empty($_POST['name_subject']) && !empty($_POST['name_subject'])) {			
    
            $name_subject = ucwords(strtolower(trim($_POST['name_subject'])));
            $details_subject = strtolower(trim($_POST['details']));
            $id_year = $_POST['id_year'];
    
            $createNewSubject = SubjectModel::newSubject($name_subject, $details_subject, $id_year, $id_career);
    
          
        }
    }
    
    

}


?>