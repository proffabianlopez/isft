<?php 

class GendersController {

	public function gendersSelect() {

		$genders = GendersModel::genders();
		
		foreach ($genders as $key => $value) {
			echo '<option value="'.$value['id_gender'].'">'.$value['details'].'</option>';
		}
		
	}


}