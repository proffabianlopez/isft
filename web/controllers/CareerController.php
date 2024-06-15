<?php

class CareerController
{

	public function careerSelect()
	{

		$showCarrer = CareerModel::showCareer();

		foreach ($showCarrer as $key => $value) {
			echo '<option value="' . $value['id_career'] . '">' . $value['career_name'] . '</option>';
		}
	}

	static public function newCareer()
	{
		if ((!empty($_POST['careerName'])) && (!empty($_POST['description'])) &&
			(!empty($_POST['abbreviation']))
		) {
			$careerName = ucwords(trim($_POST['careerName']));
			if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $careerName)) {
				echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">El nombre de la carrera sólo puede contener letras y espacios.</div>';
				return;
			}

			$description = ucfirst(trim($_POST['description']));
			if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $description)) {
				echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">La descripción sólo puede contener letras y espacios.</div>';
				return;
			}

			$abbreviation = strtoupper(trim($_POST['abbreviation']));
			if (!preg_match("/^[A-Z]{2}$/", $abbreviation)) {
				echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">Abreviación de carrera inválida.</div>';
				return;
			}

			$execute = CareerModel::newCareer($careerName, $description, $abbreviation);

			if ($execute) {
				echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=allCareers&message=correcto";
                </script>
                <div class="alert alert-succes mt-2">Se creó la carrera correctamente.</div>';
			} else {
				echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=newCareer";
                </script>
                <div class="alert alert-danger mt-2">Hubo un problema al crearla.</div>';
			}
		} else {
			echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="alert alert-danger mt-2">Debes completar los campos.</div>';
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

	static public function editCareer($id, $name, $state)
    {
        $id_career = $id;
        $name_career = $name;
        $state_career = $state;
        
        $careerName = ucwords(trim($_POST['name_career']));
        $title = ucfirst(trim($_POST['title']));
        $abbreviation = strtoupper(trim($_POST['abbreviation']));
        
		if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $careerName)) {
			echo '<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
			</script>
			<div class="alert alert-danger mt-2">El nombre de la carrera sólo puede contener letras y espacios.</div>';
			return;
		}

		if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/", $title)) {
			echo '<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
			</script>
			<div class="alert alert-danger mt-2">La descripción sólo puede contener letras y espacios.</div>';
			return;
		}

		$abbreviation = strtoupper(trim($_POST['abbreviation']));
			if (!preg_match("/^[A-Z]{2}$/", $abbreviation)) {
				echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">Abreviación de carrera inválida.</div>';
				return;
			}
  
        $execute = CareerModel::editCareer($careerName, $title, $abbreviation, $id_career);

        if ($execute) {
            // Redireccionar u otro flujo de trabajo después de la actualización exitosa
            echo '<script>window.location.href = "index.php?pages=toolsCareer&id_career=' . $id_career . '&name_career=' . urlencode($name_career) . '&state=' . $state . '";</script>';
        }
    }

	
}
