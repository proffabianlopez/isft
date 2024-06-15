<?php

class RolesController
{

	public function rolesSelect()
	{

		$roles = RolesModel::roles();

		foreach ($roles as $key => $value) {
			echo '<option value="' . $value['id_rol'] . '">' . $value['name'] . '</option>';
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
