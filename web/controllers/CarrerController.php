<?php 

class CarrerController {

	public function carrerSelect() {

		$showCarrer = CarrerModel::showCarrer();
		
		foreach ($showCarrer as $key => $value) {
			echo '<option value="'.$value['id_carrer'].'">'.$value['carrer_name'].'</option>';
		}
		
	}


}