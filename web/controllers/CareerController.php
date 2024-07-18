<?php

class CareerController
{

	//trae todas las carreras en un select
	public function careerSelect($selectedCareer)
	{
		$showCarrer = CareerModel::showCareer();

		foreach ($showCarrer as $value) {
			$selected = $value['id_career'] == $selectedCareer ? 'selected' : '';
			echo '<option value="' . $value['id_career'] . '" ' . $selected . '>' . $value['career_name'] . '</option>';
		}
	}

	//hace la consulta al modelo para traerme las carreras que administra el preceptor
	public function careerSelectPreceptor($id, $selectedCareer)
	{
		$showCarrer = CareerModel::showCareerPreceptor($id);

		foreach ($showCarrer as $value) {
			$selected = $value['id_career'] == $selectedCareer ? 'selected' : '';
			echo '<option value="' . $value['id_career'] . '" ' . $selected . '>' . $value['career_name'] . '</option>';
		}
	}

	static public function newCareer()
	{
		if ((!empty($_POST['careerName'])) && (!empty($_POST['description'])) &&
			(!empty($_POST['abbreviation']))
		) {
			$careerName = ucwords(trim($_POST['careerName']));
			if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $careerName)) {
				$response["status"] = "error";
            $response["message"] = "El nombre de la carrera sólo puede contener letras y espacios.";
            return $response;
			}

			$description = ucfirst(trim($_POST['description']));
			if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $description)) {
				$response["status"] = "error";
            $response["message"] = "La descripción sólo puede contener letras y espacios.";
            return $response;
			}

			$abbreviation = strtoupper(trim($_POST['abbreviation']));
			if (!preg_match("/^[A-Z]{2}$/", $abbreviation)) {
				$response["status"] = "error";
            $response["message"] = "Abreviación de carrera inválida.";
            return $response;
			}

			$execute = CareerModel::newCareer($careerName, $description, $abbreviation);

			if ($execute) {

				$response['title'] = "¡EXITO!";
				$response["status"] = "successLoad";
				$response["message"] = "Se creó la carrera correctamente.";
				return $response;
			} else {
				$response["status"] = "error";
				$response["message"] = "Hubo un problema al crearla";
				return $response;
			}
		} else {
			$response["status"] = "error";
				$response["message"] = "Debes completar los Campos";
				return $response;
		}
	}

	static public function getCareersData()
	{
		return CareerModel::showCareer();
	}

	static public function getNameCareer($id)
	{
		$id_career = $id;
		return CareerModel::nameCareer($id_career);
	}

	static public function editCareer()
	{
		$id_career = $_POST["idCareer"];

		$careerName = ucwords(trim($_POST['name_career']));
		$title = ucfirst(trim($_POST['title']));
		$abbreviation = strtoupper(trim($_POST['abbreviation']));

		if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $careerName)) {
			$response["status"] = "error";
            $response["message"] = "El nombre de la carrera sólo puede contener letras y espacios.";
            return $response;
		}

		if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $title)) {
			$response["status"] = "error";
            $response["message"] = "El titulo sólo puede contener letras y espacios.";
            return $response;
		}

		$abbreviation = strtoupper(trim($_POST['abbreviation']));
		if (!preg_match("/^[A-Z]{2}$/", $abbreviation)) {
			$response["status"] = "error";
            $response["message"] = "Abreviación de carrera inválida.";
            return $response;
		}

		$execute = CareerModel::editCareer($careerName, $title, $abbreviation, $id_career);

		if ($execute) {
			$response['title'] = "¡Actualizado!";
				$response["status"] = "successCareer";
				$response["message"] = "Se Actualizó la carrera correctamente.";
				return $response;
		}else {
			$response["status"] = "error";
            $response["message"] = "Hubo un problema al Actualizar";
            return $response;
		}
	}



	static public function disableStateCareer()
	{
		$id_career_actual = $_POST['id_career_actual'];
		$execute = CareerModel::disableStateCareer($id_career_actual);

		if ($execute) {
			echo '<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
			window.location="index.php?pages=allCareers";
			</script>
			<div class="alert alert-success mt-2">El estado de la carrera se ha deshabilitado correctamente.</div>';
		} else {
			echo '<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
			</script>
			<div class="alert alert-danger mt-2">No se pudo deshabilitar la carrera.</div>';
		}
	}

	// ejecuta la consulta del modelo de preceptor por carrera
	static public function careerPreceptorController($id)
	{
		return CareerModel::careerPreceptor($id);
	}

	static public function careerPreceptorControllerListAssigned($id)
	{
		return CareerModel::careerPreceptorAssigned($id);
	}
}
