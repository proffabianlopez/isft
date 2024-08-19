<?php

class RolesController
{

	public function rolesSelect($selectedRole)
	{
		$roles = RolesModel::roles();

		foreach ($roles as $value) {
			$selected = $value['id_rol'] == $selectedRole ? 'selected' : '';
			echo '<option value="' . $value['id_rol'] . '" ' . $selected . '>' . $value['name'] . '</option>';
		}
	}

	public function allRolesSelect()
	{

		$roles = RolesModel::allRoles();

		foreach ($roles as $key => $value) {
			echo '<option value="' . $value['id_rol'] . '">' . $value['name'] . '</option>';
		}
	}
}
