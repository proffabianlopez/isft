<?php
class IndexController {
	
	public function run() {
	
        session_start();
		if(isset($_SESSION['fk_rol_id']) && ($_SESSION['state']==1)){
            include "views/CheckPointHome.php";
        }else{
            include "views/pages/ViewsLogin.php";
        }
		
	}

}

?>