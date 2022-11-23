<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
	$action = "formulairepraticien";
} else {
	$action = $_REQUEST['action'];
}
switch ($action) {
	case 'formulairepraticien': {
			$result = getAllNomMedecins();
			include("vues/v_formulairePraticien.php");
			break;
		}

	case 'afficherpraticien': {
			if (isset($_REQUEST['praticien'])) {
				$prat = $_REQUEST['praticien'];
				$carac = getAllInformationsMedecin($prat);
				if ($carac) {
					include("vues/v_afficherPraticien.php");
				}
			} else {
				$_SESSION['erreur'] = true;
				header("Location: index.php?uc=praticiens&action=formulairepraticien");
			}
			break;
		}

	default: {

			header('Location: index.php?uc=praticiens&action=formulairepraticien');
			break;
		}
}
