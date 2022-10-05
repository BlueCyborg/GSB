<?php
if (!isset($_REQUEST['action']) || empty($_REQUEST['action'])) {
	$action = "formulairepraticien";
} else {
	$action = $_REQUEST['action'];
}
switch ($action) {
	case 'formulairepraticien': {

			$result = getAllNomPraticiens();
            var_dump($result);
			include("vues/v_formulairePraticien.php");
			break;
		}

	case 'afficherpraticien': {

			if (isset($_REQUEST['praticien']) && getAllInformationPraticiens($_REQUEST['praticien'])) {
				$prat = $_REQUEST['praticien'];
				$carac = getAllInformationPraticiens($prat);
				if (empty($carac[7])) {
					$carac[7] = 'Non défini(e)';
				}
				include("vues/v_afficherPraticiens.php");
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
?>