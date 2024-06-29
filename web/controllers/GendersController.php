<?php

class GendersController
{

	public function gendersSelect($selectedGender)
	{
		$genders = GendersModel::genders();

		foreach ($genders as $gender) {
			$selected = $gender['id_gender'] == $selectedGender ? 'selected' : '';
			echo '<option value="' . $gender['id_gender'] . '" ' . $selected . '>' . $gender['details'] . '</option>';
		}
	}
}
